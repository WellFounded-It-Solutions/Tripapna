@extends('layouts.admin_design') @section('title','Coupon categories') @section('content')
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
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" class="form-control" placeholder="Search by title" id="title">
                            </div>
                            <div class="col-3">

                            </div>
                            <div class="col-3">

                            </div>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Destination</th>
                                        <th>Travel_date</th>
                                        <th>Duration</th>
                                        <th>Travelers</th>
                                        <th>Budget</th>
                                        <th>Preferences</th>
                                    </tr>
                                </thead>
                                <tbody class="customtable">

                                </tbody>
                            </table>
                        </div>
                        <div class="pagnation"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<!-- Modal -->
<!-- Modal -->

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
        var end = $('#hidden_end_date').val();
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
                $.get(baseUrl + "single-package/delete/" + id, function(data, status) {
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
            url: baseUrl + "single-package/get_record_by_id/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#utitle').val(json.data.title);
                    $('#ulimit').val(json.data.limit);
                    $('#uamount').val(json.data.amount);
                    // $('#utnc').val(json.data.term_conditions);
                    // $('#udescription').val(json.data.description);
                    $('#udescription').summernote('code', json.data.description);
                    $('#utnc').summernote('code', json.data.term_conditions);
                    $('#uvalid_date').val(json.data.valid_date);
                    $('#uvalid_date').val(json.data.valid_date);
                    $('#udiscount').val(json.data.discount);
                    $('#ucategory_id').val(json.items['0'].category_id);
                    var Values = new Array();
                    json.items.forEach((number, index) => {
                        Values.push(number.coupon_id);
                    });
                    $("#ucoupon_id").val(Values).trigger('change');
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
            url: baseUrl + "single-package/clone/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#cutitle').val(json.data.title);
                    $('#culimit').val(json.data.limit);
                    $('#cuamount').val(json.data.amount);
                    $('#cutnc').val(json.data.term_conditions);
                    $('#cudescription').val(json.data.description);
                    $('#cudescription').summernote('code', json.data.description);
                    $('#cutnc').summernote('code', json.data.term_conditions);
                    $('#cudate').val(json.data.valid_date);
                    $('#cudiscount').val(json.data.discount);
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
            url: baseUrl + "single-package/details/" + id,
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

    function getCoupon($this) {
        var id = $($this).val();
        $.ajax({
            url: baseUrl + "single-package/getCoupon/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('.coupon_html').html(json.html);
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
            url: baseUrl + "single-package/change_status/" + id + "/" + status,
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
<script type="text/javascript">
        $(document).ready(function() {
          $('.summernote').summernote();
        });
    </script>
    @endif
@endsection
