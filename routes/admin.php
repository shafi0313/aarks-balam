<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\OrderManageController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Setting\AppDbBackupController;
use App\Http\Controllers\Setting\Permission\RoleController;
use App\Http\Controllers\Setting\Permission\PermissionController;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');


// Role & Permission
Route::post('/role/permission/{role}', [RoleController::class, 'assignPermission'])->name('role.permission');
Route::resource('/role', RoleController::class);
Route::resource('/permission', PermissionController::class);

// App DB Backup
Route::controller(AppDbBackupController::class)->prefix('app-db-backup')->group(function(){
    Route::get('/password', 'password')->name('backup.password');
    Route::post('/checkPassword', 'checkPassword')->name('backup.checkPassword');
    Route::get('/confirm', 'index')->name('backup.index');
    Route::post('/backup-file', 'backupFiles')->name('backup.files');
    Route::post('/backup-db', 'backupDb')->name('backup.db');
    Route::post('/backup-download/{name}/{ext}', 'downloadBackup')->name('backup.download');
    Route::post('/backup-delete/{name}/{ext}', 'deleteBackup')->name('backup.delete');
});


Route::resource('/admin-users', AdminUserController::class)->except(['show','create']);
Route::patch('/admin-users/is-active/{user}', [AdminUserController::class, 'status'])->name('admin_users.is_active');

Route::resource('/my-profile', MyProfileController::class)->only(['index','edit']);

Route::resource('/sliders', SliderController::class)->except(['create','show']);
Route::patch('/sliders/is-active/{slider}', [SliderController::class, 'status'])->name('sliders.is_active');

Route::resource('/categories', CategoryController::class)->except(['create','show']);
Route::patch('/categories/is-active/{category}', [CategoryController::class, 'status'])->name('categories.is_active');

Route::resource('/sub-categories', SubCategoryController::class)->except(['create','show']);
Route::patch('/sub-categories/is-active/{category}', [SubCategoryController::class, 'status'])->name('sub_categories.is_active');

Route::resource('/products', ProductController::class)->except(['create','show']);
Route::patch('/products/is-active/{product}', [ProductController::class, 'status'])->name('products.is_active');
Route::get('/get-sub-categories', [ProductController::class, 'getSubCategory'])->name('products.sub_categories');

Route::controller(OrderManageController::class)->name('order_manages.')->group(function(){
    Route::get('/order', 'index')->name('index');
    Route::get('/order/edit/{id}', 'edit')->name('edit');
    Route::get('/accept/{orderId}', 'accept')->name('accept');
    Route::get('/reject/{orderId}', 'reject')->name('reject');
    
});
