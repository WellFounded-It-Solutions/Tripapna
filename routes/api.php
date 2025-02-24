<?php

use App\Http\App\Controllers\App_Controllers\HomeController;
use App\Http\App\Controllers\App_Controllers\CartController;
use App\Http\App\Controllers\App_Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// authentication routes

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('user-profile', [AuthController::class, 'me']);
Route::post('user-register', [AuthController::class, 'register']);
Route::post('update-profile', [AuthController::class, 'update_profile']);
Route::post('update-password', [AuthController::class, 'update_password']);

Route::get('hotel_list', [HomeController::class, 'hotel_list']);
Route::get('getPackage', [HomeController::class, 'packages']);
Route::get('getCoupon', [HomeController::class, 'getCoupon']);

Route::post('addtocart', [CartController::class, 'addtocart']);
Route::post('removeCart', [CartController::class, 'removeCart']);
Route::get('viewCart', [CartController::class, 'viewCart']);
