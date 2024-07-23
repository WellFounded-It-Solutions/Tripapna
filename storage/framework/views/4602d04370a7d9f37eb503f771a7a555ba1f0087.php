
<?php
if (($records->count() > 0)) {
    foreach ($records as $key => $value) {
    	
        if ($value->status == "Active") {
            $class = "success";
        } else if ($value->status == "Inactive") {
            $class = "danger";
        } else {
            $class = "primary";
        }?>
        <?php 
            $newClass = 'danger';
            $label = "No";
         ?>
<tr>
	<td><?php echo ($value->custom_coupon_id) ?></td>
	<td><?php echo ucfirst($value->title) ?></td>
	<td><?php echo ucfirst($value->category->title) ?></td>
	<td><?php echo ucfirst($value->description) ?></td>
	<td><img src="<?php echo e(url('/').'/coupon/'.$value->image); ?>" height="200" width="200"/></td>
	<td><?php echo ucfirst($value->visit_type) ?></td>
	<td><?php echo ucfirst($value->note) ?></td>

	<td><div class="btn-group">
		<button type="button" class="btn btn-<?php echo $class ?>"><?php echo ucfirst($value->status) ?></button>
		<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span> </button>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Active')">Active</a>
			<a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Inactive')">Inactive</a>
		</div>
	</div></td>	
	<td><?php echo date("d-m-Y", strtotime($value->created_at)) ?></td>
 	<td><ul class="list-unstyled d-flex mb-0">
		<li>
			<button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit" onClick="editRecord(<?php echo $value->id ?>)"><i class="fas fa-pencil-alt"></i></button>	
		 </li>
		 &nbsp;
		<li>
			<button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" onClick="deleteRecord(<?php echo $value->id ?>)"><i class="far fa-trash-alt"></i></button>	
		</li>
	</ul></td>
</tr>
<?php }} else {?>
<tr>
	<td colspan="10"><div class="alert alert-warning" role="alert" style="text-align: center;">
		No Records Found !!
	</div>
</tr>
<?php }?><?php /**PATH E:\client\tripapna\admin\resources\views/coupon/list.blade.php ENDPATH**/ ?>