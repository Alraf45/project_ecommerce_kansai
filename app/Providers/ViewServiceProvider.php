<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Hitung jumlah item dalam keranjang dari session
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = collect($cart)->sum('quantity');

            $view->with('cartCount', $cartCount);
        });
    }

    public function register(): void
    {
        //
    }
}
