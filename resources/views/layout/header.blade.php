<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Kansai Paint</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    ::-webkit-scrollbar {
      height: 6px;
      width: 6px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(100, 116, 139, 0.5);
      border-radius: 3px;
    }

    @keyframes cart-bounce {
      0%, 100% { transform: scale(1); }
      30% { transform: scale(1.3) rotate(-5deg); }
      60% { transform: scale(1.3) rotate(5deg); }
    }
    .animate-bounce-cart {
      animation: cart-bounce 0.6s ease-in-out;
    }

    .nav-link {
      position: relative;
      text-color: #1e40af;
      
    }
    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      height: 2px;
      width: 0;
      background-color: #1e40af;
      transition: width 0.4s ease;
      border-radius: 999px;
      text-color: #1e40af;
    }
    .nav-link:hover::after,
    .nav-link.active::after {
      width: 100%;
    }
  </style>
</head>

<body class="bg-white font-sans text-gray-700">

  <!-- Navbar -->
  <nav class="w-full flex flex-wrap items-center justify-between px-8 py-2 shadow-sm sticky top-0 bg-white z-50">

    <!-- Logo -->
    <a href="/" class="flex items-center space-x-1 px-5">
      <img src="/img/logo.png" class="h-14" alt="Kansai Paint Logo">
    </a>

   <!-- 🌈 Menu Navigasi -->
<ul class="flex flex-wrap items-center gap-x-8 gap-y-3 text-base font-semibold mt-3 md:mt-0 text-color: #1e40af;">

  <!-- 🏠 Beranda -->
  <li>
    <a href="/"
       class="relative nav-link py-2 px-3 text-gray-700 transition-all duration-300 
              after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:rounded-full 
              after:bg-blue-900 after:transition-all after:duration-300
              {{ request()->is('/') 
                  ? 'after:w-full text-blue-900 font-bold' 
                  : 'after:w-0 hover:after:w-full hover:text-blue-900 hover:font-semibold' }}">
      Beranda
    </a>
  </li>

  <!-- 🛍️ Produk -->
  <li class="relative group">
    <a href="/products"
       class="relative flex items-center py-2 px-3 text-gray-700 transition-all duration-300
              after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:rounded-full 
              after:bg-blue-900 after:transition-all after:duration-300
              {{ request()->is('products*') 
                  ? 'after:w-full text-blue-900 font-bold' 
                  : 'after:w-0 hover:after:w-full hover:text-blue-900 hover:font-semibold' }}">
      Produk
      <svg xmlns="http://www.w3.org/2000/svg" 
           class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:rotate-180"
           fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </a>

  <!-- 🔽 Dropdown -->
    <ul class="absolute left-0 mt-3 w-56 bg-white rounded-2xl shadow-xl opacity-0 invisible 
               group-hover:opacity-100 group-hover:visible translate-y-3 group-hover:translate-y-0 
               transition-all duration-300 ease-out border border-gray-100 z-50 backdrop-blur-sm">
      <li>
        <a href="/premium" 
           class="block px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-yellow-500 hover:to-gray-700 
           hover:text-white rounded-t-2xl transition-all duration-300">Premium</a>
      </li>
      <li>
        <a href="/interior" 
           class="block px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-blue-400 hover:to-gray-700 
           hover:text-white transition-all duration-300">Interior</a>
      </li>
      <li>
        <a href="/eksterior" 
           class="block px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-red-700 hover:to-gray-700 
           hover:text-white transition-all duration-300">Eksterior</a>
      </li>
      <li>
        <a href="/kayubesi" 
           class="block px-5 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-gray-400 hover:to-gray-700 
           hover:text-white rounded-b-2xl transition-all duration-300">Kayu & Besi</a>
      </li>
    </ul>

  </li>

  <!-- 🎨 Warna -->
  <li>
    <a href="/colors"
       class="relative nav-link py-2 px-3 text-gray-700 transition-all duration-300 
              after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:rounded-full 
              after:bg-blue-900 after:transition-all after:duration-300
              {{ request()->is('colors*') 
                  ? 'after:w-full text-blue-900 font-bold' 
                  : 'after:w-0 hover:after:w-full hover:text-blue-900 hover:font-semibold' }}">
      Warna
    </a>
  </li>

  @guest
  <!-- 🔑 Masuk -->
  <li>
    <a href="/login"
       class="font-semibold block py-2 px-6 border-2 border-blue-900 rounded-xl text-blue-900 
       hover:bg-gradient-to-r hover:from-blue-900 hover:to-blue-700 hover:text-white 
       hover:shadow-md transition-all duration-300">
      Masuk
    </a>
  </li>

  <!-- 📝 Daftar -->
  <li>
    <a href="/register"
       class="font-semibold block py-2 px-6 rounded-xl bg-gradient-to-r from-blue-900 to-blue-700 text-white 
       border-2 border-transparent hover:border-blue-800 hover:from-white hover:to-white 
       hover:text-blue-900 hover:shadow-md transition-all duration-300">
      Daftar
    </a>
  </li>
  @endguest
</ul>

