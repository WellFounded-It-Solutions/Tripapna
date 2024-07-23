@foreach($moduleRecords as $key => $value)
<tr>
		<td>{{ ++$key }}</td>
		<td>{{ $value->title }}</td>
		@foreach($value->permissions as $mpermission)    
			@php
				$check = checkPermissionforhotel($id,$mpermission->id,auth()->user()->id);		
			@endphp
			<td>
				<div class="custom-control custom-checkbox">
					<input class="custom-control-input" type="checkbox" id="customCheckbox2{{ $mpermission->id }}" name="permission[]"  @if($check) checked @endif  value="{{ $mpermission->id }}">
					<label for="customCheckbox2{{ $mpermission->id }}" class="custom-control-label">{{ $mpermission->name }}</label>
				</div>
			</td>
		@endforeach    
	</tr>
@endforeach