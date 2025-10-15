<!-- Card Produk -->
<div class="product-card bg-white rounded-2xl shadow-md hover:shadow-xl transition-all overflow-hidden group" data-category="premium">
  <a href="diamondshield">
    <!-- Gambar Produk -->
    <div class="relative w-full h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
      <img src="img/diamondshield.png" 
           alt="KANSAI DIAMOND SHIELD"
           class="h-[200px] w-auto object-contain group-hover:scale-105 transition-transform duration-300">

      <!-- Badge Kategori -->
      <span class="absolute top-2 left-2 bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
        Premium
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
        KANSAI DIAMOND SHIELD
      </h3>

      <!-- Deskripsi -->
      <p class="text-gray-500 text-sm mt-1">
       Cat eksterior KANSAI DIAMOND SHIELD 12-IN-1 menghadirkan keunggulan 12 fitur dalam satu produk premium.
      </p>

      <!-- Harga -->
      <div class="mt-3">
        <span class="text-xl font-bold text-gray-900">Rp 402.000</span>
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
  // reset cartCount
  let cartCount = 0;
  localStorage.setItem("cartCount", cartCount);

  const cartCountEl = document.getElementById("cart-count");
  const cartBtn = document.getElementById("cart-btn");

  // set tampilan awal
  cartCountEl.textContent = cartCount;

  // Buat toast otomatis untuk setiap card
  document.querySelectorAll(".product-card").forEach(card => {
    const toast = document.createElement("div");
    toast.className = "toast fixed top-16 right-5 hidden z-50";
    toast.innerHTML = `
      <div class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2">
        <i class="fas fa-check-circle"></i>
        <span class="toast-message">Produk berhasil ditambahkan ke keranjang!</span>
      </div>
    `;
    card.appendChild(toast);
  });

  // Event tombol "Tambah ke Keranjang"
  document.querySelectorAll(".add-to-cart").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();

      // Update cart count
      cartCount++;
      cartCountEl.textContent = cartCount;
      localStorage.setItem("cartCount", cartCount);

      // animasi keranjang
      cartBtn.classList.add("animate-bounce");
      setTimeout(() => cartBtn.classList.remove("animate-bounce"), 500);

      // tampilkan toast card terkait
      const card = btn.closest(".product-card");
      const toast = card.querySelector(".toast");
      toast.classList.remove("hidden");
      toast.classList.add("animate-slide-in");

      setTimeout(() => {
        toast.classList.add("hidden");
        toast.classList.remove("animate-slide-in");
      }, 2500);
    });
  });
});
</script>
