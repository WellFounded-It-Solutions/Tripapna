@extends('layouts.admin_design')
@section('title', 'Create Promo Code')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Promo Code</h1>
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
                            <h3 class="card-title">Add New Promo Code</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('promocode_store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="promo_code">Promo Code</label>
                                    <input type="text" class="form-control" id="promo_code" name="promo_code" value="{{ old('promo_code') }}" placeholder="Enter promo code">
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount Amount</label>
                                    <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}" placeholder="Enter discount amount">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('promocode_list') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection