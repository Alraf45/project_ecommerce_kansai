<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Kansai Paint</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto py-12 px-6 lg:px-16">
        <!-- Header -->
        <h1 class="text-4xl font-extrabold text-blue-900 mb-10 flex items-center gap-3">
            <i class="fa-solid fa-credit-card"></i> Checkout
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- 🧾 Formulir Pengiriman -->
            <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <h2 class="text-2xl font-bold mb-6 text-blue-900">Informasi Pembeli</h2>

                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="name" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 px-4 py-2 outline-none">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 px-4 py-2 outline-none">
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="3" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 px-4 py-2 outline-none"></textarea>
                    </div>

                    <!-- Kota -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Kota</label>
                        <input type="text" name="city" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 px-4 py-2 outline-none">
                    </div>

                    <!-- Metode Pembayaran -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Metode Pembayaran</label>
                        <select name="payment_method" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 px-4 py-2 outline-none">
                            <option value="transfer">Transfer Bank</option>
                            <option value="cod">COD (Bayar di Tempat)</option>
                            <option value="ewallet">E-Wallet (OVO, DANA, GoPay)</option>
                        </select>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-xl transition">
                            <i class="fa-solid fa-check mr-2"></i> Proses Pembayaran
                        </button>
                    </div>
                </form>
            </div>

            <!-- 💰 Ringkasan Pesanan -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 h-fit">
                <h2 class="text-2xl font-bold mb-4 text-blue-900">Ringkasan Pesanan</h2>

                @php $grandTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)); @endphp

                <div class="divide-y divide-gray-200 mb-4">
                    @foreach ($cart as $item)
                        <div class="flex justify-between py-2 text-sm">
                            <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                            <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between font-semibold text-lg text-gray-800 border-t pt-3">
                    <span>Total</span>
                    <span class="text-blue-700">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>

                <div class="mt-6">
                    <a href="{{ url('/cart') }}" class="block text-center bg-gray-200 text-gray-700 py-3 rounded-xl hover:bg-gray-300 transition">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
