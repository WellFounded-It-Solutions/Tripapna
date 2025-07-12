@extends('layouts.admin_design')
@section('title', 'Fake Orders')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fake Orders</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-3">
                    <button class="btn btn-info mr-2" onclick="window.location.href='{{ route('fakeorder_new') }}'">Create Fake Order</button>
                    <button class="btn btn-primary" onclick="window.location.href='{{ route('fakeorder_import_form') }}'">Import Fake Orders</button>
                </div>
                <div class="col-12">
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Search by order code or user" id="title">
                            </div>
                            <div class="col-3">
                                <button class="btn btn-info" onclick="getList()">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Fake Orders</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 600px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Order Code</th>
                                        <th>User</th>
                                        <th>Package</th>
                                        <th>Hotel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="customtable">
                                    <!-- Populated via AJAX -->
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pagnation">
                            <!-- Populated via AJAX -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="viewFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body htmlcontent">
                <!-- Populated via AJAX -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        getList();
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_date(page);
        });
    });

    function getList() {
        var title = $('#title').val();
        $.ajax({
            url: "{{ url('orderlist') }}?title=" + title,
            type: 'get',
            dataType: 'json 
            beforeSend: function() { $('.lodding').css('display', 'block'); },
            complete: function() { $('.lodding').css('display', 'none'); },
            success: function(json) {
                $('.customtable').html(json.html);
                $('.pagnation').html(json.pagination);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText);
            }
        });
    }

    function fetch_date(page) {
        var title = $('#title').val();
        $.ajax({
            url: "{{ url('orderlist') }}?title=" + title + '&page=' + page,
            type: 'get',
            dataType: 'json',
            beforeSend: function() { $('.lodding').css('display', 'block'); },
            complete: function() { $('.lodding').css('display', 'none'); },
            success: function(json) {
                $('.customtable').html(json.html);
                $('.pagnation').html(json.pagination);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText);
            }
        });
    }

    function viewRecord(id) {
        $.ajax({
            url: "{{ url('order/details') }}/" + id,
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
                console.log(thrownError + "\r\n" + xhr.statusText);
            }
        });
    }
</script>
@endpush