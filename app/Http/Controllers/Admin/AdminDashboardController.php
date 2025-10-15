<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pages = 'dashboard';
        $products = Product::all();
        $users = User::all(); // ✅ tambahkan ini

        return view('admin.dashboard', compact('pages', 'products', 'users'));
    }
}
