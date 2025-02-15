@extends('layouts.admin_design')
@section('title','Hotel Category')
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
                    <form method="post" action="{{route(Auth::user()->roles['0']->params.'_hotel_category_store') }}" class="row callout callout-success form-horizontal ajax_form ">
                        {{csrf_field()}}
                        <div class="col-6">

                            <div class="form-group m-0">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter category">
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>

                <div class="col-12">
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" class="form-control" placeholder="Search by keyword" id="search">
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
                                        <th>Status</th>
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

<!-- Edit Modal -->
<div class="modal fade" id="editFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document ">
        <form class="modal-content form-horizontal ajax_form" action="{{route(Auth::user()->roles['0']->params.'_hotel_category_update') }}" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{csrf_field()}}
                <input type="hidden" name="id" id="_id">
                <div class="form-group m-0">
                    <input type="text" name="title" class="form-control" id="utitle" placeholder="Enter category">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>


<script>
    function createdCallback() {
        getList();
    }

    function updatedCallback() {
        setTimeout(function() {
            $('#editFromPopup').modal('hide');
        }, 1000);
        getList();
    }

    function editRecord(id) {
        $.ajax({
            url: baseUrl + "hotel_category_get_record_by_id/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#utitle').val(json.data.title);
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

    function changeSatus(id, status) {
        $.ajax({
            url: baseUrl + "hotel_category_status",
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                status: status,
                _token: "{{ csrf_token() }}"
            },
            success: function(json) {
                getList();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        getList();
    });

    function getList() {
        var name = $('#search').val();
        var end = $('#hidden_end_date').val();
        $.ajax({
            url: baseUrl + "hotel_category_list?title=" + name,
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
</script>


@endsection
