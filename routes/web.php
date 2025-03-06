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
});
