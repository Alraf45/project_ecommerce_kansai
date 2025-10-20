<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 🛒 Halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('cart.index', compact('cart', 'total'));
    }

    // ➕ Tambah ke keranjang
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404);

        $cart = session()->get('cart', []);
        $qty = $request->input('quantity', 1);
        if (isset($cart[$id])) $cart[$id]['quantity'] += $qty;
        else $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => asset('img/products/' . basename($product->image)),
            'quantity' => $qty,
        ];
        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => "{$product->name} berhasil ditambahkan!", 'count' => collect($cart)->sum('quantity')]);
    }

    // ✏️ Update quantity
    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $request->input('quantity', 1));
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui.');
    }

    // ❌ Hapus item / kosongkan keranjang
    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        if ($id === 'all') session()->forget('cart');
        elseif (isset($cart[$id])) { unset($cart[$id]); session()->put('cart', $cart); }
        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }

    // 💳 Halaman checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart.index')->with('warning', 'Keranjang kosong!');
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('cart.checkout', compact('cart', 'total'));
    }

    // ✅ Proses checkout
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart.index')->with('warning', 'Keranjang kosong!');

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $ongkir = 12000;
        $total = $subtotal + $ongkir;

        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'name'    => $request->name,
            'address' => $request->address,
            'phone'   => $request->phone,
            'total'   => $total,
            'status'  => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('cart.success')->with('success', 'Pesanan berhasil dibuat!');
    }

    // 🎉 Halaman sukses
    public function success()
    {
        return view('cart.success');
    }
}
