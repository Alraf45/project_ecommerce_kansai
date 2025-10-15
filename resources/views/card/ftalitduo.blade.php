
<!-- Card Produk -->
<div class="product-card bg-white rounded-2xl shadow-md hover:shadow-xl transition-all overflow-hidden group" data-category="kayubesi">
    <a href="ftalitduo">
  
  <!-- Gambar Produk -->
  <div class="relative w-full h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
    <a href="ftalitduo">
    <img src="img/ftalitduo.png" 
        alt="KANSAI FTALIT DUO"
        class="h-[200px] w-auto padding-auto mb-50px object-contain group-hover:scale-105 transition-transform duration-300">
    
    <!-- Badge Kategori -->
    <span class="absolute top-2 left-2 bg-orange-700 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
      Kayu & Besi
    </span>

    <!-- Badge Promo -->
    <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
      Sale
    </span>
  </div>

  <!-- Konten -->
  <div class="p-5">
    <!-- Nama Produk -->
    <h3 class="text-lg font-bold text-gray-800 group-hover:text-gray-800 transition">
      KANSAI FTALIT DUO
    </h3>

    <!-- Deskripsi -->
    <p class="text-gray-500 text-sm mt-1">
      Cat kayu & besi KANSAI FTALIT DUO tersedia dalam berbagai pilihan warna dengan hasil akhir ekstra mengkilap.
    </p>

    <!-- Harga -->
    <div class="mt-3">
      <span class="text-xl font-bold text-gray-900">Rp 110.000</span>
    </div>

    <!-- Tombol -->
    <div class="mt-4">
      <a href="javascript:void(0)"
         class="add-to-cart inline-flex items-center px-4 py-2 bg-blue-800 text-white font-semibold rounded-xl hover:bg-blue-500 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007.5 18h11a1 1 0 00.9-.55L21 13H7zm5 5a1 1 0 11-2 0 1 1 0 012 0zm8 0a1 1 0 11-2 0 1 1 0 012 0z" />
        </svg>
        Tambah ke Keranjang
      </a>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    // 🔥 reset ke 0 setiap kali halaman direfresh
    let cartCount = 0;
    localStorage.setItem("cartCount", cartCount);

    const cartCountEl = document.getElementById("cart-count");
    const cartBtn = document.getElementById("cart-btn");

    // set tampilan awal
    cartCountEl.textContent = cartCount;

    // event untuk SEMUA tombol "Tambah ke Keranjang"
    document.querySelectorAll(".add-to-cart").forEach(btn => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();

        cartCount++;
        cartCountEl.textContent = cartCount;

        // simpan ke localStorage (walau akan reset saat reload)
        localStorage.setItem("cartCount", cartCount);

        // animasi bounce
        cartBtn.classList.add("animate-bounce");
        setTimeout(() => {
          cartBtn.classList.remove("animate-bounce");
        }, 500);
      });
    });
  });
</script>

