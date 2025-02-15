
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
	<td><?php echo ucfirst($value->email) ?></td>
	<td><?php echo ucfirst($value->mobile) ?></td>

	<td><div class="btn-group">
		<button type="button" class="btn btn-<?php echo $class ?>"><?php echo ucfirst($value->status) ?></button>
		<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span> </button>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Active')">Active</a>
			<a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Inactive')">Inactive</a>
		</div>
	</div></td>	
	<td><?php echo date("d-m-Y", strtotime($value->created_at)) ?></td>
</tr>
<?php }} else {?>
<tr>
	<td colspan="10"><div class="alert alert-warning" role="alert" style="text-align: center;">
		No Records Found !!
	</div>
</tr>
<?php }?>