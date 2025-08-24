<?php

use App\Http\Controllers\App_Controllers\HomeController;
use App\Http\Controllers\App_Controllers\CartController;
use App\Http\Controllers\App_Controllers\AuthController;
use App\Http\Controllers\App_Controllers\SalesAuthController;
use App\Http\Controllers\App_Controllers\WalletController;
use App\Http\Controllers\App_Controllers\InviteController;
use App\Http\Controllers\App_Controllers\OrderController;
use App\Http\Controllers\App_Controllers\PaymentController;

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
Route::get('logout', [AuthController::class, 'logout']);
Route::post('user-register', [AuthController::class, 'register']);
//User API
Route::group(['middleware' => ['auth:api']], function () {

Route::post('refresh', [AuthController::class, 'refresh']);
Route::post("user", [AuthController::class, 'me']);

Route::get('user-profile', [AuthController::class, 'me']);
Route::post('update-profile', [AuthController::class, 'update_profile']);
Route::post('update-password', [AuthController::class, 'update_password']);
Route::post('addtocart', [CartController::class, 'addtocart']);
Route::post('removeCart', [CartController::class, 'removeCart']);
Route::post('viewCart', [CartController::class, 'viewCart']);
Route::post('profileImage', [AuthController::class, 'profileImage']);
Route::post("createOrder",[CartController::class,'createOrder']);


Route::post('/payment/create-order', [PaymentController::class, 'createOrder']);
Route::post('/payment/verify', [PaymentController::class, 'verifyPayment']);


});
Route::get('hotel_list', [HomeController::class, 'hotel_list']);
Route::get('getPackage', [HomeController::class, 'packages']);
Route::get('getCoupon', [HomeController::class, 'getCoupon']);

Route::post('applyCoupon', [CartController::class, 'applyCoupon'])->name('applyCoupon');   


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


//Invite API
Route::post('inviteLink', [SalesAuthController::class, 'inviteLink']);         // Table affetcted cart
Route::post('inviteForm',[SalesAuthController::class, 'inviteForm']);
Route::post('invite',[InviteController::class, 'index']); // Table invite
Route::put('inviteUpdate',[InviteController::class, 'updateStatus']); // Table invite
Route::post('inviteList', [InviteController::class, 'list']); // Table invite
//Track Sales API



//Wallet API
Route::get('getwallet', [WalletController::class, 'get']);    // Table wallet , commision 
Route::post('updatewallet', [WalletController::class,'update']);
Route::get('commisionswallet', [WalletController::class,'commisions']);
Route::post('newwallet', [WalletController::class,'store']);


//Sales Profile API 
Route::post('saleslogin', [SalesAuthController::class, 'login']);   // Table users
Route::post('saleslogout', [SalesAuthController::class, 'logout']);
Route::post('salesUpdateProfile', [SalesAuthController::class, 'update_profile']);
Route::post('updatePassword', [SalesAuthController::class, 'update_password']);



