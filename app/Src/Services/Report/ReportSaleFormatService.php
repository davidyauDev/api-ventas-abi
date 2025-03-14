<?php

namespace App\Src\Services\Report;

use App\Exports\SaleReportExport;
use App\Src\Interfaces\Reports\IReportSaleFormatService;
use App\Src\Interfaces\Reports\ISaleReportRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportSaleFormatService implements IReportSaleFormatService
{
    public function __construct(private readonly ISaleReportRepository $repository) {}
    private function generateSaleReport($startDate, $enDate)
    {
        $sales = $this->repository->getSalesByDateRange($startDate, $enDate);
        return $sales->map(function ($sale) {
            return [
                'codigo_venta' => $sale->code,
                'nombre_client' => $sale->customer_name,
                'id_cliente' => $sale->customer_identification,
                'email_client' => $sale->customer_email,
                'total_producto' => $sale->saleDetails->sum('quantity'),
                'total_venta' => $sale->total_amount,
                'fecha_venta' => $sale->sale_date
            ];
        });
    }
    public function formatJson(Request $request)
    {
        return $this->generateSaleReport($request->start_date, $request->end_date);
    }
    public function formatXml(Request $request)
    {
        $result = $this->generateSaleReport($request->start_date, $request->end_date);
        return Excel::download(new SaleReportExport($result), 'reporte_ventas.xlsx');
    }
}
