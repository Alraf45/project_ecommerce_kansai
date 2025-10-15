<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | Kansai Paint</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

<div class="container mx-auto py-12 px-6 lg:px-16">
    <h1 class="text-4xl font-extrabold text-blue-900 mb-10 flex items-center gap-3">
        <i class="fa-solid fa-cart-shopping"></i> Keranjang Belanja
    </h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded-lg mb-8 shadow">
            {{ session('success') }}
        </div>
    @endif

    @if (empty($cart))
        <div class="bg-white shadow-xl rounded-2xl p-10 text-center">
            <p class="text-gray-600 text-lg mb-6">Keranjangmu masih kosong 😔</p>
            <a href="{{ url('/') }}" class="inline-block bg-blue-700 text-white px-8 py-3 rounded-xl hover:bg-blue-800 transition">
                Lanjut Belanja
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- 🧱 Daftar Produk -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                @foreach ($cart as $id => $item)
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-200 pb-6 mb-6 last:border-none last:pb-0 last:mb-0">
                        
                        <!-- Gambar -->
                        <div class="flex items-center gap-5">
                            <div class="w-24 h-24 rounded-xl overflow-hidden border shadow-sm bg-gray-50">
                                @if ($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                                @else
                                    <img src="https://via.placeholder.com/150" alt="No Image" class="w-full h-full object-cover">
                                @endif
                            </div>

                            <div>
                                <h2 class="text-lg font-bold text-gray-900">{{ $item['name'] }}</h2>
                                <p class="text-gray-500 text-sm">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                <p class="text-gray-700 mt-1">
                                    Subtotal: <span class="text-blue-700 font-semibold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Aksi -->
                        <div class="mt-4 sm:mt-0 flex items-center gap-3">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    class="w-14 border rounded-lg text-center focus:ring-2 focus:ring-blue-500 focus:outline-none py-1" />
                                <button type="submit" class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </form>

                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 💳 Ringkasan Belanja -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 h-fit">
                <h2 class="text-2xl font-bold mb-5 text-blue-900">Ringkasan Belanja</h2>

                @php $grandTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)); @endphp

                <div class="space-y-3 text-gray-700 mb-6">
                    <div class="flex justify-between">
                        <span>Total Item</span>
                        <span>{{ count($cart) }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-semibold border-t pt-3">
                        <span>Total</span>
                        <span class="text-blue-700">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 transition font-semibold">
                            <i class="fa-solid fa-credit-card mr-2"></i> Lanjut ke Checkout
                        </button>
                    </form>

                    <form action="{{ route('cart.remove', 'all') }}" method="POST" onsubmit="return confirm('Kosongkan keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-gray-200 text-gray-700 py-3 rounded-xl hover:bg-gray-300 transition font-semibold">
                            <i class="fa-solid fa-trash-can mr-2"></i> Kosongkan Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

</body>
</html>
