<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class RiwayatOrderController extends Controller
{
    /**
     * Tampilkan semua pesanan (riwayat order)
     */
    public function index()
    {
        // Ambil semua pesanan terbaru beserta relasi user & items
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Tampilkan detail dari satu pesanan
     */
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status pesanan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()
            ->route('admin.orders.show', $id)
            ->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
