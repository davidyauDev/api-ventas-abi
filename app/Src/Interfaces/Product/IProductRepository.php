<?php

namespace App\Src\Interfaces\Product;

use App\Http\Requests\ProductRequestForm;

interface IProductRepository
{
    public function all(array $params);
    public function register(array $params);
    public function show(string $id);
    public function updated(int $id, ProductRequestForm $data);
    public function deleted(int $id);
}
