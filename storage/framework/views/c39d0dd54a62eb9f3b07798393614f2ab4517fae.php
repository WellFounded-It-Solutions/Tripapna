
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
	<td><?php echo ucfirst($value->order_id) ?></td>
	<td>
		<i class="fas fa-user-tie"></i> &nbsp; <?php echo e($value->user_name); ?><br />
		<i class="fas fa-mobile"></i> &nbsp; <?php echo e($value->user_phone); ?> <br />
		<i class="fas fa-envelope"></i> &nbsp; <?php echo e($value->user_email); ?> <br />
	</td>
	<td><?php echo ucfirst($value->amount) ?></td>
	<td><?php echo e($value->trans_id); ?></td>


	<td><?php echo e($value->created_at->diffForHumans()); ?></td>
 	<td><ul class="list-unstyled d-flex mb-0">

		<li>
			<button type="button" class="btn btn-block btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Details" onClick="viewRecord(<?php echo $value->id ?>)"><i class="fas fa-eye"></i></button>	
		</li>
	</ul></td>
</tr>
<?php }} else {?>
<tr>
	<td colspan="10"><div class="alert alert-warning" role="alert" style="text-align: center;">
		No Records Found !!
	</div>
</tr>
<?php }?><?php /**PATH E:\client\tripapna\admin\resources\views/order/list.blade.php ENDPATH**/ ?>