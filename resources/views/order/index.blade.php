@extends('layouts.admin_design') @section('title','Orders') @section('content')
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
                                        <th>Order id</th>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>Transaction id</th>
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
<div class="modal fade " id="viewFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
    <div class="modal-dialog modal-lg" role="document ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true ">&times;</span>
            </button>
            </div>
            <div class="modal-body htmlcontent">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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
            url: baseUrl + "orderlist?title=" + name,
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
            url: baseUrl + "orderlist?title=" + title + '&page=' + page,
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


    function viewRecord(id) {
        $.ajax({
            url: baseUrl + "order/details/" + id,
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
    $(document).ajaxComplete(function() {
        $("[data-toggle='tooltip']").tooltip();
    });
</script>
@endsection