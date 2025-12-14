@include('layout.adminhead')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Produk Cat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">


<div class="flex pt-[10px]">
    <main class="ml-64 flex-1 p-8 min-h-screen mt-[-65px]">
        <div class="container mx-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Daftar Produk</h1>
                    <p class="text-gray-500 mt-1 text-sm">Kelola data produk cat</p>
                </div>
                <a href="{{ route('admin.products.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow transition duration-200">
                    + Tambah Produk
                </a>
            </div>

            {{-- Notifikasi sukses --}}
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow">
                    {{ $message }}
                </div>
            @endif

            {{-- Tabel Produk --}}
            <div class="overflow-hidden bg-white rounded-2xl shadow-md">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wide">
                        <tr>
                            <th class="px-5 py-3 text-left">No</th>
                            <th class="px-5 py-3 text-left">Nama</th>
                            <th class="px-5 py-3 text-left">Kategori</th>
                            <th class="px-5 py-3 text-left">Warna</th>
                            <th class="px-5 py-3 text-left">Harga</th>
                            <th class="px-5 py-3 text-left">Stok</th>
                            <th class="px-5 py-3 text-center">Gambar</th>
                            <th class="px-5 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $i => $product)
                            <tr class="border-t hover:bg-gray-50 transition">
                                <td class="px-5 py-3 text-gray-600">{{ $i + $products->firstItem() }}</td>
                                <td class="px-5 py-3 font-semibold text-gray-800">{{ $product->name }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-5 py-3 font-medium text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $product->stock }}</td>
                                <td class="px-5 py-3 text-center">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                                            class="w-20 h-20 object-contain mx-auto rounded-lg shadow-sm">
                                    @else
                                        <span class="text-gray-400">Tidak ada gambar</span>
                                    @endif
                                </td>
                               <td class="px-4 py-3 border text-center">
    <div class="flex flex-col items-center gap-2">
        {{-- Tombol Edit --}}
        <a href="{{ route('admin.products.edit', $product->id) }}" 
           class="inline-flex items-center justify-center gap-1 bg-yellow-500 hover:bg-yellow-600 
                  text-white text-sm font-semibold px-4 py-2 rounded-md shadow-sm w-24
                  transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M15.232 5.232a3 3 0 014.243 4.243L7.5 21.5H3v-4.5L15.232 5.232z" />
            </svg>
            Edit
        </a>

        {{-- Tombol Hapus --}}
        <form action="{{ route('admin.products.destroy', $product->id) }}" 
              method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="inline-flex items-center justify-center gap-1 bg-red-600 hover:bg-red-700 
                           text-white text-sm font-semibold px-4 py-2 rounded-md shadow-sm w-24
                           transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" 
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
                Hapus
            </button>
        </form>
    </div>
</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6 flex justify-end">
                {{ $products->links() }}
            </div>
        </div>
    </main>
</div>

</body>
</html>
