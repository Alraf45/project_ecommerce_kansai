@include('layout.header')

<div class="bg-gray-50 py-12 md:py-16 px-6 md:px-16">
    <!-- Breadcrumb -->
    <nav class="text-sm mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-blue-900">Produk</a>
                <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7.05 3.05a.5.5 0 0 1 .7 0l6 6a.5.5 0 0 1 0 .7l-6 6a.5.5 0 1 1-.7-.7L12.29 10 7.05 4.76a.5.5 0 0 1 0-.7z"/>
                </svg>
            </li>
            <li class="inline-flex items-center">
                <span class="text-gray-700 font-medium">{{ $product->name }}</span>
            </li>
        </ol>
    </nav>

    <!-- Produk utama -->
    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-lg overflow-hidden md:flex md:gap-8 p-6 md:p-12">
        <!-- Gambar produk -->
        <div class="md:w-1/2 flex flex-col gap-4">
            <div class="w-full h-80 bg-white-900 flex items-center justify-center rounded-2xl overflow-hidden">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
            </div>
            @if($product->images && count($product->images) > 0)
            <div class="flex gap-2 overflow-x-auto">
                @foreach($product->images as $img)
                <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden cursor-pointer hover:ring-2 hover:ring-blue-500 transition">
                    <img src="{{ asset($img) }}" class="w-full h-full object-contain">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Info Produk -->
        <div class="md:w-1/2 mt-6 md:mt-0 flex flex-col justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">{{ $product->name }}</h1>

                <div class="mt-4">
                    <span class="text-2xl font-bold text-gray-900" id="product-price" data-price="{{ $product->price }}">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>

                <div class="mt-2 text-gray-600">
                    <p>Kategori: <span class="font-medium">{{ $product->category->name ?? '-' }}</span></p>
                    @if($product->color)
                    <p>Warna: <span class="font-medium">{{ $product->color->name }}</span></p>
                    @endif
                    @if(isset($product->stock))
                    <p>Stok: <span class="font-medium">{{ $product->stock }}</span></p>
                    @endif
                </div>

                <!-- Quantity -->
                <div class="mt-4 flex items-center gap-3">
                    <label for="quantity" class="text-gray-700 font-medium">Jumlah:</label>
                    <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock ?? 99 }}" class="w-20 px-3 py-2 border rounded-lg">
                </div>

                <!-- Subtotal -->
                <div class="mt-2 text-gray-600">
                    Subtotal: Rp <span id="product-subtotal">{{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Tombol -->
            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                <button 
                    type="button"
                    class="add-to-cart flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-800 text-white font-semibold rounded-2xl hover:bg-blue-600 transition shadow-lg"
                    data-id="{{ $product->id }}">
                    🛒 Tambah ke Keranjang
                </button>

                <a href="{{ route('products.index') }}"
                   class="flex-1 text-center px-6 py-3 border border-gray-300 text-gray-700 rounded-2xl hover:bg-gray-100 transition">
                   Kembali ke Produk
                </a>
            </div>
        </div>
    </div>

<!-- Deskripsi & Spesifikasi -->
<div class="max-w-6xl mx-auto mt-12">
    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-12">

        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            Deskripsi Produk
        </h2>

        <div class="text-gray-600 leading-7 whitespace-pre-line">
            {{ trim($product->description) }}
        </div>

        @if(!empty($product->specifications))
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">
                Spesifikasi
            </h2>

            <ul class="list-disc pl-5 text-gray-600 space-y-1">
                @foreach($product->specifications as $spec)
                    <li>{{ $spec }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
</div>

    <!-- Review Dummy -->
    <div class="max-w-6xl mx-auto mt-12">
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Ulasan Pelanggan</h2>
            <div class="space-y-4">
                <div class="border-b border-gray-200 pb-4">
                    <p class="text-gray-800 font-medium">Rudi Pratama</p>
                    <p class="text-yellow-500">★★★★☆</p>
                    <p class="text-gray-600 mt-1">Catnya bagus, hasilnya merata dan cepat kering!</p>
                </div>
                <div class="border-b border-gray-200 pb-4">
                    <p class="text-gray-800 font-medium">Siti Aisyah</p>
                    <p class="text-yellow-500">★★★★★</p>
                    <p class="text-gray-600 mt-1">Warna sesuai, mudah diaplikasikan, recommended!</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')

<!-- JS Add to Cart & Subtotal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const btn = document.querySelector('.add-to-cart');
    const quantityInput = document.querySelector('#quantity');
    const priceElement = document.querySelector('#product-price');
    const subtotalElement = document.querySelector('#product-subtotal');
    const priceValue = parseInt(priceElement.dataset.price);

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    // Update subtotal saat quantity berubah
    quantityInput.addEventListener('input', () => {
        let qty = parseInt(quantityInput.value) || 1;
        subtotalElement.textContent = formatRupiah(qty * priceValue);
    });

    // Add to Cart
    btn.addEventListener('click', async (e) => {
        e.stopPropagation();
        btn.disabled = true;
        const originalText = btn.innerHTML;
        btn.innerHTML = '⏳ Menambahkan...';

        try {
            const res = await fetch(`/cart/add/${btn.dataset.id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ quantity: parseInt(quantityInput.value) || 1 })
            });

            const data = await res.json();

            if (data.success) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#1e3a8a',
                    color: '#fff',
                    customClass: { popup: 'rounded-xl shadow-lg' }
                });

                if (typeof window.updateCartCount === 'function') {
                    window.updateCartCount(data.count);
                }
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: data.message || 'Gagal menambahkan ke keranjang!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

        } catch (error) {
            console.error(error);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Silakan login terlebih dahulu!',
                showConfirmButton: false,
                timer: 2000
            });
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    });
});
</script>
