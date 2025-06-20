@extends('layouts.admin_design')
@section('title', 'Create Fake Order')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $page_name }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Fake Order</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('fakeorder_store') }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label text-right">Customer Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter customer name" value="{{ old('name') }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label text-right">Customer Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter customer email" value="{{ old('email') }}">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-3 col-form-label text-right">Customer Mobile</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter customer mobile" value="{{ old('mobile') }}">
                                        @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="trans_id" class="col-sm-3 col-form-label text-right">Transaction ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="trans_id" name="trans_id" placeholder="Enter transaction ID" value="{{ old('trans_id') }}">
                                        @error('trans_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 col-form-label text-right">Type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="type" name="type" onchange="toggleFields()">
                                            <option value="package" {{ old('type') == 'package' ? 'selected' : '' }}>Package</option>
                                            <option value="coupon" {{ old('type') == 'coupon' ? 'selected' : '' }}>Coupon</option>
                                        </select>
                                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row" id="package_field">
                                    <label for="package_id" class="col-sm-3 col-form-label text-right">Package</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="package_id" name="package_id">
                                            <option value="">Select Package</option>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>{{ $package->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('package_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row" id="coupon_field" style="display: none;">
                                    <label for="coupon_id" class="col-sm-3 col-form-label text-right">Coupon</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="coupon_id" name="coupon_id">
                                            <option value="">Select Coupon</option>
                                            @foreach ($coupons as $coupon)
                                                <option value="{{ $coupon->id }}" {{ old('coupon_id') == $coupon->id ? 'selected' : '' }}>{{ $coupon->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('coupon_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="hotel_id" class="col-sm-3 col-form-label text-right">Hotel</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="hotel_id" name="hotel_id">
                                            <option value="">Select Hotel</option>
                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('hotel_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="amount" class="col-sm-3 col-form-label text-right">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" value="{{ old('amount') }}">
                                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="visit_type" class="col-sm-3 col-form-label text-right">Visit Type</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="visit_type" name="visit_type" placeholder="Enter visit type" value="{{ old('visit_type') }}">
                                        @error('visit_type') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valid_date" class="col-sm-3 col-form-label text-right">Valid Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="valid_date" name="valid_date" value="{{ old('valid_date') }}">
                                        @error('valid_date') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label text-right">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="status" name="status">
                                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Redeem" {{ old('status') == 'Redeem' ? 'selected' : '' }}>Redeem</option>
                                        </select>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label text-right">Category ID (Optional)</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="category_id" name="category_id" placeholder="Enter category ID" value="{{ old('category_id') }}">
                                        @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-info">Create Fake Order</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function toggleFields() {
        var type = document.getElementById('type').value;
        document.getElementById('package_field').style.display = type === 'package' ? 'flex' : 'none';
        document.getElementById('coupon_field').style.display = type === 'coupon' ? 'flex' : 'none';
    }
    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection