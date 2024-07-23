<?php $__env->startSection('title','Coupon'); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
   <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1><?php echo e($page_name); ?></h1>
                </div>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="clearfix mb-5">
                	<?php if(auth()->check() && auth()->user()->can('add-coupon')): ?>
                     <button type="button" class="btn btn-primary float-right"  data-toggle="modal" data-target="#addFromPopup"><i class="fas fa-plus"></i> Add</button>
                    <?php endif; ?> 
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
                              <th>Code</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Image</th>
                              <th>Description</th>
                              <th>Visit</th>
                              <th>Note</th>
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
                <form class="form-horizontal ajax_form" action="<?php echo e(route(Auth::user()->roles['0']->params.'_coupons_store')); ?>" method="post" id="user">
                    <?php echo e(csrf_field()); ?>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon Category</label>
                            <div class="col-sm-9">
                                <select class="select2" data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="category_id">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                        <option value="<?php echo e($val->id); ?>"><?php echo e(ucfirst($val->title)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea  name="description" class="form-control"> </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Visit type</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="title" placeholder="Visit type" name="visit_type" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Notes</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Notes" name="note" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="form-group">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
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
            </form>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<!-- Modal -->
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
            <form class="form-horizontal ajax_form" action="<?php echo e(route(Auth::user()->roles['0']->params.'_coupons_update')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="utitle" placeholder="Title" name="title" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon Category</label>
                            <div class="col-sm-9">
                                <select class="select2" data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="category_id" id="ucategory_id">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                        <option value="<?php echo e($val->id); ?>"><?php echo e(ucfirst($val->title)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea id="upsummernote2" name="description" class="form-control"> </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Visit type</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="uvisit" placeholder="Visit type" name="visit_type" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Notes</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Notes" name="note" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="form-group">

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
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
                $('#upsummernote2').text(json.data.description);
                $('#uvisit').val(json.data.visit_type);
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\client\tripapna\admin\resources\views/coupon/index.blade.php ENDPATH**/ ?>