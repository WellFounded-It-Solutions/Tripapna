
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo e($role->name); ?></title>
		<link rel="icon" type="image/x-icon" href="<?php echo url('/'); ?>/fav.png">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo url('/'); ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?php echo url('/'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo url('/'); ?>/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?php echo url('/'); ?>/dist/css/jquery.toast.min.css">
</head>
<body class="hold-transition login-page">
	<img src="<?php echo url('/'); ?>/logo.png" style="height:100px;"/>
<div class="login-box">
  <!-- /.login-logo -->
	<div class="card card-outline card-primary">
		<div class="card-header text-center">
			<a href="javascript:" class="h1"><b><?php echo e($role->name); ?></b></a>
		</div>
		<div class="card-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<form class="ajax_form" id="loginform" action="<?php echo e(url('administrator')); ?>" method="post" Autocomplete="off">
            <?php echo e(csrf_field()); ?>

				<div class="input-group mb-3">
					<input type="email" class="form-control" placeholder="Email" name="email">
					<div class="input-group-append">
						<div class="input-group-text">
						<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control" placeholder="Password" name="password">
					<div class="input-group-append">
						<div class="input-group-text">
						<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<input type="hidden" name="route_name" value="<?php echo e($route_name); ?>"/>
				<div class="row">
					<div class="col-8">
					</div>
					<!-- /.col -->
					<div class="col-4">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo url('/'); ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo url('/'); ?>/dist/js/jquery.form.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo url('/'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo url('/'); ?>/dist/js/adminlte.min.js"></script>
<script src="<?php echo url('/'); ?>/dist/js/pertify.js"></script>
<script src="<?php echo url('/'); ?>/dist/js/jquery.toast.min.js"></script>
</body>
</html>
<?php /**PATH E:\client\tripapna\admin\resources\views/admin/admin_login.blade.php ENDPATH**/ ?>