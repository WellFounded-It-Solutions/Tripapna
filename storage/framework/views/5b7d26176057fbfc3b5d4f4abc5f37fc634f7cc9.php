
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

	<td><?php echo date("d-m-Y", strtotime($value->created_at)) ?></td>
    <td>
            <ul class="list-unstyled d-flex mb-0">
                <li>
                    <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Permission" onClick="getPermission(<?php echo $value->id ?>)">View</button>
                </li>
            </ul>
        </td>
</tr>
<?php }} else {?>
<tr>
	<td colspan="10"><div class="alert alert-warning" role="alert" style="text-align: center;">
		No Records Found !!
	</div>
</tr>
<?php }?><?php /**PATH E:\client\tripapna\admin\resources\views/hotelpanel/permission/list.blade.php ENDPATH**/ ?>