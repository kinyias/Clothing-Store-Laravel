<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\Api\BrandProductController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\VariantController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SearchProductController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\DeliveryController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUserInfo']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::prefix('v1')->group(function () {
    Route::get('/categories/{categoryId}/products', [CategoryProductController::class, 'getProductsByCategory']);
    Route::get('/brands/{brandId}/products', [BrandProductController::class, 'getProductsByBrand']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('brands', BrandsController::class);
    Route::apiResource('colors', ColorController::class);
    Route::apiResource('sizes', SizeController::class);
    Route::apiResource('materials', MaterialController::class);
    Route::apiResource('variants', VariantController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('search_product', SearchProductController::class);
    Route::put('/deliveries/order/{orderId}', [DeliveryController::class, 'updateByOrderId']);
    Route::apiResource('deliveries', DeliveryController::class);
    Route::get('/deliveries/order/{orderId}', [DeliveryController::class, 'getByOrderId']);
    Route::get('/orders/status', [OrderController::class, 'getByStatus']);
    Route::apiResource('orders', OrderController::class);
    Route::get('users/{userId}/orders', [OrderController::class, 'getByUser']);
    Route::put('orders/{id}/status', [OrderController::class, 'updateStatus']);
    Route::apiResource('order-items', OrderItemController::class);
    Route::get('orders/{orderId}/order-items', [OrderItemController::class, 'getByOrder']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/favorites', [FavoriteController::class, 'index']);
        Route::post('/favorites', [FavoriteController::class, 'store']);
        Route::delete('/favorites/{productId}', [FavoriteController::class, 'destroy']);
        Route::apiResource('addresses', AddressController::class);

        Route::post('addresses/{address}/set-default', [AddressController::class, 'setDefault'])
            ->name('addresses.set-default');
        Route::apiResource('transactions', TransactionController::class);
        Route::get('orders/{orderId}/transactions', [TransactionController::class, 'getByOrder']);
        Route::get('/products/{productId}/reviews', [ReviewController::class, 'index']);
        Route::get('/reviews', [ReviewController::class, 'allReviews']);
        Route::post('/reviews', [ReviewController::class, 'store']);
        Route::delete('/reviews/{reviewId}', [ReviewController::class, 'destroy']);

        Route::get('/shipping/orders-to-pack', [ShippingController::class, 'getOrdersToPack']);
        Route::get('/shipping/other-orders', [ShippingController::class, 'getOtherOrders']);
        Route::get('/shipping/orders/{orderId}', [ShippingController::class, 'show']);
        Route::post('/shipping/orders/{orderId}/confirm', [ShippingController::class, 'confirmPacking']);
    });
});



