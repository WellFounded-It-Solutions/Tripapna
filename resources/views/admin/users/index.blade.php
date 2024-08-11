@extends('layouts.admin_design')
@section('title','User')
@section('content')
@if(auth()->user()->hasRole('admin'))
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
                     <button type="button" class="btn btn-primary float-right"  data-toggle="modal" data-target="#addFromPopup"><i class="fas fa-plus"></i> Add User</button>
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
                              <th>Email</th>
                              <th>Mobile</th>
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true ">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal ajax_form" action="{{ route(Auth::user()->roles['0']->params.'_user_store') }}" method="post" id="user">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fname" placeholder="Name" name="name" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  placeholder="Email" name="email" id="Email">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  placeholder="Mobile" name="mobile" id="Mobile">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control"  placeholder="Password" name="password" id="Password">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Confirmed Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control"  placeholder="Password" name="confirmed" id="confirmed">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="role" id="role" onchange="changeRole(this)">
                                    <option value="">Select</option>
                                    @php
                                        $records = get_roles(Auth::user()->roles['0']->params);
                                    @endphp
                                    @foreach($records as $record) 
                                        <option value="{{ $record->id }}">{{ $record->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div> 

                        <div class="form-group row" id="managerid" style="display: none">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Manager</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="maneger_id" id="maneger_id">
                                    <option value="">Select</option>
                                    @foreach($manegers as $record) 
                                        <option value="{{ $record->id }}">{{ $record->name }}</option>
                                    @endforeach
                                </select>
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
<div class="modal fade " id="editFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
<div class="modal-dialog modal-lg" role="document ">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true ">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal ajax_form" action="{{ route(Auth::user()->roles['0']->params.'_user_update') }}" method="post" id="users">
                {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uname" placeholder="Name" name="name" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  placeholder="Email" name="email" id="uemail" readOnly>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  placeholder="Mobile" name="mobile" id="umobile">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control"  placeholder="********" name="password" id="password">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Confirmed Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control"  placeholder="********" name="confirmed" id="confirmed">
                            </div>
                        </div> 
                    </div>
                    <input type="hidden" name="id" id="_id"/>
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
<script type = "text/javascript" >
  
function addCallBack() {
        setTimeout(function() {
            $('#addFromPopup').modal('hide');
        }, 3000);
        getList();
    }
function permissionAddCallBack() {
        setTimeout(function() {
            $('#permission').modal('hide');
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
            url: baseUrl + "userslist?title=" + name,
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
            url: baseUrl + "userslist?title=" + title + '&page=' + page,
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
                $.get(baseUrl + "users/delete/" + id, function(data, status) {
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
                            'Opps there is some error.',
                            'error'
                        )
                    }
                });
            }
        })
    }

function editRecord(id) {
    $.ajax({
        url: baseUrl + "users/get_record_by_id/" + id,
        type: 'get',
        dataType: 'json',
        beforeSend: function() {},
        complete: function() {},
        success: function(json) {
            $('#uname').val(json.data.name);
            $('#uemail').val(json.data.email);
            $('#umobile').val(json.data.mobile);
            $('#famount').val(json.data.amount);
            $('#_id').val(json.data.id);
            $('#editFromPopup').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function changeSatus(id, status) {
    $.ajax({
        url: baseUrl + "users/change_status/" + id + "/" + status,
        type: 'get',
        dataType: 'json',
        beforeSend: function() {},
        complete: function() {},
        success: function(json) {
            getList();
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
function getPermission(id) {
        $.ajax({
        url: baseUrl + "users/getPermission/" + id,
        type: 'get',
        dataType: 'json',
        beforeSend: function() {},
        complete: function() {},
        success: function(json) {
            $('#userId').val(id);
            $('.pcontainer').html(json.html)
            $('#permission').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
   
}
$(document).ajaxComplete(function() {
    $("[data-toggle='tooltip']").tooltip();
});
                        
function changeRole($this) {
 let id =  $("#role option:selected").val();
    if(id==7) {
        $('#managerid').show();
    }else{
        $('#managerid').hide();
     }
}
                        
</script>
@endif

@endsection