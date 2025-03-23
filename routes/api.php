<?php

use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\VariantController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SearchProductController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::prefix('v1')->group(function () {
    Route::get('/categories/{categoryId}/products', [CategoryProductController::class, 'getProductsByCategory']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('brands', BrandsController::class);
    Route::apiResource('colors', ColorController::class);
    Route::apiResource('sizes', SizeController::class);
    Route::apiResource('materials', MaterialController::class);
    Route::apiResource('variants', VariantController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('search_product', SearchProductController::class);

});
