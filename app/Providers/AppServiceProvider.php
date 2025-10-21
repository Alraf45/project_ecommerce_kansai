<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // ← tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 🛒 Biar cartCount tampil di semua halaman
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = collect($cart)->sum('quantity');
            $view->with('cartCount', $cartCount);
        });
    }
}
