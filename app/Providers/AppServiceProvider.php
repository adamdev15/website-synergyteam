<?php

namespace App\Providers;

use App\Models\Subcategory;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('layouts.landing', function ($view) {
            $view->with('subcategories', Subcategory::with('products')->get());
        });
    }
}
