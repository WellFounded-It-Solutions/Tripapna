<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\multiplePackageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\singlePackageController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Hotel\HotelPanelController;
use App\Http\Controllers\Hotel\HotelPanelCouponController;
use App\Http\Controllers\Hotel\HotelPanelDashboardController;
use App\Http\Controllers\Hotel\PackageController;
use App\Http\Controllers\Hotel\CouponRedeemController;
use App\Http\Controllers\Hotel\HotelPermissionController;
use App\Http\Controllers\Hotel\HotelUsersController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\SaleExecutiveController;


use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController as UserOrderController;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    echo "Cache is cleared";
    die;
});

// Administrator Routes
Route::match(['get', 'post'], 'administrator', [AdminController::class, 'login'])->name('administrator');
Route::get('/administrator/logout', [AdminController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'role:admin'], function () {
    Route::match(['get'], 'administrator/profile', [AdminController::class, 'profile'])->name('administrator_profile');
    Route::match(['post'], 'administrator/update', [AdminController::class, 'update'])->name('administrator_profile_update');

    Route::get('/administrator/modules', [ModuleController::class, 'index'])->name('administrator_modules');
    Route::get('/administrator/moduleslist', [ModuleController::class, 'get_list'])->name('administrator_moduleslist');
    Route::post('/administrator/modules/store', [ModuleController::class, 'store'])->name('administrator_modules_store');
    // Route::get('/administrator/modules/get_record_by_id/{id}', [ModuleController::class, 'get_record_by_id'])->name('administrator_modules_get_record_by_id');
    Route::post('/administrator/modules/change_status', [ModuleController::class, 'change_status'])->name('administrator_modules_change_status');
    // Route::post('/administrator/modules/store', [ModuleController::class, 'store'])->name('administrator_modules_store');
    // Route::post('/administrator/modules/update', [ModuleController::class, 'update'])->name('administrator_modules_update');
    // Route::get('/administrator/modules/delete/{ids}', [ModuleController::class, 'destroy'])->name('administrator_modules_delete');

    Route::get('/administrator/permission', [PermissionController::class, 'index'])->name('administrator_permission');
    Route::get('/administrator/permissionlist', [PermissionController::class, 'get_list'])->name('administrator_permissionlist');
    Route::get('/administrator/permission/getPermission/{id}', [PermissionController::class, 'getPermission'])->name('administrator_getPermission');
    Route::post('/administrator/permission/permission', [PermissionController::class, 'permission'])->name('administrator_permission');

    Route::get('/administrator/dashboard', [DashboardController::class, 'index'])->name('administrator_dashboard');
    Route::get('/administrator/users', [UsersController::class, 'index'])->name('administrator_user');
    Route::get('/administrator/userslist', [UsersController::class, 'get_list'])->name('administrator_users_list');
    Route::get('/administrator/users/get_record_by_id/{id}', [UsersController::class, 'get_record_by_id'])->name('administrator_users_get_record_by_id');
    Route::get('/administrator/users/change_status/{id}/{status}', [UsersController::class, 'change_status'])->name('administrator_users_change_status');
    Route::post('/administrator/store', [UsersController::class, 'store'])->name('administrator_user_store');
    Route::post('/administrator/users/update', [UsersController::class, 'update'])->name('administrator_user_update');
    Route::get('/administrator/users/delete/{id}', [UsersController::class, 'destroy'])->name('administrator_user_delete');

    Route::get('/administrator/hotels', [HotelController::class, 'index'])->name('administrator_hotel');
    Route::get('/administrator/hotelslist', [HotelController::class, 'get_list'])->name('administrator_hotels_list');
    Route::get('/administrator/hotels/get_record_by_id/{id}', [HotelController::class, 'get_record_by_id'])->name('administrator_hotels_get_record_by_id');
    Route::get('/administrator/hotels/change_status/{id}/{status}', [HotelController::class, 'change_status'])->name('administrator_hotels_change_status');
    Route::post('/administrator/hotel/store', [HotelController::class, 'store'])->name('administrator_hotel_store');
    Route::post('/administrator/hotels/update', [HotelController::class, 'update'])->name('administrator_hotel_update');
    // Route::get('/administrator/hotels/delete/{ids}', [HotelController::class, 'destroy'])->name('administrator_hotel_delete');

    Route::get('/administrator/hotel_category_create', [HotelController::class, 'create_hotel_category'])->name('administrator_hotel_category_create');
    Route::post('/administrator/hotel_category_store', [HotelController::class, 'store_hotel_category'])->name('administrator_hotel_category_store');
    Route::get('/administrator/hotel_category_list', [HotelController::class, 'get_hotel_category_list'])->name('administrator_hotel_category_list');
    Route::post('/administrator/hotel_category_status', [HotelController::class, 'change_hotel_category_status'])->name('administrator_hotel_category_status');
    Route::get('/administrator/hotel_category_get_record_by_id/{id}', [HotelController::class, 'get_hotel_category_by_id'])->name('administrator_hotel_category_get_record_by_id');
    Route::post('/administrator/hotel_category_update', [HotelController::class, 'update_hotel_category'])->name('administrator_hotel_category_update');
    // Route::get('/administrator/hotel_category_delete/{ids}',[HotelController::class, 'destroy_hotel_category'])->name('administrator_hotel_category_delete');

    Route::get('/administrator/categories', [CategoryController::class, 'index'])->name('administrator_categories');
    Route::get('/administrator/categorieslist', [CategoryController::class, 'get_list'])->name('administrator_categories_list');
    Route::get('/administrator/categories/get_record_by_id/{id}', [CategoryController::class, 'get_record_by_id'])->name('administrator_categories_get_record_by_id');
    Route::get('/administrator/categories/change_status/{id}/{status}', [CategoryController::class, 'change_status'])->name('administrator_categories_change_status');
    Route::post('/administrator/categories/store', [CategoryController::class, 'store'])->name('administrator_categories_store');
    Route::post('/administrator/categories/update', [CategoryController::class, 'update'])->name('administrator_categories_update');
    Route::get('/administrator/categories/delete/{ids}', [CategoryController::class, 'destroy'])->name('administrator_categories_delete');

    Route::get('/administrator/coupons', [CouponController::class, 'index'])->name('administrator_coupons');
    Route::get('/administrator/couponslist', [CouponController::class, 'get_list'])->name('administrator_coupons_list');
    Route::get('/administrator/coupons/get_record_by_id/{id}', [CouponController::class, 'get_record_by_id'])->name('administrator_coupons_get_record_by_id');
    Route::get('/administrator/coupons/change_status/{id}/{status}', [CouponController::class, 'change_status'])->name('administrator_coupons_change_status');
    Route::post('/administrator/coupons/store', [CouponController::class, 'store'])->name('administrator_coupons_store');
    Route::post('/administrator/coupons/update', [CouponController::class, 'update'])->name('administrator_coupons_update');
    Route::get('/administrator/coupons/delete/{ids}', [CouponController::class, 'destroy'])->name('administrator_coupons_delete');

    Route::get('/administrator/customer', [CustomerController::class, 'index'])->name('administrator_customer');
    Route::get('/administrator/customerlist', [CustomerController::class, 'get_list'])->name('administrator_customer_list');
    Route::get('/administrator/customer/change_status/{id}/{status}', [CustomerController::class, 'change_status'])->name('administrator_customer_change_status');

    Route::get('/administrator/single-package', [singlePackageController::class, 'index'])->name('administrator_single_package');
    Route::get('/administrator/single-packagelist', [singlePackageController::class, 'get_list'])->name('administrator_single_package_list');
    Route::get('/administrator/single-package/get_record_by_id/{id}', [singlePackageController::class, 'get_record_by_id'])->name('administrator_single_package_get_record_by_id');
    Route::get('/administrator/single-package/change_status/{id}/{status}', [singlePackageController::class, 'change_status'])->name('administrator_single_package_change_status');
    Route::post('/administrator/single-package/store', [singlePackageController::class, 'store'])->name('administrator_single_package_store');
    Route::post('/administrator/single-package/update', [singlePackageController::class, 'update'])->name('administrator_single_package_update');
    Route::get('/administrator/single-package/delete/{ids}', [singlePackageController::class, 'destroy'])->name('administrator_single_package_delete');
    Route::get('/administrator/single-package/details/{ids}', [singlePackageController::class, 'details'])->name('administrator_single_package_details');
    Route::post('/administrator/single-package/clone', [singlePackageController::class, 'clone'])->name('administrator_single_package_clone');
    Route::get('/administrator/single-package/clone/{id}', [singlePackageController::class, 'get_record_by_id_clone'])->name('administrator_single_package_clone_id');
    Route::get('/administrator/single-package/getCoupon/{id}', [singlePackageController::class, 'getCoupon'])->name('administrator_single_package_getCoupon');

    Route::get('/administrator/multiple-package', [multiplePackageController::class, 'index'])->name('administrator_multiple_package');
    Route::get('/administrator/multiple-packagelist', [multiplePackageController::class, 'get_list'])->name('administrator_multiple_package_list');
    Route::get('/administrator/multiple-package/get_record_by_id/{id}', [multiplePackageController::class, 'get_record_by_id'])->name('administrator_multiple_package_get_record_by_id');
    Route::get('/administrator/multiple-package/change_status/{id}/{status}', [multiplePackageController::class, 'change_status'])->name('administrator_multiple_package_change_status');
    Route::post('/administrator/multiple-package/store', [multiplePackageController::class, 'store'])->name('administrator_multiple_package_store');
    Route::post('/administrator/multiple-package/update', [multiplePackageController::class, 'update'])->name('administrator_multiple_package_update');
    Route::get('/administrator/multiple-package/delete/{ids}', [multiplePackageController::class, 'destroy'])->name('administrator_multiple_package_delete');
    Route::get('/administrator/multiple-package/details/{ids}', [multiplePackageController::class, 'details'])->name('administrator_multiple_package_details');
    Route::post('/administrator/multiple-package/clone', [multiplePackageController::class, 'clone'])->name('administrator_multiple_package_clone');
    Route::get('/administrator/multiple-package/clone/{id}', [multiplePackageController::class, 'get_record_by_id_clone'])->name('administrator_multiple_package_clone_id');
    Route::get('/administrator/multiple-package/getCoupon/{id}', [multiplePackageController::class, 'getCoupon'])->name('administrator_multiple_package_getCoupon');

    Route::get('/administrator/orders', [OrderController::class, 'index'])->name('administrator_order');
    Route::get('/administrator/orderlist', [OrderController::class, 'get_list'])->name('administrator_order_list');
    Route::get('/administrator/order/details/{id}', [OrderController::class, 'details'])->name('administrator_order_details');
});

