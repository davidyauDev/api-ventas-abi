<?php

namespace App\Providers;

use App\Src\Interfaces\Sale\ISaleRepository;
use App\Src\Interfaces\Sale\ISaleServices;
use App\Src\Repositories\Sale\SaleRepository;
use App\Src\Services\Sale\SaleService;
use Illuminate\Support\ServiceProvider;

class SaleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ISaleRepository::class,
            SaleRepository::class
        );
        $this->app->bind(
            ISaleServices::class,
            SaleService::class
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
