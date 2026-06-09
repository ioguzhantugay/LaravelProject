<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Kullanıcının favorilerini listeler.
     */
    public function index()
    {
        // Kullanıcının favorilerini, ürün bilgileriyle (Product) birlikte çekiyoruz
        $favorites = Auth::user()->favorites()->with('product')->get();
        
        return view('favorites', compact('favorites'));
    }

    /**
     * Favoriye ekleme veya çıkarma işlemi (toggle).
     */
    public function toggle(Product $product)
    {
        $user = Auth::user();

        // Ürün zaten favorilerde mi kontrol ediyoruz
        $favorite = $user->favorites()->where('product_id', $product->id)->first();

        if ($favorite) {
            // Varsa sil
            $favorite->delete();
            return back()->with('success', 'Ürün favorilerden kaldırıldı.');
        } else {
            // Yoksa ekle
            $user->favorites()->create([
                'product_id' => $product->id
            ]);
            return back()->with('success', 'Ürün favorilere eklendi.');
        }
    }
}