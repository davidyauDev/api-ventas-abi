<?php

namespace App\Src\Services\Product;

use App\Http\Requests\ProductRequestForm;
use App\Http\Requests\ProductRequestList;
use App\Src\Interfaces\Product\IProductRepository;
use App\Src\Interfaces\Product\IProductServices;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class ProductService implements IProductServices
{
    use ApiResponses;

    public function __construct(private  IProductRepository $repository) {}
    public function all(ProductRequestList $request)
    {
        try {
            $data = $this->repository->all($request->all());
            return $this->success('Consulta Exitosa', $data, 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Failed', 'error' => $ex->getMessage()], 500);
        }
    }
    public function show(string $id) {}
    public function register(ProductRequestForm $request)
    {
        try {
            $data = $this->repository->register($request->all());
            return $this->success('Regristo Exitoso', $data, 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Failed', 'error' => $ex->getMessage()], 500);
        }
    }
    public function updated(int $id, ProductRequestForm $request)
    {
        try {
            $data = $this->repository->updated($id, $request);
            return $this->success('Actualización Exitosa', $data, 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Failed', 'error' => $ex->getMessage()], 500);
        }
    }
    public function deleted(int $id)
    {
        try {
            $data = $this->repository->deleted($id);
            return $this->success('Eliminación Exitosa', $data, 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Failed', 'error' => $ex->getMessage()], 500);
        }
    }
}
