<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::view('login', 'admin.login')->middleware('admin_guest')->name('login');
    Route::post('login', [AuthAdminController::class, 'login'])->middleware('admin_guest')->name('login.post');
    Route::group(['middleware' => 'admin'], function () {
        Route::post('logout', [AuthAdminController::class, 'logout'])->name('logout');
        Route::view('home', 'admin.home')->name('home');
        Route::resource('/categories', CategoryController::class);
        Route::resource('/products', ProductController::class);
    });
});
