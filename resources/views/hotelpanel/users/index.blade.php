@extends('layouts.front_design')
@section('title','User')
@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
    <div class="col-6 d-flex align-items-center">
       <h6>{{ $page_name }}</h6>
    </div>
    <div class="col-6 text-end">
        <a class="btn bg-gradient-dark mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#addFromPopup"><i class="fas fa-plus" aria-hidden="true" ></i>&nbsp;&nbsp;Add New</a>
    </div>
    </div>
      <div class="row">
        <div class="col-12">

          <div class="card mb-4">
            <div class="card-header pb-0">
             
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
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
                 <div class="pagnation"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- Modal -->
<div class="modal fade" id="addFromPopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <form class="form-horizontal ajax_form" action="{{ route('hoteladmin_user_store') }}" method="post" id="user">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFromPopup">Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <div class="modal-body">
                    {{csrf_field()}}
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                    <input type="text" class="form-control" id="fname" placeholder="Name" name="name" data-role="tagsinput" value="">
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                <label>Email</label>
                <input type="text" class="form-control"  placeholder="Email" name="email" id="Email">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label>Mobile</label>
                     <input type="text" class="form-control"  placeholder="Mobile" name="mobile" id="Mobile">
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                <label>Role</label>
                <select class="form-control" name="role_id" id="role">
                    <option value="">Select</option>
                    @php
                    $records = get_rolesHotel();
                    @endphp
                    @foreach($records as $record) 
                    <option value="{{ $record->id }}">{{ $record->name }}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label>Password</label>
                     <input type="password" class="form-control"  placeholder="Password" name="password" id="Password">
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                <label>Confirmed Password</label>
                <input type="password" class="form-control"  placeholder="Password" name="confirmed" id="confirmed">
            </div>
        </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
    </div>
    </form>
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
            <form class="form-horizontal ajax_form" action="" method="post" id="users">
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
@endsection