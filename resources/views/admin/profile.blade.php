@extends('layouts.admin_design')
@section('title','User')
@section('content')
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager') ||auth()->user()->hasRole('agent'))
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>{{ $page_name }}</h1>
            </div>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">

               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">{{ $page_name }}</h3>
                  </div>
				<form class="ajax_form form-horizontal" id="loginform" action="{{ route(Auth::user()->roles['0']->params.'_profile_update') }}" method="post" Autocomplete="off">
                {{csrf_field()}}
                     <div class="card-body">
                        <div class="form-group row">
                           <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                           <div class="col-sm-10">
                              <input class="form-control" type="text" placeholder="Name" name="name" value="{{ auth()->user()->name }}">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                           <div class="col-sm-10">
                               <input class="form-control" type="email" placeholder="Email" readonly value="{{ auth()->user()->email }}" >
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile</label>
                           <div class="col-sm-10">
                              <input class="form-control" type="text" placeholder="Mobile"  name="mobile" value="{{ auth()->user()->mobile }}" >
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="inputPassword3" class="col-sm-2 col-form-label">Current Password</label>
                           <div class="col-sm-10">
                                 <input class="form-control" type="password" placeholder="Current password" name="current_password"  >
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                           <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="New password" name="new_password"  >
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                           <div class="col-sm-10">
                                   <input class="form-control" type="password" placeholder="Confirm password" name="new_confirm_password" >
                           </div>
                        </div>
                     </div>
                     <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endif

@endsection