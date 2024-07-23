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
        <td>
            <?php echo ucfirst($value->packages->title) ?>
        </td>
        <td>
            <?php echo ucfirst($value->packages->limit) ?>
        </td>
        <td>
            <?php echo date("d-m-Y", strtotime($value->packages->valid_date)) ?>
        </td>
        <td>
            <?php echo soldPackageCount($value->package_id); ?>
        </td>
        <td>
            <ul class="list-unstyled d-flex mb-0">
                <li>
                    <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit" onClick="viewRecord(<?php echo $value->packages->id ?>)">View</button>
                </li>
            </ul>
        </td>
    </tr>
    <?php }} else {?>
    <tr>
        <td colspan="10">
            <div class="alert alert-warning" role="alert" style="text-align: center;">
                No Records Found !!
            </div>
    </tr>
    <?php }?><?php /**PATH E:\client\tripapna\admin\resources\views/hotelpanel/package/list.blade.php ENDPATH**/ ?>