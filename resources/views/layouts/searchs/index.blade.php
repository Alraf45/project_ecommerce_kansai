@include('layout.header')

<!-- 🔍 Bagian Header Pencarian -->
<section class="bg-gradient-to-r from-blue-900 to-blue-600 text-white py-24 text-center">
    <h1 class="text-4xl md:text-5xl font-bold mb-3 animate-fade-in">
        Hasil Pencarian
    </h1>
    <p class="text-lg md:text-xl opacity-90 animate-fade-in">
        Menampilkan hasil untuk: <span class="font-semibold text-yellow-300">"{{ $query }}"</span>
    </p>
</section>

<!-- 🛍️ Hasil Produk -->
<div class="max-w-7xl mx-auto px-6 py-16">
  @if($products->isEmpty())
    <div class="flex flex-col items-center justify-center text-center py-24">
      <img src="/img/empty-search.svg" alt="Tidak ada hasil" class="w-52 mb-6 opacity-80">
      <h2 class="text-2xl font-semibold text-gray-700 mb-2">Produk tidak ditemukan</h2>
      <p class="text-gray-500 mb-6">Coba gunakan kata kunci lain untuk menemukan produk yang kamu cari.</p>
      <a href="/products" class="px-6 py-3 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition-all duration-300">
        Kembali ke Produk
      </a>
    </div>
  @else
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 animate-fade-in">
      @foreach($products as $product)
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden">
          <div class="relative">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                 class="w-full h-52 object-contain bg-gray-50 p-4 group-hover:scale-105 transition-transform duration-500">
          </div>
          <div class="p-4 text-center">
            <h3 class="font-semibold text-gray-800 text-lg mb-1 truncate">{{ $product->name }}</h3>
            <p class="text-blue-900 font-bold text-sm mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <a href="/products/{{ $product->id }}" 
               class="inline-block bg-blue-900 text-white text-sm px-4 py-2 rounded-lg 
                      hover:bg-blue-800 transition-all duration-300">
              Lihat Detail
            </a>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>

<!-- ✨ Animasi Fade -->
<style>
@keyframes fade-in {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
  animation: fade-in 0.6s ease-out both;
}
</style>

@include('layout.footer')