// Subadmin Routes
Route::match(['get', 'post'], 'subadmin', [AdminController::class, 'login'])->name('subadmin');
Route::group(['middleware' => 'role:subadmin'], function () {
    Route::match(['get'], 'subadmin/profile', [AdminController::class, 'profile'])->name('subadmin_profile');
    Route::match(['post'], 'subadmin/update', [AdminController::class, 'update'])->name('subadmin_profile_update');

    Route::get('/subadmin/users', [UsersController::class, 'index'])->name('subadmin_user');
    Route::get('/subadmin/userslist', [UsersController::class, 'get_list'])->name('subadmin_users_list');
    Route::get('/subadmin/users/get_record_by_id/{id}', [UsersController::class, 'get_record_by_id'])->name('subadmin_users_get_record_by_id');
    Route::get('/subadmin/users/change_status/{id}/{status}', [UsersController::class, 'change_status'])->name('subadmin_users_change_status');
    Route::post('/subadmin/store', [UsersController::class, 'store'])->name('subadmin_user_store');
    Route::post('/subadmin/users/update', [UsersController::class, 'update'])->name('subadmin_user_update');
    Route::post('/subadmin/users/permission', [UsersController::class, 'permission'])->name('subadmin_user_permission');
    Route::get('/subadmin/users/delete/{id}', [UsersController::class, 'destroy'])->name('subadmin_user_delete');
    Route::get('/subadmin/users/getPermission/{id}', [UsersController::class, 'getPermission'])->name('subadmin_hotel_getPermission');

    Route::get('/subadmin/dashboard', [DashboardController::class, 'index'])->name('subadmin_dashboard');
    Route::get('/subadmin/hotels', [HotelController::class, 'index'])->name('subadmin_hotel');
    Route::get('/subadmin/hotelslist', [HotelController::class, 'get_list'])->name('subadmin_hotels_list');
    Route::get('/subadmin/hotels/get_record_by_id/{id}', [HotelController::class, 'get_record_by_id'])->name('subadmin_hotels_get_record_by_id');
    Route::get('/subadmin/hotels/change_status/{id}/{status}', [HotelController::class, 'change_status'])->name('subadmin_hotels_change_status');
    Route::post('/subadmin/hotel/store', [HotelController::class, 'store'])->name('subadmin_hotel_store');
    Route::post('/subadmin/hotels/update', [HotelController::class, 'update'])->name('subadmin_hotel_update');
    // Route::get('/subadmin/hotels/delete/{ids}', [HotelController::class, 'destroy'])->name('subadmin_hotel_delete');

    Route::get('/subadmin/categories', [CategoryController::class, 'index'])->name('subadmin_categories');
    Route::get('/subadmin/categorieslist', [CategoryController::class, 'get_list'])->name('subadmin_categories_list');
    Route::get('/subadmin/categories/get_record_by_id/{id}', [CategoryController::class, 'get_record_by_id'])->name('subadmin_categories_get_record_by_id');
    Route::get('/subadmin/categories/change_status/{id}/{status}', [CategoryController::class, 'change_status'])->name('subadmin_categories_change_status');
    Route::post('/subadmin/categories/store', [CategoryController::class, 'store'])->name('subadmin_categories_store');
    Route::post('/subadmin/categories/update', [CategoryController::class, 'update'])->name('subadmin_categories_update');
    Route::get('/subadmin/categories/delete/{ids}', [CategoryController::class, 'destroy'])->name('subadmin_categories_delete');

    Route::get('/subadmin/coupons', [CouponController::class, 'index'])->name('subadmin_coupons');
    Route::get('/subadmin/couponslist', [CouponController::class, 'get_list'])->name('subadmin_coupons_list');
    Route::get('/subadmin/coupons/get_record_by_id/{id}', [CouponController::class, 'get_record_by_id'])->name('subadmin_coupons_get_record_by_id');
    Route::get('/subadmin/coupons/change_status/{id}/{status}', [CouponController::class, 'change_status'])->name('subadmin_coupons_change_status');
    Route::post('/subadmin/coupons/store', [CouponController::class, 'store'])->name('subadmin_coupons_store');
    Route::post('/subadmin/coupons/update', [CouponController::class, 'update'])->name('subadmin_coupons_update');
    Route::get('/subadmin/coupons/delete/{ids}', [CouponController::class, 'destroy'])->name('subadmin_coupons_delete');

    Route::get('/subadmin/customer', [CustomerController::class, 'index'])->name('subadmin_customer');
    Route::get('/subadmin/customerlist', [CustomerController::class, 'get_list'])->name('subadmin_customer_list');
    Route::get('/subadmin/customer/change_status/{id}/{status}', [CustomerController::class, 'change_status'])->name('subadmin_customer_change_status');

    Route::get('/subadmin/single-package', [singlePackageController::class, 'index'])->name('subadmin_single_package');
    Route::get('/subadmin/single-packagelist', [singlePackageController::class, 'get_list'])->name('subadmin_single_package_list');
    Route::get('/subadmin/single-package/get_record_by_id/{id}', [singlePackageController::class, 'get_record_by_id'])->name('subadmin_single_package_get_record_by_id');
    Route::get('/subadmin/single-package/change_status/{id}/{status}', [singlePackageController::class, 'change_status'])->name('subadmin_single_package_change_status');
    Route::post('/subadmin/single-package/store', [singlePackageController::class, 'store'])->name('subadmin_single_package_store');
    Route::post('/subadmin/single-package/update', [singlePackageController::class, 'update'])->name('subadmin_single_package_update');
    Route::get('/subadmin/single-package/delete/{ids}', [singlePackageController::class, 'destroy'])->name('subadmin_single_package_delete');
    Route::get('/subadmin/single-package/details/{ids}', [singlePackageController::class, 'details'])->name('subadmin_single_package_details');
    Route::get('/subadmin/single-package/getCoupon/{id}', [singlePackageController::class, 'getCoupon'])->name('subadmin_single_package_getCoupon');
    Route::post('/subadmin/single-package/clone', [singlePackageController::class, 'clone'])->name('subadmin_single_package_clone');
    Route::get('/subadmin/single-package/clone/{id}', [singlePackageController::class, 'get_record_by_id_clone'])->name('subadmin_single_package_clone_id');

    Route::get('/subadmin/multiple-package', [multiplePackageController::class, 'index'])->name('subadmin_multiple_package');
    Route::get('/subadmin/multiple-packagelist', [multiplePackageController::class, 'get_list'])->name('subadmin_multiple_package_list');
    Route::get('/subadmin/multiple-package/get_record_by_id/{id}', [multiplePackageController::class, 'get_record_by_id'])->name('subadmin_multiple_package_get_record_by_id');
    Route::get('/subadmin/multiple-package/change_status/{id}/{status}', [multiplePackageController::class, 'change_status'])->name('subadmin_multiple_package_change_status');
    Route::post('/subadmin/multiple-package/store', [multiplePackageController::class, 'store'])->name('subadmin_multiple_package_store');
    Route::post('/subadmin/multiple-package/update', [multiplePackageController::class, 'update'])->name('subadmin_multiple_package_update');
    Route::get('/subadmin/multiple-package/delete/{ids}', [multiplePackageController::class, 'destroy'])->name('subadmin_multiple_package_delete');
    Route::get('/subadmin/multiple-package/details/{ids}', [multiplePackageController::class, 'details'])->name('subadmin_multiple_package_details');
    Route::post('/subadmin/multiple-package/clone', [multiplePackageController::class, 'clone'])->name('subadmin_multiple_package_clone');
    Route::get('/subadmin/multiple-package/clone/{id}', [multiplePackageController::class, 'get_record_by_id_clone'])->name('subadmin_multiple_package_clone_id');
    Route::get('/subadmin/multiple-package/getCoupon/{id}', [multiplePackageController::class, 'getCoupon'])->name('subadmin_multiple_package_getCoupon');

    Route::get('/subadmin/orders', [OrderController::class, 'index'])->name('subadmin_order');
    Route::get('/subadmin/orderlist', [OrderController::class, 'get_list'])->name('subadmin_order_list');
    Route::get('/subadmin/order/details/{id}', [OrderController::class, 'details'])->name('subadmin_order_details');
});

