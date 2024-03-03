<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LockScreenController;

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


Route::get('login/locked', [LockScreenController::class,'locked'])->middleware('auth')->name('login.locked');
Route::post('login/locked', [LockScreenController::class,'unlock'])->name('login.unlock');
