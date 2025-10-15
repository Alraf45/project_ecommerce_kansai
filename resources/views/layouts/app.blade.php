@include("layout.header")

@include("layout.banner")




<div class="mb-48"></div>
<div class="text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-blue-900">Semua Kategori Cat Warna</h2>
</div>
<div class="mb-2"></div>

<!-- Bawah Banner -->
<section class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 px-6 lg:px-16 py-12">
    <!-- Card 1 -->
    <div class="relative group overflow-hidden rounded-2xl shadow-lg">
        <img src="/img/kansai_12.jpg" alt="Shoes" class="w-full h-[400px] object-cover transition-transform duration-500 group-hover:scale-110">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-30"></div>
        <div class="absolute bottom-6 left-6 text-white">
            <h2 class="text-2xl font-bold">Cat Premium</h2>
            <a href="/premium"
                class="mt-3 inline-block bg-white text-black px-5 py-2 rounded-full font-semibold hover:bg-gray-200 transition">
                Explore
            </a>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="relative group overflow-hidden rounded-2xl shadow-lg">
        <img src="/img/kansai_5.jpg" alt="Apparel" class="w-full h-[400px] object-cover transition-transform duration-500 group-hover:scale-110">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-30"></div>
        <div class="absolute bottom-6 left-6 text-white">
            <h2 class="text-2xl font-bold">Cat Eksterior</h2>
            <a href="/eksterior"
              class="mt-3 inline-block bg-white text-black px-5 py-2 rounded-full font-semibold hover:bg-gray-200 transition">
                Explore
            </a>
        </div>

    </div>


    <!-- Card 3 -->
    <div class="relative group overflow-hidden rounded-2xl shadow-lg">
        <img src="/img/kansai_7.jpg" alt="Accessories" class="w-full h-[400px] object-cover transition-transform duration-500 group-hover:scale-110">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-30"></div>
        <div class="absolute bottom-6 left-6 text-white">
            <h2 class="text-2xl font-bold">Cat Interior</h2>
            <a href="/interior"
              class="mt-3 inline-block bg-white text-black px-5 py-2 rounded-full font-semibold hover:bg-gray-200 transition">
                Explore
            </a>
        </div>

    </div>




    <!-- Card 2 -->
    <div class="relative group overflow-hidden rounded-2xl shadow-lg">
        <img src="/img/kansai_6.jpg" alt="Apparel" class="w-full h-[400px] object-cover transition-transform duration-500 group-hover:scale-110">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-30"></div>
        <div class="absolute bottom-6 left-6 text-white">
            <h2 class="text-2xl font-bold">Cat Kayu & Besi</h2>
            <a href="/kayubesi"
              class="mt-3 inline-block bg-white text-black px-5 py-2 rounded-full font-semibold hover:bg-gray-200 transition">
                Explore
            </a>
        </div>

    </div>
    </section>




  </div> 





<!-- Script sederhana untuk filter (bisa ditempatkan di bawah sebelum </body>) -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.category-btn');
    const cards = document.querySelectorAll('.product-card');

    function setActiveBtn(activeBtn) {
      buttons.forEach(btn => {
        if (btn === activeBtn) {
          btn.classList.remove('bg-white', 'text-gray-700', 'border', 'hover:text-white');
          btn.classList.add('bg-blue-900', 'text-white', 'shadow', 'hover:bg-blue-900', 'hover:text-white',);
        } else {
          btn.classList.remove('bg-blue-600', 'text-white', 'shadow',);
          btn.classList.add('bg-white', 'text-gray-700', 'border',);
        }
      });
    }

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const cat = btn.getAttribute('data-cat'); // all, interior, eksterior, kayu, besi, dekoratif
        setActiveBtn(btn);

        cards.forEach(card => {
          if (cat === 'all') {
            card.style.display = '';
          } else {
            const c = card.getAttribute('data-category');
            card.style.display = (c === cat) ? '' : 'none';
          }
        });
      });
    });
  });
</script>

<div class="mb-32"></div>
        


<div class="mb-79"></div>

@include('layout.footer')

</body>
</html>

  