@include('layout.header')

<section 
  class="relative h-[90vh] flex flex-col items-center justify-center text-center text-white overflow-hidden bg-cover bg-center"
  style="background-image: url('{{ asset('img/kayubesi/kayu1.png') }}');">

  <!-- Overlay supaya teks tetap terbaca -->
  <div class="absolute inset-0 bg-black bg-opacity-40"></div>
  
  <div class="relative z-10 max-w-3xl mx-auto px-6">
  <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-lg animate-fade-in-up">
    Temukan Cat 
    <span>
      <span class="text-yellow-600 font-extrabold">Kayu</span> &nbsp;
      <span class="text-gray-400 font-extrabold">Besi</span>
    </span>
    Kami untuk Setiap Kebutuhan Anda
  </h1>

  <p class="text-blue-100 text-lg md:text-xl leading-relaxed mb-8 animate-fade-in-up delay-200">
    Eksplor koleksi cat Kayu & Besi Kansai Paint — dirancang untuk keindahan, ketahanan, dan kenyamanan sempurna.
  </p>

  <a href="#productGrid" 
     id="scrollToProducts"
     class="inline-block px-10 py-4 bg-white text-blue-900 font-semibold rounded-full transform transition-all duration-500 ease-in-out hover:bg-blue-100 hover:scale-105 hover:shadow-2xl animate-fade-in-up delay-300">
     Jelajahi Produk
  </a>
</div>

</section>


<!-- 🧱 GRID PRODUK -->
<section
  id="productGrid"
  class="relative max-w-7xl mx-auto px-6 md:px-12 mt-13 rounded-1xl py-10 h-[700px] bg-cover bg-center"
  style="background-image: url('{{ asset('img/kayubesi/kayu2.jpg') }}');">

  <!-- Optional overlay supaya teks tetap terbaca -->
  <div class="absolute inset-0 bg-black bg-opacity-30 rounded-1xl"></div>

  <div class="relative z-10">
    <h1 class="text-center text-1xl md:text-4xl font-extrabold mb-6 leading-tight drop-shadow-lg animate-fade-in-up text-white">
      
    </h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-8 place-items-center">
      @foreach($products as $product)
        <div class="product-card opacity-0 translate-y-8 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group w-full max-w-[280px]"
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
  </div>
  
</section>


@include('layout.footer')

<!-- JS Global -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {

    // Smooth scroll tombol Jelajahi Produk
    const button = document.getElementById('scrollToProducts');
    const target = document.getElementById('productGrid');

    button.addEventListener('click', function(e) {
        e.preventDefault();
        const offset = 80; // header height
        const topPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;

        window.scrollTo({ top: topPosition, behavior: 'smooth' });
    });

    // Fade-in produk saat scroll (otomatis, tidak perlu klik tombol)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
                entry.target.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll('.product-card').forEach(card => observer.observe(card));

    // Add to Cart
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.stopPropagation();
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
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ quantity: 1 })
                });

                const data = await res.json();

                if (data.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: data.message || 'Produk berhasil ditambahkan!',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#1e3a8a',
                        color: '#fff',
                        customClass: { popup: 'rounded-xl shadow-lg' }
                    });

                    if (typeof window.updateCartCount === 'function') {
                        window.updateCartCount(data.count);
                    }
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: data.message || 'Gagal menambahkan ke keranjang!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }

            } catch (error) {
                console.error(error);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Silakan login terlebih dahulu!',
                    showConfirmButton: false,
                    timer: 2000
                });
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        });
    });

});
</script>
