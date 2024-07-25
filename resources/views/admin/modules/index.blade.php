@extends('layouts.admin_design')
@section('title','Modul Managment')
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
                    <form method="post" action="{{route(Auth::user()->roles['0']->params.'_modules_store') }}" class="row callout callout-success form-horizontal ajax_form ">
                        {{csrf_field()}}
                        <div class="col-6">

                            <div class="form-group m-0">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Module Title">
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Add Module</button>
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

    function changeSatus(id, status) {
        $.ajax({
            url: baseUrl + "modules/change_status",
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
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getList(page);
        })
    });

    function getList(page =1) {
        var search = $('#search').val();
        $.ajax({
            type: 'get',
            url: baseUrl + 'moduleslist?search=' + search + '&page=' + page,
            data: {
                'search': search
            },
            success: function(response) {
                $('.customtable').html(response.html);
                $('.pagnation').html(response.pagination);
            },
            error: function(xhr, status, error) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
</script>

@endsection
