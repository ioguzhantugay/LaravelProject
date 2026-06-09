<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // Kategori modelini ekledik
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Kategorileri çekip view dosyasına gönderiyoruz
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Kategori seçimi zorunlu
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id; // Kategori ID'sini kaydediyoruz
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img/products'), $imageName);
            $product->image = 'img/products/'.$imageName;
        }

        $product->save();

        return redirect('/admin/products')->with('success', 'Ürün başarıyla eklendi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Düzenleme ekranında da kategorileri listelememiz lazım
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Ürün bilgilerini güncelle
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id; // Kategori ID'sini güncelliyoruz

        // Eğer yeni bir resim yüklediyse güncelle
        if ($request->hasFile('image')) {
            if($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img/products'), $imageName);
            $product->image = 'img/products/'.$imageName;
        }

        $product->save();

        return redirect('/admin/products')->with('success', 'Ürün başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect('/admin/products')->with('success', 'Ürün başarıyla silindi!');
    }
}