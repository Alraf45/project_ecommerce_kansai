<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kamu masih kosong!');
        }

        // Hitung total harga
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // (Opsional) Simpan ke database: order, order_items, dll.

        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        // Kembalikan ke halaman sukses
        return redirect()->route('checkout.success')->with('success', 'Checkout berhasil! Terima kasih sudah berbelanja.');
    }

    public function success()
    {
        return view('cart.success');
    }
}
