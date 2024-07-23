  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
        <img src="<?php echo url('/'); ?>/logo/{{ auth()->user()->logo }}" alt="main_logo">
        <span class="ms-1 font-weight-bold">{{ auth()->user()->name }}</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  {{ Route::is('hotel_dashboard') ? 'active' : '' }}" href="{{ route('hotel_dashboard') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            D
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ Route::is('hoteladmin_coupons') ? 'active' : '' }} " href="{{ route('hoteladmin_coupons') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            P
            </div>
            <span class="nav-link-text ms-1">Promotion Management</span>
          </a>
        </li>
      @if(auth()->user()->role_id==1)
        <li class="nav-item">
          <a class="nav-link  {{ Route::is('hoteladmin_permission') ? 'active' : '' }} " href="{{ route('hoteladmin_permission') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              P
            </div>
            <span class="nav-link-text ms-1">Permission Management</span>
          </a>
        </li>
        @endif
        @if(auth()->user()->role_id==1)
        <li class="nav-item">
          <a class="nav-link  {{ Route::is('hoteladmin_user') ? 'active' : '' }} " href="{{ route('hoteladmin_user') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            U
            </div>
            <span class="nav-link-text ms-1">User Management</span>
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a class="nav-link {{ Route::is('hoteladmin_coupons_redeem') ? 'active' : '' }}  " href="{{ route('hoteladmin_coupons_redeem') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              CR
            </div>
            <span class="nav-link-text ms-1">Cuopon Redeem</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('hoteladmin_single_package') ? 'active' : '' }}  " href="{{ route('hoteladmin_single_package') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              SP
            </div>
            <span class="nav-link-text ms-1">Sold Packages</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('update_profile') ? 'active' : '' }}  " href="{{ route('update_profile') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              P
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
  </aside>