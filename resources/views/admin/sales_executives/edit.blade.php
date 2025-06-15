@extends('layouts.admin_design')
@section('content')
<style>
    .content-wrapper {
        background-color: #f8f9fa;
        padding: 2rem;
    }
    .content-header h1 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 1.5rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group label {
        font-weight: 500;
        margin-bottom: 8px;
    }
    .form-control, .form-select {
        border-radius: 4px;
    }
    .select2-container {
        width: 100% !important;
    }
    .btn-submit-container {
        margin-top: 1.5rem;
        text-align: right;
    }
    @media (max-width: 768px) {
        .btn-submit-container {
            text-align: center;
        }
    }
</style>

@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Update Sales Executive</h1>
        </div>
    </section>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('sales_executives.update', $salesExecutive->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $salesExecutive->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $salesExecutive->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" name="age" id="age" class="form-control" value="{{ $salesExecutive->age }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $salesExecutive->address }}" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $salesExecutive->mobile }}" required>
                            </div>
                            <div class="form-group">
                                <label for="id_proof">ID Proof</label>
                                <input type="text" name="id_proof" id="id_proof" class="form-control" value="{{ $salesExecutive->id_proof }}" required>
                            </div>
                            <div class="form-group">
                                <label for="pay_status">Payment Type</label>
                                <select class="form-control form-select" name="pay_status" id="pay_status">
                                    <option value="">Choose</option>
                                    <option value="1" {{ $salesExecutive->pay_status == 1 ? 'selected' : '' }}>COD (Cash On Deposit)</option>
                                    <option value="2" {{ $salesExecutive->pay_status == 2 ? 'selected' : '' }}>Online Payment</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_package_id">Assign Package to Agent</label>
                                <select class="form-control select2" name="package_id[]" id="edit_package_id" multiple="multiple">
                                    @foreach ($assignPackage as $package)
                                        <option value="{{ $package->id }}" {{ in_array($package->id, $selectedPackages) ? 'selected' : '' }}>
                                            {{ $package->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="btn-submit-container">
                                <button type="submit" class="btn btn-success px-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endif
@endsection