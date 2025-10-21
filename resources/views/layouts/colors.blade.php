@include('layout.header')

<!-- 🌟 HERO SECTION -->
<section class="relative h-[90vh] bg-gradient-to-br from-blue-100 via-white to-blue-50 flex flex-col items-center justify-center text-center overflow-hidden">
  <div class="absolute inset-0 opacity-40 bg-[url('/images/bg-pattern.svg')] bg-cover bg-center animate-[pulse_10s_infinite]"></div>
  <div class="relative z-10">
    <h1 class="text-6xl md:text-7xl font-extrabold text-blue-900 mb-4 drop-shadow-sm">
      Temukan Warna Terbaik untuk Setiap Kebutuhan Project Anda
    </h1>
    <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
      Koleksi warna dari Kansai — warna yang hidup, kualitas yang tahan lama, dan sentuhan kemewahan di setiap sapuan kuas.
    </p>

    <!-- 🔘 Tombol scroll ke grid warna -->
    <a href="#colorGrid"
       class="mt-8 inline-block px-10 py-4 bg-blue-900 text-white rounded-full text-lg font-semibold hover:scale-105 hover:bg-blue-800 transition-all duration-300 shadow-lg"
       onclick="showAllColors(event)">
        🌈 Lihat Semua Warna
    </a>
  </div>
</section>

