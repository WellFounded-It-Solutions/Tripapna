@extends('user.layouts.app_layout')

@section('content')
@include('user.comp.customer_dashboard')

<div class="page-title-area" *ngFor="let Content of pageTitle;" style="background-image: url();">
    <div class="container">
        <h1>My Profile</h1>
    </div>
</div>

<div class="dashboard-area ptb-100">
    <div class="container">
        <div class="dashboard-tabs-list">
            <ul>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/profile" class="active">Profile</a></li>
                <!-- <li><a href="/dashboard-store">Store</a></li> -->
                <li><a href="/packages">My Packages</a></li>
                <!-- <li><a href="/dashboard-deals">Deals</a></li> -->
                <li><a href="/vouchers">Vouchers</a></li>
                <!-- <li><a href="/dashboard-agents">Agents</a></li> -->
                <!-- <li><a href="/">Logout</a></li> -->
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="dashboard-profile-box">
                    <div class="image">
                        <div class="profileImageView">
                            <img src={{auth()->guard('customer')->user()->image ? asset("user/img/".auth()->guard('customer')->user()->image) : asset('user/img/user1.jpg')}} alt="userProfile" class="userProfile">
                        </div>
                        <span class="userName">{{auth()->guard('customer')->user()->name}}</span>
                    </div>
                    <div class="pb-3">
                        <input type="file" accept="image/*" hidden id="file" class="profilePic"
                            data-max-width="4046" onchange="onImageChanged(this , event)" />
                        <a onclick="imageUpload()" class="logout">Change Profile</a>
                    </div>
                    <!-- <p>You have <strong>$19,321</strong> dollars left, <a href="/">earn mores</a></p> -->
                    <a onclick="logout()" class="logout">Log Out</a>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="dashboard-stats">
                    <form action="{{route('customer.profile.update') }}" method="post">
                        @csrf()
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email <span>*</span></label>
                                    <input type="email" disabled class="form-control" value="{{auth()->guard('customer')->user()->email}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Username <span>*</span></label>
                                    <input name="name" type="text" formControlName="name" class="form-control" value="{{auth()->guard('customer')->user()->name}}" />
                                    @error('name')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input name="mobile" type="text" formControlName="mobile" class="form-control" value="{{auth()->guard('customer')->user()->mobile}}">
                                    @error('mobile')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Pin Code</label>
                                    <input name="pincode" type="text" formControlName="pincode" class="form-control" value="{{auth()->guard('customer')->user()->pincode}}">
                                    @error('pincode')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>DOB</label>
                                    <input name="dob" type="date" formControlName="dob" class="form-control" value="{{auth()->guard('customer')->user()->dob}}">
                                    @error('dob')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Anniversary Date</label>
                                    <input name="anniversary" type="date" formControlName="anniversary_date" class="form-control" value="{{auth()->guard('customer')->user()->anniversary}}">
                                    @error('anniversary')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" type="text" formControlName="address" class="form-control">{{auth()->guard('customer')->user()->address}}</textarea>
                                    @error('address')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 mt-5 mb-3">
                                <button type="submit" onclick="updateProfile()" class="default-btn">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-lg-4 col-md-12">

            </div>

            <div class="col-lg-8 col-md-12 d-none">
                <div class="dashboard-stats">
                    <form [formGroup]="profileFormWithPass" *ngIf="updateForm">
                        <div class="row">
                            <!-- <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <input type="file">
                                </div>
                            </div> -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" formControlName="current_password" class="form-control">
                                    @error('current_password')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" formControlName="new_password" class="form-control">
                                    @error('new_password')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" formControlName="new_confirm_password" class="form-control">
                                    @error('new_confirm_password')
                                    <small class="text-danger">* {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 mt-5 mb-3">
                                <button type="submit" onclick="updateProfileWithPass()" class="default-btn">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function imageUpload() {
        document.getElementById("file").click();
    }

    function onImageChanged(input, event) {

        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.userProfile').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }

        document.getElementById("file").value = null;

        var formData = new FormData();
        formData.append("image", file);
        formData.append("_token", "{{csrf_token()}}");

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $.ajax({
            type: "POST",
            url: "{{route('customer.image.upload')}}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
            }
        });
    }
</script>

@endsection
