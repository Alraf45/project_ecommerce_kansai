<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Kansai Paint</title>
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

<body class="min-h-screen flex items-center justify-center bg-center bg-no-repeat relative overflow-hidden"
      style="background-image: url('{{ asset('img/base/bg4.png') }}'); background-size: cover;">

  <!-- 🌈 Gradient Overlay -->
  <div class="absolute inset-0 bg-gradient-to-br from-sky-900/70 via-sky-800/60 to-blue-600/60 backdrop-blur-sm"></div>

  <!-- ✨ Efek Cahaya -->
  <div class="absolute -top-32 -right-32 w-96 h-96 bg-sky-400/30 rounded-full blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>

  <!-- 💎 Card Login -->
  <div class="relative z-10 w-full max-w-md bg-white rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.2)] p-10 mx-4 animate-fadeInUp border border-gray-100">

    <!-- 🔹 Logo -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('img/logo.png') }}" alt="Kansai Paint" class="h-14 drop-shadow-md">
    </div>


    <!-- 🔹 Session Status -->
    <x-auth-session-status class="mb-4 text-gray-700" :status="session('status')" />

    <!-- 🔹 Form Login -->
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email -->
      <div class="mb-4">
        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold"/>
        <x-text-input id="email" 
                      class="block mt-1 w-full rounded-xl bg-gray-50 border border-gray-300 text-gray-800 shadow-sm focus:ring-sky-500 focus:border-sky-500 placeholder-gray-400" 
                      type="email" 
                      name="email" 
                      :value="old('email')" 
                      required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
      </div>

      <!-- Password -->
      <div class="mb-4">
        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold"/>
        <x-text-input id="password" 
                      class="block mt-1 w-full rounded-xl bg-gray-50 border border-gray-300 text-gray-800 shadow-sm focus:ring-sky-500 focus:border-sky-500 placeholder-gray-400" 
                      type="password" 
                      name="password" 
                      required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
      </div>

      <!-- Remember Me & Forgot -->
      <div class="flex items-center justify-between mb-6">
        <label for="remember_me" class="inline-flex items-center">
          <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500" name="remember">
          <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>

        @if (Route::has('password.request'))
          <a class="text-sm text-sky-600 hover:text-sky-500 transition" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
          </a>
        @endif
      </div>

      <!-- 🔘 Tombol Login -->
      <x-primary-button 
        class="w-full justify-center bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 rounded-xl shadow-md transition duration-300 ease-in-out transform hover:scale-[1.03] hover:shadow-lg">
        {{ __('Log in') }}
      </x-primary-button>
    </form>

    <!-- 🧭 Belum punya akun -->
    @if (Route::has('register'))
      <p class="text-center text-gray-600 mt-6 text-sm">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-sky-600 font-semibold hover:text-sky-500 transition">
          Daftar di sini
        </a>
      </p>
    @endif
  </div>
</body>
</html>
