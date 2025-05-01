<div class="card">
   <div class="card-header">
      <h3 class="card-title"></h3>
   </div>
   <div class="card-body p-0">
      
      @php $parray = array(); @endphp
         @forelse ($records->orderPackageDetails  as $val )
         @php 
         
           // pr($val);
            $package = json_decode($val->package_log);
            $order_details = getorderDetails($package->id,$records->id);
            
         @endphp
         <?php  
            if (!in_array($package->id,$parray)) {
               array_push($parray,$package->id);
          ?>
               <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Package : {{ $package->title }}</h3>
                  <div class="card-tools">
                     <!-- Collapse Button -->
                     <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
                  <!-- /.card-tools -->
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table class="table table-sm">
         <thead>
            <tr>
               <th style="width: 10px">#</th>
               <th>Coupon Title</th>
               <th>Coupon Code </th>
               <th>Hotel</th>
               <th>Valid Date</th>
               <th>Visit Type</th>
               <th style="width: 40px">Status</th>
            </tr>
         </thead>
         <tbody>
            @php $i=1; @endphp
            @forelse ($order_details  as $val )
            @php 
            $coupon_data = json_decode($val->coupon_data);
            $hotal_Data = json_decode($val->hotel_data);
             @endphp
               <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $coupon_data->title }}</td>
                  <td>{{ $coupon_data->custom_coupon_id }}</td>
                  <td>
                     <i class="fas fa-hotel"></i>&nbsp; {{ $hotal_Data->name }} <br/>
                     <i class="fas fa-map-marker"></i>&nbsp; {{ $hotal_Data->location }} <br/>
                     <i class="fas fa-mobile"></i>&nbsp; {{ $hotal_Data->mobile }} <br/>
                  </td> 
                  <td>{{ $val->valid_date }}</td>
                  <td>{{ $val->visit_type }}</td>
                  <td><span class="badge @if($val->status=="Pending") bg-info @else bg-success @endif">{{ $val->status }}</span></td>
               </tr>
               @php $i++; @endphp
            @empty
               
            @endforelse

         </tbody>
      </table>
               </div>
               <!-- /.card-body -->
               </div>
               <?php  } ?>
                 @empty
            @endforelse   
   </div>
</div>