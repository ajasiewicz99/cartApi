<?php

namespace App\Providers;

use App\Models\Repositories\Interfaces\ProductInterface;
use App\Models\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
    }
}
