<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequestList;
use App\Http\Requests\SaleRequestForm;
use App\Src\Interfaces\Sale\ISaleServices;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    public function __construct(private readonly ISaleServices $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index(ProductRequestList $request)
    {
        return $this->service->all($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleRequestForm $request)
    {
        return $this->service->register($request);
    }
}
