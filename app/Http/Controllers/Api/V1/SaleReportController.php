<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Src\Interfaces\Reports\IReportSaleFormatService;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    public function __construct(private readonly IReportSaleFormatService $service){}
    public function generateReportByRanges(Request $request){
        try{
            $typeFormat = $request->typeFormat;
            if($typeFormat === 'json'){
                return response()->json($this->service->formatJson($request));
            }

            if($typeFormat === 'xlsx'){
                return $this->service->formatXml($request);
            }
            return response()->json('Formato invalido',400);
        }catch(\Exception $ex){
            return response()->json($ex->getMessage(),500);
        }
    }
}