// Manager Routes
Route::match(['get', 'post'], 'manager', [AdminController::class, 'login'])->name('manager');
Route::group(['middleware' => 'role:manager'], function () {
    Route::match(['get'], 'manager/profile', [AdminController::class, 'profile'])->name('manager_profile');
    Route::match(['post'], 'manager/update', [AdminController::class, 'update'])->name('manager_profile_update');

    Route::get('/manager/users', [UsersController::class, 'index'])->name('manager_user');
    Route::get('/manager/userslist', [UsersController::class, 'get_list'])->name('manager_users_list');
    Route::get('/manager/users/get_record_by_id/{id}', [UsersController::class, 'get_record_by_id'])->name('manager_users_get_record_by_id');
    Route::get('/manager/users/change_status/{id}/{status}', [UsersController::class, 'change_status'])->name('manager_users_change_status');
    Route::post('/manager/store', [UsersController::class, 'store'])->name('manager_user_store');
    Route::post('/manager/users/update', [UsersController::class, 'update'])->name('manager_user_update');
    Route::post('/manager/users/permission', [UsersController::class, 'permission'])->name('manager_user_permission');
    Route::get('/manager/users/delete/{id}', [UsersController::class, 'destroy'])->name('manager_user_delete');
    Route::get('/manager/users/getPermission/{id}', [UsersController::class, 'getPermission'])->name('manager_hotel_getPermission');

    Route::get('/manager/dashboard', [DashboardController::class, 'index'])->name('manager_dashboard');
    Route::get('/manager/hotels', [HotelController::class, 'index'])->name('manager_hotel');
    Route::get('/manager/hotelslist', [HotelController::class, 'get_list'])->name('manager_hotels_list');
    Route::get('/manager/hotels/get_record_by_id/{id}', [HotelController::class, 'get_record_by_id'])->name('manager_hotels_get_record_by_id');
    Route::get('/manager/hotels/change_status/{id}/{status}', [HotelController::class, 'change_status'])->name('manager_hotels_change_status');
    Route::post('/manager/hotel/store', [HotelController::class, 'store'])->name('manager_hotel_store');
    Route::post('/manager/hotels/update', [HotelController::class, 'update'])->name('manager_hotel_update');
    // Route::get('/manager/hotels/delete/{ids}', [HotelController::class, 'destroy'])->name('manager_hotel_delete');

    Route::get('/manager/categories', [CategoryController::class, 'index'])->name('manager_categories');
    Route::get('/manager/categorieslist', [CategoryController::class, 'get_list'])->name('manager_categories_list');
    Route::get('/manager/categories/get_record_by_id/{id}', [CategoryController::class, 'get_record_by_id'])->name('manager_categories_get_record_by_id');
    Route::get('/manager/categories/change_status/{id}/{status}', [CategoryController::class, 'change_status'])->name('manager_categories_change_status');
    Route::post('/manager/categories/store', [CategoryController::class, 'store'])->name('manager_categories_store');
    Route::post('/manager/categories/update', [CategoryController::class, 'update'])->name('manager_categories_update');
    Route::get('/manager/categories/delete/{ids}', [CategoryController::class, 'destroy'])->name('manager_categories_delete');

    Route::get('/manager/coupons', [CouponController::class, 'index'])->name('manager_coupons');
    Route::get('/manager/couponslist', [CouponController::class, 'get_list'])->name('manager_coupons_list');
    Route::get('/manager/coupons/get_record_by_id/{id}', [CouponController::class, 'get_record_by_id'])->name('manager_coupons_get_record_by_id');
    Route::get('/manager/coupons/change_status/{id}/{status}', [CouponController::class, 'change_status'])->name('manager_coupons_change_status');
    Route::post('/manager/coupons/store', [CouponController::class, 'store'])->name('manager_coupons_store');
    Route::post('/manager/coupons/update', [CouponController::class, 'update'])->name('manager_coupons_update');
    Route::get('/manager/coupons/delete/{ids}', [CouponController::class, 'destroy'])->name('manager_coupons_delete');

    Route::get('/manager/customer', [CustomerController::class, 'index'])->name('manager_customer');
    Route::get('/manager/customerlist', [CustomerController::class, 'get_list'])->name('manager_customer_list');
    Route::get('/manager/customer/change_status/{id}/{status}', [CustomerController::class, 'change_status'])->name('manager_customer_change_status');

    Route::get('/manager/single-package', [singlePackageController::class, 'index'])->name('manager_single_package');
    Route::get('/manager/single-packagelist', [singlePackageController::class, 'get_list'])->name('manager_single_package_list');
    Route::get('/manager/single-package/get_record_by_id/{id}', [singlePackageController::class, 'get_record_by_id'])->name('manager_single_package_get_record_by_id');
    Route::get('/manager/single-package/change_status/{id}/{status}', [singlePackageController::class, 'change_status'])->name('manager_single_package_change_status');
    Route::post('/manager/single-package/store', [singlePackageController::class, 'store'])->name('manager_single_package_store');
    Route::post('/manager/single-package/update', [singlePackageController::class, 'update'])->name('manager_single_package_update');
    Route::get('/manager/single-package/delete/{ids}', [singlePackageController::class, 'destroy'])->name('manager_single_package_delete');
    Route::get('/manager/single-package/details/{ids}', [singlePackageController::class, 'details'])->name('manager_single_package_details');
    Route::get('/manager/single-package/getCoupon/{id}', [singlePackageController::class, 'getCoupon'])->name('manager_single_package_getCoupon');

    Route::post('/manager/single-package/clone', [singlePackageController::class, 'clone'])->name('manager_single_package_clone');
    Route::get('/manager/single-package/clone/{id}', [singlePackageController::class, 'get_record_by_id_clone'])->name('manager_single_package_clone_id');

    Route::get('/manager/multiple-package', [multiplePackageController::class, 'index'])->name('manager_multiple_package');
    Route::get('/manager/multiple-packagelist', [multiplePackageController::class, 'get_list'])->name('manager_multiple_package_list');
    Route::get('/manager/multiple-package/get_record_by_id/{id}', [multiplePackageController::class, 'get_record_by_id'])->name('manager_multiple_package_get_record_by_id');
    Route::get('/manager/multiple-package/change_status/{id}/{status}', [multiplePackageController::class, 'change_status'])->name('manager_multiple_package_change_status');
    Route::post('/manager/multiple-package/store', [multiplePackageController::class, 'store'])->name('manager_multiple_package_store');
    Route::post('/manager/multiple-package/update', [multiplePackageController::class, 'update'])->name('manager_multiple_package_update');
    Route::get('/manager/multiple-package/delete/{ids}', [multiplePackageController::class, 'destroy'])->name('manager_multiple_package_delete');
    Route::get('/manager/multiple-package/details/{ids}', [multiplePackageController::class, 'details'])->name('manager_multiple_package_details');
    Route::post('/manager/multiple-package/clone', [multiplePackageController::class, 'clone'])->name('manager_multiple_package_clone');
    Route::get('/manager/multiple-package/clone/{id}', [multiplePackageController::class, 'get_record_by_id_clone'])->name('manager_multiple_package_clone_id');
    Route::get('/manager/multiple-package/getCoupon/{id}', [multiplePackageController::class, 'getCoupon'])->name('manager_multiple_package_getCoupon');

    Route::get('/manager/orders', [OrderController::class, 'index'])->name('manager_order');
    Route::get('/manager/orderlist', [OrderController::class, 'get_list'])->name('manager_order_list');
    Route::get('/manager/order/details/{id}', [OrderController::class, 'details'])->name('manager_order_details');

    Route::resource('sales_executives', SaleExecutiveController::class);

});

