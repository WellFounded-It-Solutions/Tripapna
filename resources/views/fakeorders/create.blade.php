@extends('layouts.admin_design')
@section('title', 'Create Fake Order')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Fake Order</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('fakeorder_store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Customer Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Customer Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Customer Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" required>
                                </div>
                                <div class="form-group">
                                    <label for="package_id">Package</label>
                                    <select class="form-control" id="package_id" name="package_id" required>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="hotel_id">Hotel</label>
                                    <select class="form-control" id="hotel_id" name="hotel_id" required>
                                        @foreach($hotels as $hotel)
                                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection