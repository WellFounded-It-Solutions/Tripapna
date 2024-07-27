@extends('layouts.admin_design')
@section('title','Hotel')
@section('content')
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

                        @if(auth()->check() && auth()->user()->can('create-hotel'))
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addFromPopup"><i class="fas fa-plus"></i> Add Hotel</button>
                        @endif


                        @if(auth()->check() && auth()->user()->can('add-hotel-category'))
                        <a href="{{ route('administrator_hotel_category_create') }}" class="btn btn-primary float-right mr-3"><i class="fas fa-plus"></i> Add Hotel Category</a>
                        @endif

                    </div>
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" class="form-control" placeholder="Search by keyword" id="title">
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
                                        <th>Location</th>
                                        <th>Eamil</th>
                                        <th>Mobile</th>
                                        <th>Type</th>
                                        <th>Logo</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
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
<div class="modal fade " id="addFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
    <div class="modal-dialog modal-lg" role="document ">
        <form class="form-horizontal ajax_form" action="{{ route(Auth::user()->roles['0']->params.'_hotel_store') }}" method="post" id="user">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Location</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Location" name="location" id="location">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Lat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Long</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="long" name="long" id="long">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Mobile" name="mobile" id="mobile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel type</label>
                            <div class="col-sm-9">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="type" checked="" value="c" onchange="typeChange(this)">
                                        <label for="radioPrimary1">
                                            Commsission able
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="type" value="nc" onchange="typeChange(this)">
                                        <label for="radioPrimary2">
                                            Non Commsission able
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row amount">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="amount" name="amount" id="amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="hotel_category">
                                    <option value="">Select</option>
                                    @foreach ( $hotel_category as $v )
                                    <option value="{{ $v->id }}">{{ $v->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Logo</label>
                            <div class="col-sm-9">
                                <div class="form-group">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile1" name="logo">
                                        <label class="custom-file-label" for="customFile1">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel images</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="filenames" name="filenames[]" multiple>
                                        <label class="custom-file-label" for="filenames">Choose file</label>
                                    </div>
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
            </div>
    </div>
    </form>
</div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade " id="editFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
    <div class="modal-dialog modal-lg" role="document ">
        <form class="form-horizontal ajax_form" action="{{ route(Auth::user()->roles['0']->params.'_hotel_update') }}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uname" placeholder="Name" name="name" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Location</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Location" name="location" id="ulocation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Lat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="lat" name="lat" id="ulat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Long</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="long" name="long" id="ulong">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Email" name="email" id="uemail" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Mobile" name="mobile" id="umobile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel type</label>
                            <div class="col-sm-9">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="uradioPrimary1" name="type" checked="" value="c" onchange="typeChange(this)">
                                        <label for="uradioPrimary1">
                                            Commsission able
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="uradioPrimary2" name="type" value="nc" onchange="typeChange(this)">
                                        <label for="uradioPrimary2">
                                            Non Commsission able
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row amount">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="amount" name="amount" id="uamount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="hotel_category" id="ufhotel_category">
                                    <option value="">Select</option>
                                    @foreach ( $hotel_category as $v )
                                    <option value="{{ $v->id }}">{{ $v->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Logo</label>
                            <div class="col-sm-9">
                                <div class="form-group">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile2" name="logo">
                                        <label class="custom-file-label" for="customFile2">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel images</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="filenames2" name="filenames[]" multiple>
                                        <label class="custom-file-label" for="filenames2">Choose file</label>
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
                </div>
            </div>
        </form>
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
        var end = $('#hidden_end_date').val();
        $.ajax({
            url: baseUrl + "hotelslist?title=" + name,
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
            url: baseUrl + "hotelslist?title=" + title + '&page=' + page,
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
                $.get(baseUrl + "hotels/delete/" + id, function(data, status) {
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
            url: baseUrl + "hotels/get_record_by_id/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#uname').val(json.data.name);
                    $('#ulocation').val(json.data.location);
                    $('#umobile').val(json.data.mobile);
                    $('#uemail').val(json.data.email);
                    $('#uamount').val(json.data.amount);
                    $('#ulat').val(json.data.lat);
                    $('#ulong').val(json.data.long);
                    $('#ufhotel_category').val(json.data.hotel_category);
                    $('#_id').val(json.data.id);
                    if (json.data.type == 'c') {
                        $('.amount').show();
                        $('#uradioPrimary1').attr('checked', 'checked');
                    } else {
                        $('.amount').hide();
                        $('#uradioPrimary2').attr('checked', 'checked');
                    }
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

    function changeSatus(id, status) {
        $.ajax({
            url: baseUrl + "hotels/change_status/" + id + "/" + status,
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

    function typeChange($this) {
        if ($($this).val() == 'c') {
            $('.amount').show();
        } else {
            $('.amount').hide();
        }
    }
</script>

@endsection
