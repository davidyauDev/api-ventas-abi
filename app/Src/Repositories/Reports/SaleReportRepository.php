<?php

namespace App\Src\Repositories\Reports;

use App\Models\Sale;
use App\Src\Interfaces\Reports\ISaleReportRepository;

class SaleReportRepository implements ISaleReportRepository
{
    public function getSalesByDateRange($startDate, $enDate): \Illuminate\Support\Collection
    {
        return Sale::with(['saleDetails.product'])
            ->whereBetween('sale_date', [$startDate, $enDate])
            ->get();
    }
}
