<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Pesanan #{{ $order->id }} | Kansai Paint</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- 🔹 HEADER -->
  <header class="bg-white shadow-md py-4 px-8 flex justify-between items-center border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center gap-3">
      <img src="/img/logo.png" alt="Kansai Paint Logo" class="h-14">
    </div>
    <a href="{{ route('orders.index') }}" class="text-blue-700 hover:text-blue-900 font-semibold">
      <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
  </header>

  <main class="max-w-7xl mx-auto mt-28 px-6 lg:px-10 mb-16">
    <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100">
      <!-- Atas: ID & Status -->
      <div class="flex justify-between items-start mb-6">
        <div>
          <h2 class="text-2xl font-bold text-blue-900">Pesanan #{{ $order->id }}</h2>
          <p class="text-gray-500 mt-1">Dibuat: {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <span class="px-5 py-2 rounded-full text-sm font-semibold
          @if($order->status == 'pending') bg-yellow-100 text-yellow-700
          @elseif($order->status == 'processing') bg-blue-100 text-blue-700
          @elseif($order->status == 'completed') bg-green-100 text-green-700
          @elseif($order->status == 'cancelled') bg-red-100 text-red-700
          @endif">
          {{ ucfirst($order->status) }}
        </span>
      </div>

      <!-- GRID 2 KOLOM -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- 📞 Kolom Kiri: Info & Pengiriman -->
        <div class="space-y-6">
          <!-- Info Pembayaran -->
          <div class="border rounded-xl p-5 bg-blue-50/50">
            <h3 class="text-lg font-semibold text-blue-900 mb-3"><i class="fa-solid fa-money-bill-wave"></i> Informasi Pembayaran</h3>
            <div class="flex justify-between text-gray-700">
              <span>Subtotal</span>
              <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-gray-700">
              <span>Ongkir</span>
              <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-lg font-bold text-blue-900 border-t pt-3 mt-3">
              <span>Total</span>
              <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
          </div>

          <!-- Info Pengiriman -->
          <div class="border rounded-xl p-5 bg-gray-50">
            <h3 class="text-lg font-semibold text-blue-900 mb-3"><i class="fa-solid fa-truck"></i> Data Pengiriman</h3>
            <p><strong>Nama:</strong> {{ $order->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>
            <p><strong>Telepon:</strong> {{ $order->phone }}</p>
          </div>
        </div>

        <!-- 📦 Kolom Kanan: Produk -->
        <div class="border rounded-xl p-5 bg-gray-50 max-h-[600px] overflow-y-auto">
          <h3 class="text-lg font-semibold text-blue-900 mb-4"><i class="fa-solid fa-box"></i> Produk Dipesan</h3>
          <div class="divide-y divide-gray-200">
            @foreach($order->items as $item)
              <div class="flex justify-between py-4 items-center">
                <div class="flex items-center gap-4">
                  <div class="w-16 h-16 rounded-lg overflow-hidden bg-white border">
                    <img src="{{ asset('img/products/' . basename($item->product->image)) }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain">
                  </div>
                  <div>
                    <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                    <p class="text-gray-500 text-sm">x{{ $item->quantity }}</p>
                  </div>
                </div>
                <p class="font-semibold text-blue-800 text-sm">
                  Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </p>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-blue-900 text-white text-center py-6 mt-auto">
    © 2025 Kansai Paint. All rights reserved.
  </footer>

</body>
</html>
