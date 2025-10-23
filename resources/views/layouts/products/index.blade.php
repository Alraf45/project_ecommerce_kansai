@include('layout.header')

<!-- 🌟 HERO + KATEGORI PRODUK -->
<section class="relative min-h-[100vh] bg-gradient-to-br from-blue-100 via-white to-blue-50 flex flex-col items-center text-center overflow-hidden">

  <!-- 🌈 Background animasi -->
  <div class="absolute inset-0 opacity-40 bg-[url('/images/bg-pattern.svg')] bg-cover bg-center animate-[pulse_10s_infinite]"></div>

  <!-- 🏠 Hero Content -->
  <div class="relative z-10 w-full max-w-5xl mx-auto px-6 pt-28 pb-20">
    <h1 class="text-5xl md:text-6xl font-extrabold text-blue-900 mb-6 leading-tight drop-shadow-sm">
      Temukan Cat Warna Terbaik untuk Setiap Kebutuhan Project Anda
    </h1>
    <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
      Koleksi cat premium dari Kansai — warna yang hidup, kualitas yang tahan lama, dan sentuhan kemewahan di setiap sapuan kuas.
    </p>

    <!-- Tombol -->
    <a href="#categoryButtons"
       onclick="scrollToCategory(event)"
       class="mt-10 inline-flex items-center justify-center gap-3 px-10 py-4 bg-blue-900 text-white rounded-full text-lg font-semibold shadow-lg hover:bg-blue-800 hover:scale-105 transition-all duration-300">
        Lihat Semua Produk
    </a>
  </div>

  <!-- 💠 KATEGORI PRODUK -->
  <div class="relative z-10 w-full max-w-6xl mx-auto px-6 py-16 border-blue-200 mt-4">
    <h2 class="text-4xl font-extrabold text-blue-900 mb-6">Kategori Cat Kansai</h2>
    <p class="text-gray-600 mb-10 max-w-xl mx-auto">
      Pilih kategori untuk menemukan produk yang sesuai dengan kebutuhan proyek Anda.
    </p>

    <div id="categoryButtons" class="flex justify-center flex-wrap gap-4">
      <button data-cat="all"
        class="category-btn px-6 py-3 rounded-full bg-blue-900 text-white font-semibold shadow-md hover:scale-105 transition">
        Semua
      </button>

      @foreach($categories as $category)
        <button 
          data-cat="{{ strtolower($category->slug ?? $category->name) }}"
          class="category-btn px-6 py-3 rounded-full bg-white border border-gray-200 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition shadow-sm">
          {{ $category->name }}
        </button>
      @endforeach
    </div>
  </div>
</section>

<!-- 🧭 Scroll halus ke kategori -->
<script>
function scrollToCategory(event) {
  event.preventDefault();
  const target = document.querySelector('#categoryButtons');
  if (!target) return;
  const yOffset = -80;
  const y = target.getBoundingClientRect().top + window.pageYOffset + yOffset;
  window.scrollTo({ top: y, behavior: 'smooth' });
}
</script>


<!-- 🧱 GRID PRODUK -->
<section class="max-w-7xl mx-auto px-6 md:px-12 mt-12 mb-24">
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 place-items-center" id="productGrid">
    @foreach($products as $product)
      <div class="product-card bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group w-full max-w-[280px] transform hover:-translate-y-2"
        data-category="{{ strtolower($product->category->slug ?? $product->category->name ?? 'all') }}"
        id="product-{{ $product->id }}">

        <!-- GAMBAR PRODUK -->
        <a href="{{ route('products.show', $product->id) }}" class="block relative w-full aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
          <img src="{{ asset($product->image) }}" 
               alt="{{ $product->name }}" 
               class="h-[200px] w-auto object-contain group-hover:scale-110 transition-transform duration-500 ease-out">
          <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
        </a>

        <!-- DETAIL PRODUK -->
        <div class="p-5 text-center">
          <h3 class="text-base font-semibold text-gray-800 mb-1 hover:text-blue-800 transition">
            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
          </h3>
          <p class="text-gray-500 text-sm mb-3">{{ Str::limit($product->description, 60) }}</p>
          <span class="block text-xl font-bold text-blue-900 mb-3">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </span>

          <button 
            type="button"
            class="add-to-cart inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-900 text-white font-semibold rounded-full hover:bg-blue-800 hover:scale-105 transition-all duration-300 shadow-md"
            data-id="{{ $product->id }}">
            🛒 Tambah
          </button>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- 💬 CTA PENUTUP -->
<section class="relative bg-gradient-to-br from-blue-100 via-white to-blue-50 py-24 text-center text-blue-900 overflow-hidden">
  <div class="absolute inset-0 bg-[url('/images/paint-flow.png')] bg-cover opacity-10"></div>

  <div class="relative z-10 max-w-3xl mx-auto px-6">
    <h2 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg animate-fadeIn">
      Butuh Saran Warna yang Tepat?
    </h2>

    <p class="text-gray-700 mb-10 text-lg md:text-xl leading-relaxed animate-fadeIn delay-200">
      Tim Kansai siap membantu Anda memilih kombinasi warna terbaik untuk rumah atau proyek Anda.
    </p>

    <a href="/colors" 
       class="inline-block px-12 py-4 bg-blue-900 text-white rounded-full font-semibold shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl hover:bg-blue-800">
       🌈 Lihat Palet Warna
    </a>
  </div>
</section>

<style>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn { animation: fadeIn 0.8s ease forwards; }
.animate-fadeIn.delay-200 { animation-delay: 0.2s; }
</style>

@include('layout.footer')

<!-- ✅ SWEETALERT DAN SCRIPT AJAX -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // FILTER KATEGORI
  const categoryButtons = document.querySelectorAll('.category-btn');
  const productCards = document.querySelectorAll('.product-card');
  categoryButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const cat = btn.dataset.cat;

      categoryButtons.forEach(b => {
        b.classList.remove('bg-blue-900','text-white','shadow-md','scale-105');
        b.classList.add('bg-white','border','border-gray-200','text-gray-700','hover:bg-blue-100','hover:text-blue-900','shadow-sm');
      });

      btn.classList.add('bg-blue-900','text-white','shadow-md','scale-105');
      btn.classList.remove('bg-white','border','border-gray-200','text-gray-700','hover:bg-blue-100','hover:text-blue-900','shadow-sm');

      productCards.forEach(card => {
        const show = cat === 'all' || card.dataset.category === cat;
        if (show) {
          card.style.display = 'block';
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
          }, 10);
        } else {
          card.style.opacity = '0';
          card.style.transform = 'scale(0.95)';
          setTimeout(() => card.style.display = 'none', 300);
        }
      });
    });
  });

  // TAMBAH KE KERANJANG
  document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) return alert('ID produk tidak tersedia!');

      button.disabled = true;
      const originalText = button.innerHTML;
      button.innerHTML = '⏳ Menambahkan...';

      try {
        const res = await fetch(`/cart/add/${id}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
          },
          credentials: 'same-origin',
          body: JSON.stringify({ quantity: 1 })
        });

        const data = await res.json();

        if (res.ok && data.success) {
          const cartCountEl = document.getElementById('cart-count');
          if (cartCountEl) cartCountEl.textContent = data.count;

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

        } else if (res.status === 401) {
          window.location.href = '/login';

        } else {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: data.message || 'Terjadi kesalahan!',
            showConfirmButton: false,
            timer: 2000
          });
        }

      } catch (error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Kesalahan Server',
          text: 'Gagal menambahkan produk ke keranjang.',
        });
      } finally {
        button.disabled = false;
        button.innerHTML = originalText;
      }
    });
  });
});
</script>
