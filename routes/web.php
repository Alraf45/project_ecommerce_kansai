<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;

// Frontend Controllers
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;

use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================== HOMEPAGE ==========================
Route::get('/', function () {
    $product = Product::with(['category', 'color'])->latest()->paginate(11);
    return view('layouts.app', compact('product'));
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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ========================== SEARCH ==========================
Route::get('/search', [SearchController::class, 'index'])->name('search');


// ========================== ADMIN AREA ==========================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Produk (admin.products.index, admin.products.create, dll)
    Route::resource('products', AdminProductController::class);

    // CRUD Pengguna (admin.users.index, admin.users.create, dll)
    Route::resource('users', UserController::class);

    // Halaman tambahan admin
    Route::view('/analytics', 'admin.analytics')->name('analytics');
    Route::view('/orders', 'admin.orders')->name('orders');
});


// ========================== FRONTEND PRODUCTS ==========================
Route::controller(FrontendProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/{id}', 'show')->name('products.show');
});


// ========================== CART & CHECKOUT ==========================
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
});


// ========================== STATIC PAGES ==========================
Route::view('/colors', 'layouts.colors');
Route::view('/diskon', 'pages.diskon');
Route::view('/checkout', 'pages.checkout');
Route::view('/payment-success', 'pages.payment-success');
Route::view('/order-history', 'pages.order-history');


// ========================== CATEGORY PAGES ==========================
Route::view('/interior', 'category.interior');
Route::view('/eksterior', 'category.eksterior');
Route::view('/premium', 'category.premium');
Route::view('/kayubesi', 'category.kayubesi');


// ========================== PRODUCT DETAIL PAGES ==========================
Route::view('/ftalitduo', 'detail.ftalitduo');
Route::view('/ftalit', 'detail.ftalit');
Route::view('/spleshglimmer', 'detail.spleshglimmer');
Route::view('/splesh', 'detail.splesh');
Route::view('/diamondshield', 'detail.diamondshield');
Route::view('/pearlsheen', 'detail.pearlsheen');
Route::view('/rainblock', 'detail.rainblock');
Route::view('/propertyeks', 'detail.propertyeks');
Route::view('/propertyint', 'detail.propertyint');
Route::view('/tropic', 'detail.tropic');
