<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // 🔍 Cari produk berdasarkan nama saja
        $products = Product::where('name', 'like', "%{$query}%")->get();

        // Ambil semua kategori (kalau mau tampilkan filter di halaman)
        $categories = Category::all();

        // Arahkan ke tampilan pencarian
        return view('layouts.searchs.index', compact('products', 'query', 'categories'));
    }
}
