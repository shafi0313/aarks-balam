<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\MyAccountController;
use App\Http\Controllers\Frontend\ShippingController;
use App\Http\Controllers\Frontend\WishlistController;

Route::controller(CartController::class)->prefix('/cart')->group(function(){
    Route::get('/index', 'index')->name('cart.index');
    Route::post('/store', 'store')->name('cart.store');
    Route::get('/show', 'show')->name('cart.show');
    Route::get('/show-menu', 'cartMenu')->name('cart.cartMenu');
    Route::post('/incrementStore', 'incrementStore')->name('cart.incrementStore');
    Route::post('/decrementStore', 'decrementStore')->name('cart.decrementStore');
    Route::get('/delete/{id}', 'delete')->name('cart.delete');
    Route::delete('/destroy', 'destroy')->name('cart.destroy');
});


Route::controller(ShippingController::class)->prefix('/shipping')->group(function(){
    Route::get('/', 'index')->name('shipping.index');
    Route::post('/', 'store')->name('shipping.store');
    Route::get('/multi', 'shippingMulti')->name('shipping.shippingMulti');
    Route::post('/multiple/store', 'multipleStore')->name('shipping.multipleStore');
    Route::post('/confirm', 'confirm')->name('shipping.confirm');
});

// Route::controller(MyAccountController::class)->prefix('/my-account')->name('my_account.')->group(function(){
//     Route::get('/', 'index')->name('index');
// });
