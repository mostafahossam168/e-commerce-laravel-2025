<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::view('login', 'admin.login')->middleware('admin_guest')->name('login');
    Route::post('login', [AuthAdminController::class, 'login'])->middleware('admin_guest')->name('login.post');
    Route::group(['middleware' => 'admin'], function () {
        Route::post('logout', [AuthAdminController::class, 'logout'])->name('logout');
        Route::view('home', 'admin.home')->name('home');
        Route::resource('/users', UserController::class);
        Route::resource('/admins', AdminController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/products', ProductController::class);
        Route::get('/contacts', [ContactUsController::class, 'index'])->name('contacts');
        Route::delete('/contacts/delete/{id}', [ContactUsController::class, 'destroy'])->name('contacts.destroy');
    });
});