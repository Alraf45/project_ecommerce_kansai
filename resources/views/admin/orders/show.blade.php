@include('layout.adminhead')
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Pesanan | Kansai Paint Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800" x-data="{ sidebarOpen: true }">

<div class="flex pt-[10px]">
  <main class="ml-64 flex-1 p-8 bg-gray-50 min-h-screen mt-[-65px] transition-all duration-300">

    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-blue-900 flex items-center gap-2">
        <i class="fa-solid fa-receipt"></i> Detail Pesanan
      </h1>
      <a href="{{ route('admin.orders.index') }}" 
         class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
         ← Kembali
      </a>
    </div>

    <!-- Info Pembeli -->
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
      <h2 class="text-xl font-semibold text-blue-900 mb-4 border-b pb-2">Informasi Pembeli</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p><span class="font-semibold text-gray-700">Nama:</span> {{ $order->name }}</p>
          <p><span class="font-semibold text-gray-700">Alamat:</span> {{ $order->address }}</p>
          <p><span class="font-semibold text-gray-700">No. Telepon:</span> {{ $order->phone }}</p>
        </div>
        <div>
          <p><span class="font-semibold text-gray-700">Tanggal Pesanan:</span> {{ $order->created_at->format('d M Y, H:i') }}</p>
          <p><span class="font-semibold text-gray-700">Total Pembayaran:</span> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
          <p><span class="font-semibold text-gray-700">Status:</span> 
            <span class="
              px-3 py-1 rounded-full text-xs font-semibold
              @if($order->status == 'pending') bg-yellow-100 text-yellow-700
              @elseif($order->status == 'processing') bg-blue-100 text-blue-700
              @elseif($order->status == 'completed') bg-green-100 text-green-700
              @else bg-red-100 text-red-700 @endif">
              {{ ucfirst($order->status) }}
            </span>
          </p>
        </div>
      </div>
    </div>

    <!-- Produk yang Dipesan -->
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
      <h2 class="text-xl font-semibold text-blue-900 mb-4 border-b pb-2">Daftar Produk</h2>

      @if($order->items && count($order->items) > 0)
        <div class="overflow-x-auto">
          <table class="min-w-full text-left text-sm text-gray-700">
            <thead class="bg-blue-900 text-white">
              <tr>
                <th class="px-6 py-3">#</th>
                <th class="px-6 py-3">Produk</th>
                <th class="px-6 py-3">Harga</th>
                <th class="px-6 py-3">Qty</th>
                <th class="px-6 py-3">Subtotal</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach($order->items as $item)
              <tr>
                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                <td class="px-6 py-4">{{ $item->product->name ?? '-' }}</td>
                <td class="px-6 py-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="px-6 py-4">{{ $item->quantity }}</td>
                <td class="px-6 py-4">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-gray-500">Tidak ada produk dalam pesanan ini.</p>
      @endif
    </div>

    <!-- Update Status -->
    <div class="bg-white p-6 rounded-xl shadow-md">
      <h2 class="text-xl font-semibold text-blue-900 mb-4 border-b pb-2">Perbarui Status Pesanan</h2>

      <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-4">
        @csrf
        @method('PUT')
        <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
          <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
          <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
          <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit" 
                class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
          Simpan Perubahan
        </button>
      </form>
    </div>

  </main>
</div>

</body>
</html>
