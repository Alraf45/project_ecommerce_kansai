<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // 🏠 Semua produk
    public function index()
    {
        $products = Product::with(['category', 'colors'])->get();
        $categories = Category::all();

        return view('layouts.products.index', compact('products', 'categories'));
    }

    // 🔍 Detail produk
    public function show(Product $product)
    {
        $product->load('colors');

        return view('layouts.products.show', compact('product'));
    }

    // ⭐ Produk Premium
    public function premium()
    {
        $products = Product::with(['category', 'colors'])
            ->where('category_id', Category::where('name','Premium')->first()->id)
            ->get();

        $categories = Category::all();

        return view('layouts.products.category.premium', compact('products', 'categories'));
    }

    // 🏠 Produk Interior
    public function interior()
    {
        $products = Product::with(['category', 'colors'])
            ->where('category_id', Category::where('name','Interior')->first()->id)
            ->get();

        $categories = Category::all();

        return view('layouts.products.category.interior', compact('products', 'categories'));
    }

    // 🌳 Produk Eksterior
    public function eksterior()
    {
        $products = Product::with(['category', 'colors'])
            ->where('category_id', Category::where('name','Eksterior')->first()->id)
            ->get();

        $categories = Category::all();

        return view('layouts.products.category.eksterior', compact('products', 'categories'));
    }

    // 🪵 Produk Kayu & Besi
    public function kayubesi()
    {
        $products = Product::with(['category', 'colors'])
            ->where('category_id', Category::where('name','Kayu & Besi')->first()->id)
            ->get();

        $categories = Category::all();

        return view('layouts.products.category.kayubesi', compact('products', 'categories'));
    }
}
