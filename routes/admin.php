<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SettingsController;

Route::middleware('web')->group(function () {
    Route::view('login', 'admin.login')->middleware('admin_guest')->name('login');
    Route::post('login', [AuthAdminController::class, 'login'])->middleware('admin_guest')->name('login.post');
    Route::group(['middleware' => 'admin'], function () {
        Route::post('logout', [AuthAdminController::class, 'logout'])->name('logout');
        Route::view('/', 'admin.home')->name('home');
        Route::resource('/users', UserController::class);
        Route::resource('/admins', AdminController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/orders', OrderController::class);
        Route::group(['prefix' => 'orders', 'as' => 'orders.', 'controller' => OrderController::class], function () {
            Route::PATCH('/canceled/{id}', 'canceled')->name('canceled');
            Route::PUT('/confirm/{id}', 'confirm')->name('confirm');
            Route::PUT('/complete/{id}', 'complete')->name('complete');
        });
        Route::get('/contacts', [ContactUsController::class, 'index'])->name('contacts');
        Route::delete('/contacts/delete/{id}', [ContactUsController::class, 'destroy'])->name('contacts.destroy');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::group(['prefix' => 'settings', 'as' => 'settings.', 'controller' => SettingsController::class], function () {
            Route::get('/', 'show')->name('show');
            Route::post('/update', 'update')->name('update');
        });
    });
});