// Agent Route
Route::match(['get', 'post'], 'agent', [AdminController::class, 'login'])->name('agent');
Route::group(['middleware' => 'role:agent'], function () {
    Route::match(['get'], 'agent/profile', [AdminController::class, 'profile'])->name('agent_profile');
    Route::match(['post'], 'agent/update', [AdminController::class, 'update'])->name('agent_profile_update');

    Route::get('/agent/dashboard', [DashboardController::class, 'index'])->name('agent_dashboard');
    Route::get('/agent/hotels', [HotelController::class, 'index'])->name('agent_hotel');
    Route::get('/agent/hotelslist', [HotelController::class, 'get_list'])->name('agent_hotels_list');
    Route::get('/agent/hotels/get_record_by_id/{id}', [HotelController::class, 'get_record_by_id'])->name('agent_hotels_get_record_by_id');
    Route::get('/agent/hotels/change_status/{id}/{status}', [HotelController::class, 'change_status'])->name('agent_hotels_change_status');
    Route::post('/agent/hotel/store', [HotelController::class, 'store'])->name('agent_hotel_store');
    Route::post('/agent/hotels/update', [HotelController::class, 'update'])->name('agent_hotel_update');
    Route::get('/agent/hotels/delete/{ids}', [HotelController::class, 'destroy'])->name('agent_hotel_delete');

    Route::get('/agent/categories', [CategoryController::class, 'index'])->name('agent_categories');
    Route::get('/agent/categorieslist', [CategoryController::class, 'get_list'])->name('agent_categories_list');
    Route::get('/agent/categories/get_record_by_id/{id}', [CategoryController::class, 'get_record_by_id'])->name('agent_categories_get_record_by_id');
    Route::get('/agent/categories/change_status/{id}/{status}', [CategoryController::class, 'change_status'])->name('agent_categories_change_status');
    Route::post('/agent/categories/store', [CategoryController::class, 'store'])->name('agent_categories_store');
    Route::post('/agent/categories/update', [CategoryController::class, 'update'])->name('agent_categories_update');
    Route::get('/agent/categories/delete/{ids}', [CategoryController::class, 'destroy'])->name('agent_categories_delete');

    Route::get('/agent/coupons', [CouponController::class, 'index'])->name('agent_coupons');
    Route::get('/agent/couponslist', [CouponController::class, 'get_list'])->name('agent_coupons_list');
    Route::get('/agent/coupons/get_record_by_id/{id}', [CouponController::class, 'get_record_by_id'])->name('agent_coupons_get_record_by_id');
    Route::get('/agent/coupons/change_status/{id}/{status}', [CouponController::class, 'change_status'])->name('agent_coupons_change_status');
    Route::post('/agent/coupons/store', [CouponController::class, 'store'])->name('agent_coupons_store');
    Route::post('/agent/coupons/update', [CouponController::class, 'update'])->name('agent_coupons_update');
    Route::get('/agent/coupons/delete/{ids}', [CouponController::class, 'destroy'])->name('agent_coupons_delete');

    Route::get('/agent/customer', [CustomerController::class, 'index'])->name('agent_customer');
    Route::get('/agent/customerlist', [CustomerController::class, 'get_list'])->name('agent_customer_list');
    Route::get('/agent/customer/change_status/{id}/{status}', [CustomerController::class, 'change_status'])->name('agent_customer_change_status');

    Route::get('/agent/single-package', [singlePackageController::class, 'index'])->name('agent_single_package');
    Route::get('/agent/single-packagelist', [singlePackageController::class, 'get_list'])->name('agent_single_package_list');
    Route::get('/agent/single-package/get_record_by_id/{id}', [singlePackageController::class, 'get_record_by_id'])->name('agent_single_package_get_record_by_id');
    Route::get('/agent/single-package/change_status/{id}/{status}', [singlePackageController::class, 'change_status'])->name('agent_single_package_change_status');
    Route::post('/agent/single-package/store', [singlePackageController::class, 'store'])->name('agent_single_package_store');
    Route::post('/agent/single-package/update', [singlePackageController::class, 'update'])->name('agent_single_package_update');
    Route::get('/agent/single-package/delete/{ids}', [singlePackageController::class, 'destroy'])->name('agent_single_package_delete');
    Route::get('/agent/single-package/details/{ids}', [singlePackageController::class, 'details'])->name('agent_single_package_details');
    Route::get('/agent/single-package/getCoupon/{id}', [singlePackageController::class, 'getCoupon'])->name('agent_single_package_getCoupon');

    Route::post('/agent/single-package/clone', [singlePackageController::class, 'clone'])->name('agent_single_package_clone');
    Route::get('/agent/single-package/clone/{id}', [singlePackageController::class, 'get_record_by_id_clone'])->name('agent_single_package_clone_id');

    Route::get('/agent/multiple-package', [multiplePackageController::class, 'index'])->name('agent_multiple_package');
    Route::get('/agent/multiple-packagelist', [multiplePackageController::class, 'get_list'])->name('agent_multiple_package_list');
    Route::get('/agent/multiple-package/get_record_by_id/{id}', [multiplePackageController::class, 'get_record_by_id'])->name('agent_multiple_package_get_record_by_id');
    Route::get('/agent/multiple-package/change_status/{id}/{status}', [multiplePackageController::class, 'change_status'])->name('agent_multiple_package_change_status');
    Route::post('/agent/multiple-package/store', [multiplePackageController::class, 'store'])->name('agent_multiple_package_store');
    Route::post('/agent/multiple-package/update', [multiplePackageController::class, 'update'])->name('agent_multiple_package_update');
    Route::get('/agent/multiple-package/delete/{ids}', [multiplePackageController::class, 'destroy'])->name('agent_multiple_package_delete');
    Route::get('/agent/multiple-package/details/{ids}', [multiplePackageController::class, 'details'])->name('agent_multiple_package_details');
    Route::post('/agent/multiple-package/clone', [multiplePackageController::class, 'clone'])->name('agent_multiple_package_clone');
    Route::get('/agent/multiple-package/clone/{id}', [multiplePackageController::class, 'get_record_by_id_clone'])->name('agent_multiple_package_clone_id');
    Route::get('/agent/multiple-package/getCoupon/{id}', [multiplePackageController::class, 'getCoupon'])->name('agent_multiple_package_getCoupon');

    Route::get('/agent/orders', [OrderController::class, 'index'])->name('agent_order');
    Route::get('/agent/orderlist', [OrderController::class, 'get_list'])->name('agent_order_list');
    Route::get('/agent/order/details/{id}', [OrderController::class, 'details'])->name('agent_order_details');
});

// Hotel Routes
Route::match(['get', 'post'], 'hoteladmin', [HotelPanelController::class, 'login'])->name('login');
Route::get('/hoteladmin/logout', [HotelPanelController::class, 'logout'])->name('hotelpanel-logout');
Route::group(['middleware' => 'auth:hotel'], function () {
    Route::get('/hoteladmin/dashboard', [HotelPanelDashboardController::class, 'index'])->name('hotel_dashboard');

    Route::get('/hoteladmin/coupons', [HotelPanelCouponController::class, 'index'])->name('hoteladmin_coupons');
    Route::get('/hoteladmin/couponslist', [HotelPanelCouponController::class, 'get_list'])->name('hoteladmin_coupons_list');
    Route::get('/hoteladmin/coupons/get_record_by_id/{id}', [HotelPanelCouponController::class, 'get_record_by_id'])->name('hoteladmin_coupons_get_record_by_id');
    Route::get('/hoteladmin/coupons/change_status/{id}/{status}', [HotelPanelCouponController::class, 'change_status'])->name('hoteladmin_coupons_change_status');
    Route::post('/hoteladmin/coupons/store', [HotelPanelCouponController::class, 'store'])->name('hoteladmin_coupons_store');
    Route::post('/hoteladmin/coupons/update', [HotelPanelCouponController::class, 'update'])->name('hoteladmin_coupons_update');
    Route::get('/hoteladmin/coupons/delete/{ids}', [HotelPanelCouponController::class, 'destroy'])->name('hoteladmin_coupons_delete');

    Route::get('/hoteladmin/package', [PackageController::class, 'index'])->name('hoteladmin_single_package');
    Route::get('/hoteladmin/packagelist', [PackageController::class, 'get_list'])->name('hoteladmin_single_package_list');
    Route::get('/hoteladmin/package/get_record_by_id/{id}', [PackageController::class, 'get_record_by_id'])->name('hoteladmin_single_package_get_record_by_id');
    Route::get('/hoteladmin/package/change_status/{id}/{status}', [PackageController::class, 'change_status'])->name('hoteladmin_single_package_change_status');
    Route::post('/hoteladmin/package/store', [PackageController::class, 'store'])->name('hoteladmin_single_package_store');
    Route::post('/hoteladmin/package/update', [PackageController::class, 'update'])->name('hoteladmin_single_package_update');
    Route::get('/hoteladmin/package/delete/{ids}', [PackageController::class, 'destroy'])->name('hoteladmin_single_package_delete');
    Route::get('/hoteladmin/package/details/{ids}', [PackageController::class, 'details'])->name('hoteladmin_single_package_details');
    Route::get('/hoteladmin/package/getCoupon/{id}', [PackageController::class, 'getCoupon'])->name('hoteladmin_single_package_getCoupon');

    Route::get('/hoteladmin/coupons_redeem', [CouponRedeemController::class, 'index'])->name('hoteladmin_coupons_redeem');
    Route::get('/hoteladmin/orders', [CouponRedeemController::class, 'orders'])->name('hoteladmin_orders');
    Route::get('/hoteladmin/coupons_redeemlist/{id}', [CouponRedeemController::class, 'get_list'])->name('hoteladmin_coupons_redeem_list');
    Route::get('/hoteladmin/coupons_redeem/change_status/{id}/{status}', [CouponRedeemController::class, 'change_status'])->name('hoteladmin_coupons_redeem_change_status');
    Route::post('/hoteladmin/coupons_redeem/change_status_multiple', [CouponRedeemController::class, 'change_status_multiple'])->name('hoteladmin_coupons_change_status_multiple');

    Route::match(['get', 'post'], 'profile', [HotelPanelController::class, 'update'])->name('update_profile');


    Route::get('/hoteladmin/permission', [HotelPermissionController::class, 'index'])->name('hoteladmin_permission');
    Route::get('/hoteladmin/permissionlist', [HotelPermissionController::class, 'get_list'])->name('hoteladmin_permissionlist');
    Route::get('/hoteladmin/permission/getPermission/{id}', [HotelPermissionController::class, 'getPermission'])->name('hoteladmin_getPermission');
    Route::post('/hoteladmin/permission/permission', [HotelPermissionController::class, 'permission'])->name('hoteladmin_permission_view');


    Route::get('/hoteladmin/users', [HotelUsersController::class, 'index'])->name('hoteladmin_user');
    Route::get('/hoteladmin/userslist', [HotelUsersController::class, 'get_list'])->name('hoteladmin_users_list');
    Route::get('/hoteladmin/users/get_record_by_id/{id}', [HotelUsersController::class, 'get_record_by_id'])->name('hoteladmin_users_get_record_by_id');
    Route::get('/hoteladmin/users/change_status/{id}/{status}', [HotelUsersController::class, 'change_status'])->name('hoteladmin_users_change_status');
    Route::post('/hoteladmin/store', [HotelUsersController::class, 'store'])->name('hoteladmin_user_store');
    Route::post('/hoteladmin/users/update', [HotelUsersController::class, 'update'])->name('hoteladmin_user_update');
    Route::get('/hoteladmin/users/delete/{id}', [HotelUsersController::class, 'destroy'])->name('hoteladmin_hotel_delete');
});

