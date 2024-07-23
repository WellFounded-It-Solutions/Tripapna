
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
	<td><?php echo ucfirst($value->title) ?></td>


	<td><div class="btn-group">
		<button type="button" class="btn btn-<?php echo $class ?>"><?php echo ucfirst($value->status) ?></button>
		<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split border" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span> </button>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Active')">Active</a>
			<a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Inactive')">Inactive</a>
		</div>
	</div></td>
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
<?php }?>
