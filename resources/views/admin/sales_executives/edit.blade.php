@extends('layouts.admin_design')
@section('content')
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
<div class="content-wrapper pl-3">
    <h1>Sales Executives</h1>
   <div class="row">
    <div class="col-md-8">
    <form action="{{ route('sales_executives.update', $salesExecutive->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $salesExecutive->name }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $salesExecutive->email }}" readonly>
        </div>
        <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="{{ $salesExecutive->age }}" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ $salesExecutive->address }}" required>
        </div>
        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control" value="{{ $salesExecutive->mobile }}" required>
        </div>
        <div class="form-group">
            <label>ID Proof</label>
            <input type="text" name="id_proof" class="form-control" value="{{ $salesExecutive->id_proof }}" required>
        </div>
        </div>
        <div class="form-group row">
            <label for="package_id" class="col-sm-3 text-right control-label col-form-label">Assign Package to Agent</label>
            <div class="col-sm-9">
                <select class="form-control select2" name="package_id[]" id="edit_package_id" multiple="multiple">
                    @foreach ($assignPackage as $package)
                        <option value="{{ $package->id }}" {{ in_array($package->id, $selectedPackages) ? 'selected' : '' }}>
                            {{ $package->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">        <button type="submit" class="btn btn-success">Update</button>
        </div>               
    </form>
</div>
</div>
</div>
@endif
@endsection






   

