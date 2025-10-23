<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pesanan | Kansai Paint</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- 🔹 HEADER -->
  <header class="bg-white shadow-md py-4 px-8 flex justify-between items-center border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center gap-3">
      <img src="/img/logo.png" alt="Kansai Paint Logo" class="h-14">
    </div>
    <a href="{{ url('/') }}" class="text-blue-700 hover:text-blue-900 font-semibold">
      <i class="fa-solid fa-store"></i> Belanja Lagi
    </a>
  </header>

  <main class="max-w-6xl mx-auto mt-28 mb-20 px-6 lg:px-10">
    <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-10 relative overflow-hidden">
      <!-- 🌤️ Background Gradient -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-blue-100 opacity-60 pointer-events-none rounded-3xl"></div>

      <div class="relative z-10">
        <!-- 🏷️ Judul -->
        <div class="text-center mb-12">
          <h2 class="text-4xl font-extrabold text-blue-900 tracking-tight drop-shadow-sm">
            Riwayat Pesanan Saya
          </h2>
          <p class="text-gray-600 mt-3 text-lg">Pantau status pesananmu dengan tampilan yang elegan dan mudah dipahami.</p>
        </div>

        @if($orders->isEmpty())
          <!-- ❌ Jika Belum Ada Pesanan -->
          <div class="text-center py-20">
            <img src="/img/empty-orders.svg" alt="Tidak ada pesanan" class="mx-auto h-40 mb-8 opacity-80">
            <p class="text-gray-600 text-lg mb-4">Belum ada pesanan yang tercatat.</p>
            <a href="{{ url('/') }}" 
              class="inline-flex items-center gap-2 px-8 py-3 bg-blue-900 text-white rounded-full font-semibold shadow-md hover:bg-blue-800 hover:scale-105 transition">
              <i class="fa-solid fa-store"></i> Belanja Sekarang
            </a>
          </div>
        @else
          <!-- 📋 Tabel Pesanan -->
          <div class="overflow-x-auto rounded-2xl border border-gray-200 shadow-lg bg-white">
            <table class="w-full text-left border-collapse">
              <thead class="bg-blue-900 text-white text-sm uppercase tracking-wide">
                <tr>
                  <th class="px-6 py-4 font-semibold">ID Pesanan</th>
                  <th class="px-6 py-4 font-semibold">Tanggal</th>
                  <th class="px-6 py-4 font-semibold">Total</th>
                  <th class="px-6 py-4 font-semibold">Status</th>
                  <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100 text-gray-700">
                @foreach($orders as $order)
                  <tr class="hover:bg-blue-50 transition-all duration-300 ease-in-out">
                    <td class="px-6 py-4 font-semibold text-blue-900">#{{ $order->id }}</td>
                    <td class="px-6 py-4">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                      Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                      <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-700
                        @elseif($order->status == 'completed') bg-green-100 text-green-700
                        @else bg-gray-100 text-gray-600 @endif">
                        {{ ucfirst($order->status) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                      <a href="{{ route('orders.show', $order->id) }}" 
                        class="inline-flex items-center gap-2 px-5 py-2 bg-blue-900 text-white text-sm rounded-full shadow-md hover:bg-blue-800 hover:scale-105 transition-all duration-200">
                        <i class="fa-solid fa-eye"></i> Lihat Detail
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </main>

  <footer class="bg-blue-900 text-white text-center py-6 mt-auto">
    © 2025 Kansai Paint. All rights reserved.
  </footer>

</body>
</html>
