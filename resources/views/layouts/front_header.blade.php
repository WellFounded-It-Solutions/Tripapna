<!DOCTYPE html>
<html lang="en">
<?php 
$baseUrl =  url('/').'/hoteladmin/';
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo url('/'); ?>/hotelpanel/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo url('/'); ?>/hotelpanel/assets/img/favicon.png">
	<title>@yield('title')</title>
  <link rel="icon" type="image/x-icon" href="<?php echo url('/'); ?>/fav.png">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?php echo url('/'); ?>/hotelpanel/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?php echo url('/'); ?>/hotelpanel/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="<?php echo url('/'); ?>/hotelpanel/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="<?php echo url('/'); ?>/plugins/jquery/jquery.min.js"></script>
  	<link href="<?php echo url('/'); ?>\plugins\summernote\summernote-bs5.css" rel="stylesheet">
	<script src="<?php echo url('/'); ?>\plugins\summernote\summernote-bs5.js"></script>
  <link rel="stylesheet" href="<?php echo url('/'); ?>/dist/css/jquery.toast.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
  	<script>
		var baseUrl = '<?php echo $baseUrl ?>';
	</script>
  <!-- CSS Files -->
  <link id="pagestyle" href="<?php echo url('/'); ?>/hotelpanel/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  @include('layouts.front_sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="{{ route('hotelpanel-logout') }}" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->