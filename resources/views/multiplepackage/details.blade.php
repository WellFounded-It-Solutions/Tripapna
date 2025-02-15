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
      <tr><td colspan="2" align="center"> <strong>Hotels</strong></td></tr>
      @php $data = getPackageDetailsmultiple($records->id); 
       @endphp
         @foreach ($data as $hotelvalue )
          <tr>
               <th>
                  {{ $hotelvalue->hotel->name }}
               </th>
               <th>
               @php $datas = getPackageDetailsmultiplecoupon($records->id,$hotelvalue->hotel->id); @endphp
               @foreach($datas as $v)
                   @php $cdata = couponDetails($v->coupon_id)  @endphp
                  <small class="badge badge-primary">    {{ $cdata->title }}</small>
               @endforeach
               </th>
         </tr>
         @endforeach
</table>