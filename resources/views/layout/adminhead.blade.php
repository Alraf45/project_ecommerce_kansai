<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard | Kansai Paint</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800" x-data="{ sidebarOpen: true }">

  <!-- HEADER -->
  <header class="flex items-center justify-between bg-white px-8 py-4 shadow-md border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
    <!-- Logo -->
    <div class="flex items-center space-x-3">
      <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700 focus:outline-none md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      
     
      <img src="/img/logo.png" class="h-14 "  alt="Kansai Paint Logo">


    </div>

    <!-- Profil Admin -->
    <div class="relative" x-data="{ open: false }">
      <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
             class="h-10 w-10 rounded-full border">
      </button>

      <div x-show="open" 
           @click.away="open = false"
           x-transition
           class="absolute right-0 mt-3 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">👤 Profil</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">⚙️ Pengaturan</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">🚪 Logout</button>
        </form>
      </div>
    </div>
  </header>

  <!-- KONTEN UTAMA -->
  <div class="flex pt-[80px]"> {{-- padding top agar tidak tertutup header --}}
    <!-- SIDEBAR -->
    <aside 
      class="bg-blue-900 text-white min-h-screen p-6 fixed top-[80px] left-0 transition-all duration-300 ease-in-out"
      :class="sidebarOpen ? 'w-64' : 'w-20'">

      <ul class="space-y-3 mt-6">
        <li>
          <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 hover:bg-blue-800 px-3 py-2 rounded-md transition">
            <span>📊</span>
            <span x-show="sidebarOpen">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 hover:bg-blue-800 px-3 py-2 rounded-md transition">
            <span>👤</span>
            <span x-show="sidebarOpen">Pengguna</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.products.index') }}" class="flex items-center space-x-3 hover:bg-blue-800 px-3 py-2 rounded-md transition">
            <span>🎨</span>
            <span x-show="sidebarOpen">Produk Cat</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 hover:bg-blue-800 px-3 py-2 rounded-md transition">
            <span>🛒</span>
            <span x-show="sidebarOpen">Order</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.analytics') }}" class="flex items-center space-x-3 hover:bg-blue-800 px-3 py-2 rounded-md transition">
            <span>📈</span>
            <span x-show="sidebarOpen">Analisis</span>
          </a>
        </li>
      </ul>
    </aside>

    <!-- ISI HALAMAN -->
    <main class="flex-1 p-8 ml-[16rem]" x-bind:class="!sidebarOpen ? 'ml-[5rem]' : 'ml-[16rem]'">
      @yield('content')
    </main>
  </div>

</body>
</html>
