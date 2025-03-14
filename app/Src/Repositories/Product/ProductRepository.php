<?php

namespace App\Src\Repositories\Product;

use App\Http\Requests\ProductRequestForm;
use App\Models\Product;
use App\Src\Interfaces\Product\IProductRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository implements IProductRepository
{

    public function all(array $request)
    {
        $perPage = $request['per_page'] ?? 15;
        $query = Product::query();
        return $query->paginate($perPage);
    }

    public function register(array $data)
    {
        DB::beginTransaction();
        try {
            $product = new Product();
            $product->fill($data);
            $product->save();

            DB::commit();
            return $product;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function show(string $id) {}

    public function updated(int $id, ProductRequestForm $data)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->fill($data);
            $product->save();

            DB::commit();
            return $product;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function deleted(int $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->forceDelete(); // Eliminación física

            DB::commit();
            return $product;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
