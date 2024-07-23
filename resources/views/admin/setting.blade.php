@extends('layouts.admin_design')
@section('content')
<!-- path -->
<div class="container-fluid">
	<div class="path">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a routerLink="/dashboard">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Setting</li>
			</ol>
		</nav>
	</div>
</div>
<!-- #path -->
<!-- Content -->

<div class="container-fluid">
	<div class="content_container">
		<h2>Setting</h2>
		<div class="form_container">
                            <form class="form-horizontal ajax_form" action="{{ url('administrator/profile/setting') }}" method="post" id="clinicForm">
                                {{csrf_field()}}
                                <div class="card-body">
                                  
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label"> Origination Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname" placeholder="Origination Name Here" name="name" value="<?php echo $user->name ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lname" placeholder="Email Here" name="email" value="<?php echo $user->email ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" placeholder="*****" name="npassword">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Logo</label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="logo" class="custom-file-input" id="validatedCustomFile">
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Contact No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cono1" placeholder="Contact No Here" name="mobile_number" value="<?php echo $user->mobile_number ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="address"><?php echo $user->address ?></textarea>
                                        </div>
                                    </div>
                                                 <!--        <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Package Type</label>
                        <div class="col-sm-9">
                            <div class="custom-control custom-radio w-50">
                                <input type="radio" id="customRadio3" name="retailar_package" class="custom-control-input" value="All" <?php if($user->retailar_package=="All") { echo "checked";} ?> >
                                <label class="custom-control-label" for="customRadio3">All</label>
                            </div>
                            <div class="custom-control custom-radio w-50">
                                <input type="radio" id="customRadio1" name="retailar_package" class="custom-control-input" value="Retailer"  <?php if($user->retailar_package=="Retailer") { echo "checked";} ?>>
                                <label class="custom-control-label" for="customRadio1">Retailer</label>
                            </div>
                            <div class="custom-control custom-radio w-50">
                                <input type="radio" id="customRadio2" name="retailar_package" class="custom-control-input" value="Customer" <?php if($user->retailar_package=="Customer") { echo "checked";} ?> >
                                <label class="custom-control-label" for="customRadio2">Customer</label>
                            </div>
                        </div>
                    </div> -->
                                </div>
                                <input type="hidden" name="id" value="<?php echo $user->id ?>">
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-info rounded-0">Submit</button>
                                    </div>
                                </div>
                            </form>
		</div>
	</div>
</div>
@endsection