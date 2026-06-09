<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OrderController;

// ANA SAYFA - Ürün Listeleme
Route::get('/', function (Request $request) {
    $query = Product::query();
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }
    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%');
    }
    $products = $query->get();
    $categories = Category::all();
    return view('index', compact('products', 'categories'));
});

// ADMIN PANELİ - Yetkili Erişim
Route::middleware(['auth'])->group(function () {
    // Admin Paneli Ana Sayfası (Dashboard)
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('admin/products', ProductController::class)->names('admin.products');
    Route::resource('admin/categories', CategoryController::class)->names('admin.categories');
    
    Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::delete('admin/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});

// SEPET VE ÖDEME ROTALARI
Route::get('/cart/add/{id}', [CartController::class, 'add']);
Route::get('/cart/remove/{id}', [CartController::class, 'remove']);
Route::get('/sepetim', [CartController::class, 'index']);
Route::get('/odeme', function (Request $request) {
    $method = $request->query('method', 'kart');
    return view('odeme', ['method' => $method]);
});
Route::post('/siparis-tamamla', [CartController::class, 'checkoutComplete']);

// GİRİŞ ROTALARI
require __DIR__.'/auth.php';