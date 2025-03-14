<?php

namespace App\Providers;

use App\Src\Interfaces\Product\IProductRepository;
use App\Src\Interfaces\Product\IProductServices;
use App\Src\Repositories\Product\ProductRepository;
use App\Src\Services\Product\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IProductRepository::class,
            ProductRepository::class
        );
        $this->app->bind(
            IProductServices::class,
            ProductService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
