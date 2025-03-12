<?php

use App\Http\Controllers\App_Controllers\HomeController;
use App\Http\Controllers\App_Controllers\CartController;
use App\Http\Controllers\App_Controllers\AuthController;
use App\Http\Controllers\App_Controllers\SalesAuthController;


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

Route::post('saleslogin', [SalesAuthController::class, 'login']);
Route::post('saleslogout', [SalesAuthController::class, 'logout']);


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

// Order API

// Order API
Route::post('orderPlace', [OrderController::class, 'orderPlace']);
Route::get('myOrder', [OrderController::class, 'myOrder']);
Route::post('getorderbyid', [OrderController::class, 'getorderbyid']);
Route::post('orderDetails', [OrderController::class, 'orderDetails']);
Route::post('voucherDetails', [OrderController::class, 'voucherDetails']);
Route::post('package_coupon', [OrderController::class, 'package_coupon']);

// List
Route::get('search', [HomeController::class, 'search']);
Route::get('get-hotel-type', [HomeController::class, 'hotel_type']);
Route::post('hotel_package', [HomeController::class, 'hotel_package']);
Route::post('packagesDetails', [HomeController::class, 'packagesDetails']);
Route::post('getCouponDetails', [HomeController::class, 'getCouponDetails']);

// Wishlist`
Route::post('addtowish', [WishListController::class, 'add']);
Route::post('removewishlist', [WishListController::class, 'remove']);
Route::get('mywishlist', [WishListController::class, 'view']);