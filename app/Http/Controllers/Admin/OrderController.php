<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tüm siparişleri listeler.
     */
    public function index()
    {
        // En yeni siparişler en üstte görünecek
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Sipariş detaylarını ve içindeki ürünleri gösterir.
     */
    public function show($id)
    {
        // Siparişi, içindeki ürünlerle (items ilişkisiyle) birlikte getir
        $order = Order::with('items')->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Siparişi veritabanından siler.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return redirect()->route('admin.orders')->with('success', 'Sipariş başarıyla silindi.');
    }
}