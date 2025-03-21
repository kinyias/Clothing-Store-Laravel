<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
Route::get('/shop/{product_slug}',[ShopController::class,'product_details'])->name("shop.product.details");

Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard',[UserController::class, 'index'])->name('user.index');
    Route::get('/account-orders',[UserController::class, 'orders'])->name('user.orders');
    Route::get('/account-order/{order_id}',[UserController::class, 'order_details'])->name('user.order.details');

});


Route::middleware(['auth'], AuthAdmin::class)->group(function(){
    Route::get('/admin',[AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/brands',[AdminController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brands/add',[AdminController::class, 'add_brand'])->name('admin.brand.add');
    Route::post('/admin/brands/store',[AdminController::class, 'brand_store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}',[AdminController::class, 'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update',[AdminController::class, 'brand_update'])->name('admin.brand.update');
    Route::delete('admin/brand/{id}/delete',[AdminController::class, 'brand_delete'])->name('admin.brand.delete');

    Route::get('admin/categories',[AdminController::class, 'categories'])->name('admin.categories');
    Route::get('admin/category/add',[AdminController::class, 'category_add'])->name('admin.category.add');
    Route::post('admin/category/store',[AdminController::class, 'category_store'])->name('admin.category.store');
    Route::get('admin/category/edit/{id}',[AdminController::class, 'category_edit'])->name('admin.category.edit');
    Route::put('admin/category/update',[AdminController::class, 'category_update'])->name('admin.category.update');
    Route::delete('admin/category/{id}/delete',[AdminController::class, 'category_delete'])->name('admin.category.delete');

    Route::get('/admin/products',[AdminController::class,'products'])->name('admin.products');
    Route::get('/admin/product/add',[AdminController::class,'product_add'])->name('admin.product.add');
    Route::post('/admin/product/store',[AdminController::class,'product_store'])->name('admin.product.store');
    Route::get('/admin/product/{id}/edit',[AdminController::class, 'product_edit'])->name('admin.product.edit');
    Route::put('/admin/product/update', [AdminController::class, 'product_update'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete',[AdminController::class,'delete_product'])->name('admin.product.delete');

    Route::get('/admin/search',[AdminController::class,'search'])->name('admin.search');

    Route::get('/admin/coupons', [AdminController::class,'coupons'])->name('admin.coupons');
    Route::get('/admin/coupon/add', [AdminController::class,'coupon_add'])->name('admin.coupon.add');
    Route::post('/admin/coupon/store', [AdminController::class,'coupon_store'])->name('admin.coupon.store');
    Route::get('/admin/coupon/edit/{id}', [AdminController::class,'coupon_edit'])->name('admin.coupon.edit');
    Route::put('/admin/coupon/update', [AdminController::class,'coupon_update'])->name('admin.coupon.update');
    Route::delete('/admin/coupon/delete/{id}', [AdminController::class,'coupon_delete'])->name('admin.coupon.delete');

    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/orders-details/{order_id}', [AdminController::class, 'order_details'])->name('admin.order.details');
    Route::put('/admin/orders-details/update-status', [AdminController::class, 'update_order_status'])->name('admin.order.status.update');

    // Colors
    Route::get('colors', [AdminController::class, 'colors'])->name('admin.colors');
    Route::get('color/add', [AdminController::class, 'colorAdd'])->name('admin.color.add');
    Route::post('color/store', [AdminController::class, 'colorStore'])->name('admin.color.store');
    Route::get('color/edit/{id}', [AdminController::class, 'colorEdit'])->name('admin.color.edit');
    Route::post('color/update/{id}', [AdminController::class, 'colorUpdate'])->name('admin.color.update');
    Route::delete('color/delete/{id}', [AdminController::class, 'colorDelete'])->name('admin.color.delete');

    // Sizes
    Route::get('sizes', [AdminController::class, 'sizes'])->name('admin.sizes');
    Route::get('size/add', [AdminController::class, 'sizeAdd'])->name('admin.size.add');
    Route::post('size/store', [AdminController::class, 'sizeStore'])->name('admin.size.store');
    Route::get('size/edit/{id}', [AdminController::class, 'sizeEdit'])->name('admin.size.edit');
    Route::post('size/update/{id}', [AdminController::class, 'sizeUpdate'])->name('admin.size.update');
    Route::delete('size/delete/{id}', [AdminController::class, 'sizeDelete'])->name('admin.size.delete');

    // Materials
    Route::get('materials', [AdminController::class, 'materials'])->name('admin.materials');
    Route::get('material/add', [AdminController::class, 'materialAdd'])->name('admin.material.add');
    Route::post('material/store', [AdminController::class, 'materialStore'])->name('admin.material.store');
    Route::get('material/edit/{id}', [AdminController::class, 'materialEdit'])->name('admin.material.edit');
    Route::post('material/update/{id}', [AdminController::class, 'materialUpdate'])->name('admin.material.update');
    Route::delete('material/delete/{id}', [AdminController::class, 'materialDelete'])->name('admin.material.delete');

    // Variants
    Route::get('variants', [AdminController::class, 'variants'])->name('admin.variants');
    Route::get('variant/add', [AdminController::class, 'variantAdd'])->name('admin.variants.add');
    Route::post('variant/store', [AdminController::class, 'variantStore'])->name('admin.variants.store');
    Route::get('variant/edit/{id}', [AdminController::class, 'variantEdit'])->name('admin.variants.edit');
    Route::post('variant/update/{id}', [AdminController::class, 'variantUpdate'])->name('admin.variants.update');
    Route::delete('variant/delete/{id}', [AdminController::class, 'variantDelete'])->name('admin.variants.delete');
});
