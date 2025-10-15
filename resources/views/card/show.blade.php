@include('layout.header')

<div class="mt-12"></div>

<div class="bg-white">
  <div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
      
      <!-- Product Image -->
      <div class="w-full md:w-1/2 px-4 mb-8">
        <img 
          id="mainImage"
          src="{{ asset($product->image) }}"
          alt="{{ $product->name }}"
          class="w-full h-auto rounded-lg shadow-md mb-4 bg-gray-100 p-10">
      </div>

      <!-- Product Details -->
      <div class="w-full md:w-1/2 px-4">
        <!-- Title -->
        <h2 class="text-3xl font-bold mb-2">{{ $product->name }}</h2>
        <p class="text-gray-600 mb-4">Stock : {{ $product->stock }}</p>
        
        <!-- Harga -->
        <div class="mb-4">
          <span id="productPrice" class="text-2xl font-bold mr-2">
            Rp {{ number_format($product->price,0,',','.') }}
          </span>
        </div>

        <!-- Description -->
        <p class="text-gray-700 mb-6">
          {{ $product->description ?? 'Belum ada deskripsi untuk produk ini.' }}
        </p>

        <!-- Warna -->
        <div class="mb-6">
          <h3 class="text-lg font-semibold mb-2">Color:</h3>
          <span class="px-3 py-1 rounded-full border bg-gray-100">
            {{ $product->color->name ?? '-' }}
          </span>
        </div>

        <!-- Quantity -->
        <form action="{{ route('cart.checkout') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">

          <div class="mb-6">
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
            <input 
              type="number" 
              id="quantity" 
              name="quantity" 
              min="1" 
              value="1"
              class="w-16 text-center rounded-md border-gray-300 shadow-sm"
            >
          </div>

          <!-- Buttons -->
          <div class="flex space-x-4 mb-6">
            <button type="submit" 
              class="bg-blue-900 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-blue-600">
              Add to Cart
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Related Products -->
<div class="mt-3 max-w-full grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-2 gap-y-12 justify-items-center">
  @foreach($related as $r)
  <div class="group border rounded-md overflow-hidden max-w-[200px] hover:shadow-lg transition-shadow">
    <a href="{{ route('products.show', $r->id) }}">
      <img src="{{ asset($r->image_) }}" alt="{{ $r->name }}"
          class="w-full h-[200px] object-cover bg-gray-200 group-hover:opacity-60 p-4" />
      <div class="p-3 text-center">
        <h3 class="text-sm text-gray-700 font-semibold">{{ $r->name }}</h3>
        <p class="mt-3 text-sm text-red-500 font-semibold">
          Rp {{ number_format($r->price,0,',','.') }}
        </p>
      </div>
    </a>
  </div>
  @endforeach
</div>

@include('layout.footer')
