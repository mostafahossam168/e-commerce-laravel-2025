<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RateController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('profile', 'profile')->middleware('auth:api');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('update-profile', 'update_profile')->middleware('auth:api');
});


Route::group(['middleware' => StartSession::class, 'prefix' => 'cart', 'controller' => CartController::class], function () {
    Route::get('/index', 'index');
    Route::post('/add-to-cart/{id}', 'addToCart');
    Route::post('/remove-from-cart/{id}', 'removeFromCart');
});
Route::group(['prefix' => 'rates', 'controller' => RateController::class], function () {
    Route::get('/index/{product_id}', 'index');
    Route::post('/add-rate/{product_id}', 'addRate')->middleware('auth:api');
    Route::post('/remove-rate/{product_id}', 'removeRate')->middleware('auth:api');
});


Route::group(['middleware' => StartSession::class, 'prefix' => 'favorites', 'controller' => FavoriteController::class], function () {
    Route::get('/index', 'index');
    Route::post('/add-to-favorite/{id}', 'addToFavorite');
    Route::post('/remove-from-favorite/{id}', 'removeFromFavorite');
});

Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
    Route::get('/index', 'index');
    Route::get('/show/{id}', 'show');
});


Route::group(['middleware' => ['auth:api', StartSession::class], 'prefix' => 'orders', 'controller' => OrderController::class], function () {
    Route::get('/index', 'index');
    Route::get('/show/{id}', 'show');
    Route::post('/store', 'store');
});
Route::group(['middleware' => ['auth:api'], 'prefix' => 'notifications', 'controller' => NotificationController::class], function () {
    Route::get('/index', 'index');
    Route::post('/mark-as-read', 'markAsRead');
});

Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
    Route::get('/index', 'index');
    Route::get('/show/{id}', 'show');
});
Route::group(['prefix' => 'contact-us', 'controller' => ContactUsController::class], function () {
    Route::post('/create', 'create');
});
Route::group(['prefix' => 'settings', 'controller' => SettingsController::class], function () {
    Route::get('/', 'show');
});