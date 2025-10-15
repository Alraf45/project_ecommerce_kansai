@include('layout.adminhead')

<div class="flex pt-[10px]">
  {{-- Main content --}}
  <main class="ml-64 flex-1 p-8 min-h-screen mt-[-65px]">
    <div class="container mx-auto">

      {{-- Header --}}
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Tambah Produk Baru</h1>
          <p class="text-gray-500 mt-1 text-sm">Isi informasi lengkap untuk menambahkan produk cat baru</p>
        </div>
        <a href="{{ route('admin.products.index') }}"
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium px-5 py-2.5 rounded-lg shadow transition duration-200">
          ← Kembali
        </a>
      </div>

      {{-- Card Form --}}
      <div class="bg-white p-8 rounded-2xl shadow-md">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          {{-- Nama Produk --}}
          <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-2">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            @error('name')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Kategori --}}
          <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-2">Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            @error('category')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Warna --}}
          <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-2">Warna</label>
            <input type="text" name="color" value="{{ old('color') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            @error('color')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Harga --}}
          <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-2">Harga</label>
            <input type="number" name="price" value="{{ old('price') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            @error('price')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Stok --}}
          <div class="mb-5">
            <label class="block font-semibold text-gray-700 mb-2">Stok</label>
            <input type="number" name="stock" value="{{ old('stock') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            @error('stock')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Upload Gambar --}}
          <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Gambar Produk</label>
            <input type="file" name="image_url"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('image_url')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Tombol --}}
          <div class="flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2.5 rounded-lg shadow transition duration-200">
               Batal
            </a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition duration-200">
              Simpan Produk
            </button>
          </div>
        </form>
      </div>

    </div>
  </main>
</div>
  