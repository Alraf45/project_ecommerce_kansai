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
      <img src="/img/logo.png" class="h-14" alt="Kansai Paint Logo">
    </div>

    <!-- Profil Admin -->
    <div class="relative" x-data="{ open: false }">
      <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
             class="h-10 w-10 rounded-full border">
      </button>

      <!-- Dropdown Profil -->
      <div x-show="open" 
           @click.away="open = false"
           x-transition.scale.origin.top.right
           class="absolute right-0 mt-3 w-56 bg-white/80 backdrop-blur-lg border border-gray-200 
                  shadow-[0_8px_30px_rgba(0,0,0,0.1)] rounded-2xl py-3 z-50 transition-all duration-300 ease-out">
            
        <!-- 👤 Profil -->
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-[15px] text-gray-700 
                  hover:bg-gradient-to-r hover:from-blue-900 hover:to-blue-700 
                  hover:text-white rounded-xl transition-all duration-300">
          <i class="fa-solid fa-user text-blue-900"></i>
          <span>Profil</span>
        </a>

        <!-- 🏠 Home -->
        <a href="/"
           class="flex items-center gap-3 px-5 py-2.5 text-[15px] text-gray-700 
                  hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-700 
                  hover:text-white rounded-xl transition-all duration-300">
          <i class="fa-solid fa-house text-blue-900"></i>
          <span>Beranda</span>
        </a>

        <!-- 🚪 Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-1">
          @csrf
          <button type="submit"
                  class="flex items-center gap-3 w-full text-left px-5 py-2.5 text-[15px] text-gray-700 
                         hover:bg-gradient-to-r hover:from-red-600 hover:to-red-700 
                         hover:text-white rounded-xl transition-all duration-300">
            <i class="fa-solid fa-right-from-bracket text-red-700"></i>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- KONTEN UTAMA -->
  <div class="flex pt-[80px]">

    <!-- 🧭 SIDEBAR ELEGAN -->
    <aside 
      class="bg-gradient-to-b from-blue-900 to-blue-800 text-white min-h-screen fixed top-[80px] left-0 
             transition-all duration-300 ease-in-out shadow-xl flex flex-col justify-between"
      :class="sidebarOpen ? 'w-64' : 'w-20'">

      <!-- 🔹 Navigasi -->
      <ul class="space-y-2 mt-6 flex-1 px-3">
        <li>
          <a href="{{ route('admin.dashboard') }}" 
             class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-blue-700 transition group">
            <span class="text-2xl">📊</span>
            <span x-show="sidebarOpen" class="text-sm font-medium group-hover:translate-x-1 transition">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.users.index') }}" 
             class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-blue-700 transition group">
            <span class="text-2xl">👤</span>
            <span x-show="sidebarOpen" class="text-sm font-medium group-hover:translate-x-1 transition">Pengguna</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.products.index') }}" 
             class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-blue-700 transition group">
            <span class="text-2xl">🎨</span>
            <span x-show="sidebarOpen" class="text-sm font-medium group-hover:translate-x-1 transition">Produk Cat</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.orders.index') }}" 
             class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-blue-700 transition group">
            <span class="text-2xl">🛒</span>
            <span x-show="sidebarOpen" class="text-sm font-medium group-hover:translate-x-1 transition">Order</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.analytics') }}" 
             class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-blue-700 transition group">
            <span class="text-2xl">📈</span>
            <span x-show="sidebarOpen" class="text-sm font-medium group-hover:translate-x-1 transition">Analisis</span>
          </a>
        </li>
      </ul>

      <!-- 🔹 Logout -->
      <div class="p-4 border-t border-blue-700">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" 
                  class="flex items-center space-x-3 w-full px-3 py-2 rounded-lg hover:bg-blue-700 transition">
            <span>🚪</span>
            <span x-show="sidebarOpen" class="text-sm font-medium">Logout</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- ISI HALAMAN -->
    <main class="flex-1 p-8 transition-all duration-300"
          x-bind:class="sidebarOpen ? 'ml-[16rem]' : 'ml-[5rem]'">
      @yield('content')
    </main>

  </div>

</body>
</html>
