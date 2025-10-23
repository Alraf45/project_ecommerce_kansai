<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * 🧾 Tampilkan daftar pesanan milik user yang sedang login
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * 📄 Tampilkan detail pesanan tertentu milik user
     */
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id()) // keamanan: hanya bisa lihat pesanan sendiri
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
