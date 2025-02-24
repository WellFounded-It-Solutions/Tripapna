@extends('layouts.admin_design') @section('title','Coupon categories') @section('content')
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class=" text-black">
                <h4 class="mb-0 py-2">Add New Package</h4>
            </div>
            <div class="card-body">
                <form class="form-horizontal ajax_form" action="{{ route(Auth::user()->roles['0']->params.'_multiple_package_store') }}" method="post" id="user">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>

                    <div id="dynamicAddRemove">
                        <div class="form-group">
                            <label>Hotel</label>
                            <select class="form-control select4 " multiple  name="hotel_id[]" >
                                <option value="">Select</option>
                                @foreach($hotelRecord as $val)
                                    <option value="{{ $val->id }}">{{ ucfirst($val->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control select4" name="category_id[]" onchange="getCoupon(this)" multiple>
                                <option value="">Select</option>
                                @foreach($Categories as $val)
                                    <option value="{{ $val->id }}">{{ ucfirst($val->title) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Coupons</label>
                            <select class="form-control coupon_html select4"  name="coupon[]" multiple onchange="updateCouponQuantities(this)">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6"  id = "quantity">
                        <div class="form-group ">
                            <label>Coupon Quantities</label>
                            <div id="couponQuantities" class="d-flex flex-wrap"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Limit</label>
                        <input type="number" class="form-control" name="limit" placeholder="Limit">
                    </div>

                    <div class="form-group">
                        <label>Terms and Conditions</label>
                        <textarea rows="4" class="form-control" name="term_conditions" placeholder="Terms and Conditions"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Amount">
                    </div>

                    <div class="form-group">
                        <label>Discount (%)</label>
                        <input type="text" class="form-control" name="discount" placeholder="Discount in %">
                    </div>

                    <div class="form-group">
                        <label>Expire Type</label>
                        <div>
                            <input type="radio" name="expire_type" value="Fixed" checked onchange="checkDate(this)"> Date &nbsp;
                            <input type="radio" name="expire_type" value="variable" onchange="checkDate(this)"> Non-date
                        </div>
                    </div>

                    <div class="form-group expire_type">
                        <label>Valid Date</label>
                        <input type="date" class="form-control" name="valid_date">
                    </div>

                    <div class="form-group d-none variable_month">
                        <label>Select Duration</label>
                        <select class="form-control" name="variable_month">
                            <option value="">Select</option>
                            <option value="3">3 Months</option>
                            <option value="6">6 Months</option>
                            <option value="9">9 Months</option>
                            <option value="12">12 Months</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="4" class="form-control" name="description" placeholder="Description"></textarea>
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
</div>

<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        // $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
        //     '][subject]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        //     );
        $("#dynamicAddRemove").append('<div class="form-group row"><div class="col-sm-3"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel</label><div class="col-sm-9"><select class="form-control" data-placeholder="Select a Category" name="hotel_id[]" id="uhotel_id"><option value="">Select</option>@foreach($hotelRecord as $val)<option value="{{ $val->id }}">{{ ucfirst($val->name) }}</option>@endforeach</select></div></div><div class="col-sm-3"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label><div class="col-sm-9"><select class="form-control" data-placeholder="Select a Category" name="category_id[]" id="category_id" onchange="getCoupon(this,'+i+')"><option value="">Select</option>@foreach($Categories as $val)<option value="{{ $val->id }}">{{ ucfirst($val->title) }}</option>@endforeach</select></div></div><div class="col-sm-4"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon</label><div class="col-sm-9"><select class="form-control coupon_html'+i+'"  data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="coupon[]" id="category_id"><option value="">Select</option></select></div></div> <div class="col-md-2"> <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label> <button type="button" name="add"  class="btn btn-outline-danger remove-input-field">Remove</button></div></div>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).closest(".form-group").remove();
    });

</script>
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
        $("input , select").val('');
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_date(page);
        });
    });

    function getList() {
        var name = $('#title').val();
        var end = $('#hidden_end_date').val();
        $.ajax({
            url: baseUrl + "multiple-packagelist?title=" + name,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('.lodding').css('display', 'block');
            },
            complete: function() {
                $('.lodding').css('display', 'none');
            },
            success: function(json) {
                $('.customtable').html(json.html)
                $('.pagnation').html(json.pagination)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function fetch_date(page) {
        var title = $('#title').val();
        $.ajax({
            url: baseUrl + "multiple-packagelist?title=" + title + '&page=' + page,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('.lodding').css('display', 'block');
            },
            complete: function() {
                $('.lodding').css('display', 'none');
            },
            success: function(json) {
                $('.customtable').html(json.html)
                $('.pagnation').html(json.pagination)
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
                $.get(baseUrl + "multiple-package/delete/" + id, function(data, status) {
                    if (data.success) {
                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        )
                        getList();
                    } else {
                        Swal.fire(
                            'Deleted!',
                            data.message,
                            'error'
                        )
                    }
                });
            }
        })
    }

    function editRecord(id) {
        $.ajax({
            url: baseUrl + "multiple-package/get_record_by_id/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#utitle').val(json.data.title);
                    $('#ulimit').val(json.data.limit);
                    $('#uamount').val(json.data.amount);
                    $('#utnc').val(json.data.term_conditions);
                    $('#udescription').val(json.data.description);
                    $('#uvalid_date').val(json.data.valid_date);
                    $('#updateDiv').html(json.html);
                    $('#_id').val(json.data.id);
                    $('#editFromPopup').modal('show');
                } else {
                    Swal.fire(
                        'Warning!',
                        json.message,
                        'error'
                    )
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function cloneRecord(id) {
        $.ajax({
            url: baseUrl + "multiple-package/clone/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#cloneDiv').html(json.html);
                    $('#cutitle').val(json.data.title);
                    $('#culimit').val(json.data.limit);
                    $('#cuamount').val(json.data.amount);
                    $('#cutnc').val(json.data.term_conditions);
                    $('#cudescription').val(json.data.description);
                    $('#cudate').val(json.data.valid_date);
                    $('#cuhotel_id').val(json.items['0'].hotel_id);
                    $('#cucategory_id').val(json.items['0'].category_id);
                    $('#cloneFromPopup').modal('show');
                    var Values = new Array();
                    json.items.forEach((number, index) => {
                        Values.push(number.coupon_id);
                    });
                    $("#cucoupon").val(Values).trigger('change');
                    //$('#cucoupon').val(json.data.category_id).trigger('change');
                } else {
                    Swal.fire(
                        'Warning!',
                        json.message,
                        'error'
                    )
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function viewRecord(id) {
        $.ajax({
            url: baseUrl + "multiple-package/details/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#viewFromPopup').modal('show');
                    $('.htmlcontent').html(json.html);
                } else {
                    Swal.fire(
                        'Warning!',
                        json.message,
                        'error'
                    )
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
    function getCoupon($this) {
        var id = $($this).val();
        $.ajax({
            url: baseUrl + "multiple-package/getCoupon/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('.coupon_html').append(json.html);
                } else {
                    Swal.fire(
                        'Warning!',
                        json.message,
                        'error'
                    )
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function changeSatus(id, status) {
        $.ajax({
            url: baseUrl + "multiple-package/change_status/" + id + "/" + status,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    getList();
                } else {
                    Swal.fire(
                        'Warning!',
                        json.message,
                        'error'
                    )
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
        if($($this).val()=="Fixed") {
            $('.expire_type').removeClass('d-none');
            $('.variable_month').addClass('d-none');
        }else{
            $('.expire_type').addClass('d-none');
            $('.variable_month').removeClass('d-none');
        }
    }
</script>
@endif
@endsection
