<!-- Tambah link Swiper CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Container -->

<div class="swiper mySwiper max-w-[1430px] mx-auto h-[530px] rounded-2xl shadow-2xl overflow-hidden relative">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <img src="/img/kansai_19.jpg" class="w-full h-full object-cover transition-transform duration-700 ease-in-out hover:scale-105" />
    </div>
    <div class="swiper-slide">
      <img src="/img/kansai_16.jpg" class="w-full h-full object-cover transition-transform duration-700 ease-in-out hover:scale-105" />
    </div>
    <div class="swiper-slide">
      <img src="/img/kansai_3.jpg" class="w-full h-full object-cover transition-transform duration-700 ease-in-out hover:scale-105" />
    </div>
  </div>

  <!-- Pagination & Navigasi -->
  <div class="swiper-pagination"></div>
</div>

<script>
  var swiper = new Swiper(".mySwiper", {
    loop: true,
    effect: "fade", // efek lembut antar slide
    fadeEffect: {
      crossFade: true,
    },
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    speed: 1200, // transisi halus
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
</script>

<!-- Styling tambahan -->
<style>
  .swiper-pagination-bullet {
    background: white;
    opacity: 0.7;
    transition: all 0.3s ease;
  }
  .swiper-pagination-bullet-active {
    background: #2563eb; /* biru elegan */
    opacity: 1;
    transform: scale(1.3);
  }
  .swiper-slide img {
    filter: brightness(0.9);
  }
  .swiper-slide-active img {
    filter: brightness(1);
  }
</style>
