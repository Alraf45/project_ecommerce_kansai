@include('layout.header')

<div class="mt-12"></div>

<div class="bg-white">
  <div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
      
      <!-- Product Images -->
      <div class="w-full md:w-1/2 px-4 mb-8">
        <img 
          id="mainImage"
          src="/img/pearlsheen.png"
          alt="Product"
          class="w-full h-auto rounded-lg shadow-md mb-4 bg-gray-100 p-10">

        <!-- Thumbnail -->
        <div class="flex gap-4 py-4 justify-center overflow-x-auto">
          @php
              $thumbnails = [
                  "/img/pearlsheen.png",
                  "/img/pearlsheen.png",
                  "/img/pearlsheen.png",
                  "/img/pearlsheen.png",
              ];
          @endphp

          @foreach($thumbnails as $thumb)
            <img 
              src="{{ $thumb }}"
              alt="Thumbnail"
              class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
              onclick="changeImage(this.src)">
          @endforeach
        </div>
      </div>

      <!-- Product Details -->
      <div class="w-full md:w-1/2 px-4">
        <!-- Title -->
        <h2 class="text-3xl font-bold mb-2">KANSAI PEARLSHEEN</h2>
        <p class="text-gray-600 mb-4">Stock : 500</p>
        
        <!-- Harga -->
        <div class="mb-4">
          <span id="productPrice" class="text-2xl font-bold mr-2">Rp.94.000</span>
          <span class="text-gray-500 line-through">Rp.100.000</span>
        </div>

        <!-- Rating -->
        <div class="flex items-center mb-4">
          @for($i = 0; $i < 5; $i++)
            <svg xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 24 24" 
                fill="currentColor"
                class="size-6 text-yellow-500">
              <path fill-rule="evenodd" 
                    d="M10.788 3.21c.448-1.077 1.976-1.077 
                       2.424 0l2.082 5.006 5.404.434c1.164.093 
                       1.636 1.545.749 2.305l-4.117 3.527 
                       1.257 5.273c.271 1.136-.964 2.033-1.96 
                       1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425
                       l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212
                       .749-2.305l5.404-.434 2.082-5.005Z" 
                    clip-rule="evenodd" />
            </svg>
          @endfor
          <span class="ml-2 text-gray-600">4.5 (120 reviews)</span>
        </div>
        
        <!-- Description -->
        <p class="text-gray-700 mb-6">
          KANSAI PEARLSHEEN adalah cat warna premium yang memberikan hasil akhir yang mengkilap seperti baru, cepat kering dan tahan lama. Segera beli KANSAI PEARLSHEEN sekarang juga!
          
        </p>

        <!-- Color Options -->
        <div class="mb-6">
          <h3 class="text-lg font-semibold mb-2">Color:</h3>
          <div class="flex space-x-2">
            <button class="w-8 h-8 bg-stone-400 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-400"></button>
            <button class="w-8 h-8 bg-red-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"></button>
            <button class="w-8 h-8 bg-orange-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"></button>
            <button class="w-8 h-8 bg-yellow-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"></button>
            <button class="w-8 h-8 bg-green-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"></button>
            <button class="w-8 h-8 bg-blue-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"></button>
            <button class="w-8 h-8 bg-indigo-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"></button>
          </div>
        </div>

        <!-- Quantity -->
        <div class="mb-6">
          <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
          <input 
            type="number" 
            id="quantity" 
            name="quantity" 
            min="1" 
            value="1"
            class="w-12 text-center rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            oninput="updatePrice()"
          >
        </div>

        <!-- stok -->
        

        <!-- Add to cart -->
        <div class="flex space-x-4 mb-6">
          <a href="/cart">
            <button class="bg-blue-900 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
              <svg xmlns="http://www.w3.org/2000/svg" 
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5" 
                  stroke="currentColor" 
                  class="size-6">
                <path stroke-linecap="round" 
                      stroke-linejoin="round"
                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 
                        14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 
                        2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 
                        14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 
                        .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 
                        0 .75.75 0 0 1 1.5 0Z" />
              </svg>
              Add to Cart
            </button>
          </a>
        </div>

        <!-- Payment -->
        <div class="flex space-x-4 mb-6">
          <a href="/checkout">
            <button class="bg-white flex gap-2 items-center border border-black text-black px-12 py-2 rounded-md hover:border-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
              Buy Now
            </button>
          </a>
        </div>

        <!-- Key features -->
        <div>
          <h3 class="text-lg font-semibold mb-2">Key Features:</h3>
          <ul class="list-disc list-inside text-gray-700">
            <li>Daya tutup sangat baik</li>
            <li>Tahan cuaca</li>
            <li>Daya rekat sangat baik</li>
            <li>Tidak mengandung timbal dan logam berat</li>
            <li>Tidak cepat menguning</li>
            <li>Dapat diaplikasikan pada permukaan kayu</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    function changeImage(src) {
      document.getElementById('mainImage').src = src;
    }

    const basePrice = 94000; 
    const priceElement = document.getElementById("productPrice");
    const quantityInput = document.getElementById("quantity");

    function updatePrice() {
      let qty = parseInt(quantityInput.value) || 1;
      let total = basePrice * qty;
      priceElement.textContent = formatRupiah(total);
    }

    function formatRupiah(angka) {
      return "Rp." + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  </script>
</div>


<!-- Related Products -->
<div class="mt-3 max-w-full grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-2 gap-y-12 justify-items-center">

  </div>
</div>

<div class="mb-96"></div>

@include('layout.footer')
