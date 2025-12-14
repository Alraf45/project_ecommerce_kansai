@include('layout.header')
@include('layout.banner') 
<!-- Spacer bawah banner -->
<div class="mb-15"></div>

<!-- ===================== -->
<!-- INSPIRASI RUANG -->
<!-- ===================== -->
<section class="px-6 lg:px-16 py-20 bg-gray-50">
    <div class="text-center mb-14">
        <h2 class="text-3xl md:text-4xl font-bold text-blue-900">
            Inspirasi Ruang
        </h2>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto leading-relaxed">
            Ciptakan suasana ruang yang indah dan nyaman dengan inspirasi warna
            dari Kansai Paint untuk setiap kebutuhan hunian Anda.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-7xl mx-auto">

        <!-- Ruang Tamu -->
        <div class="group relative overflow-hidden rounded-3xl shadow-xl">
            <img src="/img/interior/bg2.png"
                 alt="Inspirasi Ruang Tamu"
                 class="w-full h-[450px] object-cover transition-transform duration-700 group-hover:scale-110">

            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

            <div class="absolute bottom-6 left-6 right-6 text-white">
                <h3 class="text-2xl font-semibold">Ruang Tamu</h3>
                <p class="text-sm opacity-90 mt-1">
                    Elegan, hangat, dan menyambut
                </p>
            </div>
        </div>

        <!-- Kamar Tidur -->
        <div class="group relative overflow-hidden rounded-3xl shadow-xl">
            <img src="/img/interior/bg5.png"
                 alt="Inspirasi Kamar Tidur"
                 class="w-full h-[450px] object-cover transition-transform duration-700 group-hover:scale-110">

            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

            <div class="absolute bottom-6 left-6 right-6 text-white">
                <h3 class="text-2xl font-semibold">Kamar Tidur</h3>
                <p class="text-sm opacity-90 mt-1">
                    Tenang dan nyaman untuk beristirahat
                </p>
            </div>
        </div>

        <!-- Dapur -->
        <div class="group relative overflow-hidden rounded-3xl shadow-xl">
            <img src="/img/interior/bg3.png"
                 alt="Inspirasi Dapur"
                 class="w-full h-[450px] object-cover transition-transform duration-700 group-hover:scale-110">

            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

            <div class="absolute bottom-6 left-6 right-6 text-white">
                <h3 class="text-2xl font-semibold">Dapur</h3>
                <p class="text-sm opacity-90 mt-1">
                    Bersih, modern, dan fungsional
                </p>
            </div>
        </div>

    </div>
</section>
<!-- Inspirasi Eksterior -->
<section class="px-6 lg:px-16 py-20 bg-white">
    <div class="text-center mb-14">
        <h2 class="text-3xl md:text-4xl font-bold text-blue-900">
            Inspirasi Eksterior
        </h2>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto leading-relaxed">
            Perlindungan dan keindahan maksimal untuk tampilan luar bangunan Anda.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-6xl mx-auto">
        <!-- Rumah -->
        <div class="group relative overflow-hidden rounded-3xl shadow-xl">
            <img src="/img/eksterior/bg2.png"
                 class="w-full h-[420px] object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
                <h3 class="text-2xl font-semibold">Fasad Rumah</h3>
                <p class="text-sm opacity-90 mt-1">Tahan cuaca & tahan lama</p>
            </div>
        </div>

        <!-- Gedung -->
        <div class="group relative overflow-hidden rounded-3xl shadow-xl">
            <img src="/img/eksterior/gedung.png"
                 class="w-full h-[420px] object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
                <h3 class="text-2xl font-semibold">Gedung & Bangunan</h3>
                <p class="text-sm opacity-90 mt-1">Kuat & profesional</p>
            </div>
        </div>
    </div>
</section>
<!-- Inspirasi Kayu & Besi -->
<section class="px-6 lg:px-16 py-20 bg-gray-50">
    <div class="text-center mb-14">
        <h2 class="text-3xl md:text-4xl font-bold text-blue-900">
            Inspirasi Kayu & Besi
        </h2>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto leading-relaxed">
            Perlindungan optimal dan tampilan estetis untuk material kayu dan besi.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-6xl mx-auto">
        <!-- Kayu -->
        <div class="group relative overflow-hidden rounded-3xl shadow-xl">
            <img src="/img/kayubesi/kayu.png"
                 class="w-full h-[420px] object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
                <h3 class="text-2xl font-semibold">Permukaan Kayu</h3>
                <p class="text-sm opacity-90 mt-1">Alami & tahan lama</p>
            </div>
        </div>

        <!-- Besi -->
        <div class="group relative overflow-hidden rounded-3xl shadow-xl">
            <img src="/img/kayubesi/besi.png"
                 class="w-full h-[420px] object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
                <h3 class="text-2xl font-semibold">Permukaan Besi</h3>
                <p class="text-sm opacity-90 mt-1">Anti karat & kuat</p>
            </div>
        </div>
    </div>
</section>


<!-- ===================== -->
<!-- CTA PRODUK -->
<!-- ===================== -->
<section class="px-6 lg:px-16 py-20 bg-white">
    <div class="max-w-6xl mx-auto bg-blue-900 rounded-3xl p-10 md:p-16 text-center text-white shadow-xl">
        <h2 class="text-3xl md:text-4xl font-bold">
            Temukan Cat Terbaik untuk Setiap Ruang
        </h2>
        <p class="mt-4 text-blue-100 max-w-2xl mx-auto leading-relaxed">
            Jelajahi berbagai produk cat Kansai Paint dengan kualitas premium
            untuk hasil maksimal dan tahan lama.
        </p>

        <a href="{{ route('products.index') }}"
           class="inline-block mt-8 bg-white text-blue-900 px-8 py-4 rounded-full font-semibold
                  hover:bg-gray-100 transition shadow-lg">
            Lihat Semua Produk
        </a>
    </div>
</section>

<!-- Spacer bawah -->
<div class="mb-15"></div>

@include('layout.footer')
