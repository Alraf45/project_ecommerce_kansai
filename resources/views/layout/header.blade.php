<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" /> 
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Kansai Paint</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      height: 6px;
      width: 6px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(100, 116, 139, 0.5);
      border-radius: 3px;
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

    </div>

    <!-- Dropdown -->
    <ul class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm font-medium text-gray-700 mt-3 md:mt-0">
      <li><a href="/" class="font-semibold nav-link block py-2 px-2 border-b-2 border-transparent hover:border-blue-900 hover:text-blue-900 transition-all">Beranda</a></li>
      <li class="relative group">
        <a href="/products" class="nav-link block py-2 px-2 border-b-2 border-transparent hover:border-blue-900 hover:text-blue-900 transition-all font-semibold ">Produk</a>
        <ul class="absolute hidden group-hover:block bg-white shadow-md rounded-md mt-2 w-96 z-50">
          <li><a href="/interior" class="block px-4 py-2 hover:bg-gray-100">Interior</a></li>
          <li><a href="/eksterior" class="block px-4 py-2 hover:bg-gray-100">Eksterior</a></li>
          <li><a href="/kayubesi" class="block px-4 py-2 hover:bg-gray-100">Kayu & Besi</a></li>
          <li><a href="/premium" class="block px-4 py-2 hover:bg-gray-100">Premium</a></li>
        </ul>
      </li>
      <li><a href="/colors" class="font-semibold nav-link block py-2 px-2 border-b-2 border-transparent hover:border-blue-900 hover:text-blue-900 transition-all">Warna</a></li>
      <li>
        <a href="/login" class="font-semibold nav-link block py-2 px-6 border-2 border-blue-900 rounded-lg text-blue-900 hover:border-blue-700 hover:bg-blue-700 hover:text-white transition-all">Masuk</a>
      </li>
      <li>
        <a href="/register" class="font-semibold bg-blue-900 text-white nav-link block py-2 px-6 border-2 rounded-lg hover:border-blue-600 transition-all hover:text-blue-600">Daftar</a>
      </li>
    </ul>


  


    <!-- Search + Cart + User -->
    <div class="flex flex-wrap items-center gap-[29px] mt-3 md:mt-0">

      <!-- Search -->
      <form action="{{ route('search') }}" method="GET" class="relative w-48 md:w-72">
  <input type="text" name="query" placeholder="Cari Produk . . ." 
         class="w-full rounded-lg border border-gray-300 py-2 pl-4 pr-10 text-sm 
                focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent" required/>
  <button type="submit" aria-label="Search" class="absolute right-2 top-2.5 text-gray-400 hover:text-blue-900">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 10-10.61-10.61 7.5 7.5 0 0010.6 10.6z"/>
    </svg>
  </button>
</form>


  
              <!--cart-->
      <a href="/cart">
        <button id="cart-btn" aria-label="Shopping Cart"
          class="relative p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 flex items-center 
                 text-blue-900 hover:text-blue-900">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" class="stroke-current">
            <path d="M6.29977 5H21L19 12H7.37671M20 16H8L6 3H3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.5523 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span id="cart-count"
            class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold 
                  w-5 h-5 flex items-center justify-center rounded-full">
            0
          </span>
        </button>
      </a>

@if(session('success'))
<div 
    id="toast-success" 
    class="fixed top-5 right-5 z-50 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg animate-bounce"
>
    {{ session('success') }}
</div>

<script>
    setTimeout(() => {
        document.getElementById('toast-success')?.remove();
    }, 3000);
</script>
@endif




      
      <!-- Dropdown User -->
      <div class="relative inline-block text-center">
        <button id="dropdownButton" class="p-2 rounded-lg focus:outline-none focus:ring-2 text-blue-900 focus:ring-blue-900 hover:text-blue-900">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 16 16" fill="currentColor">

            <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"/>
            <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z"/>
          </svg>
        </button>


        <!-- Dropdown menu -->
        <div id="dropdownMenu"
          class="absolute right-0 w-40 mt-1 origin-top-right bg-white divide-y divide-gray-100 
                rounded-md shadow-lg opacity-0 invisible transition duration-300">
          <div class="py-1">
            <a href="/order history" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
            <a href="/settings" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Setting</a>
            <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
        </form>
          </div>
        </div>
      </div>
    </div>
  </nav>


  <!-- Dropdown Script -->

  <script>
    
    const button = document.getElementById('dropdownButton');
    const menu = document.getElementById('dropdownMenu');
    button.addEventListener('click', () => {
      menu.classList.toggle('opacity-0');
      menu.classList.toggle('invisible');
    });
    document.addEventListener('click', (e) => {
      if (!button.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('opacity-0', 'invisible');
      }
    });




  

    const currentPath = window.location.pathname;
    document.querySelectorAll(".nav-link").forEach(link => {
      if (link.getAttribute("href") === currentPath) {
        link.classList.add("text-blue-400", "border-blue-400");
      }
    });

    window.addEventListener("load", () => {
      localStorage.setItem("cartCount", 0);
      document.getElementById("cart-count").textContent = "0";
    });
  </script>


</body>
</html>
