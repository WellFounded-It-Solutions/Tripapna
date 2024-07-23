
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
	<td><?php echo ucfirst($value->name) ?></td>
	<td><?php echo ($value->email) ?></td>
	<td><?php echo ($value->mobile) ?></td>

	<td>
		<div class="dropdown">
		<button class="btn bg-gradient-<?php echo $class ?> dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
			<?php echo ucfirst($value->status) ?>
		</button>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<li><a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Active')">Active</a></li>
			<li><a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Inactive')">Inactive</a></li>
		</ul>
		</div>
	</td>
	<td><?php echo date("d-m-Y", strtotime($value->created_at)) ?></td>
 	<td><ul class="list-unstyled d-flex mb-0">
		
		<li>
			<button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" onClick="deleteRecord(<?php echo $value->id ?>)">Delete</button>	
		</li>
	</ul></td>
</tr>
<?php }} else {?>
<tr>
	<td colspan="10"><div class="alert alert-warning" role="alert" style="text-align: center;">
		No Records Found !!
	</div>
</tr>
<?php }?><?php /**PATH E:\client\tripapna\admin\resources\views/hotelpanel/users/list.blade.php ENDPATH**/ ?>