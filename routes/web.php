<?php

use Illuminate\Support\Facades\Route;

// ========================== CONTROLLERS ==========================
// 🔐 Auth
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;

// 🛍️ Frontend
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController; // ✅ Tambah ini

// 🧩 Admin
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController; // ✅ Alias supaya tidak tabrakan

// 🧱 Models
use App\Models\Product;

// ========================== HOMEPAGE ==========================
Route::get('/', function () {
    $products = Product::with(['category'])->latest()->take(11)->get();
    return view('layouts.app', compact('products'));
})->name('dashboard');

// ========================== AUTH ==========================
Route::controller(AuthenticatedSessionController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'destroy')->name('logout');
});

// ========================== PROFILE ==========================
Route::middleware(['auth'])->group(function () {
    // Semua user termasuk admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================== SEARCH ==========================
Route::get('/search', [SearchController::class, 'index'])->name('search');

// ========================== ADMIN AREA ==========================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', AdminProductController::class);
        Route::resource('users', UserController::class);

        // 📦 Riwayat Pesanan (Admin)
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

        Route::view('/analytics', 'admin.analytics')->name('analytics');
    });

// ========================== FRONTEND PRODUCTS ==========================
// Semua produk
Route::get('/products', [FrontendProductController::class, 'index'])->name('products.index');
// Detail produk
Route::get('/products/{product}', [FrontendProductController::class, 'show'])->name('products.show');
// Pencarian produk
Route::get('/products/search', [FrontendProductController::class, 'search'])->name('products.search');

// ========================== CART & CHECKOUT ==========================
Route::middleware(['auth'])->group(function () {
    // Tampilkan keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // Tambah ke keranjang (AJAX)
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

    // Update quantity
    Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');

    // Hapus item
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
    Route::get('/checkout/success', [CartController::class, 'success'])->name('cart.success');
});

// ========================== ORDER HISTORY (FRONTEND CUSTOMER) ==========================
Route::middleware(['auth'])->group(function () {
    // Daftar pesanan
    Route::get('/orders', [FrontendOrderController::class, 'index'])->name('orders.index');

    // Detail pesanan
    Route::get('/orders/{id}', [FrontendOrderController::class, 'show'])->name('orders.show');
});

// ========================== STATIC PAGES ==========================
Route::view('/colors', 'layouts.colors')->name('colors');

// ========================== CATEGORY PAGES ==========================
Route::get('/premium', [FrontendProductController::class, 'premium'])->name('category.premium');
Route::get('/interior', [FrontendProductController::class, 'interior'])->name('category.interior');
Route::get('/eksterior', [FrontendProductController::class, 'eksterior'])->name('category.eksterior');
Route::get('/kayubesi', [FrontendProductController::class, 'kayubesi'])->name('category.kayubesi');
