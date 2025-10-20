<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesanan Berhasil | Kansai Paint</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center min-h-screen">

  <div class="flex flex-col items-center justify-center text-center p-6 bg-white rounded-3xl shadow-2xl border border-gray-200 animate-fadeIn">
    
    <!-- Icon Success -->
    <div class="relative">
      <i class="fa-solid fa-circle-check text-green-500 text-7xl mb-4 animate-bounce"></i>
      <div class="absolute -top-8 -right-8 w-6 h-6 bg-yellow-400 rounded-full animate-ping opacity-75"></div>
      <div class="absolute -bottom-8 -left-8 w-6 h-6 bg-pink-500 rounded-full animate-ping opacity-75"></div>
    </div>

    <!-- Title -->
    <h1 class="text-4xl font-extrabold text-blue-900 mb-4">
      Pesanan Berhasil!
    </h1>

    <!-- Personalized Name -->
    @if(Auth::check())
      <p class="text-lg text-gray-700 mb-4">
        Terima kasih, <span class="font-semibold text-blue-800">{{ Auth::user()->name }}</span>, telah berbelanja di Kansai Paint.
      </p>
    @else
      <p class="text-lg text-gray-700 mb-4">
        Terima kasih telah berbelanja di Kansai Paint.
      </p>
    @endif

    <!-- Info -->
    <p class="text-gray-600 mb-6">Pesananmu sedang diproses dan akan segera dikirimkan.</p>

    <!-- Button Kembali -->
    <a href="{{ url('/') }}" 
       class="bg-blue-900 text-white px-8 py-3 rounded-xl hover:bg-blue-800 shadow-lg transition-all font-semibold flex items-center gap-2">
       <i class="fa-solid fa-house"></i> Kembali ke Beranda
    </a>
  </div>

  <!-- Confetti -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Confetti otomatis
      confetti({
        particleCount: 200,
        spread: 160,
        origin: { y: 0.6 }
      });

      // Tambahan confetti loop
      setTimeout(() => {
        confetti({
          particleCount: 100,
          spread: 120,
          origin: { y: 0.6 }
        });
      }, 1000);

      setTimeout(() => {
        confetti({
          particleCount: 50,
          spread: 100,
          origin: { y: 0.6 }
        });
      }, 2000);
    });
  </script>

  <style>
    /* Animasi fadeIn */
    .animate-fadeIn {
      animation: fadeIn 1s ease-in-out forwards;
    }
    @keyframes fadeIn {
      0% { opacity: 0; transform: scale(0.95); }
      100% { opacity: 1; transform: scale(1); }
    }
  </style>
</body>
</html>
