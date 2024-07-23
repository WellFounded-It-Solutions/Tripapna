 <?php $__env->startSection('title','Coupon categories'); ?> <?php $__env->startSection('content'); ?>
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
                        <?php if(auth()->check() && auth()->user()->can('add-multiple-package')): ?>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addFromPopup"><i class="fas fa-plus"></i> Add</button> <?php endif; ?>
                    </div>
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
                                        <th>Title</th>
                                        <th>Limit</th>
                                        <th>Amount</th>
                                        <th>Valid Date</th>
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
                <form class="form-horizontal ajax_form" action="<?php echo e(route(Auth::user()->roles['0']->params.'_multiple_package_store')); ?>" method="post" id="user">
                    <?php echo e(csrf_field()); ?>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div id="dynamicAddRemove">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel</label>
                                <div class="col-sm-9">
                                    <select class="form-control" data-placeholder="Select a Category" name="hotel_id[]" id="uhotel_id">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $hotelRecord; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                            <option value="<?php echo e($val->id); ?>"><?php echo e(ucfirst($val->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" data-placeholder="Select a Category" name="category_id[]" id="category_id" onchange="getCoupon(this,0)">
                                        <option value="">Select</option>
                                        <?php $__currentLoopData = $Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                            <option value="<?php echo e($val->id); ?>"><?php echo e(ucfirst($val->title)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon</label>
                                <div class="col-sm-9">
                                    <select class="form-control coupon_html0"  data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="coupon[]" id="category_id">
                                        <option value="">Select</option>
    
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                                <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add</button>
                            </div>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Limit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="limit" placeholder="Limit" name="limit" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Terms and Conditions</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control" placeholder="Terms and Conditions" cols="70" name="term_conditions"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="discount" placeholder="discount in %" name="discount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input type="radio" class="btn-check" name="expire_type" id="option1" autocomplete="off" onchange="checkDate(this)" value="Fixed" checked>
                                <label class="btn btn-secondary" for="option1">Date</label>

                                <input type="radio" class="btn-check" name="expire_type" id="option2" autocomplete="off" value="variable" onchange="checkDate(this)">
                                <label class="btn btn-secondary" for="option2">Non date</label>
                            </div>
                        </div>
                        <div class="form-group row expire_type ">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Valid Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="valid_date" placeholder="Valid Date" name="valid_date" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row d-none variable_month">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Select</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="variable_month">
                                    <option value="">Select</option>
                                    <option value="3">3 Months</option>
                                    <option value="3">6 Months</option>
                                    <option value="9">9 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control" placeholder="Description" cols="70" name="description"></textarea>
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
                <form class="form-horizontal ajax_form" action="<?php echo e(route(Auth::user()->roles['0']->params.'_multiple_package_update')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="utitle" placeholder="Title" name="title" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div id="updateDiv"></div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Limit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="ulimit" placeholder="Title" name="limit" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Terms and Conditions</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control" placeholder="Terms and Conditions" cols="70" name="term_conditions" id="utnc"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uamount" placeholder="Amount" name="amount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="udiscount" placeholder="discount in %" name="discount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input type="radio" class="btn-check" name="expire_type" id="option1" autocomplete="off" onchange="checkDate(this)" value="Fixed" checked>
                                <label class="btn btn-secondary" for="option1">Date</label>

                                <input type="radio" class="btn-check" name="expire_type" id="option2" autocomplete="off" value="variable" onchange="checkDate(this)">
                                <label class="btn btn-secondary" for="option2">Non date</label>
                            </div>
                        </div>
                        <div class="form-group row expire_type ">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Valid Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="valid_date" placeholder="Valid Date" name="valid_date" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row d-none variable_month">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Select</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="variable_month">
                                    <option value="">Select</option>
                                    <option value="3">3 Months</option>
                                    <option value="3">6 Months</option>
                                    <option value="9">9 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="uvalid_date" placeholder="Title" name="valid_date" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control" placeholder="Terms and Conditions" cols="70" name="description" id="udescription"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="_id" />
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
<div class="modal fade " id="cloneFromPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
    <div class="modal-dialog modal-lg" role="document ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true ">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal ajax_form" action="<?php echo e(route(Auth::user()->roles['0']->params.'_multiple_package_clone')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cutitle" placeholder="Title" name="title" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div id="cloneDiv">

                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Limit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="culimit" placeholder="Title" name="limit" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Terms and Conditions</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control" placeholder="Terms and Conditions" cols="70" name="term_conditions" id="cutnc"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cuamount" placeholder="Amount" name="amount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Discount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cudiscount" placeholder="discount in %" name="discount" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input type="radio" class="btn-check" name="expire_type" id="option1" autocomplete="off" onchange="checkDate(this)" value="Fixed" checked>
                                <label class="btn btn-secondary" for="option1">Date</label>

                                <input type="radio" class="btn-check" name="expire_type" id="option2" autocomplete="off" value="variable" onchange="checkDate(this)">
                                <label class="btn btn-secondary" for="option2">Non date</label>
                            </div>
                        </div>
                        <div class="form-group row expire_type ">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Valid Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="cudate" placeholder="Valid Date" name="valid_date" data-role="tagsinput" value="">
                            </div>
                        </div>
                        <div class="form-group row d-none variable_month">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Select</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="variable_month">
                                    <option value="">Select</option>
                                    <option value="3">3 Months</option>
                                    <option value="3">6 Months</option>
                                    <option value="9">9 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea rows="5" class="form-control" placeholder="Description" cols="70" name="description" id="cudescription"></textarea>
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
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        // $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
        //     '][subject]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        //     );
        $("#dynamicAddRemove").append('<div class="form-group row"><div class="col-sm-3"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel</label><div class="col-sm-9"><select class="form-control" data-placeholder="Select a Category" name="hotel_id[]" id="uhotel_id"><option value="">Select</option><?php $__currentLoopData = $hotelRecord; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($val->id); ?>"><?php echo e(ucfirst($val->name)); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div></div><div class="col-sm-3"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label><div class="col-sm-9"><select class="form-control" data-placeholder="Select a Category" name="category_id[]" id="category_id" onchange="getCoupon(this,'+i+')"><option value="">Select</option><?php $__currentLoopData = $Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($val->id); ?>"><?php echo e(ucfirst($val->title)); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div></div><div class="col-sm-4"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon</label><div class="col-sm-9"><select class="form-control coupon_html'+i+'"  data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="coupon[]" id="category_id"><option value="">Select</option></select></div></div> <div class="col-md-2"> <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label> <button type="button" name="add"  class="btn btn-outline-danger remove-input-field">Remove</button></div></div>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).closest(".form-group").remove();
    });

</script>
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
            url: baseUrl + "multiple-packagelist?title=" + name,
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
            url: baseUrl + "multiple-packagelist?title=" + title + '&page=' + page,
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
                $.get(baseUrl + "multiple-package/delete/" + id, function(data, status) {
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
            url: baseUrl + "multiple-package/get_record_by_id/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#utitle').val(json.data.title);
                    $('#ulimit').val(json.data.limit);
                    $('#uamount').val(json.data.amount);
                    $('#utnc').val(json.data.term_conditions);
                    $('#udescription').val(json.data.description);
                    $('#uvalid_date').val(json.data.valid_date);
                    $('#updateDiv').html(json.html);    
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

    function cloneRecord(id) {
        $.ajax({
            url: baseUrl + "multiple-package/clone/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('#cloneDiv').html(json.html);
                    $('#cutitle').val(json.data.title);
                    $('#culimit').val(json.data.limit);
                    $('#cuamount').val(json.data.amount);
                    $('#cutnc').val(json.data.term_conditions);
                    $('#cudescription').val(json.data.description);
                    $('#cudate').val(json.data.valid_date);
                    $('#cuhotel_id').val(json.items['0'].hotel_id);
                    $('#cucategory_id').val(json.items['0'].category_id);
                    $('#cloneFromPopup').modal('show');
                    var Values = new Array();
                    json.items.forEach((number, index) => {
                        Values.push(number.coupon_id);
                    });
                    $("#cucoupon").val(Values).trigger('change');
                    //$('#cucoupon').val(json.data.category_id).trigger('change');
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

    function viewRecord(id) {
        $.ajax({
            url: baseUrl + "multiple-package/details/" + id,
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

    function getCoupon($this,i) {
        var id = $($this).val();
        $.ajax({
            url: baseUrl + "multiple-package/getCoupon/" + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            complete: function() {},
            success: function(json) {
                if (json.success) {
                    $('.coupon_html'+i).html(json.html);
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
            url: baseUrl + "multiple-package/change_status/" + id + "/" + status,
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
    function checkDate($this) {
        if($($this).val()=="Fixed") {
            $('.expire_type').removeClass('d-none');
            $('.variable_month').addClass('d-none');
        }else{
            $('.expire_type').addClass('d-none');
            $('.variable_month').removeClass('d-none');
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\client\tripapna\admin\resources\views/multiplepackage/index.blade.php ENDPATH**/ ?>