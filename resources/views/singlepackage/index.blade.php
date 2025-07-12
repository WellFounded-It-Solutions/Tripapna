@extends('layouts.admin_design')
@section('title','Coupon categories')
@section('content')
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
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
                <div class="col-12">
                    <div class="clearfix mb-5">
                        @if(auth()->check() && auth()->user()->can('add-single-package'))
                        <button type="button" class="btn btn-primary float-right" data-target="#addFromPopup" onclick="window.location.href='{{ route('administrator_single_package_new') }}'"><i class="fas fa-plus"></i> Add</button>
                        @endif
                    </div>
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" class="form-control" placeholder="Search by title" id="title">
                            </div>
                            <div class="col-3"></div>
                            <div class="col-3"></div>
                            <div class="col-3">
                                <button type="button" class="btn btn-info" onclick="getList()">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 600px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Limit</th>
                                        <th>Amount</th>
                                        <th>Valid Date</th>
                                        <th>Sales Commission %</th>
                                        <th>Manager Commission %</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="customtable"></tbody>
                            </table>
                        </div>
                        <div class="pagnation"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal ajax_form" action="{{ route(Auth::user()->roles['0']->params.'_single_package_update') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="utitle" placeholder="Title" name="title" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel</label>
                            <div class="col-sm-9">
                                <select class="form-control" data-placeholder="Select a Category" name="hotel_id" id="uhotel_id">
                                    <option value="">Select</option>
                                    @foreach($hotelRecord as $val)
                                        <option value="{{ $val->id }}">{{ ucfirst($val->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" data-placeholder="Select a Category" name="category_id" id="ucategory_id" onchange="getCoupon(this)">
                                    <option value="">Select</option>
                                    @foreach($Categories as $val)
                                        <option value="{{ $val->id }}">{{ ucfirst($val->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon</label>
                            <div class="col-sm-9">
                                <select class="select3 coupon_html" multiple data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="coupon[]" id="ucoupon_id">
                                    <option value=""></option>
                                    @foreach($couponRecord as $val)
                                        <option value="{{ $val->id }}">{{ ucfirst($val->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Coupon Quantities</label>
                            <div class="col-sm-9">
                                <div id="couponQuantities" class="d-flex flex-wrap"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Limit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="ulimit" placeholder="Limit" name="limit" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Terms and Conditions</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control summernote" placeholder="Terms and Conditions" cols="70" name="term_conditions" id="utnc"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uamount" placeholder="Amount" name="amount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="udiscount" placeholder="Discount in %" name="discount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sales Commission</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="usales_commission" placeholder="Sales Commission" name="sales_commission" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Manager Commission</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="umanager_commission" placeholder="Manager Commission" name="manager_commission" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input type="radio" class="btn-check" name="expireowna_type" id="option1" autocomplete="off" onchange="checkDate(this)" value="Fixed" checked>
                                <label class="btn btn-secondary" for="option1">Date</label>
                                <input type="radio" class="btn-check" name="expire_type" id="option2" autocomplete="off" value="variable" onchange="checkDate(this)">
                                <label class="btn btn-secondary" for="option2">Non date</label>
                            </div>
                        </div>
                        <div class="form-group row expire_type">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Valid Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="uvalid_date" placeholder="Valid Date" name="valid_date" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row d-none variable_month">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Select</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="variable_month">
                                    <option value="">Select</option>
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="9">9 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control summernote" placeholder="Description" cols="70" name="description" id="udescription"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="_id" />
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-info rounded-0">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Clone Modal -->
<div class="modal fade" id="cloneFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal ajax_form" action="{{ route(Auth::user()->roles['0']->params.'_single_package_clone') }}" method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cutitle" placeholder="Title" name="title" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel</label>
                            <div class="col-sm-9">
                                <select class="form-control" data-placeholder="Select a Category" name="hotel_id" id="cuhotel_id">
                                    <option value="">Select</option>
                                    @foreach($hotelRecord as $val)
                                        <option value="{{ $val->id }}">{{ ucfirst($val->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" data-placeholder="Select a Category" name="category_id" id="cucategory_id" onchange="getCoupon(this)">
                                    <option value="">Select</option>
                                    @foreach($Categories as $val)
                                        <option value="{{ $val->id }}">{{ ucfirst($val->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon</label>
                            <div class="col-sm-9">
                                <select class="select5 coupon_html" multiple data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="coupon[]" id="cucoupon">
                                    <option value=""></option>
                                    @foreach($couponRecord as $val)
                                        <option value="{{ $val->id }}">{{ ucfirst($val->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Coupon Quantities</label>
                            <div class="col-sm-9">
                                <div id="couponQuantitiesClone" class="d-flex flex-wrap"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Limit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="culimit" placeholder="Limit" name="limit" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Terms and Conditions</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control summernote" placeholder="Terms and Conditions" cols="70" name="term_conditions" id="cutnc"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cuamount" placeholder="Amount" name="amount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cudiscount" placeholder="Discount in %" name="discount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sales Commission</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="cusales_commission" placeholder="Sales Commission" name="sales_commission" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Manager Commission</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="cumanager_commission" placeholder="Manager Commission" name="manager_commission" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input type="radio" class="btn-check" name="expire_type" id="coption1" autocomplete="off" onchange="checkDate(this)" value="Fixed" checked>
                                <label class="btn btn-secondary" for="coption1">Date</label>
                                <input type="radio" class="btn-check" name="expire_type" id="coption2" autocomplete="off" value="variable" onchange="checkDate(this)">
                                <label class="btn btn-secondary" for="coption2">Non date</label>
                            </div>
                        </div>
                        <div class="form-group row expire_type">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Valid Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="cuvalid_date" placeholder="Valid Date" name="valid_date" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row d-none variable_month">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Select</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="variable_month">
                                    <option value="">Select</option>
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="9">9 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control summernote" placeholder="Description" cols="70" name="description" id="cudescription"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFileClone" name="image">
                                        <label class="custom-file-label" for="customFileClone">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-info rounded-0">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body htmlcontent"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function addCallBack() {
        setTimeout(function() {
            $('#addFromPopup').modal('hide');
        }, 3000);
        getList();
    }

    function updatedCallback() {
        setTimeout(function() {
            $('#editFromPopup').modal('hide');
        }, 1000);
        getList();
    }

    $(document).ready(function() {
        getList();
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_date(page);
        });
    });

    function getList() {
        var name = $('#title').val();
        $.ajax({
            url: baseUrl + "single-packagelist?title=" + name,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('.lodding').css('display', 'block');
            },
            complete: function() {
                $('.lodding').css('display', 'none');
            },
            success: function(json) {
                $('.customtable').html(json.html);
                $('.pagnation').html(json.pagination);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function fetch_date(page) {
        var title = $('#title').val();
        $.ajax({
            url: baseUrl + "single-packagelist?title=" + title + '&page=' + page,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('.lodding').css('display', 'block');
            },
            complete: function() {
                $('.lodding').css('display', 'none');
            },
            success: function(json) {
                $('.customtable').html(json.html);
                $('.pagnation').html(json.pagination);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function deleteRecord(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.get(baseUrl + "single-package/delete/" + id, function(data, status) {
                    if ( Plaintext )
                    if (data.success) {
                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        );
                        getList();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.message,
                            'error'
                        );
                    }
                });
            }
        });
    }

    function editRecord(id) {
        $.ajax({
            url: baseUrl + "single-package/get_record_by_id/" + id,
            type: 'get',
            dataType: 'json',
            success: function(json) {
                if (json.success) {
                    $('#utitle').val(json.data.title);
                    $('#ulimit').val(json.data.limit);
                    $('#uamount').val(json.data.amount);
                    $('#udescription').summernote('code', json.data.description);
                    $('#utnc').summernote('code', json.data.term_conditions);
                    $('#uvalid_date').val(json.data.valid_date);
                    $('#udiscount').val(json.data.discount);
                    $('#usales_commission').val(json.data.sales_commission);
                    $('#umanager_commission').val(json.data.manager_commission);
                    $('#uhotel_id').val(json.items['0'].hotel_id);
                    $('#ucategory_id').val(json.items['0'].category_id);
                    var Values = [];
                    json.items.forEach((item) => {
                        Values.push(item.coupon_id);
                    });
                    $("#ucoupon_id").val(Values).trigger('change');
                    updateCouponQuantities($('#ucoupon_id'));
                    $('#_id').val(json.data.id);
                    $('#editFromPopup').modal('show');
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
        var quantityContainer = $(select).closest('.form-group').siblings().find('#couponQuantities, #couponQuantitiesClone');
        quantityContainer.html("");
        if (selectedCoupons && selectedCoupons.length > 0) {
            selectedCoupons.forEach(function(couponId) {
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

    function cloneRecord(id) {
        $.ajax({
            url: baseUrl + "single-package/clone/" + id,
            type: 'get',
            dataType: 'json',
            success: function(json) {
                if (json.success) {
                    $('#cutitle').val(json.data.title);
                    $('#culimit').val(json.data.limit);
                    $('#cuamount').val(json.data.amount);
                    $('#cudescription').summernote('code', json.data.description);
                    $('#cutnc').summernote('code', json.data.term_conditions);
                    $('#cuvalid_date').val(json.data.valid_date);
                    $('#cudiscount').val(json.data.discount);
                    $('#cusales_commission').val(json.data.sales_commission);
                    $('#cumanager_commission').val(json.data.manager_commission);
                    $('#cuhotel_id').val(json.items['0'].hotel_id);
                    $('#cucategory_id').val(json.items['0'].category_id);
                    var Values = [];
                    json.items.forEach((item) => {
                        Values.push(item.coupon_id);
                    });
                    $("#cucoupon").val(Values).trigger('change');
                    updateCouponQuantities($('#cucoupon'));
                    $('#cloneFromPopup').modal('show');
                } else {
                    Swal.fire('Warning!', json.message, 'error');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function viewRecord(id) {
        $.ajax({
            url: baseUrl + "single-package/details/" + id,
            type: 'get',
            dataType: 'json',
            success: function(json) {
                if (json.success) {
                    $('#viewFromPopup').modal('show');
                    $('.htmlcontent').html(json.html);
                } else {
                    Swal.fire('Warning!', json.message, 'error');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function getCoupon($this) {
        var id = $($this).val();
        $.ajax({
            url: baseUrl + "single-package/getCoupon/" + id,
            type: 'get',
            dataType: 'json',
            success: function(json) {
                if (json.success) {
                    $('.coupon_html').html(json.html);
                } else {
                    Swal.fire('Warning!', json.message, 'error');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function changeSatus(id, status) {
        $.ajax({
            url: baseUrl + "single-package/change_status/" + id + "/" + status,
            type: 'get',
            dataType: 'json',
            success: function(json) {
                if (json.success) {
                    getList();
                } else {
                    Swal.fire('Warning!', json.message, 'error');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function getPermission($this) {
        $('#permission').modal('show');
    }

    $(document).ajaxComplete(function() {
        $("[data-toggle='tooltip']").tooltip();
    });

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