@extends('layouts.front_design')
@section('title','Hotel')
@section('content')
<div class="col-lg-9 mt-lg-0 mt-4">
   <div class="card card-body" id="profile">
      <div class="row justify-content-center align-items-center">
         <div class="col-sm-auto col-4">
            <div class="avatar avatar-xl position-relative">
               <img src="<?php echo url('/'); ?>/logo/{{ auth()->user()->logo }}" alt="bruce" class="w-100 border-radius-lg shadow-sm">
            </div>
         </div>
         <div class="col-sm-auto col-8 my-auto">
            <div class="h-100">
               <h5 class="mb-1 font-weight-bolder">
                  {{ auth()->user()->name }}
               </h5>
            </div>
         </div>
         <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
         </div>
      </div>
   </div>
   <div class="card mt-4" id="password">
      <div class="card-header">
         <h5>Change Password</h5>
      </div>
      <div class="card-body pt-0">
        <form class="ajax_form" id="loginform" action="{{ route('update_profile') }}" method="post" Autocomplete="off">
                {{csrf_field()}}
            <label class="form-label">Hotel Name</label>
            <div class="form-group">
               <input class="form-control" type="text" placeholder="Name" name="name" value="{{ auth()->user()->name }}">
            </div>
            <label class="form-label">Hotel Location</label>
            <div class="form-group">
               <input class="form-control" type="text" placeholder="Location" name="location" value="{{ auth()->user()->location }}">
            </div>
            <label class="form-label">Email</label>
            <div class="form-group">
               <input class="form-control" type="email" placeholder="Email" readonly value="{{ auth()->user()->email }}" >
            </div>
            <label class="form-label">Mobile</label>
            <div class="form-group">
               <input class="form-control" type="text" placeholder="Mobile"  name="mobile" value="{{ auth()->user()->mobile }}" >
            </div>
            <label class="form-label">Logo</label>
            <div class="form-group">
               <input type="file" class="custom-file-input" id="customFile" name="logo">
            </div>
            
            <label class="form-label">Current password</label>
            <div class="form-group">
               <input class="form-control" type="password" placeholder="Current password" name="current_password"  >
            </div>
            <label class="form-label">New password</label>
            <div class="form-group">
               <input class="form-control" type="password" placeholder="New password" name="new_password"  >
            </div>
            <label class="form-label">Confirm new password</label>
            <div class="form-group">
               <input class="form-control" type="password" placeholder="Confirm password" name="new_confirm_password" >
            </div>
            <h5 class="mt-5">Password suggestion</h5>
            <p class="text-muted mb-2">
               Please follow this guide for a strong password:
            </p>
            <ul class="text-muted ps-4 mb-0 float-start">
               <li>
                  <span class="text-sm">One special characters</span>
               </li>
               <li>
                  <span class="text-sm">Min 8 characters</span>
               </li>
               <li>
                  <span class="text-sm">One number (2 are recommended)</span>
               </li>
               <li>
                  <span class="text-sm">Change it often</span>
               </li>
            </ul>
            <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0" type="submit">Update password</button>
         </form>
      </div>
   </div>
</div>
@endsection