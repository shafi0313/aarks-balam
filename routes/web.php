<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Admin\LockScreenController;
use App\Http\Controllers\Frontend\MyOrderController;
use App\Http\Controllers\Frontend\MyProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('login/locked', [LockScreenController::class, 'locked'])->middleware('auth')->name('login.locked');
Route::post('login/locked', [LockScreenController::class, 'unlock'])->name('login.unlock');

Route::controller(AuthController::class)->group(function () {
    Route::get('/sign-in', 'signIn')->name('sign_in');
    Route::post('/sign-in', 'store')->name('sign_in');
    Route::get('/sign-up', 'signUp')->name('sign_up');
    Route::get('sign-out', 'signOut')->name('sign_out');
});

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/sub-category/{cat_id}', 'subCategory')->name('sub_category');
    Route::get('/product', 'product')->name('products');
    Route::get('/product-by-category/{cat_id}', 'productByCategory')->name('product_by_category');
    Route::get('/product-by-sub-category/{sub_cat_id}', 'productBySubCategory')->name('product_by_sub_category');
    Route::get('/product-show/{id}', 'productShow')->name('product_show');
    // Route::get('contact', 'contact')->name('frontend.contact');
});

Route::get('/my-profile', [MyProfileController::class, 'index'])->name('my_profile.index');
Route::post('/my-profile/{user}', [MyProfileController::class, 'update'])->name('my_profile.update');

Route::controller(MyOrderController::class)->prefix('/my-order')->name('my_order.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/cancel/{order}', 'cancel')->name('cancel');
});
