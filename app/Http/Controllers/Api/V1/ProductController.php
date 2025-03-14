<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequestForm;
use App\Http\Requests\ProductRequestList;
use App\Src\Interfaces\Product\IProductServices;

class ProductController extends Controller
{
    public function __construct(private readonly IProductServices $service) {}
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
    public function store(ProductRequestForm $request)
    {

        return $this->service->register($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequestForm $request, int $id)
    {
        return $this->service->updated($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->service->deleted($id);
    }
}
