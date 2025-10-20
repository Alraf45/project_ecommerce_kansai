@include('layout.header')


<section class="relative h-[90vh] bg-gradient-to-br from-yellow-300 via-yellow-600 to-yellow-800 flex flex-col items-center justify-center text-center text-white overflow-hidden">
  <div class="absolute inset-0 bg-[url('/images/color-splash.png')] bg-cover bg-center opacity-10"></div>
  
  <div class="relative z-10 max-w-3xl mx-auto px-6">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-lg animate-fade-in-up">
      Temukan Cat Premium Kami untuk Setiap Kebutuhan Anda
    </h1>
    <p class="text-blue-100 text-lg md:text-xl leading-relaxed mb-8 animate-fade-in-up delay-200">
      Eksplor koleksi cat Premium Kansai Paint — dirancang untuk keindahan, ketahanan, dan kenyamanan sempurna.
    </p>
    <a href="#productGrid" 
       class="inline-block px-10 py-4 bg-white text-blue-900 font-semibold rounded-full hover:bg-blue-100 transition transform hover:scale-105 shadow-lg animate-fade-in-up delay-300">
       🎨 Jelajahi Produk
    </a>
  </div>
</section>


<!-- 🧱 GRID PRODUK -->
<section class="max-w-7xl mx-auto px-6 md:px-12 mt-16 mb-20">
 

  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 place-items-center" id="productGrid">
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

<!-- HIGHLIGHT PRODUCT -->
<section class="relative bg-gradient-to-r from-blue-900 to-blue-700 text-white py-24 my-20 overflow-hidden">
  <div class="absolute inset-0 bg-[url('/images/color-splash.png')] bg-cover opacity-10"></div>
  <div class="max-w-6xl mx-auto text-center relative z-10">
    <h2 class="text-4xl font-bold mb-6">🌟 Produk Pilihan Minggu Ini</h2>
    <p class="text-blue-100 mb-12 max-w-2xl mx-auto">Dipilih oleh para profesional — warna yang paling populer di kalangan arsitek dan desainer interior.</p>
    
    @if($products->count() > 0)
      @php $highlight = $products->first(); @endphp
      <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-10 max-w-2xl mx-auto hover:scale-105 transition-transform duration-500">
        <img src="{{ asset($highlight->image) }}" alt="{{ $highlight->name }}" class="h-56 w-auto mx-auto object-contain mb-6 drop-shadow-lg">
        <h3 class="text-2xl font-bold mb-2">{{ $highlight->name }}</h3>
        <p class="text-blue-100 mb-4">{{ Str::limit($highlight->description, 120) }}</p>
        <span class="text-3xl font-bold text-white">Rp {{ number_format($highlight->price, 0, ',', '.') }}</span>
      </div>
    @endif
  </div>
</section>

<!-- CTA AKHIR -->
<section class="relative bg-gradient-to-t from-blue-50 to-white py-24 text-center">
  <div class="max-w-4xl mx-auto">
    <h2 class="text-4xl font-extrabold text-blue-900 mb-4">Mulai Petualangan Warnamu</h2>
    <p class="text-gray-600 mb-8 text-lg">Warna bukan hanya dekorasi — tapi cerminan gaya hidup. Yuk, pilih warna impianmu!</p>
    <a href="/colors" class="px-10 py-4 bg-blue-900 text-white font-semibold rounded-full hover:bg-blue-800 hover:scale-105 transition-all duration-300 shadow-xl">
      🌈 Lihat Palet Warna
    </a>
  </div>
</section>

@include('layout.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const token = document.querySelector('meta[name="csrf-token"]').content;
  document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', async () => {
      btn.disabled = true;
      const id = btn.dataset.id;
      const original = btn.innerHTML;
      btn.innerHTML = "⏳ Menambahkan...";
      try {
        const res = await fetch(`/cart/add/${id}`, {
          method: "POST",
          headers: {"Content-Type": "application/json", "X-CSRF-TOKEN": token},
          body: JSON.stringify({ quantity: 1 })
        });
        const data = await res.json();
        Swal.fire({
          toast: true, position: 'top-end',
          icon: data.success ? 'success' : 'error',
          title: data.message || 'Terjadi kesalahan',
          showConfirmButton: false,
          timer: 2000,
          background: data.success ? '#1e3a8a' : '#b91c1c',
          color: '#fff'
        });
      } finally {
        btn.disabled = false;
        btn.innerHTML = original;
      }
    });
  });
});
</script>
