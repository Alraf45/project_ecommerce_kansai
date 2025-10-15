<!-- Card Produk -->
<body>
<div class="product-card bg-white rounded-2xl shadow-md hover:shadow-xl transition-all overflow-hidden group" data-category="premium">
  <a href="pearlsheen">
    <!-- Gambar Produk -->
    <div class="relative w-full h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
      <img src="img/pearlsheen.png" 
           alt="KANSAI PEARLSHEEN"
           class="h-[200px] w-auto padding-auto mb-50px object-contain group-hover:scale-105 transition-transform duration-300">

      <!-- Badge Kategori -->
      <span class="absolute top-2 left-2 bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
        Premium
      </span>

      <!-- Badge Promo -->
      <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
        Sale
      </span>
    </div>
  </a>

  <!-- Konten -->
  <div class="p-5">
    <!-- Nama Produk -->
    <h3 class="text-lg font-bold text-gray-800 group-hover:text-gray-800 transition">
      KANSAI PEARLSHEEN
    </h3>

    <!-- Deskripsi -->
    <p class="text-gray-500 text-sm mt-1">
      Cat interior KANSAI PEARLSHEEN cat berkualitas tinggi dan menampilkan sentuhan kemewahan yang abadi bagi dinding Anda.
    </p>

    <!-- Harga -->
    <div class="mt-3">
      <span class="text-xl font-bold text-gray-900">Rp 295.000</span>
    </div>

     <!-- Tombol -->
    <div class="mt-4">
  <a href="javascript:void(0)"
    class="add-to-cart w-15px inline-flex justify-items-start items-center px-4 py-2 bg-blue-800 text-white font-semibold rounded-xl hover:bg-blue-500 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007.5 18h11a1 1 0 00.9-.55L21 13H7zm5 5a1 1 0 11-2 0 1 1 0 012 0zm8 0a1 1 0 11-2 0 1 1 0 012 0z" />
    </svg>
    Tambah ke Keranjang
    </a>

    <!-- Toast Notification -->
<div id="toast" class="fixed top-16 right-5 hidden z-50 down-20">
  <div class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2">
    <i class="fas fa-check-circle"></i>
    <span id="toast-message">Produk berhasil ditambahkan ke keranjang!</span>
  </div>
</div>
    </div>
  </div>
</div>


<script>
  // 🔥 reset ke 0 setiap kali halaman direfresh
  let cartCount = 0;
  localStorage.setItem("cartCount", cartCount);

  const cartCountEl = document.getElementById("cart-count");
  const cartBtn = document.getElementById("cart-btn");

  // set tampilan awal
  cartCountEl.textContent = cartCount;

  // event untuk semua tombol "Tambah ke Keranjang"
  document.querySelectorAll(".add-to-cart").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();

      cartCount++;
      cartCountEl.textContent = cartCount;

      // simpan ke localStorage (tetap update, walau akan reset saat reload)
      localStorage.setItem("cartCount", cartCount);

      // animasi bounce
      cartBtn.classList.add("animate-bounce");
      setTimeout(() => {
        cartBtn.classList.remove("animate-bounce");
      }, 500);
    });
  });

  // Ambil elemen toast
const toast = document.getElementById("toast");
const toastMsg = document.getElementById("toast-message");

// Fungsi tampilkan notifikasi
function showToast(message) {
  toastMsg.textContent = message;
  toast.classList.remove("hidden");
  toast.classList.add("animate-slide-in");

  // Hilang otomatis setelah 2.5 detik
  setTimeout(() => {
    toast.classList.add("hidden");
    toast.classList.remove("animate-slide-in");
  }, 2500);
}

// Event untuk semua tombol Tambah ke Keranjang
document.querySelectorAll(".add-to-cart").forEach(btn => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();

    cartCount++;
    cartCountEl.textContent = cartCount;
    localStorage.setItem("cartCount", cartCount);

    // animasi keranjang bounce
    cartBtn.classList.add("animate-bounce");
    setTimeout(() => cartBtn.classList.remove("animate-bounce"), 500);

    // munculkan notifikasi
    showToast("Produk berhasil ditambahkan ke keranjang!");
  });
});
</script>
</body>