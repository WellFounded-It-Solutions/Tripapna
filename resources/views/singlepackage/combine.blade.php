@extends('layouts.admin_design')
@section('title','Coupon Categories')
@section('content')
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
{{-- {{ dump(vars: $coupons) }} --}}

<div class="content-wrapper ">
    <div class="container-fluid">
        <h2 class="p-3">Combine Coupon</h2>
    <div>
      <form method="POST" action="{{ route('coupon-combinations') }}" class="d-flex flex-column p-3">
        @csrf
        @foreach ($coupons as $coupon)
        <div class="form-group mb-4">
            <select class="form-select" disabled>
                <option selected value="{{ $coupon->id }}">{{ $coupon->title }}</option>
            </select>
    
            {{-- Hidden fields for coupon ID and package ID --}}
            <input type="hidden" name="coupons[{{ $coupon->id }}][coupon_id]" value="{{ $coupon->id }}">
            <input type="hidden" name="coupons[{{ $coupon->id }}][package_id]" value="{{ $coupons->package_id }}">
    
            <label>Cannot Combine With</label>
            <select class="form-control select4" multiple name="coupons[{{ $coupon->id }}][cannot_combine_ids][]">
                @foreach ($coupons as $otherCoupon)
                    @if ($otherCoupon->id !== $coupon->id)
                        <option value="{{ $otherCoupon->id }}">{{ $otherCoupon->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    @endforeach
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>
  </div>

@endif
@endsection
