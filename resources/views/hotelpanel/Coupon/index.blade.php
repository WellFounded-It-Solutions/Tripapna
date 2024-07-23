@extends('layouts.front_design')
@section('title','Coupon')
@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
    <div class="col-6 d-flex align-items-center">
       <h6>{{ $page_name }}</h6>
    </div>
    <div class="col-6 text-end">
        <a class="btn bg-gradient-dark mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-plus" aria-hidden="true" ></i>&nbsp;&nbsp;Add New</a>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Code</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Visit Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Limit</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                      <th class="text-secondary opacity-7"></th>
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
<!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <form class="form-horizontal ajax_form" action="{{ route('hoteladmin_coupons_store') }}" method="post" id="user">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          {{csrf_field()}}
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label>Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" data-role="tagsinput" value="">
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                <label>Visit Type</label>
                <input type="number" class="form-control" id="visit" placeholder="Visit type" name="visit_type" data-role="tagsinput" value="">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label>Limit</label>
                    <input type="number" class="form-control" id="limit" placeholder="Limit" name="used_limit" data-role="tagsinput" value="">
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                <label>Valid Date</label>
                <input type="date" class="form-control" id="valid_date" placeholder="Date" name="valid_date" data-role="tagsinput" value="">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label class="form-label">Image</label>
               <input type="file" class="custom-file-input" id="customFile" name="image">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-12">
            <label>Description</label>
                <textarea id="summernote" name="description"> </textarea>
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

<div class="modal fade" id="editFromPopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<form class="form-horizontal ajax_form" action="{{ route('hoteladmin_coupons_update') }}" method="post">
    {{csrf_field()}}
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label>Title</label>
                    <input type="text" class="form-control" id="utitle" placeholder="Title" name="title" data-role="tagsinput" value="">
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                <label>Visit Type</label>
                <input type="number" class="form-control" id="uvisit" placeholder="Visit type" name="visit_type" data-role="tagsinput" value="">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label>Limit</label>
                    <input type="number" class="form-control" id="ulimit" placeholder="Limit" name="used_limit" data-role="tagsinput" value="">
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                <label>Valid Date</label>
                <input type="date" class="form-control" id="uvalid_date" placeholder="Date" name="valid_date" data-role="tagsinput" value="">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-6">
            <label class="form-label">Image</label>
               <input type="file" class="custom-file-input" id="customFile" name="image">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-sm-12">
            <label>Description</label>
                <textarea id="summernote2" name="description"> </textarea>
            </div>
        </div>
      </div>
      <input type="hidden" name="id" id="_id"/>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
    </div>
    </form>
</div>
<script type = "text/javascript" >
  
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
            url: baseUrl + "couponslist?title=" + name,
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
            url: baseUrl + "couponslist?title=" + title + '&page=' + page,
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
                $.get(baseUrl + "coupons/delete/" + id, function(data, status) {
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
        url: baseUrl + "coupons/get_record_by_id/" + id,
        type: 'get',
        dataType: 'json',
        beforeSend: function() {},
        complete: function() {},
        success: function(json) {
            if(json.success) {
                $('#utitle').val(json.data.title);
                $('#ucategory_id').val(json.data.category_id).trigger('change');;
                $('#summernote2').summernote("code",json.data.description);
                $('#uvisit').val(json.data.visit_type);
                $('#ulimit').val(json.data.used_limit);
                $('#uvalid_date').val(json.data.valid_date);
                $('#_id').val(json.data.id);
                $('#editFromPopup').modal('show');
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

function changeSatus(id, status) {
    $.ajax({
        url: baseUrl + "coupons/change_status/" + id + "/" + status,
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
function getPermission($this) {
    $('#permission').modal('show');
}
$(document).ajaxComplete(function() {
    $("[data-toggle='tooltip']").tooltip();
});
</script>
@endsection