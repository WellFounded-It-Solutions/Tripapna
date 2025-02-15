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
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Status</th>
                              <th>Created</th>
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

<script type = "text/javascript" >
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
            url: baseUrl + "customerlist?title=" + name,
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
            url: baseUrl + "customerlist?title=" + title + '&page=' + page,
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

function changeSatus(id, status) {
    $.ajax({
        url: baseUrl + "customer/change_status/" + id + "/" + status,
        type: 'get',
        dataType: 'json',
        beforeSend: function() {},
        complete: function() {},
        success: function(json) {
            if(json.success) {
                getList();
            }else {
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
@endif
@endsection