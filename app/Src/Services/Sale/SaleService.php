<?php

namespace App\Src\Services\Sale;

use App\Http\Requests\ProductRequestList;
use App\Http\Requests\SaleRequestForm;
use App\Src\Interfaces\Sale\ISaleRepository;
use App\Src\Interfaces\Sale\ISaleServices;
use App\Traits\ApiResponses;

class SaleService implements ISaleServices
{
    use ApiResponses;

    public function __construct(private  ISaleRepository $repository) {}
    public function all(ProductRequestList $request)
    {
        try {
            $data = $this->repository->all($request->all());
            return $this->success('Consulta Exitosa', $data, 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Failed', 'error' => $ex->getMessage()], 500);
        }
    }
    public function register(SaleRequestForm $request)
    {
        try {
            $data = $this->repository->register($request);
            return $this->success('Venta registrada exitosamente', $data, 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Failed', 'error' => $ex->getMessage()], 500);
        }
    }
}
