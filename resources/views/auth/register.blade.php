<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Kansai Paint</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
      animation: fadeInUp 0.8s ease-out forwards;
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center relative overflow-hidden" 
      style="background-image: url('{{ asset('img/base/bg4.png') }}');">

  <!-- 🌈 Gradient Overlay -->
  <div class="absolute inset-0 bg-gradient-to-br from-sky-900/80 via-sky-700/70 to-blue-600/60 backdrop-blur-sm"></div>

  <!-- ✨ Efek Cahaya -->
  <div class="absolute -top-32 -right-32 w-96 h-96 bg-sky-400/30 rounded-full blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>

  <!-- 💎 Card Register -->
  <div class="relative z-10 w-full max-w-md bg-white rounded-3xl shadow-2xl p-10 mx-4 animate-fadeInUp border border-gray-200">

    <!-- 🔹 Logo -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('img/logo.png') }}" alt="Kansai Paint" class="h-14 drop-shadow-md">
    </div>

    <!-- 🔹 Form Register -->
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div class="mb-4">
        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-sky-700 font-semibold"/>
        <x-text-input id="name" 
                      class="block mt-1 w-full rounded-xl bg-gray-50 border border-gray-300 text-gray-800 shadow-sm focus:ring-sky-500 focus:border-sky-500 placeholder-gray-400" 
                      type="text" 
                      name="name" 
                      :value="old('name')" 
                      required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
      </div>

      <!-- Email -->
      <div class="mb-4">
        <x-input-label for="email" :value="__('Email')" class="text-sky-700 font-semibold"/>
        <x-text-input id="email" 
                      class="block mt-1 w-full rounded-xl bg-gray-50 border border-gray-300 text-gray-800 shadow-sm focus:ring-sky-500 focus:border-sky-500 placeholder-gray-400" 
                      type="email" 
                      name="email" 
                      :value="old('email')" 
                      required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
      </div>

      <!-- Password -->
      <div class="mb-4">
        <x-input-label for="password" :value="__('Password')" class="text-sky-700 font-semibold"/>
        <x-text-input id="password" 
                      class="block mt-1 w-full rounded-xl bg-gray-50 border border-gray-300 text-gray-800 shadow-sm focus:ring-sky-500 focus:border-sky-500 placeholder-gray-400" 
                      type="password" 
                      name="password" 
                      required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
      </div>

      <!-- Confirm Password -->
      <div class="mb-6">
        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-sky-700 font-semibold"/>
        <x-text-input id="password_confirmation" 
                      class="block mt-1 w-full rounded-xl bg-gray-50 border border-gray-300 text-gray-800 shadow-sm focus:ring-sky-500 focus:border-sky-500 placeholder-gray-400" 
                      type="password" 
                      name="password_confirmation" 
                      required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
      </div>

      <!-- 🔘 Tombol Register -->
      <x-primary-button 
        class="w-full justify-center bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 rounded-xl shadow-md transition duration-300 ease-in-out transform hover:scale-[1.03] hover:shadow-lg">
        {{ __('Register') }}
      </x-primary-button>

      <!-- 🔹 Sudah punya akun -->
      <p class="text-center text-sm text-gray-600 mt-6">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-sky-600 hover:text-sky-800 font-semibold transition">
          Login di sini
        </a>
      </p>
    </form>
  </div>
</body>
</html>
