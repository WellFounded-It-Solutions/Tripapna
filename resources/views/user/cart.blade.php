@extends('user.layouts.app_layout')

@section('content')
<style>
    .noCart {
        height: 600px;
        width: 600px;
        margin: auto;

        .img {
            height: 100%;
            width: 100%;
        }
    }

    .cart-table {
        table {
            margin-bottom: 0;

            thead {
                tr {
                    border-top: none;

                    th {
                        border: none;
                        padding: 15px;
                        white-space: nowrap;
                        vertical-align: middle;
                        border-bottom-width: 0px;
                        text-transform: uppercase;

                        font: {
                            size: 16px;
                            weight: 700;
                        }

                        ;
                    }
                }
            }

            tbody {
                tr {
                    border-top: none;

                    td {
                        white-space: nowrap;
                        vertical-align: middle;
                        color: var(--optionalColor);
                        padding: 15px;

                        font: {
                            weight: 600;
                            size: var(--fontSize);
                        }

                        ;

                        border: {
                            left: none;
                            right: none;
                            color: #dee0f1;
                        }

                        ;

                        &.product-thumbnail {
                            width: 80px;
                            height: 80px;

                            a {
                                display: block;

                                img {
                                    width: 100%;
                                    height: 100%;
                                }
                            }
                        }

                        &.product-name {
                            a {
                                display: inline-block;
                            }
                        }

                        &.product-subtotal {
                            overflow: hidden;

                            .remove {
                                float: right;
                                color: red;
                                line-height: 1;
                                font-size: 18px;
                                margin-left: 50px;
                            }
                        }

                        &.product-quantity {
                            .input-counter {
                                max-width: 130px;
                                min-width: 130px;
                                text-align: center;
                                position: relative;
                                display: flex;

                                /* Chrome, Safari, Edge, Opera */
                                input::-webkit-outer-spin-button,
                                input::-webkit-inner-spin-button {
                                    -webkit-appearance: none;
                                    margin: 0;
                                }

                                /* Firefox */
                                input[type=number] {
                                    -moz-appearance: textfield;
                                }

                                input {
                                    outline: 0;
                                    width: 100%;
                                    border: none;
                                    height: 45px;
                                    display: block;
                                    text-align: center;
                                    color: var(--blackColor);
                                    background-color: #f8f8f8;

                                    font: {
                                        size: 17px;
                                        weight: 600;
                                    }

                                    &::placeholder {
                                        color: var(--blackColor);
                                    }

                                    &::-webkit-inner-spin-button {
                                        opacity: 1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    .cart-buttons {
        margin-top: 30px;

        .shopping-coupon-code {
            position: relative;
            max-width: 530px;

            .form-control {
                height: 50px;
            }

            button {
                right: 0;
                top: 0;
                height: 50px;
                border: none;
                outline: 0;
                position: absolute;
                padding: 0 25px 3px;
                transition: var(--transition);
                background: var(--blackColor);
                color: var(--whiteColor);

                font: {
                    weight: 600;
                    size: var(--fontSize);
                }

                ;

                &:hover {
                    background-color: var(--mainColor);
                }
            }
        }

        .pay-option {
            font-size: 16px;
            font-weight: 700;
            margin-top: 3rem;
        }
    }

    .cart-totals {
        padding: 40px;
        max-width: 500px;
        border-radius: 5px;
        background: var(--whiteColor);

        margin: {
            top: 60px;
            left: auto;
            right: auto;
        }

        ;

        h3 {
            font-size: 20px;
            margin-bottom: 25px;
        }

        ul {
            padding-left: 0;
            margin: 0 0 25px;
            list-style-type: none;

            li {
                overflow: hidden;
                padding: 10px 15px;
                color: var(--blackColor);
                border: 1px solid #eaedff;

                font: {
                    weight: 600;
                    size: 13.5px;
                }

                ;

                &:first-child {
                    border: {
                        bottom: none;
                    }
                }

                &:last-child {
                    font-size: 17px;

                    border: {
                        top: none;
                    }

                    ;

                    span {
                        font-weight: 700;
                        color: var(--blackColor);
                    }
                }

                span {
                    float: right;
                    font-weight: normal;
                    color: var(--optionalColor);
                }
            }
        }
    }




    /* Max width 767px */
    @media only screen and (max-width: 767px) {

        .cart-table {
            table {
                thead {
                    tr {
                        th {
                            font-size: 14px;

                            padding: {
                                left: 15px;
                                right: 15px;
                            }

                            ;

                            &:first-child {
                                padding-left: 0;
                            }

                            &:last-child {
                                padding-right: 60px;
                            }
                        }
                    }
                }

                tbody {
                    tr {
                        td {
                            font-size: 13px;

                            padding: {
                                left: 15px;
                                right: 15px;
                            }

                            ;

                            &:first-child {
                                padding-left: 0;
                            }

                            &.product-subtotal {
                                .remove {
                                    margin-left: 0;
                                }

                                i.bx.bx-trash {
                                    cursor: pointer;
                                }

                            }
                        }
                    }
                }
            }
        }

        .cart-buttons {
            .shopping-coupon-code {
                text-align: center;

                button {
                    position: relative;
                    right: 0;
                    top: 0;
                    height: auto;
                    padding: 12px 25px;
                    line-height: initial;
                    font-size: 13px;
                    margin-top: 15px;
                }
            }

            .text-end {
                text-align: center !important;
                margin-top: 20px;
            }
        }

        .cart-totals {
            padding: 25px 20px;
            max-width: 100%;
            margin-top: 40px;

            h3 {
                font-size: 15px;
            }

            ul {
                margin-bottom: 20px;

                li {
                    font-size: 13px;

                    &:last-child {
                        font-size: 15px;
                    }
                }
            }
        }

    }

    /* Min width 576px to Max width 767px */
    @media only screen and (min-width: 576px) and (max-width: 767px) {}

    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {}

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {}

    /* Min width 1200px to Max width 1355px */
    @media only screen and (min-width: 1200px) and (max-width: 1355px) {}

    /* Min width 1550px */
    @media only screen and (min-width: 1550px) {}
</style>

<div class="page-title-area" *ngFor="let Content of pageTitle;" style="background-image: url(assets/img/TripApna/image-header.jpg);">
    <div class="container">
        <h1>Cart</h1>
    </div>
</div>

<div class="cart-area ptb-100">
    <div class="container">
        <!-- <form> -->
        @if(count($data)>0)
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

                    @for($i=0; $i < count($data); $i++)
                        <tr>
                        <td class="product-thumbnail">
                            <input type="hidden" class="productId" value="{{$data[$i]->id}}" />
                            @if($data[$i]->coupons)
                            <a class="proImage">
                                <img src={{$data[$i]->coupon->image}} alt="item">
                            </a>
                            @endif
                            @if($data[$i]->package())
                            <a class="proImage">
                                <img src={{$data[$i]->package->image}} alt="item">
                            </a>
                            @endif
                        </td>
                        <td class="product-name">
                            @if($data[$i]->coupon)
                            <a>{{substr($data[$i]->coupons->description,0,50)}}</a>
                            @endif
                            @if($data[$i]->package)
                            <a>{{substr($data[$i]->package->description,0,50)}}</a>
                            @endif
                        </td>
                        <td class="product-price">
                            <span class="unit-amount"><i class="fa fa-rupee"></i>{{$data[$i]->amount}}</span>
                        </td>
                        <td class="product-quantity">

                            <div class="input-counter">
                                <button onclick="minus(this)" type="button" style="border: none"><i class='bx bx-minus'></i></button>
                                <input type="number" value="{{$data[$i]->qty}}" disabled aria-disabled="">
                                <button onclick="plus(this)" type="button" style="border: none"><i class='bx bx-plus'></i></button>
                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span class="subtotal-amount"><i class="fa fa-rupee"></i>{{$data[$i]->amount}}</span>
                            <a href="{{'removeCart/'.$data[$i]->id}}" class="remove"><i class='bx bx-trash'></i></a>
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
        @endif
        @if(count($data) == 0)
        <div class="text-center noCart">
            <img src='{{ "assets/img/no-cart.png" }}' alt="" class="img">
        </div>
        @endif
        <div class="cart-buttons" *ngIf="cartDetails->length">
            <div class="row align-items-center">
                <div class="col-lg-7 col-sm-7 col-md-7">
                    <div class="shopping-coupon-code">
                        <input type="text" class="form-control" placeholder="Coupon code" name="coupon-code"
                            id="coupon-code">
                        <button type="submit">Apply Coupon</button>
                    </div>
                    <div class="pay-option">
                        <input type="radio" id="cash_on_delivery" name="cash_on_delivery" value="cash_on_delivery" checked>
                        <label for="cash_on_delivery">Cash on delivery</label>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-5 col-md-5 text-end">
                    <p>
                        <input type="checkbox" id="accept_terms" name="accept_terms" value="accept_terms">
                        <label for="accept_terms">I agree with terms and conditions</label>
                    </p>
                    <a onclick="orderPlace()" class="default-btn">Proceed to Checkout</a>
                </div>
            </div>
        </div>

        <!-- <div class="cart-totals" *ngIf="cartDetails->length">
                <h3>Cart Totals</h3>
                <ul>
                    <li>Subtotal <span>$800.00</span></li>
                    <li>Shipping <span>$30.00</span></li>
                    <li>Total <span>$830.00</span></li>
                </ul>
                <a routerLink="/checkout" class="default-btn">Proceed to Checkout</a>
            </div> -->
        <!-- </form> -->
    </div>
</div>


<script>
    function orderPlace() {
        if (!document.getElementById("accept_terms").checked) {
            alert("Please accept terms and conditions");
        }
        $.ajax({
            type: "POST",
            url: "{{route('placeOrder')}}",
            data: $("#placeOrder").serialize(),
            success: function(response) {
                if (response.status == 200) {

                }
            }
        })
    }

    function plus(e) {
        var input = e.previousElementSibling;
        input.value = Number(input.value) + 1;
    }

    function minus(e) {
        var input = e.nextElementSibling;
        if (input.value > 1) {
            input.value = Number(input.value) - 1;
        }
    }
</script>

@endsection