// USER ROUTES
Route::get("/", [UserController::class, 'index'])->name('home');
Route::get("/all-stores", [UserController::class, 'allStores'])->name('allStores');

Route::get("/stores-details/{id}", [UserController::class, 'storeDetails'])->name('stores-details');
Route::get("/deals-details/{id}", [UserController::class, 'dealDetails'])->name('deals-details');


Route::group(['middleware' => 'auth:customer'], function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('viewCart');
    Route::post('addtocart', [CartController::class, 'addtocart'])->name('addtocart');
    Route::get('/removeCart/{id}', [CartController::class, 'removeCart'])->name('removeCart');
    Route::post('/updateCart', [CartController::class, 'updateCart'])->name('updateCart');

    Route::get("/dashboard", [AuthController::class, 'me'])->name('dashboard');
    Route::get("/profile", [AuthController::class, 'update_profile'])->name('update_profile');
    Route::post("/update-profile", [AuthController::class, 'update_profile_post'])->name('customer.profile.update');

    Route::post('/orderPlace', [UserOrderController::class, 'orderPlace'])->name('orderPlace');
    Route::get('/packages', [UserOrderController::class, 'myOrder'])->name('myOrder');
    // Route::post('getorderbyid', 'UserOrderController@getorderbyid');
    Route::get('/order-detail/{id}', [UserOrderController::class, 'orderDetails'])->name('orderDetails');
    // Route::post('voucherDetails', 'UserOrderController@voucherDetails');
    // Route::post('package_coupon', 'UserOrderController@package_coupon');
});

