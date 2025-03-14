<?php

namespace App\Src\Interfaces\Reports;

use Illuminate\Support\Collection;

interface ISaleReportRepository
{
    /**
     * Summary of getSalesByDateRange
     * @param mixed $startDate
     * @param mixed $enDate
     * @return \Illuminate\Support\Collection<int,\App\Models\Sale>
     */
    public function getSalesByDateRange($startDate, $enDate);
}
