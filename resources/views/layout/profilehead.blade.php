<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profil Saya</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Efek shimmer lembut */
    .shimmer {
      background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0) 100%);
      background-size: 200% 100%;
      animation: shimmer 2.5s infinite;
    }

    @keyframes shimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }
  </style>
</head>
<body class="bg-gray-50">

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
     x-transition.scale.origin.top.right
     class="absolute right-0 mt-3 w-56 bg-white/80 backdrop-blur-lg border border-gray-200 
            shadow-[0_8px_30px_rgba(0,0,0,0.1)] rounded-2xl py-3 z-50 transition-all duration-300 ease-out">


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


</body>
</html>
