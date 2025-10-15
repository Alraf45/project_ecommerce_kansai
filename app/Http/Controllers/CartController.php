<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // 🛒 Tampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->getCartTotal();
        return view('cart.index', compact('cart', 'total'));
    }

    // ➕ Tambah produk ke keranjang
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Cek apakah produk sudah ada di keranjang
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image ?? null,
            ];
        }

        // Simpan ke session
        session()->put('cart', $cart);

        // Jika lewat AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "{$product->name} berhasil ditambahkan ke keranjang!",
                'cart_count' => $this->getCartCount(),
                'cart_total' => number_format($this->getCartTotal(), 0, ',', '.'),
            ]);
        }

        // Jika bukan AJAX
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // 🔢 Update jumlah produk
    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $request->quantity);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    // ❌ Hapus produk dari keranjang
    public function removeItem($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    // 🔒 Helper: jumlah total item
    private function getCartCount()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }

    // 💰 Helper: total harga
    private function getCartTotal()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    }

    // 🧾 Checkout Page
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang masih kosong!');
        }

        return view('cart.checkout', compact('cart'));
    }

    // 💳 Proses Checkout
    public function processCheckout(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // (Simulasi) Simpan pesanan ke database
        // TODO: buat tabel orders + order_items nanti

        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        return redirect('/')->with('success', 'Pesanan kamu berhasil diproses! 🎉');
    }
}
