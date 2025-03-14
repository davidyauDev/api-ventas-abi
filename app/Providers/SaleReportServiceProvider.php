<?php

namespace App\Providers;

use App\Src\Interfaces\Reports\IReportSaleFormatService;
use App\Src\Interfaces\Reports\ISaleReportRepository;
use App\Src\Repositories\Reports\SaleReportRepository;
use App\Src\Services\Report\ReportSaleFormatService;
use Illuminate\Support\ServiceProvider;

class SaleReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ISaleReportRepository::class,
            SaleReportRepository::class
        );

        $this->app->bind(
            IReportSaleFormatService::class,
            ReportSaleFormatService::class
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
