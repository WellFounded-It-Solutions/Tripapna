<table class="table table-striped">
      <tr>
         <th>Title</th>
         <td>{{ $records->title }}</td>
      </tr>
      <tr>
         <th>Limit</th>
         <td>{{ $records->limit }}</td>
      </tr>
      <tr>
         <th>Amount</th>
         <td>{{ $records->amount }}</td>
      </tr>
      <tr>
         <th>Valid Date</th>
         <td>{{ $records->valid_date }}</td>
      </tr>
      <tr>
         <th>Task</th>
         <td>{{ $records->title }}</td>
      </tr>
      <tr>
         <th>Description</th>
         <td>{{ $records->description }}</td>
      </tr>
      <tr>
         <th>Term and Conditions</th>
         <td>{{ $records->term_conditions }}</td>
      </tr>
      @php $data = getPackageDetails($records->id);  @endphp
      
      <tr>
         <th>Hotel</th>
         <td>{{ $data->hotel->name }}</td>
      </tr>
      <tr>
         <th>Coupon</th>
         <?php 
         $details = getPackageDetailsWithCoupon($records->id);
         ?>
           
         <td>
            @foreach($details as $val) 
                @php $cdetail = couponDetails($val->coupon_id)  @endphp
                 <small class="mb-0 text-sm"> {{ $cdetail->title }} | </small>
            @endforeach
        </td>
      </tr>
</table>