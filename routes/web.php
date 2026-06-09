<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;

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

    // Kullanıcının favorilerini güvenli bir şekilde dizi olarak alıyoruz
    $userFavorites = auth()->check() ? auth()->user()->favorites()->pluck('product_id')->toArray() : [];

    $cartTotal = 0;
    if (session('cart')) {
        foreach (session('cart') as $details) {
            $cartTotal += $details['price'] * ($details['quantity'] ?? 1);
        }
    }

    return view('index', compact('products', 'categories', 'cartTotal', 'userFavorites'));
});

// ADMIN PANELİ
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class)->names('admin.products');
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
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

// PROFİL, GİRİŞ VE FAVORİ ROTALARI
Route::middleware(['auth'])->group(function () {
    Route::get('/profilim', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profilim', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profilim', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Favori Rotaları
    Route::post('/favorites/toggle/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorilerim', [FavoriteController::class, 'index'])->name('favorites.index');
});

require __DIR__.'/auth.php';