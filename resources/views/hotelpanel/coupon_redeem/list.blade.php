
<?php
if (($records->count() > 0)) {
    foreach ($records as $key => $value) {
    	$singleOrder = geSingleOrder($value->order_id);
    	$hotel_data = isset($value->hotel_data) ? json_decode($value->hotel_data):'';
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
			<td><?php echo isset($singleOrder->order_id) ? ucfirst($singleOrder->order_id):'';?></td>
			<td>
				<i class="fas fa-user-tie"></i> &nbsp;<?php echo isset($singleOrder->user_name) ? $singleOrder->user_name:'';?><br />
				<i class="fas fa-mobile"></i> &nbsp; <?php echo isset($singleOrder->user_phone) ? $singleOrder->user_phone:'';?><br />
				<i class="fas fa-envelope"></i> &nbsp; <?php echo isset($singleOrder->user_email) ? $singleOrder->user_email:'';?><br />
			</td>
			<td><?php echo isset($hotel_data->amount) ? $hotel_data->amount:''; ?></td>
			<td><?php echo isset($singleOrder->trans_id) ? ucfirst($singleOrder->trans_id):'';?></td>


			<td>{{ $value->created_at->diffForHumans() }}</td>
		 	<td><ul class="list-unstyled d-flex mb-0">

				<li>

					<button type="button" class="btn btn-block btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Details" onClick="viewRecord(<?php echo $singleOrder->id ?>)">View Details</button>	
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