<?php
if (($records->count() > 0)) {
    foreach ($records as $key => $value) {
    	$coupon_data = ($value->coupon_data);
    	// $coupon_data = json_decode($value->coupon_data);
    	$category_id = isset($coupon_data->category_id) ? $coupon_data->category_id:'';
    	$category_detail = getCouponCategory($category_id);
        if ($value->status == "Redeem") {
            $class = "success";
        } else if ($value->status == "Pending") {
            $class = "primary";
        } else {
            $class = "primary";
        }?>
        <?php
            $newClass = 'danger';
            $label = "No";
         ?>
	<tr>
		<td><input type="checkbox" name="row-check[]" value="{{ $value->id }}"></td>
		<td><?php echo ($value->coupon) ?></td>
        <td><?php echo ucfirst($value->coupon_data->description) ?></td>
		<td><?php echo isset($category_detail->title) ? $category_detail->title:''; ?></td>
		<td><?php echo ucfirst($value->visit_type) ?></td>
		<td><?php echo ucfirst($value->mobile_number) ?></td>
		<td><?php echo date("d-m-Y",strtotime($value->valid_date)) ?></td>
		<td>

			<div class="dropdown">
			<?php if($value->status == "Redeem"){ ?>
				<a class="btn btn-<?php echo $class ?>" href="javascript:"><?php echo ucfirst($value->status) ?></a>
			<?php }else{ ?>
				<button class="btn bg-gradient-<?php echo $class ?> dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
					<?php echo ucfirst($value->status) ?>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<li><a class="dropdown-item" href="javascript:" onClick="changeSatus(<?php echo $value->id ?>,'Redeem')">Redeem</a></li>
				</ul>
			<?php } ?>
			</div>
		</td>
		<td><?php echo date("d-m-Y", strtotime($value->created_at)) ?></td>

	</tr>
	<?php }} else {?>
	<tr>
		<td colspan="10"><div class="alert alert-warning" role="alert" style="text-align: center;">
			No Records Found !!
		</div>
	</tr>
	<?php }?>
