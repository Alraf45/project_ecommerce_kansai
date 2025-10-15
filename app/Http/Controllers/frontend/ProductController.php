<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index()
{
    $categories = \App\Models\Category::all(); // ambil kategori dari DB
    $products = \App\Models\Product::all(); // ambil semua produk

    return view('layouts.products.index', compact('categories', 'products'));
}


    public function show(Product $product)
    {
        return view('layouts.products.show', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhereHas('category', fn($q) => $q->where('name', 'LIKE', "%{$query}%"))
            ->orWhereHas('color', fn($q) => $q->where('name', 'LIKE', "%{$query}%"))
            ->get();

        return view('layouts.products.search_results', compact('products', 'query'));
    }
}
