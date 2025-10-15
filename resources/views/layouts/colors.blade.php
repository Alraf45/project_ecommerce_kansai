@include("layout.header")

<div class="mb-44"></div>
<div class="text-center">
  <h2 class="text-3xl md:text-4xl font-bold font-display leading-tight text-blue-900">
    Color Collection
  </h2>
</div>
<div class="mb-24"></div>

<div class="p-4 bg-[#f1f2f6] rounded-md">
  <!-- Grid kategori utama -->
  <div class="grid grid-cols-5 lg:grid-cols-7 gap-4">

    <!-- Neutral -->
    <div class="bg-white shadow rounded-md border hover:border-navy cursor-pointer"
        onclick="toggleRow('neutralRow')">
      <div class="h-[50px] md:h-[95px] rounded-md"
        style="background-color: rgb(181, 172, 150);"></div>
      <div class="p-3 hidden md:block">
        <p class="text-sm">Netral</p>
      </div>
    </div>

    <!-- Red -->
    <div class="bg-white shadow rounded-md border hover:border-navy cursor-pointer"
        onclick="toggleRow('redRow')">
      <div class="h-[50px] md:h-[95px] rounded-md"
        style="background-color: rgb(237, 32, 36);"></div>
      <div class="p-3 hidden md:block">
        <p class="text-sm">Merah</p>
      </div>
    </div>

    <!-- Orange -->
    <div class="bg-white shadow rounded-md border hover:border-navy cursor-pointer"
        onclick="toggleRow('orangeRow')">
      <div class="h-[50px] md:h-[95px] rounded-md"
        style="background-color: rgb(250, 164, 26);"></div>
      <div class="p-3 hidden md:block">
        <p class="text-sm">Oranye</p>
      </div>
    </div>

    <!-- Yellow -->
    <div class="bg-white shadow rounded-md border hover:border-navy cursor-pointer"
        onclick="toggleRow('yellowRow')">
      <div class="h-[50px] md:h-[95px] rounded-md"
        style="background-color: rgb(246, 235, 20);"></div>
      <div class="p-3 hidden md:block">
        <p class="text-sm">Kuning</p>
      </div>
    </div>

    <!-- Green -->
    <div class="bg-white shadow rounded-md border hover:border-navy cursor-pointer"
        onclick="toggleRow('greenRow')">
      <div class="h-[50px] md:h-[95px] rounded-md"
        style="background-color: rgb(11, 129, 64);"></div>
      <div class="p-3 hidden md:block">
        <p class="text-sm">Hijau</p>
      </div>
    </div>

    <!-- Blue -->
    <div class="bg-white shadow rounded-md border hover:border-navy cursor-pointer"
        onclick="toggleRow('blueRow')">
      <div class="h-[50px] md:h-[95px] rounded-md"
        style="background-color: rgb(57, 83, 164);"></div>
      <div class="p-3 hidden md:block">
        <p class="text-sm">Biru</p>
      </div>
    </div>

    <!-- Purple -->
    <div class="bg-white shadow rounded-md border hover:border-navy cursor-pointer"
        onclick="toggleRow('purpleRow')">
      <div class="h-[50px] md:h-[95px] rounded-md"
        style="background-color: rgb(124, 39, 125);"></div>
      <div class="p-3 hidden md:block">
        <p class="text-sm">Ungu</p>
      </div>
    </div>
  </div>

  <!-- Grid turunan warna (row 2), default hidden -->
  <div id="redRow" class="grid grid-cols-5 lg:grid-cols-7 gap-4 mt-4 hidden">
    <div class="bg-[#ff4d4d] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#b30000] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#ff9999] h-[50px] md:h-[95px] rounded-md"></div>
  </div>

  <div id="neutralRow" class="grid grid-cols-5 lg:grid-cols-7 gap-4 mt-4 hidden">
    <div class="bg-[#d9d9d9] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#a6a6a6] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#737373] h-[50px] md:h-[95px] rounded-md"></div>
  </div>

  <div id="orangeRow" class="grid grid-cols-5 lg:grid-cols-7 gap-4 mt-4 hidden">
    <div class="bg-[#ffa500] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#ff8c00] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#ffcc80] h-[50px] md:h-[95px] rounded-md"></div>
  </div>

  <!-- tambahin row lain sesuai kategori -->
  <div id="yellowRow" class="grid grid-cols-5 lg:grid-cols-7 gap-4 mt-4 hidden">
    <div class="bg-[#ddff01] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#efe124] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#efe256] h-[50px] md:h-[95px] rounded-md"></div>
  </div>

  <div id="greenRow" class="grid grid-cols-5 lg:grid-cols-7 gap-4 mt-4 hidden">
    <div class="bg-[#b2ff59] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#76ff03] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#a8e6cf] h-[50px] md:h-[95px] rounded-md"></div>
  </div>

  <div id="blueRow" class="grid grid-cols-5 lg:grid-cols-7 gap-4 mt-4 hidden">
    <div class="bg-[#1394fe] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#0059ff] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#70caf1] h-[50px] md:h-[95px] rounded-md"></div>
  </div>

  <div id="purpleRow" class="grid grid-cols-5 lg:grid-cols-7 gap-4 mt-4 hidden">
    <div class="bg-[#431de9] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#7153be] h-[50px] md:h-[95px] rounded-md"></div>
    <div class="bg-[#8b71a8] h-[50px] md:h-[95px] rounded-md"></div>
  </div>
</div>

<div class="mb-[500px]"></div>
@include('layout.footer')

<script>
  function toggleRow(id) {
    // sembunyiin semua row turunan dulu
    document.querySelectorAll('[id$="Row"]').forEach(el => el.classList.add("hidden"));

    // tampilkan row yang diklik
    const row = document.getElementById(id);
    row.classList.remove("hidden");

    // animasi item muncul satu per satu
    const items = row.children;
    [...items].forEach((item, i) => {
      item.style.opacity = 0;
      setTimeout(() => {
        item.style.transition = "opacity 0.3s ease";
        item.style.opacity = 1;
      }, i * 200);
    });
  }
</script>
