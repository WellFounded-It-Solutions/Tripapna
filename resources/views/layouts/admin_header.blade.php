<?php  $baseUrl = '';
$user_type='';
if(auth()->check() && auth()->user()->hasRole('admin')) {
	$baseUrl =  url('/').'/administrator/';
}else if(auth()->check() && auth()->user()->hasRole('sub-admin')) {
	$baseUrl =  url('/').'/subadmin/';

}else if(auth()->check() && auth()->user()->hasRole('manager')) {
	$baseUrl =  url('/').'/manager/';
}
else if(auth()->check() && auth()->user()->hasRole('agent')) {
	$baseUrl =  url('/').'/agent/';
}
?>
@if(Session::has('user_type'))
  @php $user_type = Session::get('user_type') @endphp
@endif
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<link rel="icon" type="image/x-icon" href="<?php echo url('/'); ?>/fav.png">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?php echo url('/'); ?>/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo url('/'); ?>/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo url('/'); ?>/dist/css/adminlte.min.css?v=3.2.0">
	<link rel="stylesheet" href="<?php echo url('/'); ?>/dist/css/jquery.toast.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
	<script src="<?php echo url('/'); ?>/plugins/jquery/jquery.min.js"></script>
	<link href="<?php echo url('/'); ?>\plugins\summernote\summernote-bs5.css" rel="stylesheet">
	<script src="<?php echo url('/'); ?>\plugins\summernote\summernote-bs5.js"></script>

	<script>
		
		var baseUrl = '<?php echo $baseUrl ?>';
	</script>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    </ul>
   </ul>
</nav>
@include('layouts.admin_sidebar')