<script>
function showAllColors(event) {
  event.preventDefault(); // hindari lompat langsung
  const colorGrid = document.querySelector('#colorGrid');
  if (colorGrid) {
    colorGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}
</script>

<!-- 💠 KOLEKSI WARNA -->
<section id="colorGrid" x-data="{ selectedColor: null, shades: [], colorName: '' }" class="max-w-7xl mx-auto px-6 py-20">
  <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">Eksplorasi Kategori Warna</h2>

  @php
      $colors = [
          [
              'name'=>'Netral','main'=>'#b5ac96',
              'shades'=>[
                  ['name'=>'Putih Gading','hex'=>'#f0ede6'],
                  ['name'=>'Abu Lembut','hex'=>'#d9d9d9'],
                  ['name'=>'Beige Hangat','hex'=>'#bfb6a2'],
                  ['name'=>'Abu Tua','hex'=>'#a6a6a6'],
                  ['name'=>'Coklat Pasir','hex'=>'#8c8370'],
              ]
          ],
          [
              'name'=>'Merah','main'=>'#ed2024',
              'shades'=>[
                  ['name'=>'Merah Cerah','hex'=>'#ff4c4c'],
                  ['name'=>'Merah Muda','hex'=>'#ff6666'],
                  ['name'=>'Merah Tua','hex'=>'#b30000'],
                  ['name'=>'Maroon','hex'=>'#800000'],
                  ['name'=>'Ceri','hex'=>'#ff3333'],
              ]
          ],
          [
              'name'=>'Oranye','main'=>'#faa41a',
              'shades'=>[
                  ['name'=>'Oranye Terang','hex'=>'#ffa500'],
                  ['name'=>'Oranye Muda','hex'=>'#ffb84d'],
                  ['name'=>'Oranye Tua','hex'=>'#cc6600'],
                  ['name'=>'Amber','hex'=>'#ff9933'],
                  ['name'=>'Tembaga','hex'=>'#b35900'],
              ]
          ],
          [
              'name'=>'Kuning','main'=>'#f6eb14',
              'shades'=>[
                  ['name'=>'Kuning Cerah','hex'=>'#ffff66'],
                  ['name'=>'Kuning Lemon','hex'=>'#fff799'],
                  ['name'=>'Kuning Emas','hex'=>'#ffcc00'],
                  ['name'=>'Kuning Muda','hex'=>'#fff200'],
                  ['name'=>'Kuning Gelap','hex'=>'#e6b800'],
              ]
          ],
          [
              'name'=>'Hijau','main'=>'#0b8140',
              'shades'=>[
                  ['name'=>'Hijau Cerah','hex'=>'#27ae60'],
                  ['name'=>'Hijau Lumut','hex'=>'#0e7033'],
                  ['name'=>'Hijau Tua','hex'=>'#084c23'],
                  ['name'=>'Hijau Daun','hex'=>'#1abc4d'],
                  ['name'=>'Hijau Mint','hex'=>'#16a085'],
              ]
          ],
          [
              'name'=>'Biru','main'=>'#3953a4',
              'shades'=>[
                  ['name'=>'Biru Laut','hex'=>'#3498db'],
                  ['name'=>'Biru Langit','hex'=>'#5dade2'],
                  ['name'=>'Biru Gelap','hex'=>'#154360'],
                  ['name'=>'Biru Tua','hex'=>'#1b4f72'],
                  ['name'=>'Biru Muda','hex'=>'#2874a6'],
              ]
          ],
          [
              'name'=>'Ungu','main'=>'#7c277d',
              'shades'=>[
                  ['name'=>'Ungu Lembut','hex'=>'#a569bd'],
                  ['name'=>'Ungu Muda','hex'=>'#af7ac5'],
                  ['name'=>'Ungu Tua','hex'=>'#633974'],
                  ['name'=>'Lavender','hex'=>'#9b59b6'],
                  ['name'=>'Violet','hex'=>'#8e44ad'],
              ]
          ],
          [
              'name'=>'Cokelat','main'=>'#964b00',
              'shades'=>[
                  ['name'=>'Coklat Muda','hex'=>'#a0522d'],
                  ['name'=>'Coklat Susu','hex'=>'#c97c4e'],
                  ['name'=>'Coklat Tua','hex'=>'#663300'],
                  ['name'=>'Coklat Kayu','hex'=>'#996633'],
                  ['name'=>'Coklat Kopi','hex'=>'#804000'],
              ]
          ],
      ];
  @endphp

  <!-- 🔳 GRID WARNA -->
  <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-6 justify-center">
      @foreach($colors as $color)
      <div 
          class="group relative cursor-pointer"
          @click="selectedColor = '{{ $color['main'] }}'; shades = {{ json_encode($color['shades']) }}; colorName = '{{ $color['name'] }}'">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
          <div class="h-28 w-full" style="background-color: {{ $color['main'] }};"></div>
          <div class="p-3 text-center">
            <p class="font-semibold text-gray-800 group-hover:text-blue-800 transition">{{ $color['name'] }}</p>
          </div>
        </div>
      </div>
      @endforeach
  </div>

  <div class="mt-16 border-t-4 border-blue-200 w-1/2 mx-auto rounded-full"></div>

  <!-- 💡 Modal Pop-Up Warna -->
  <div 
    x-show="selectedColor"
    x-transition.opacity
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4"
  >
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full p-6 relative animate-fadeIn">
      <button @click="selectedColor = null" class="absolute top-3 right-3 text-gray-600 hover:text-red-500 transition text-2xl font-bold">&times;</button>

      <h3 class="text-2xl font-bold text-center text-blue-900 mb-6" x-text="colorName + ' Shades'"></h3>

      <div class="w-24 h-24 mx-auto rounded-full shadow-lg border mb-8" :style="'background-color:' + selectedColor"></div>

      <!-- Daftar Turunan -->
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 justify-center">
        <template x-for="(shade, index) in shades" :key="shade.hex">
          <div 
            class="flex flex-col items-center opacity-0 scale-90 transform transition duration-500 ease-out"
            :style="`animation: fadeUp 0.5s ease-out forwards; animation-delay: ${index * 0.1}s;`"
          >
            <div 
              class="w-24 h-24 rounded-xl shadow-md border border-gray-200 hover:scale-110 hover:shadow-xl hover:border-blue-400 transition"
              :style="'background-color:' + shade.hex"
            ></div>
            <p class="text-sm text-gray-700 mt-3 font-semibold" x-text="shade.name"></p>
          </div>
        </template>
      </div>
    </div>
  </div>
</section>

<!-- 💬 CTA PENUTUP -->
<section class="relative bg-gradient-to-br from-blue-100 via-white to-blue-50 py-24 text-center text-blue-900 overflow-hidden">
  <div class="absolute inset-0 bg-[url('/images/paint-flow.png')] bg-cover opacity-10"></div>
  <div class="relative z-10 max-w-3xl mx-auto px-6">
    <h2 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg animate-fadeIn">Mau Lihat Produk Kami?</h2>
    <p class="text-gray-700 mb-10 text-lg md:text-xl leading-relaxed animate-fadeIn delay-200">Tim Kansai siap membantu Anda memilih kombinasi produk terbaik untuk rumah atau proyek Anda.</p>
    <a href="/products" class="inline-block px-12 py-4 bg-blue-900 text-white rounded-full font-semibold shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl hover:bg-blue-800">🎨 Lihat Produk</a>
  </div>
</section>

@include('layout.footer')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
@keyframes fadeUp {
  0% {
    opacity: 0;
    transform: translateY(20px) scale(0.9);
  }
  100% {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}
</style>
