<?php

namespace App\Src\Interfaces\Reports;

use Illuminate\Http\Request;

interface IReportSaleFormatService
{
    public function formatJson(Request $request);
    public function formatXml(Request $request);
}
