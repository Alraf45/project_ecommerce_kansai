@include('layout.adminhead')
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pesanan | Kansai Paint Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800" x-data="{ sidebarOpen: true }">

<div class="flex pt-[10px]">
  <!-- MAIN CONTENT -->
  <main class="ml-64 flex-1 p-8 bg-gray-50 min-h-screen mt-[-65px] transition-all duration-300">

    <h1 class="text-3xl font-bold text-blue-900 mb-6 flex items-center gap-2">
      <i class="fa-solid fa-box-archive"></i> Riwayat Pesanan
    </h1>

    <!-- Notifikasi -->
    @if(session('success'))
      <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-5 border border-green-300">
        {{ session('success') }}
      </div>
    @endif

    <!-- Tabel Riwayat Pesanan -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-100">
      <table class="min-w-full text-left text-sm text-gray-700">
        <thead class="bg-blue-900 text-white">
          <tr>
            <th class="px-6 py-3">No</th>
            <th class="px-6 py-3">Nama Pemesan</th>
            <th class="px-6 py-3">Total</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Tanggal</th>
            <th class="px-6 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($orders as $order)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
              <td class="px-6 py-4">{{ $order->name }}</td>
              <td class="px-6 py-4">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <td class="px-6 py-4">
                <span class="
                  px-3 py-1 rounded-full text-xs font-semibold
                  @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                  @elseif($order->status == 'processing') bg-blue-100 text-blue-700
                  @elseif($order->status == 'completed') bg-green-100 text-green-700
                  @else bg-red-100 text-red-700 @endif">
                  {{ ucfirst($order->status) }}
                </span>
              </td>
              <td class="px-6 py-4">{{ $order->created_at->format('d M Y, H:i') }}</td>
              <td class="px-6 py-4 flex justify-center items-center gap-2">
                <a href="{{ route('admin.orders.show', $order->id) }}" 
                   class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                   Detail
                </a>
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                    class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Hapus
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                Belum ada pesanan yang masuk.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{ $orders->links('pagination::tailwind') }}
    </div>

  </main>
</div>

</body>
</html>
