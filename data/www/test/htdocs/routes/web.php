<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('products');
});

Route::middleware('auth')->group(function (){
    Route::get('/products', [ProductController::class,'index'])->name('products');
    Route::get('/cart', [CartController::class,'index'])->name('cart');

    Route::post('/cart-product-update',[CartController::class,'cartProductUpdate'])->name('cart-product-update');
    Route::post('/cart-promo-update',[CartController::class,'cartPromoUpdate'])->name('cart-promo-update');
});

Auth::routes();
