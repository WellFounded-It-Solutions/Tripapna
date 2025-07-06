@extends('user.layouts.app_layout')

@section('content')
    <style>
        .noCart {
            height: 600px;
            width: 600px;
            margin: auto;
        }

        .noCart .img {
            height: 100%;
            width: 100%;
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
                            font-size: 16px;
                            font-weight: 700;
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
                            font-weight: 600;
                            font-size: var(--fontSize);
                            border-left: none;
                            border-right: none;
                            border-color: #dee0f1;

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

                                    input::-webkit-outer-spin-button,
                                    input::-webkit-inner-spin-button {
                                        -webkit-appearance: none;
                                        margin: 0;
                                    }

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
                                        font-size: 17px;
                                        font-weight: 600;

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
                    font-weight: 600;
                    font-size: var(--fontSize);

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
            margin-top: 60px;
            margin-left: auto;
            margin-right: auto;

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
                    font-weight: 600;
                    font-size: 13.5px;

                    &:first-child {
                        border-bottom: none;
                    }

                    &:last-child {
                        font-size: 17px;
                        border-top: none;

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
                                padding-left: 15px;
                                padding-right: 15px;

                                &:first-child {
                                    padding-left: 0;
                                }

                                &:last-child {
                                    padding-right: 60px;
                                }
                            }
                        }

                        tbody {
                            tr {
                                td {
                                    font-size: 13px;
                                    padding-left: 15px;
                                    padding-right: 15px;

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
    </style>

    <div class="page-title-area" style="background-image: url(assets/img/TripApna/image-header.jpg);">
        <div class="container">
            <h1>Cart</h1>
        </div>
    </div>

    <div class="cart-area ptb-100">
        <div class="container">
            @if(count($data) > 0)
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
                            @foreach($data as $item)
                                <tr id="row_{{$item->id}}">
                                    <td class="product-thumbnail">
                                        <input type="hidden" class="productId" value="{{$item->id}}" />
                                        @if($item->coupon)
                                            <a class="proImage">
                                                <img src="{{ $item->coupon->image }}" alt="item">
                                            </a>
                                        @elseif($item->package)
                                            <a class="proImage">
                                                <img src="{{ $item->package->image }}" alt="item">
                                            </a>
                                        @endif
                                    </td>
                                    <td class="product-name">
                                        @if($item->coupon)
                                            <a>{!! Str::limit(strip_tags($item->coupon->description), 50) !!}</a>
                                        @elseif($item->package)
                                            <a>{!! Str::limit(strip_tags($item->package->description), 50) !!}</a>
                                        @endif
                                    </td>
                                    <td class="product-price">
                                        <span class="unit-amount"><i class="fa fa-rupee"></i>{{ $item->amount }}</span>
                                    </td>
                                    <td class="product-quantity">
                                        <div class="input-counter">
                                            <button onclick="minus(this, {{ $item->id }}, {{ $item->amount }})" type="button" style="border: none"><i class='bx bx-minus'></i></button>
                                            <input id="qty_{{ $item->id }}" type="number" value="{{ $item->qty }}" disabled>
                                            <button onclick="plus(this, {{ $item->id }}, {{ $item->amount }})" type="button" style="border: none"><i class='bx bx-plus'></i></button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="subtotal-amount"><i class="fa fa-rupee"></i><span id="total_{{ $item->id }}">{{ $item->amount * $item->qty }}</span></span>
                                        <a href="{{ route('removeCart', $item->id) }}" class="remove"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-buttons">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-sm-7 col-md-7">
                            <div class="shopping-coupon-code">
                                <form id="coupon-form" method="POST" action="{{ route('applyCoupon') }}">
                                    @csrf
                                    <input type="text" class="form-control" placeholder="Coupon code" name="coupon_code" id="coupon-code" value="">
                                    <button type="submit">Apply Coupon</button>
                                </form>
                                <div id="coupon-message" class="mt-2"></div>
                                <div class="pay-option">
                                    <input type="radio" id="pay_with_phonepay" name="pay-option" value="phone_pay">
                                    <label for="pay_with_phonepay">Pay with PhonePay</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-5 col-md-5 text-end">
                            <p>
                                <input type="checkbox" id="accept_terms" name="accept_terms" value="accept_terms">
                                <label for="accept_terms">I agree with terms and conditions</label>
                            </p>
                            <a onclick="orderPlace()" class="btn btn-primary" role="button">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>

                <div class="cart-totals">
                    <h3>Cart Totals</h3>
                    <ul>
                        <li>Subtotal <span><i class="fa fa-rupee"></i><span id="cart-subtotal">{{ collect($data)->sum(fn($item) => $item->amount * $item->qty) }}</span></span></li>
                        <li>Discount ({{ session('applied_promo_code.discount_percentage', 0) }}%) <span><i class="fa fa-rupee"></i><span id="cart-discount">{{ collect($data)->sum(fn($item) => $item->amount * $item->qty) * (session('applied_promo_code.discount_percentage', 0) / 100) }}</span></span></li>
                        <li>Total <span><i class="fa fa-rupee"></i><span id="cart-total">{{ collect($data)->sum(fn($item) => $item->amount * $item->qty) * (1 - session('applied_promo_code.discount_percentage', 0) / 100) }}</span></span></li>
                    </ul>
                </div>
            @else
                <div class="text-center noCart">
                    <img src="{{ asset('user/img/no-cart.png') }}" alt="No items in cart" class="img">
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#coupon-form').on('submit', function(event) {
                event.preventDefault();
                const couponCode = $('#coupon-code').val().trim();
                const messageDiv = $('#coupon-message');

                if (!couponCode) {
                    messageDiv.html('<div class="alert alert-danger">Please enter a promo code.</div>');
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ route('applyCoupon') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "coupon_code": couponCode
                    },
                    success: function(response) {
                        if (response.success) {
                            messageDiv.html(`<div class="alert alert-success">${response.message}</div>`);
                            $('#cart-subtotal').text(response.subtotal);
                            $('#cart-discount').text(response.discount);
                            $('#cart-total').text(response.total);
                        } else {
                            messageDiv.html(`<div class="alert alert-danger">${response.message}</div>`);
                        }
                    },
                    error: function(xhr) {
                        messageDiv.html('<div class="alert alert-danger">Error applying coupon. Please try again.</div>');
                    }
                });
            });
        });

        function orderPlace() {
            if (!document.getElementById("accept_terms").checked) {
                alert("Please accept terms and conditions");
                return;
            }

            let payment_method = "";
            if (document.getElementById("pay_with_phonepay").checked) {
                payment_method = "phone_pay";
            } else {
                alert("Please select payment method");
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('orderPlace') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "payment_method": payment_method
                },
                success: function(response) {
                    if (response.success) {
                        alert("Your order is being created. You will be redirected soon.");
                        window.location.href = "{{ route('myOrder') }}";
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error placing order: " + xhr.responseText);
                }
            });
        }

        function plus(e, id, amount) {
            var input = e.previousElementSibling;
            input.value = Number(input.value) + 1;
            updateCart(id);
            updateTotals();
        }

        function minus(e, id, amount) {
            var input = e.nextElementSibling;
            if (input.value > 1) {
                input.value = Number(input.value) - 1;
                updateCart(id);
                updateTotals();
            }
        }

        function updateCart(id) {
            var qty = document.getElementById("qty_" + id).value;
            $.ajax({
                type: "POST",
                url: "{{ route('updateCart') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "qty": qty
                },
                success: function(response) {
                    if (response.status == 200) {
                        var total = document.getElementById("total_" + id);
                        total.innerText = Number(response.data.amount) * Number(response.data.qty);
                        updateTotals();
                    }
                }
            });
        }

        function updateTotals() {
            const totals = Array.from(document.querySelectorAll('.subtotal-amount span[id^="total_"]'))
                .reduce((sum, el) => sum + Number(el.innerText), 0);
            const discountPercentage = {{ session('applied_promo_code.discount_percentage', 0) }};
            const discount = totals * (discountPercentage / 100);
            document.getElementById('cart-subtotal').innerText = totals;
            document.getElementById('cart-discount').innerText = discount;
            document.getElementById('cart-total').innerText = totals - discount;
        }
    </script>
@endsection