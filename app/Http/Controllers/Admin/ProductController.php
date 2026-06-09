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
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/products'), $imageName);
            $data['image'] = 'img/products/' . $imageName;
        }

        Product::create($data);

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
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }
            
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/products'), $imageName);
            $data['image'] = 'img/products/' . $imageName;
        }

        $product->update($data);

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