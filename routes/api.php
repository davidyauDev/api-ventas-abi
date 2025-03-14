<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\SaleReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\SaleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::prefix("auth")->controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');

    Route::post('logout', 'logout')->middleware("auth:sanctum");
});

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('products/{id}', [ProductController::class, 'destroy']);
    Route::post('report-sale', [SaleReportController::class, 'generateReportByRanges']);

    Route::middleware('role:Seller')->group(function () {
        Route::post('products', [ProductController::class, 'store']);
        Route::put('products/{id}', [ProductController::class, 'update']);
        Route::get('products', [ProductController::class, 'index']);
        Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
        Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    });
});