Route::get('/cart', [CartController::class, 'viewCart'])->name('viewCart');

Route::get("/login", [AuthController::class, 'login'])->name('custmor_login');
Route::post("/login", [AuthController::class, 'login_post'])->name('custmor_login_post');
Route::get("/register", [AuthController::class, 'register'])->name('custmor_register');
Route::post("/register", [AuthController::class, 'register_post'])->name('custmor_register_post');


// /////////////////////
// Route::post('refresh', 'AuthController@refresh');
// Route::get('user-profile', 'AuthController@me');
// Route::post('user-register', 'AuthController@register');
// Route::post('update-profile', 'AuthController@update_profile');
// Route::post('update-password', 'AuthController@update_password');
// // // Cart API
// Route::post('addtocart', 'CartController@addtocart');
// Route::post('removeCart', 'CartController@removeCart');
// Route::get('viewCart', 'CartController@viewCart');
// // Order API
// Route::post('orderPlace', 'OrderController@orderPlace');
// Route::get('myOrder', 'OrderController@myOrder');
// Route::post('getorderbyid', 'OrderController@getorderbyid');
// Route::post('orderDetails', 'OrderController@orderDetails');
// Route::post('voucherDetails', 'OrderController@voucherDetails');
// Route::post('package_coupon', 'OrderController@package_coupon');
// // List
// Route::get('getCoupon', 'HomeController@getCoupon');
// Route::get('getPackage', 'HomeController@packages');
// Route::get('search', 'HomeController@search');
// Route::get('get-hotel-type', 'HomeController@hotel_type');
// Route::get('hotel_list', 'HomeController@hotel_list');
// Route::post('hotel_package', 'HomeController@hotel_package');
// Route::post('packagesDetails', 'HomeController@packagesDetails');
// Route::post('getCouponDetails', 'HomeController@getCouponDetails');
// Route::post('addtowish', 'WishListController@add');
// Route::post('removewishlist', 'WishListController@remove');
// Route::get('mywishlist', 'WishListController@view');
// Route::post('/create-order', 'PaymentController@createOrder');
// Route::post('/phone_redirect_url', 'PaymentController@phone_redirect_url');
