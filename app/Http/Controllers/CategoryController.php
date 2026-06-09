<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create($request->all());
        return back()->with('success', 'Kategori eklendi!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori silindi!');
    }
}