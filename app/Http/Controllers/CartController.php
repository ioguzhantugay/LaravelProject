<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function add(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "title"    => $product->title,
                "quantity" => 1,
                "price"    => $product->price,
                "image"    => $product->image
            ];
        }

        session()->put('cart', $cart);
        session()->save(); 

        return back()->with('success', 'Ürün sepete başarıyla eklendi!');
    }

    public function index() 
    {
        $cart = session()->get('cart', []);
        $recommendedProducts = Product::inRandomOrder()->limit(4)->get();
        return view('sepetim', compact('cart', 'recommendedProducts'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->save();
        }
        return back()->with('success', 'Ürün sepetten kaldırıldı!');
    }

    public function checkoutComplete(Request $request)
    {
        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect('/sepetim')->with('error', 'Sepetiniz boş!');
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'name'           => $request->name,
                'surname'        => $request->surname,
                'phone'          => $request->phone,
                'city'           => $request->city,
                'district'       => $request->district,
                'address_detail' => $request->address_detail,
                'payment_method' => $request->payment_method ?? 'kapida',
                'total_amount'   => array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)),
            ]);

            foreach ($cart as $id => $item) {
                $product = Product::lockForUpdate()->find($id);

                if (!$product) {
                    throw new \Exception("Ürün veritabanında bulunamadı.");
                }

                // GÜVENLİ STOK KONTROLÜ
                // Veritabanı değeri boşsa 0 kabul et
                $dbStock = (int)($product->stock ?? 0);
                $cartQty = (int)$item['quantity'];

                if ($dbStock < $cartQty) {
                    throw new \Exception($item['title'] . ' için stok yetersiz. Mevcut Stok: ' . $dbStock);
                }

                // Stok güncelleme
                $product->stock = $dbStock - $cartQty;
                $product->save();

                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_title' => $item['title'],
                    'quantity'      => $item['quantity'],
                    'price'         => $item['price'],
                ]);
            }

            DB::commit();
            session()->forget('cart');
            session()->save();

            return redirect('/')->with('success', 'Siparişiniz başarıyla alındı!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Sipariş Hatası: ' . $e->getMessage());
            return redirect('/sepetim')->with('error', 'Hata: ' . $e->getMessage());
        }
    }
}