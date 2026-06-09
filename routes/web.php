<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoryController; // Kategori controller'ı dahil ettik

// ANA SAYFA
Route::get('/', function () {
    $products = Product::all();
    return view('index', ['products' => $products]);
});

// ADMIN PANELİ - ÜRÜNLER
Route::resource('admin/products', ProductController::class);

// ADMIN PANELİ - KATEGORİLER (Yeni eklediğimiz rota)
Route::resource('admin/categories', CategoryController::class);