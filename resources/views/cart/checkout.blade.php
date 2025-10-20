<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | Kansai Paint</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
    <h1 class="text-2xl font-bold text-blue-900 flex items-center gap-2">
      <i class="fa-solid fa-credit-card"></i> Checkout
    </h1>
    <a href="{{ url('/') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke Beranda</a>
  </div>
</header>

<!-- Main Content -->
<div class="max-w-7xl mx-auto py-12 px-6 lg:px-10">
  <form action="{{ route('cart.processCheckout') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf

    <!-- Data Pengiriman -->
    <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-md border border-gray-100 space-y-6">
      <h2 class="text-2xl font-bold text-blue-800 flex items-center gap-2">
        <i class="fa-solid fa-truck"></i> Data Pengiriman
      </h2>

      <!-- Nama Penerima -->
      <div>
        <label class="block font-semibold mb-2">Nama Penerima</label>
        <input 
          type="text" 
          name="name" 
          value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}" 
          class="w-full border p-3 rounded-lg bg-gray-50" 
          required
        >
      </div>

      <!-- Alamat Lengkap -->
      <div>
        <label class="block font-semibold mb-2">Alamat Lengkap</label>
        <textarea name="address" rows="4" 
          class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" 
          placeholder="Masukkan alamat lengkap Anda..." required>{{ old('address') }}</textarea>
      </div>

      <!-- Nomor HP -->
      <div>
        <label class="block font-semibold mb-2">Nomor HP</label>
        <input type="text" name="phone" 
          value="{{ old('phone') }}"
          class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" 
          placeholder="Masukkan nomor HP..." required
        >
      </div>

      <!-- Metode Pembayaran -->
      <div>
        <h2 class="text-2xl font-bold mb-4 text-blue-800 flex items-center gap-2">
          <i class="fa-solid fa-money-bill-wave"></i> Pilih Metode Pembayaran
        </h2>
        <div class="space-y-4">
          <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
            <input type="radio" name="payment_method" value="bank_transfer" class="form-radio h-5 w-5 text-blue-600" checked>
            <div>
              <p class="font-semibold text-gray-900">Transfer Bank</p>
              <p class="text-sm text-gray-500">Transfer ke rekening kami.</p>
            </div>
          </label>
          <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
            <input type="radio" name="payment_method" value="e_wallet" class="form-radio h-5 w-5 text-blue-600">
            <div>
              <p class="font-semibold text-gray-900">E-Wallet</p>
              <p class="text-sm text-gray-500">Bayar menggunakan OVO, GoPay, Dana, dll.</p>
            </div>
          </label>
          <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
            <input type="radio" name="payment_method" value="cod" class="form-radio h-5 w-5 text-blue-600">
            <div>
              <p class="font-semibold text-gray-900">Cash on Delivery (COD)</p>
              <p class="text-sm text-gray-500">Bayar langsung saat barang diterima.</p>
            </div>
          </label>
        </div>
      </div>
    </div>

    <!-- Ringkasan Pesanan -->
    <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 h-fit sticky top-28 space-y-6">
      <h2 class="text-2xl font-bold mb-4 text-blue-800 flex items-center gap-2">
        <i class="fa-solid fa-bag-shopping"></i> Ringkasan Pesanan
      </h2>

      <div class="divide-y divide-gray-200 mb-4">
        @foreach(session('cart') as $item)
          <div class="flex justify-between py-3 items-center">
            <div class="flex items-center gap-3">
              <div class="w-14 h-14 rounded-lg overflow-hidden border bg-gray-50">
                <img src="{{ asset('img/products/' . basename($item['image'])) }}" 
                     alt="{{ $item['name'] }}" 
                     class="w-full h-full object-contain"
                     onerror="this.onerror=null; this.src='https://via.placeholder.com/80';">
              </div>
              <div>
                <p class="font-medium text-gray-900">{{ $item['name'] }}</p>
                <p class="text-sm text-gray-500">x{{ $item['quantity'] }}</p>
              </div>
            </div>
            <p class="font-semibold text-blue-700">
              Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
            </p>
          </div>
        @endforeach
      </div>

      @php 
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart')));
        $ongkir = 12000;
      @endphp

      <div class="border-t pt-4 mt-3 space-y-2">
        <div class="flex justify-between text-gray-700">
          <span>Subtotal</span>
          <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
          <span>Ongkir</span>
          <span>Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-lg font-bold text-blue-900 border-t pt-3">
          <span>Total Bayar</span>
          <span>Rp {{ number_format($subtotal + $ongkir, 0, ',', '.') }}</span>
        </div>
      </div>

      <button type="submit" 
        class="mt-6 w-full bg-blue-900 text-white py-3 rounded-xl hover:bg-blue-800 transition font-semibold flex items-center justify-center gap-2">
        <i class="fa-solid fa-paper-plane"></i> Konfirmasi & Proses Pembayaran
      </button>
    </div>
  </form>
</div>

<!-- Footer -->
<footer class="bg-white mt-16 border-t py-6 text-center text-sm text-gray-500">
  © 2025 Kansai Paint. All rights reserved.
</footer>

</body>
</html>
