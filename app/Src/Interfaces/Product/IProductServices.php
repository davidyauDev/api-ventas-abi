<?php

namespace App\Src\Interfaces\Product;

use App\Http\Requests\ProductRequestForm;
use App\Http\Requests\ProductRequestList;

interface IProductServices
{
    public function all(ProductRequestList $request);
    public function register(ProductRequestForm $request);
    public function show(string $id);
    public function updated(int $id, ProductRequestForm $request);
    public function deleted(int $id);
}
