<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Belanja | Kansai Paint</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
    <img src="/img/logo.png" alt="Kansai Paint Logo" class="h-14">
  </div>

  <!-- 🔹 Kembali ke Beranda -->
  <div class="flex items-center">
    <a href="{{ url('/') }}" 
       class="text-blue-700 font-semibold hover:text-blue-900 transition-colors duration-200 flex items-center gap-2">
      <i class="fa-solid fa-house text-blue-700"></i>
      <span>Kembali ke Beranda</span>
    </a>
  </div>
</header>


  <!-- 🛍️ KONTEN UTAMA -->
  <div class="max-w-7xl mx-auto py-10 px-6 lg:px-10 mt-24">

    {{-- ✅ Pesan sukses --}}
    @if (session('success'))
      <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded-lg mb-8 shadow">
        {{ session('success') }}
      </div>
    @endif

    {{-- ✅ Jika keranjang kosong --}}
    @if (empty($cart))
      <div class="bg-white shadow-xl rounded-2xl p-10 text-center">
        <p class="text-gray-600 text-lg mb-6">Keranjangmu masih kosong 😔</p>
        <a href="{{ url('/') }}" 
           class="inline-block bg-blue-700 text-white px-8 py-3 rounded-xl hover:bg-blue-800 transition">
          Lanjut Belanja
        </a>
      </div>

    @else
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- 🧱 Daftar Produk -->
        <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-md border border-gray-100">
          @foreach ($cart as $id => $item)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-200 
                        pb-6 mb-6 last:border-none last:pb-0 last:mb-0 transition-all hover:scale-[1.01] 
                        hover:shadow-sm duration-200">

              <!-- 🖼️ Gambar Produk -->
              <div class="flex items-center gap-5">
                <div class="w-24 h-24 rounded-xl overflow-hidden border bg-gray-50 flex items-center justify-center">
                  <img src="{{ asset('img/products/' . basename($item['image'])) }}" 
                       alt="{{ $item['name'] }}" 
                       class="w-full h-full object-contain transition-transform hover:scale-105"
                       onerror="this.onerror=null; this.src='https://via.placeholder.com/150';">
                </div>

                <div>
                  <h2 class="text-lg font-bold text-gray-900">{{ $item['name'] }}</h2>
                  <p class="text-gray-500 text-sm">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                  <p class="text-gray-700 mt-1 subtotal" data-id="{{ $id }}">
                    Subtotal:
                    <span class="text-blue-700 font-semibold">
                      Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                    </span>
                  </p>
                </div>
              </div>

              <!-- 🔢 Input Quantity + 🗑️ Hapus -->
              <div class="mt-4 sm:mt-0 flex items-center gap-3">
                <input 
                  type="number" 
                  name="quantity" 
                  value="{{ $item['quantity'] }}" 
                  min="1"
                  class="w-16 border rounded-lg text-center focus:ring-2 focus:ring-blue-500 
                         focus:outline-none py-1 quantity-input shadow-sm"
                  data-id="{{ $id }}" 
                  data-price="{{ $item['price'] }}"
                />

                <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition shadow-sm">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>

        <!-- 💳 Ringkasan Belanja -->
        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 h-fit sticky top-28">
          <h2 class="text-2xl font-bold mb-5 text-blue-900 flex items-center gap-2">
            <i class="fa-solid fa-receipt"></i> Ringkasan Belanja
          </h2>

          @php 
            $grandTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)); 
          @endphp

          <div class="space-y-3 text-gray-700 mb-6">
            <div class="flex justify-between">
              <span>Total Item</span>
              <span id="total-items">{{ count($cart) }}</span>
            </div>
            <div class="flex justify-between text-lg font-semibold border-t pt-3">
              <span>Total</span>
              <span class="text-blue-700" id="grand-total">
                Rp {{ number_format($grandTotal, 0, ',', '.') }}
              </span>
            </div>
          </div>

          <!-- 🔘 Tombol Aksi -->
          <div class="space-y-3">
            <a href="{{ route('cart.checkout') }}" 
               class="block text-center bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 
                      transition font-semibold shadow-md hover:shadow-lg">
              <i class="fa-solid fa-credit-card mr-2"></i> Lanjut ke Checkout
            </a>

            <form action="{{ route('cart.remove', 'all') }}" method="POST" onsubmit="return confirm('Kosongkan keranjang?')">
              @csrf
              @method('DELETE')
              <button type="submit" 
                      class="w-full bg-gray-200 text-gray-700 py-3 rounded-xl hover:bg-gray-300 
                             transition font-semibold shadow-sm hover:shadow">
                <i class="fa-solid fa-trash-can mr-2"></i> Kosongkan Keranjang
              </button>
            </form>
          </div>
        </div>
      </div>
    @endif
  </div>

  <!-- ⚙️ Script Update Otomatis -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const inputs = document.querySelectorAll('.quantity-input');
      const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

      inputs.forEach(input => {
        input.addEventListener('change', function() {
          const id = this.dataset.id;
          const price = parseInt(this.dataset.price);
          const quantity = Math.max(1, parseInt(this.value));

          // Update subtotal
          const subtotalEl = document.querySelector(`.subtotal[data-id="${id}"] span`);
          const newSubtotal = price * quantity;
          subtotalEl.textContent = `Rp ${newSubtotal.toLocaleString('id-ID')}`;

          // Hitung ulang total
          let grandTotal = 0;
          document.querySelectorAll('.quantity-input').forEach(i => {
            const p = parseInt(i.dataset.price);
            const q = Math.max(1, parseInt(i.value));
            grandTotal += p * q;
          });
          document.getElementById('grand-total').textContent = `Rp ${grandTotal.toLocaleString('id-ID')}`;

          // Kirim update ke backend
          fetch(`/cart/update/${id}`, {
            method: 'PATCH',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ quantity: quantity })
          });
        });
      });
    });
  </script>

  <!-- 🦶 FOOTER -->
  <footer class="bg-blue-900 border-t py-6 mt-16 text-center text-sm text-white">
    © 2025 Kansai Paint. All rights reserved.
  </footer>

</body>
</html>
