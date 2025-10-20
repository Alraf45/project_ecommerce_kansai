<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // 1) Ambil query dari input form
        $query = trim($request->input('query', ''));

        // 2) Jika query kosong -> tampilkan semua produk
        if ($query === '') {
            $products = Product::all();
        } 
        // 3) Jika query ada -> filter pakai LIKE
        else {
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        }

        // 4) Kirim data ke view product.blade.php
        return view('layouts.products.index', compact('products'));
    }
}
