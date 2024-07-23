                        @foreach($items as $key => $value)
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel</label>
                                <div class="col-sm-9">
                                    <select class="form-control" data-placeholder="Select a Category" name="hotel_id[]" id="uhotel_id">
                                        <option value="">Select</option>
                                        @foreach($hotelRecord as $val)    
                                            <option value="{{ $val->id }}" @if($value->hotel_id == $val->id) selected="selected"  @endif >{{ ucfirst($val->name) }}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" data-placeholder="Select a Category" name="category_id[]" id="category_id" onchange="getCoupon(this,0)">
                                        <option value="">Select</option>
                                        @foreach($Categories as $val)    
                                            <option value="{{ $val->id }}" @if($value->category_id == $val->id) selected="selected"  @endif>{{ ucfirst($val->title) }}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon</label>
                                <div class="col-sm-9">
                                    <select class="form-control coupon_html0"  data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="coupon[]" id="category_id">
                                        <option value="">Select</option>
                                    @foreach($couponRecord as $val)    
                                        <option value="{{ $val->id }}"  @if($value->coupon_id == $val->id) selected="selected"  @endif>{{ ucfirst($val->title) }}</option>
                                    @endforeach    
                                </select>
                                    </select>
                                </div>
                            </div>
                            @if($key==0)
                            <div class="col-md-2">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                                <button type="button" name="add" id="dynamic-clone" class="btn btn-outline-primary">Add</button>
                            </div>
                            @else
                            <div class="col-md-2">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                                <button type="button" name="add"  class="btn btn-outline-danger remove-input-field">Remove</button>
                            </div>
                            @endif
                        </div>
                        @endforeach

                        <script>
                            var j = 0;
    $("#dynamic-clone").click(function () {
        ++j;
        // $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
        //     '][subject]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        //     );
        $("#cloneDiv").append('<div class="form-group row"><div class="col-sm-3"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Hotel</label><div class="col-sm-9"><select class="form-control" data-placeholder="Select a Category" name="hotel_id[]" id="uhotel_id"><option value="">Select</option>@foreach($hotelRecord as $val)<option value="{{ $val->id }}">{{ ucfirst($val->name) }}</option>@endforeach</select></div></div><div class="col-sm-3"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label><div class="col-sm-9"><select class="form-control" data-placeholder="Select a Category" name="category_id[]" id="category_id" onchange="getCoupon(this,'+j+')"><option value="">Select</option>@foreach($Categories as $val)<option value="{{ $val->id }}">{{ ucfirst($val->title) }}</option>@endforeach</select></div></div><div class="col-sm-4"><label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon</label><div class="col-sm-9"><select class="form-control coupon_html'+j+'"  data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="coupon[]" id="category_id"><option value="">Select</option></select></div></div> <div class="col-md-2"> <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label> <button type="button" name="add"  class="btn btn-outline-danger remove-input-field">Remove</button></div></div>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).closest(".form-group").remove();
    });
    </script>