<!-- 💅 Style Tambahan -->
<style>
.nav-link {
  position: relative;
}
.nav-link:hover {
  text-shadow: 0 0 6px rgba(30, 58, 138, 0.3); /* efek glow biru tua elegan */
}
</style>



    <!-- Search + Cart + User -->
    <div class="flex flex-wrap items-center gap-[29px] mt-3 md:mt-0">

      <!-- Search -->
      <form action="{{ route('search') }}" method="GET" class="relative w-48 md:w-72">
        <input type="text" name="query" placeholder="Cari Produk . . ."
               class="w-full rounded-lg border border-gray-300 py-2 pl-4 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent"
               required/>
        <button type="submit" aria-label="Search" class="absolute right-2 top-2.5 text-gray-400 hover:text-blue-900">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
               viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 10-10.61-10.61 7.5 7.5 0 0010.6 10.6z"/>
          </svg>
        </button>
      </form>

      <!-- Cart -->
      <button id="cart-btn" onclick="window.location.href='/cart'" aria-label="Shopping Cart"
              class="relative p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 flex items-center text-blue-900 hover:text-blue-900">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
             fill="none" class="stroke-current">
          <path d="M6.29977 5H21L19 12H7.37671M20 16H8L6 3H3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.5523 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        @php
          $cart = session('cart', []);
          $cartCount = array_sum(array_column($cart, 'quantity'));
        @endphp
        <span id="cart-count"
              class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
          {{ $cartCount }}
        </span>
      </button>

      <!-- User Dropdown -->
      <!-- User Dropdown -->
@auth
<div class="relative inline-block text-center">
  <button id="dropdownButton"
          class="p-2 rounded-lg focus:outline-none focus:ring-2 text-blue-900 focus:ring-blue-900 hover:text-blue-900">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 16 16" fill="currentColor">
      <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"/>
      <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z"/>
    </svg>
  </button>

  <div id="dropdownMenu"
       class="absolute right-0 w-48 mt-2 origin-top-right bg-white/70 backdrop-blur-md border border-gray-200 shadow-[0_8px_30px_rgba(0,0,0,0.1)] rounded-2xl opacity-0 invisible transition-all duration-300 transform scale-95 z-50">
    <div class="py-2">
      <!-- 👤 Profile -->
      <a href="/profile"
         class="flex items-center gap-3 px-5 py-2.5 text-[15px] text-gray-700 hover:bg-gradient-to-r hover:from-gray-800 hover:to-blue-700 hover:text-white rounded-xl transition-all duration-300">
        <i class="fa-solid fa-screwdriver-wrench text-blue-900"></i>
        <span>Profile</span>
      </a>

      <!-- Riwayat Pesanan -->  
      <a href="/orders"
         class="flex items-center gap-3 px-5 py-2.5 text-[15px] text-gray-700 hover:bg-gradient-to-r hover:from-gray-800 hover:to-blue-700 hover:text-white rounded-xl transition-all duration-300">
        <i class="fa-solid fa-clock-rotate-left text-blue-900"></i>
        <span>Riwayat Pesanan</span>
      </a>

      <!-- ⚙️ Admin (hanya muncul untuk admin) -->
      @if(auth()->user()->role === 'admin')
      <a href="/admin/dashboard"
         class="flex items-center gap-3 px-5 py-2.5 text-[15px] text-gray-700 hover:bg-gradient-to-r hover:from-gray-800 hover:to-blue-700 hover:text-white rounded-xl transition-all duration-300">
        <i class="fa-solid fa-screwdriver-wrench text-blue-900"></i>
        <span>Admin Manage</span>
      </a>
      @endif

      <!-- 🚪 Logout -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="flex items-center gap-3 w-full text-left px-5 py-2.5 text-[15px] text-gray-700 hover:bg-gradient-to-r hover:from-red-600 hover:to-red-700 hover:text-white rounded-xl transition-all duration-300">
          <i class="fa-solid fa-right-from-bracket text-red-700"></i>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>
</div>
@endauth

    </div>
  </nav>

  <!-- Dropdown & Active Menu Script -->
  <script>
    const button = document.getElementById('dropdownButton');
    const menu = document.getElementById('dropdownMenu');

    button?.addEventListener('click', () => {
      menu.classList.toggle('opacity-0');
      menu.classList.toggle('invisible');
    });

    document.addEventListener('click', (e) => {
      if (!button?.contains(e.target) && !menu?.contains(e.target)) {
        menu?.classList.add('opacity-0', 'invisible');
      }
    });

    // Highlight active menu
    const currentPath = window.location.pathname;
    document.querySelectorAll(".nav-link").forEach(link => {
      if (link.getAttribute("href") === currentPath) {
        link.classList.add("text-blue-900", "border-blue-900");
      }
    });

    // 🛒 Update jumlah keranjang di navbar (dipanggil dari AJAX)
    window.updateCartCount = function(count) {
      const el = document.getElementById("cart-count");
      const btn = document.getElementById("cart-btn");
      if (el) el.textContent = count;
      if (btn) {
        btn.classList.add("animate-bounce-cart");
        setTimeout(() => btn.classList.remove("animate-bounce-cart"), 600);
      }
    };
  </script>

  <!-- SweetAlert Notifikasi -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      @if(session('success'))
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: '{{ session("success") }}',
          showConfirmButton: false,
          timer: 2500,
          background: '#1e3a8a',
          color: '#fff',
          customClass: { popup: 'rounded-xl shadow-lg' }
        });
      @endif

      @if(Auth::check() && session('just_logged_in'))
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: '🎉 Selamat datang kembali, {{ session("login_name") }}!',
          showConfirmButton: false,
          timer: 3000,
          background: '#1e3a8a',
          color: '#fff',
          customClass: { popup: 'rounded-xl shadow-lg' }
        });
      @endif
    });
  </script>

</body>
</html>
