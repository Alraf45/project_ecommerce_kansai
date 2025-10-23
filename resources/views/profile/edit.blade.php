<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">

  <!-- 🧭 Header -->
  @include('layout.profilehead')
<div class="mt-24"></div>
  <!-- 💠 Konten -->
  <div class="py-16">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

      <!-- 🧍‍♂️ Kartu Profil -->
      <div class="relative bg-white rounded-3xl border border-gray-100 shadow-2xl hover:shadow-[0_10px_40px_rgba(30,58,138,0.15)] transition-all duration-500 p-10 mb-12">
        <div class="absolute -top-3 -left-3 w-20 h-20 bg-gradient-to-br from-blue-700 via-blue-500 to-indigo-400 blur-3xl opacity-30 rounded-full"></div>
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-10 relative z-10">

          <!-- Foto Profil -->
          <div 
            x-data="{ 
              preview: '{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('img/default.png') }}' 
            }"
            class="relative group"
          >
            <input type="file" name="profile_picture" id="profileInput"
                   @change="preview = URL.createObjectURL($event.target.files[0])"
                   class="hidden" form="profile-form">

            <label for="profileInput" class="cursor-pointer block relative">
              <img :src="preview" 
                   alt="Foto Profil"
                   class="w-36 h-36 rounded-full object-cover border-4 border-blue-800 shadow-lg transition-all duration-500 group-hover:opacity-80 group-hover:scale-105">
              <div class="absolute inset-0 bg-black/30 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition">
                <span class="text-white text-sm font-semibold">Ganti Foto</span>
              </div>
            </label>
          </div>

          <!-- Info User -->
          <div class="text-center sm:text-left mt-6 sm:mt-0">
            <h3 class="text-3xl font-extrabold text-blue-900">{{ auth()->user()->name }}</h3>
            <p class="text-gray-600 mt-1 text-lg">{{ auth()->user()->email }}</p>
            <p class="text-gray-400 text-sm mt-1">
              Bergabung sejak <span class="font-medium text-blue-800">{{ auth()->user()->created_at->format('d M Y') }}</span>
            </p>
          </div>
        </div>
      </div>

      <!-- 📝 Form Edit Profil -->
      <div class="relative bg-white rounded-3xl border border-gray-100 shadow-xl hover:shadow-[0_8px_35px_rgba(30,58,138,0.15)] transition-all duration-500 p-10 mb-12">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-tl from-blue-200/50 via-transparent to-indigo-300/50 rounded-full blur-2xl"></div>

        <div class="flex items-center justify-between mb-10 relative z-10">
          <h3 class="text-2xl font-bold text-blue-900 tracking-tight">Ubah Informasi Profil</h3>
          <div class="h-1 w-28 bg-gradient-to-r from-blue-900 via-indigo-700 to-blue-500 rounded-full"></div>
        </div>

        <form id="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="relative z-10">
          @csrf
          @method('PATCH')

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Nama -->
            <div>
              <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">Nama Lengkap</label>
              <input type="text" name="name" value="{{ auth()->user()->name }}" 
                     class="mt-2 w-full border border-gray-200 rounded-2xl p-4 text-gray-800 shadow-inner focus:ring-2 focus:ring-blue-900 focus:border-transparent transition-all duration-300">
            </div>

            <!-- Email -->
            <div>
              <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">Email</label>
              <input type="email" name="email" value="{{ auth()->user()->email }}" 
                     class="mt-2 w-full border border-gray-200 rounded-2xl p-4 text-gray-800 shadow-inner focus:ring-2 focus:ring-blue-900 focus:border-transparent transition-all duration-300">
            </div>
          </div>

          <!-- Tombol Simpan -->
          <div class="mt-12 flex justify-end">
            <button type="submit"
                    class="bg-gradient-to-r from-blue-900 via-indigo-800 to-blue-700 hover:from-blue-800 hover:via-indigo-700 hover:to-blue-600 text-white font-semibold px-10 py-3 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-500 flex items-center gap-2">
              💾 <span>Simpan Perubahan</span>
            </button>
          </div>
        </form>
      </div>

      <!-- 🏠 Tombol Kembali ke Home -->
      <div class="text-center mt-10">
        <a href="{{ url('/') }}" 
           class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-900 to-indigo-700 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-500">
          🏠 <span>Kembali ke Beranda</span>
        </a>
      </div>

    </div>
  </div>

</body>
</html>
