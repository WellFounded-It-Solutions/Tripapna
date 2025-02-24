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
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::get('user-profile', 'AuthController@me');
Route::post('user-register', 'AuthController@register');
Route::post('update-profile', 'AuthController@update_profile');
Route::post('update-password', 'AuthController@update_password');



Route::get('hotel_list', 'HomeController@hotel_list');
Route::get('getPackage', 'HomeController@packages');
Route::get('getCoupon', 'HomeController@getCoupon');



Route::post('addtocart', 'CartController@addtocart');
Route::post('removeCart', 'CartController@removeCart');
Route::get('viewCart', 'CartController@viewCart');