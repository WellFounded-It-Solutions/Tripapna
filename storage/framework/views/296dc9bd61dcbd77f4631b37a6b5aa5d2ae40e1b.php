<?php $__env->startSection('title','Coupon'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
    <div class="col-6 d-flex align-items-center">
       <h6><?php echo e($page_name); ?></h6></br>
    </div>
    <div class="col-6 text-end">
        <a class="btn bg-gradient-dark mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-plus" aria-hidden="true" ></i>&nbsp;&nbsp;Search </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0"></div>
            <!-- <button type="submit" class="btn bg-gradient-dark mb-3 ml-3 col-sm-2" form="myform">Reedeem Now</button> -->
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <!-- <form id="myform" action="<?php echo e(route('hoteladmin_coupons_change_status_multiple')); ?>" method="post" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?> -->
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>  
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order id</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Transaction id</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                    </tbody>
                    </table>
                <!-- </form> -->
                 <div class="pagnation"></div>
              </div>
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
<!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="permission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <button type="submit" class="btn bg-gradient-dark mb-3 ml-3 col-sm-2" form="myform">Reedeem Now</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="myform" action="<?php echo e(route('hoteladmin_coupons_change_status_multiple')); ?>" method="post" enctype="multipart/form-data">
                         <?php echo e(csrf_field()); ?>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            <input id="check_all" type="checkbox">
                                        </th>   
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Visit Type</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mobile</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody class="pcontainer">
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        var coupon = $('#coupon').val();
        var mobile = $('#mobile').val();
        var end = $('#hidden_end_date').val();
        $.ajax({
            url: baseUrl + "orders?coupon=" + coupon+'&mobile='+mobile,
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
                $('#staticBackdrop').modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    function viewRecord(id){
        $.ajax({
        url: baseUrl + "coupons_redeemlist/" + id,
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
    // function viewRecord(id) {
    //     $.ajax({
    //         url: baseUrl + "coupons_redeemlist/" + id,
    //         type: 'get',
    //         dataType: 'json',
    //         beforeSend: function() {},
    //         complete: function() {},
    //         success: function(json) {
    //             if (json.success) {
    //                 $('#viewFromPopup').modal('show');
    //                 $('.htmlcontent').html(json.html);
    //             } else {
    //                 Swal.fire(
    //                     'Warning!',
    //                     json.message,
    //                     'error'
    //                 )
    //             }
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    //         }
    //     });
    // }
    $(document).ajaxComplete(function() {
        $("[data-toggle='tooltip']").tooltip();
    });
    function fetch_date(page) {
        var title = $('#title').val();
        $.ajax({
            url: baseUrl + "coupons_redeemlist?title=" + title + '&page=' + page,
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
                $.get(baseUrl + "coupons_redeem/delete/" + id, function(data, status) {
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
        url: baseUrl + "coupons_redeem/get_record_by_id/" + id,
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
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reedeem it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: baseUrl + "coupons_redeem/change_status/" + id + "/" + status,
                type: 'get',
                dataType: 'json',
                beforeSend: function() {},
                complete: function() {},
                success: function(json) {
                    if(json.success) {
                        window.location.reload();
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
    })
}
function getPermission($this) {
    $('#permission').modal('show');
}
$(document).ajaxComplete(function() {
    $("[data-toggle='tooltip']").tooltip();
});
$(function() {
	//If check_all checked then check all table rows
	$("#check_all").on("click", function () {
		if ($("input:checkbox").prop("checked")) {
			$("input:checkbox[name='row-check[]']").prop("checked", true);
		} else {
			$("input:checkbox[name='row-check[]']").prop("checked", false);
		}
	});
	// Check each table row checkbox
	$("input:checkbox[name='row-check[]']").on("change", function () {
		var total_check_boxes = $("input:checkbox[name='row-check[]']").length;
		var total_checked_boxes = $("input:checkbox[name='row-check[]']:checked").length;
		// If all checked manually then check check_all checkbox
		if (total_check_boxes === total_checked_boxes) {
			$("#check_all").prop("checked", true);
		}
		else {
			$("#check_all").prop("checked", false);
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\client\tripapna\admin\resources\views/hotelpanel/coupon_redeem/index.blade.php ENDPATH**/ ?>