<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Yeni ürün nesnesi oluştur
        $product = new Product();
        $product->title       = $request->title;
        $product->price       = $request->price;
        $product->stock       = $request->stock; // Stok kesinlikle buraya atanıyor
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/products'), $imageName);
            $product->image = 'img/products/' . $imageName;
        }

        $product->save(); // Veritabanına kaydet

        return redirect('/admin/products')->with('success', 'Ürün başarıyla eklendi!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product'    => $product,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mevcut ürünü güncelle
        $product->title       = $request->title;
        $product->price       = $request->price;
        $product->stock       = $request->stock;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }
            
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/products'), $imageName);
            $product->image = 'img/products/' . $imageName;
        }

        $product->save();

        return redirect('/admin/products')->with('success', 'Ürün başarıyla güncellendi!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        $product->delete();

        return redirect('/admin/products')->with('success', 'Ürün başarıyla silindi!');
    }
}