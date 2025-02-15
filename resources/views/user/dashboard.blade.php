@extends('user.layouts.app_layout')

@section('content')
@include('user.comp.customer_dashboard')
<div class="page-title-area" *ngFor="let Content of pageTitle;" style="background-image: url();">
    <div class="container">
        <h1>My Dashboard</h1>
    </div>
</div>

<div class="dashboard-area ptb-100">
    <div class="container">
        <div class="dashboard-tabs-list">
            <ul>
                <li><a href="/dashboard" class="active">Dashboard</a></li>
                <li><a href="/profile">Profile</a></li>
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
                    <!-- <p>You have <strong>$19,321</strong> dollars left, <a href="/">earn mores</a></p> -->
                    <a href="/" class="logout">Log Out</a>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="dashboard-stats">
                    <p>Hi <strong>{{auth()->guard('customer')->user()->name}}</strong> here's quick overview of your stats.</p>
                    <ul class="stats">
                        <!-- <li>
                            <div class="icon">
                                <i class='bx bx-bar-chart-alt-2'></i>
                            </div>
                            Sales: <span class="badge bg-primary">540</span>
                        </li> -->
                        <li>
                            <div class="icon">
                                <i class='bx bx-purchase-tag'></i>
                            </div>
                            Coupons: <span class="badge bg-primary">{{auth()->guard('customer')->user()->coupon}}</span>
                        </li>
                        <li>
                            <div class="icon">
                                <i class='bx bxs-hand-right'></i>
                            </div>
                            Packages: <span class="badge bg-primary">{{auth()->guard('customer')->user()->total_pakage}}</span>
                        </li>
                        <!-- <li>
                            <div class="icon">
                                <i class='bx bx-dollar-circle'></i>
                            </div>
                            Earnings Due: <span class="badge bg-primary">$54,541</span>
                        </li> -->
                        <li>
                            <div class="icon">
                                <i class='bx bx-dollar'></i>
                            </div>
                            Purchase: <span class="badge bg-primary"><i class="fa fa-rupee"></i>{{auth()->guard('customer')->user()->amount ||0}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
