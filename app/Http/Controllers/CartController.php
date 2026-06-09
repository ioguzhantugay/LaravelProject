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

        // Arayüzden gelen adet (quantity) bilgisini alıyoruz, seçilmediyse veya hatalıysa 1 kabul ediyoruz
        $qty = (int) $request->input('quantity', 1);
        if ($qty < 1) {
            $qty = 1;
        }

        if(isset($cart[$id])) {
            // Önceden sepette varsa, yeni seçilen adeti üzerine ekliyoruz
            $cart[$id]['quantity'] += $qty;
        } else {
            // İlk defa ekleniyorsa seçilen adetle birlikte ekliyoruz
            $cart[$id] = [
                "id"       => $product->id,
                "title"    => $product->title,
                "quantity" => $qty,
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
        
        $cartTotal = 0;
        $cartItems = collect(); 
        
        foreach($cart as $id => $details) {
            $cartTotal += $details['price'] * $details['quantity'];
            
            // HATA ÇÖZÜMÜ: Eğer hafızada kalan eski ürünlerde 'id' yoksa, otomatik ekle
            if (!isset($details['id'])) {
                $details['id'] = $id;
            }

            $cartItems->push((object) $details);
        }

        $recommendedProducts = Product::inRandomOrder()->limit(4)->get();
        
        return view('sepetim', compact('cart', 'cartItems', 'cartTotal', 'recommendedProducts'));
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

                $dbStock = (int)($product->stock ?? 0);
                $cartQty = (int)$item['quantity'];

                if ($dbStock < $cartQty) {
                    throw new \Exception($item['title'] . ' için stok yetersiz. Mevcut Stok: ' . $dbStock);
                }

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