@include('layout.header')

<!-- Hero Section -->
<div class="bg-blue-900 py-60">
  <h1 class="text-4xl font-bold text-white text-center">Semua Produk Cat</h1>
  <p class="text-white text-center mt-2">Temukan cat berkualitas untuk semua kebutuhan proyek Anda</p>
</div>

<div class="mb-20"></div>

<!-- Kategori / Filter -->
<div class="flex flex-col items-center mb-12">
  <h1 class="text-4xl font-bold text-blue-900 mb-4">Kategori Produk</h1>

  <div id="categoryButtons" class="flex justify-center gap-3 flex-wrap">
    <!-- Tombol Semua -->
    <button data-cat="all"
      class="category-btn px-5 py-2 rounded-full bg-blue-900 text-white font-semibold shadow transition-all duration-200">
      Semua
    </button>

    <!-- Tombol Dinamis -->
    @foreach($categories as $category)
      <button 
        data-cat="{{ strtolower($category->slug ?? $category->name) }}"
        class="category-btn px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-700 hover:bg-gray-100 hover:text-blue-900 transition-all duration-200">
        {{ $category->name }}
      </button>
    @endforeach
  </div>
</div>

<!-- Grid Produk -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 p-6 md:px-16" id="productGrid">
  @foreach($products as $product)
    <div class="product-card bg-white rounded-2xl shadow-md hover:shadow-xl transition-all overflow-hidden group"
      data-category="{{ strtolower($product->category->slug ?? $product->category->name ?? 'all') }}"
      id="product-{{ $product->id }}">
      
      <!-- Gambar Produk -->
      <div class="relative w-full h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
        <img src="{{ asset($product->image) }}" 
          alt="{{ $product->name }}" 
          class="h-[200px] w-auto object-contain group-hover:scale-105 transition-transform duration-300">
        <span class="absolute top-3 left-3 bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
          {{ $product->category->name ?? 'Tanpa Kategori' }}
        </span>
      </div>

      <!-- Konten -->
      <div class="p-5">
        <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
        <p class="text-gray-500 text-sm mt-1">{{ Str::limit($product->description, 80) }}</p>

        <div class="mt-3">
          <span class="text-xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        </div>

        <div class="mt-4">
          <button 
            type="button"
            class="add-to-cart inline-flex items-center gap-2 px-4 py-2 bg-blue-800 text-white font-semibold rounded-xl hover:bg-blue-600 transition"
            data-id="{{ $product->id }}">
            🛒 Tambah ke Keranjang
          </button>
        </div>
      </div>
    </div>
  @endforeach
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const buttons = document.querySelectorAll('.category-btn');
  const cards = document.querySelectorAll('.product-card');
  const addToCartButtons = document.querySelectorAll('.add-to-cart');
  const cartCountEl = document.getElementById('cart-count');
  const cartBtn = document.getElementById('cart-btn');

  // === Filter kategori dinamis ===
  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      const cat = btn.dataset.cat;

      // Styling aktif
      buttons.forEach(b => b.className = 
        "category-btn px-5 py-2 rounded-full bg-white border border-gray-200 text-gray-700 hover:bg-gray-100 hover:text-blue-900 transition-all duration-200"
      );
      btn.className = "category-btn px-5 py-2 rounded-full bg-blue-900 text-white font-semibold shadow transition-all duration-200";

      // Filter produk
      cards.forEach(card => {
        const show = (cat === 'all' || card.dataset.category === cat);
        card.style.opacity = show ? "1" : "0";
        card.style.transform = show ? "scale(1)" : "scale(0.9)";
        setTimeout(() => { card.style.display = show ? "" : "none"; }, show ? 0 : 200);
      });
    });
  });

  // === Tambah ke keranjang ===
  addToCartButtons.forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      btn.disabled = true;
      const originalText = btn.innerHTML;
      btn.innerHTML = "⏳ Menambahkan...";

      try {
        const res = await fetch(`/cart/add/${id}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
          },
          credentials: 'same-origin'
        });

        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();

        if (data.success) {
          cartCountEl.textContent = data.count;
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: data.message,
            showConfirmButton: false,
            timer: 2000,
            background: '#1e3a8a',
            color: '#fff',
            customClass: { popup: 'rounded-xl shadow-lg' }
          });

          cartBtn.classList.add('animate-bounce-cart');
          setTimeout(() => cartBtn.classList.remove('animate-bounce-cart'), 600);
        }
      } catch (error) {
        console.error(error);
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Daftar atau Login akun terlebih dahulu!',
          showConfirmButton: false,
          timer: 2000
        });
      } finally {
        btn.disabled = false;
        btn.innerHTML = originalText;
      }
    });
  });

  // === Style animasi keranjang ===
  const style = document.createElement("style");
  style.textContent = `
    @keyframes cart-bounce {
      0%, 100% { transform: scale(1); }
      30% { transform: scale(1.3) rotate(-5deg); }
      60% { transform: scale(1.3) rotate(5deg); }
    }
    .animate-bounce-cart {
      animation: cart-bounce 0.6s ease-in-out;
    }
  `;
  document.head.appendChild(style);
});
</script>

<div class="mb-32"></div>

@include('layout.footer')
