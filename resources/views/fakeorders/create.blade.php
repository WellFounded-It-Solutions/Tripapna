@extends('layouts.admin_design')
@section('title', 'Create Fake Order')
@section('content')
<div class="content-wrapper pl-3 pb-2">
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Fake Order</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('fakeorder_store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_id">User ID (Random, Unique)</label>
                                            <input type="number" class="form-control" id="user_id" name="user_id" value="{{ old('user_id') }}" min="1" required>
                                            <small class="form-text text-muted">Enter a unique ID not already used in orders.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">User Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="trans_id">Transaction ID</label>
                                            <input type="text" class="form-control" id="trans_id" name="trans_id" value="{{ old('trans_id', 'txn_' . rand(111111, 999999)) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Order Type</label>
                                            <select class="form-control" id="type" name="type" required onchange="toggleFields()">
                                                <option value="package" {{ old('type') == 'package' ? 'selected' : '' }}>Package</option>
                                                <option value="coupon" {{ old('type') == 'coupon' ? 'selected' : '' }}>Coupon</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="package_field">
                                            <label for="package_id">Package</label>
                                            <select class="form-control" id="package_id" name="package_id">
                                                <option value="">Select Package</option>
                                                @foreach ($packages as $package)
                                                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>{{ $package->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group" id="coupon_field" style="display: none;">
                                            <label for="coupon_id">Coupon</label>
                                            <select class="form-control" id="coupon_id" name="coupon_id">
                                                <option value="">Select Coupon</option>
                                                @foreach ($coupons as $coupon)
                                                    <option value="{{ $coupon->id }}" {{ old('coupon_id') == $coupon->id ? 'selected' : '' }}>{{ $coupon->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="hotel_id">Hotel</label>
                                            <select class="form-control" id="hotel_id" name="hotel_id" required>
                                                <option value="">Select Hotel</option>
                                                @foreach ($hotels as $hotel)
                                                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', 0) }}" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="visit_type">Visit Type</label>
                                            <input type="number" class="form-control" id="visit_type" name="visit_type" value="{{ old('visit_type', 1) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="valid_date">Valid Date</label>
                                            <input type="date" class="form-control" id="valid_date" name="valid_date" value="{{ old('valid_date', \Carbon\Carbon::now()->addYears(5)->format('Y-m-d')) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Redeem" {{ old('status') == 'Redeem' ? 'selected' : '' }}>Redeem</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category ID (Optional)</label>
                                            <input type="number" class="form-control" id="category_id" name="category_id" value="{{ old('category_id') }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Create Order</button>
                                <a href="{{ route('administrator_fakeorder') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
    function toggleFields() {
        var type = document.getElementById('type').value;
        document.getElementById('package_field').style.display = type === 'package' ? 'block' : 'none';
        document.getElementById('coupon_field').style.display = type === 'coupon' ? 'block' : 'none';
    }
    // Run on page load to set initial state
    toggleFields();
</script>
@endpush