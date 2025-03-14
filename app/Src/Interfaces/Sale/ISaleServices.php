<?php

namespace App\Src\Interfaces\Sale;

use App\Http\Requests\ProductRequestList;
use App\Http\Requests\SaleRequestForm;

interface ISaleServices
{
    public function all(ProductRequestList $request);
    public function register(SaleRequestForm $request);
}
