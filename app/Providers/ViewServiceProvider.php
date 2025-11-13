<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Subcategory;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('layouts.landing', function ($view) {
            $view->with('subcategories', Subcategory::with('products')->get());
        });
    }
}
