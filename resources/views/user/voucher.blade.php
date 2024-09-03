@extends('user.layouts.app_layout')

@section('content')
@include('user.comp.customer_dashboard')

<div class="page-title-area" *ngFor="let Content of pageTitle;" style="background-image: url('assets/img/TripApna/image-header.jpg');">
    <div class="container">
        <h1>My Packages</h1>
    </div>
</div>

<div class="dashboard-area ptb-100">
    <div class="container">
        <div class="dashboard-tabs-list">
            <ul>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/profile">Profile</a></li>
                <!-- <li><a href="/dashboard-store">Store</a></li> -->
                <li><a href="/packages">My Packages</a></li>
                <!-- <li><a href="/dashboard-deals">Deals</a></li> -->
                <li><a href="/vouchers" class="active">Vouchers</a></li>
                <!-- <li><a href="/dashboard-agents">Agents</a></li> -->
                <!-- <li><a href="/">Logout</a></li> -->
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="dashboard-profile-box">
                    <div class="image">
                        <div class="profileImageView">
                            <img src={{auth()->guard('customer')->user()->image ? asset("user/img/".auth()->guard('customer')->user()->image) : `user/img/user1.jpg` }} alt="userProfile" class="userProfile">
                        </div>
                        <span class="userName">{{auth()->guard('customer')->user()->name}}</span>
                    </div>
                    <!-- <p>You have <strong>$19,321</strong> dollars left</p> -->
                    <a click="logout()" class="logout">Log Out</a>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="dashboard-stats">
                    <!-- <a href="/dashboard-add-coupon" class="default-btn">Add Coupon</a> -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order id</th>
                                    <th>Status</th>
                                    <th>Purchases</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $order)
                                <tr *ngFor="let order of myOrders">
                                    <td><a>{{$order->order_id}}</a></td>
                                    <td>Confirm</td>
                                    <td><i class="fa fa-rupee"></i>{{$order->amount}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>
                                        <a class="view" href="/voucherDetails/{{$order->id}}"><i class='bx bx-show'></i></a><br>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
