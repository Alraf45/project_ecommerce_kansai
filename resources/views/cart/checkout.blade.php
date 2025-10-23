<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | Kansai Paint</title>

  <!-- Tailwind & Font Awesome -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- 🔷 HEADER -->
  <header class="flex items-center justify-between bg-white px-8 py-4 shadow-md border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
    <!-- 🔹 Logo -->
    <div class="flex items-center space-x-3">
      <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700 focus:outline-none md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <img src="/img/logo.png" alt="Kansai Paint Logo" class="h-14">
    </div>

    <!-- 🔹 Kembali ke Keranjang -->
    <div class="flex items-center">
      <a href="{{ url('cart') }}" 
         class="text-blue-900 font-semibold hover:text-blue-700 transition-colors duration-200 flex items-center gap-2">
         <i class="fa-solid text-blue-700"></i>
        <span>🛒 Kembali ke Keranjang</span>
      </a>
    </div>
  </header>

  <!-- 🧾 MAIN CONTENT -->
  <main class="pt-32 pb-20 px-6 lg:px-10 max-w-7xl mx-auto"> 
    <!-- ✅ pt-32 agar tidak ketutup header -->
    <form action="{{ route('cart.processCheckout') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-10">
      @csrf

      <!-- 🏠 DATA PENGIRIMAN -->
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
            class="w-full border border-gray-300 p-3 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            required>
        </div>

        <!-- Alamat Lengkap -->
        <div>
          <label class="block font-semibold mb-2">Alamat Lengkap</label>
          <textarea 
            name="address" 
            rows="4" 
            class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" 
            placeholder="Masukkan alamat lengkap Anda..." 
            required>{{ old('address') }}</textarea>
        </div>

        <!-- Nomor HP -->
        <div>
          <label class="block font-semibold mb-2">Nomor HP</label>
          <input 
            type="text" 
            name="phone" 
            value="{{ old('phone') }}" 
            class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" 
            placeholder="Masukkan nomor HP..." 
            required>
        </div>

        <!-- 💳 Metode Pembayaran -->
        <div>
          <h2 class="text-2xl font-bold mb-4 text-blue-800 flex items-center gap-2">
            <i class="fa-solid fa-money-bill-wave"></i> Pilih Metode Pembayaran
          </h2>

          <div class="space-y-4">
            <!-- Transfer Bank -->
            <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
              <input type="radio" name="payment_method" value="bank_transfer" class="form-radio h-5 w-5 text-blue-600" checked>
              <div>
                <p class="font-semibold text-gray-900">Transfer Bank</p>
                <p class="text-sm text-gray-500">Transfer ke rekening kami.</p>
              </div>
            </label>

            <!-- E-Wallet -->
            <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
              <input type="radio" name="payment_method" value="e_wallet" class="form-radio h-5 w-5 text-blue-600">
              <div>
                <p class="font-semibold text-gray-900">E-Wallet</p>
                <p class="text-sm text-gray-500">Bayar menggunakan OVO, GoPay, Dana, dll.</p>
              </div>
            </label>

            <!-- COD -->
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

      <!-- 🧮 RINGKASAN PESANAN -->
      <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 h-fit sticky top-32 space-y-6">
        <h2 class="text-2xl font-bold mb-4 text-blue-800 flex items-center gap-2">
          <i class="fa-solid fa-bag-shopping"></i> Ringkasan Pesanan
        </h2>

        <!-- Daftar Produk -->
        <div class="divide-y divide-gray-200 mb-4">
          @foreach(session('cart') as $item)
            <div class="flex justify-between py-3 items-center">
              <div class="flex items-center gap-3">
                <div class="w-14 h-14 rounded-lg overflow-hidden border bg-gray-50">
                  <img 
                    src="{{ asset('img/products/' . basename($item['image'])) }}" 
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

        <!-- Perhitungan -->
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

        <!-- Tombol Konfirmasi -->
        <button type="submit" 
          class="mt-6 w-full bg-blue-900 text-white py-3 rounded-xl hover:bg-blue-800 transition font-semibold flex items-center justify-center gap-2">
          <i class="fa-solid fa-paper-plane"></i> Konfirmasi & Proses Pembayaran
        </button>
      </div>
    </form>
  </main>

  <!-- 🦶 FOOTER -->
  <footer class="bg-blue-900 mt-20 border-t py-6 text-center text-sm text-white">
    © 2025 Kansai Paint. All rights reserved.
  </footer>

</body>
</html>
