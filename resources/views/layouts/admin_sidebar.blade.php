<?php
$hotelUrl = '';
$dashboardUrl = '';
$UserUrl = '';
$categoryUrl = '';
$couponUrl = '';
$profileUrl = '';
$customerUrl = '';
$singlePakcage = '';
$multiplePakcage = '';
$orderUrl = '';
$permissionUrl = url('/administrator') . '/permission';
if (auth()->check() && auth()->user()->hasRole('admin')) {
    $hotelUrl = url('/administrator') . '/hotels';
    $dashboardUrl = url('/administrator') . '/dashboard';
    $UserUrl = url('/administrator') . '/users';
    $categoryUrl = url('/administrator') . '/categories';
    $couponUrl = url('/administrator') . '/coupons';
    $profileUrl = url('/administrator') . '/profile';
    $customerUrl = url('/administrator') . '/customer';
    $singlePakcage = url('/administrator') . '/single-package';
    $multiplePakcage = url('/administrator') . '/multiple-package';
    $orderUrl = url('/administrator') . '/orders';
} else if (auth()->check() && auth()->user()->hasRole('subadmin')) {
    $hotelUrl = url('/subadmin') . '/hotels';
    $dashboardUrl = url('/subadmin') . '/dashboard';
    $UserUrl = url('/subadmin') . '/users';
    $categoryUrl = url('/subadmin') . '/categories';
    $couponUrl = url('/subadmin') . '/coupons';
    $profileUrl = url('/subadmin') . '/profile';
    $customerUrl = url('/subadmin') . '/customer';
    $singlePakcage = url('/subadmin') . '/single-package';
    $multiplePakcage = url('/subadmin') . '/multiple-package';
    $orderUrl = url('/subadmin') . '/orders';
} else if (auth()->check() && auth()->user()->hasRole('manager')) {
    $hotelUrl = url('/manager') . '/hotels';
    $dashboardUrl = url('/manager') . '/dashboard';
    $UserUrl = url('/manager') . '/users';
    $categoryUrl = url('/manager') . '/categories';
    $couponUrl = url('/manager') . '/coupons';
    $profileUrl = url('/manager') . '/profile';
    $customerUrl = url('/manager') . '/customer';
    $singlePakcage = url('/manager') . '/single-package';
    $multiplePakcage = url('/manager') . '/multiple-package';
    $orderUrl = url('/manager') . '/orders';
} else if (auth()->check() && auth()->user()->hasRole('agent')) {
    $hotelUrl = url('/agent') . '/hotels';
    $dashboardUrl = url('/agent') . '/dashboard';
    $UserUrl = url('/agent') . '/users';
    $categoryUrl = url('/agent') . '/categories';
    $couponUrl = url('/agent') . '/coupons';
    $profileUrl = url('/agent') . '/profile';
    $customerUrl = url('/agent') . '/customer';
    $singlePakcage = url('/agent') . '/single-package';
    $multiplePakcage = url('/agent') . '/multiple-package';
    $orderUrl = url('/agent') . '/orders';
}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light"><img src="<?php echo url('/'); ?>/logo.png" style="height:60px;" /></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager')||auth()->user()->hasRole('agent'))
                <li class="nav-item">
                    <a href="<?php echo $dashboardUrl ?>" class="nav-link {{ Route::is('admin_dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->check() && auth()->user()->hasRole('admin'))
                <li class="nav-item">
                    <a href="<?php echo $permissionUrl ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_permission') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Permission
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasRole('manager'))
                <li class="nav-item">
                    <a href="{{ route('sales_executives.index') }}"class="nav-link {{ route('sales_executives.index') }} ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Sales Executive
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasRole('manager'))
                <li class="nav-item">
                    <a href="{{ route('sales_executives.index') }}"class="nav-link {{ route('sales_executives.index') }} ">
                        <i class="nav-icon fa fa-map-marker"></i>
                        <p>
                            Track sales
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasRole('manager'))
                <li class="nav-item">
                    <a href="{{ route('sales_executives.index') }}"class="nav-link {{ route('sales_executives.index') }} ">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Payment Status
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasRole('manager'))
                <li class="nav-item">
                    <a href="{{ route('assignHotel') }}"class="nav-link {{ route('assignHotel') }} ">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Offer for sales boy
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item @if( Route::is(Auth::user()->roles['0']->params.'_user') || Route::is(Auth::user()->roles['0']->params.'_customer') || Route::is(Auth::user()->roles['0']->params.'_hotel') ) menu-open @endif">
                @if(auth()->user()->hasRole('admin') )
                <a href="#" class="nav-link @if( Route::is(Auth::user()->roles['0']->params.'_user') || Route::is(Auth::user()->roles['0']->params.'_customer') || Route::is(Auth::user()->roles['0']->params.'_hotel') ) active @endif">
                        <i class="fas fa-user-secret"></i>
                        <p>
                            &nbsp;&nbsp;&nbsp;&nbsp; Role Managment
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    @endif
                    <ul class="nav nav-treeview" @if( Route::is(Auth::user()->roles['0']->params.'_user') || Route::is(Auth::user()->roles['0']->params.'_customer') || Route::is(Auth::user()->roles['0']->params.'_hotel') ) style="display: block" @endif>
                    @if(auth()->user()->hasRole('admin') )
                        <li class="nav-item">
                            <a href="<?php echo $UserUrl ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_user') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Role User
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href="<?php echo $customerUrl; ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_customer') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Customer
                                    
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href="<?php echo $hotelUrl ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_hotel') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-hotel"></i>
                                <p>
                                    Hotel
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if(auth()->user()->hasRole('admin'))
                <li class="nav-item @if( Route::is(Auth::user()->roles['0']->params.'_categories') || Route::is(Auth::user()->roles['0']->params.'_coupons')  ) menu-is-opening menu-open @endif ">
                    <a href="#" class="nav-link @if( Route::is(Auth::user()->roles['0']->params.'_categories') || Route::is(Auth::user()->roles['0']->params.'_coupons')  ) active @endif">
                        <i class="fas fa-ad"></i>
                        <p>
                            &nbsp;&nbsp;&nbsp;&nbsp; Coupon Manegement
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if( Route::is(Auth::user()->roles['0']->params.'_categories') || Route::is(Auth::user()->roles['0']->params.'_coupons') ) style="display: block @endif ">
                        @if(auth()->check() && auth()->user()->can('view-categories'))
                        <li class="nav-item">
                            <a href="<?php echo $categoryUrl ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_categories') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-code-branch"></i>
                                <p>
                                    Coupon categories
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href="<?php echo $couponUrl ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_coupons') ? 'active' : '' }}">
                                <i class="fas fa-window-restore"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <p>
                                    Coupon
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(auth()->user()->hasRole('admin'))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-people-carry nav-item"></i>
                        <p>
                            &nbsp;&nbsp;&nbsp;&nbsp; Package
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">                        
                        <li class="nav-item">
                            <a href="<?php echo $singlePakcage ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_single_package') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Single Package
                                </p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="<?php echo $multiplePakcage ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_multiple_package') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Multiple Package
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(auth()->user()->hasRole('admin'))
                <li class="nav-item">
                    <a href="<?php echo $orderUrl ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_order') ? 'active' : '' }}">
                        <i class="fab fa-linode nav-icon"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                @endif
                
                @if(auth()->check() && auth()->user()->can('view-profile')|| auth()->user()->hasRole('manager') || auth()->user()->hasRole('agent'))
                <li class="nav-item">
                    <a href="<?php echo $profileUrl ?>" class="nav-link {{ Route::is(Auth::user()->roles['0']->params.'_profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tools"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="<?php echo route('logout') ?>" class="nav-link {{ Route::is('daimond-package') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
