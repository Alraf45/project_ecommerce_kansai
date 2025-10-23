@include('layout.adminhead')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard | Kansai Paint</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800" x-data="{ sidebarOpen: true">
<div class="flex pt-[10px]"> {{-- padding top agar tidak tertutup header --}}
  <!-- MAIN CONTENT -->


  
   <main class="ml-64 flex-1 p-6 bg-gray-50 min-h-screen mt-[-65px]">

    <h1 class="text-3xl font-bold text-gray-900 mb-6">Selamat Datang, {{ Auth::user()->name }}!</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Card Statistik -->
      <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
        <h3 class="text-gray-500 text-sm font-medium">Total Produk</h3>
        <p class="text-3xl font-bold text-blue-900 mt-2">{{ $products->count() }}</p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
        <h3 class="text-gray-500 text-sm font-medium">Pesanan Hari Ini</h3>
        <p class="text-3xl font-bold text-blue-900 mt-2"></p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
        <h3 class="text-gray-500 text-sm font-medium">Pengguna Aktif</h3>
        <p class="text-3xl font-bold text-blue-900 mt-2">{{ $users->count() }}</p>
      </div>
    </div>
  </main>
</div>

</body>
</html>
    