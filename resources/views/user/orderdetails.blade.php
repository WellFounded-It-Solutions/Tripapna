@extends('user.layouts.app_layout')

@section('content')
@include('user.comp.customer_dashboard')

<div class="page-title-area" *ngFor="let Content of pageTitle;" style="background-image: url('assets/img/TripApna/image-header.jpg');">
    <div class="container">
        <h1>Order Detail</h1>
    </div>
</div>

<div class="cart-area ptb-100">
    <div class="container">
        <!-- <form> -->
        <div class="cart-table table-responsive">
            <table class="table table-bordered p-10">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Name</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records->packageDetails as $packageDetails)
                    <tr>

                        <td class="product-thumbnail">
                            <a class="proImage">
                                <img src={{$packageDetails->package_log->image}} alt="product" height="120" width="120" >
                            </a>

                        </td>
                        <td class="product-name">
                            <a>{{strlen($packageDetails->package_log->description) > 50 ? substr($packageDetails->package_log->description, 0, 50)."..." : $packageDetails->package_log->description}}</a>

                        </td>
                        <td class="product-price">
                            <span class="unit-amount"><i class="fa fa-rupee"></i>{{$packageDetails->package_log->amount}}</span>
                        </td>
                        <td class="product-quantity">
                            <div class="input-counter">
                                <input type="number" value="1" disabled aria-disabled="">
                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span class="subtotal-amount"><i class="fa fa-rupee"></i>{{$packageDetails->package_log->amount}}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
