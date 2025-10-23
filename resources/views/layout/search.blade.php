<h2 class="text-lg font-bold mb-6">Hasil Pencarian: 
  <span class="text-blue-900">{{ $keyword }}</span>
</h2>

@if($products->isEmpty())
  <p class="text-gray-600">Tidak ada produk yang cocok dengan kata kunci tersebut.</p>
@else

  <!-- 🧱 GRID PRODUK -->
  <section class="max-w-7xl mx-auto px-6 md:px-12 mt-8 mb-20">
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

            <!-- TOMBOL TAMBAH KE KERANJANG -->
            <form action="{{ route('cart.add') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <button 
                type="submit"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-900 text-white font-semibold rounded-full hover:bg-blue-800 hover:scale-105 transition-all duration-300 shadow-md">
                🛒 Tambah
              </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="mt-10">
      {{ $products->links() }}
    </div>
  </section>
@endif
<div class="mt-40"
