@extends('layouts.admin_design')
@section('title','Coupon Categories')
@section('content')

@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="text-black p-2">
            <h4 class="mb-0">Add New Package</h4>
        </div>
        <div class="card-body">
            <form class="form-horizontal ajax_form" action="{{ route(Auth::user()->roles[0]->params.'_single_package_store') }}" method="post" id="user">
                {{ csrf_field() }}
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hotel</label>
                            <select class="form-control" name="hotel_id">
                                <option value="">Select</option>
                                @foreach($hotelRecord as $val)
                                    <option value="{{ $val->id }}">{{ ucfirst($val->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" onchange="getCoupon(this)">
                                <option value="">Select</option>
                                @foreach($Categories as $val)
                                    <option value="{{ $val->id }}">{{ ucfirst($val->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Coupons</label>
                            <select class="form-control select4 coupon_html" multiple name="coupon[]" onchange="updateCouponQuantities(this)">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Limit</label>
                            <input type="number" class="form-control" name="limit" placeholder="Limit">
                        </div>
                    </div>
                    <div class="col-md-6" id="quantity">
                        <div class="form-group">
                            <label>Coupon Quantities</label>
                            <div id="couponQuantities" class="d-flex flex-wrap"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" placeholder="Amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Discount (%)</label>
                            <input type="text" class="form-control" name="discount" placeholder="Discount in %">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Expire Type</label>
                            <div class="d-flex align-items-center">
                                <input type="radio" name="expire_type" value="Fixed" checked onchange="checkDate(this)"> Date  
                                <input type="radio" name="expire_type" value="variable" onchange="checkDate(this)"> Non-date
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row expire_type">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Valid Date</label>
                            <input type="date" class="form-control" name="valid_date">
                        </div>
                    </div>
                </div>

                <div class="row d-none variable_month">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Duration</label>
                            <select class="form-control" name="variable_month">
                                <option value="">Select</option>
                                <option value="3">3 Months</option>
                                <option value="6">6 Months</option>
                                <option value="9">9 Months</option>
                                <option value="12">12 Months</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Terms and Conditions</label>
                    <textarea rows="4" class="form-control summernote" name="term_conditions" placeholder="Terms and Conditions"></textarea>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="4" class="form-control summernote" name="description" placeholder="Description"></textarea>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getCoupon($this) {
        var id = $($this).val();
        $.ajax({
            url: baseUrl + "single-package/getCoupon/" + id,
            type: 'get',
            dataType: 'json',
            success: function(json) {
                if (json.success) {
                    $('.coupon_html').append(json.html);
                } else {
                    Swal.fire('Warning!', json.message, 'error');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function updateCouponQuantities(select) {
        var selectedCoupons = $(select).val(); 
        var quantityContainer = $("#couponQuantities");
        quantityContainer.html("");
        if (selectedCoupons.length > 0) {
            selectedCoupons.forEach(function (couponId) {
                var couponTitle = $(select).find("option[value='" + couponId + "']").text(); 
                var inputHtml = `
                    <div class="form-group mr-4">
                        <label>${couponTitle}</label>
                        <input type="number" class="form-control" name="quantity[${couponId}]" placeholder="Enter quantity">
                    </div>
                `;
                quantityContainer.append(inputHtml);
            });
        }
    }

    function checkDate($this) {
        if ($($this).val() == "Fixed") {
            $('.expire_type').removeClass('d-none');
            $('.variable_month').addClass('d-none');
        } else {
            $('.expire_type').addClass('d-none');
            $('.variable_month').removeClass('d-none');
        }
    }

    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endif
@endsection