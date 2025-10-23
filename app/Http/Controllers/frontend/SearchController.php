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
        // Ambil kata kunci dari input form
        $keyword = $request->input('query');

        // 🔍 Cari produk berdasarkan nama saja
        $products = Product::query()
            ->when($keyword, function ($queryBuilder) use ($keyword) {
                $queryBuilder->where('name', 'like', "%{$keyword}%");
            })
            ->paginate(12) // pagination biar gak berat
            ->appends(['query' => $keyword]); // biar keyword tetap muncul di URL

        // Ambil semua kategori (kalau mau tampilkan filter di halaman)
        $categories = Category::all();

        // Kirim data ke view
        return view('layouts.searchs.index', compact('products', 'keyword', 'categories'));
    }
}
