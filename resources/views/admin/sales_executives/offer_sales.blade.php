@extends('layouts.admin_design')
@section('content')
<div class="content-wrapper pl-3 pb-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Sales Boy Offer</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('sales_boy_offers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Offer Name</label>
                        <input type="text" name="offer" class="form-control" required>
                    </div>
                    <div class="form-group col">
                        <label for="fname" class=" text-right control-label col-form-label">Select Sales Boy</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="package_id[]" id="boy_id" required>
                                <option value="">Select</option>
                                @foreach ( $assignedPackage as $package )
                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Commission (%)</label>
                        <input type="number" name="commission" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Automatic Credit Commission</label>
                        <select name="automatic_credit_commission" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group col">
                        <label for="fname" class=" text-right control-label col-form-label">Assign Package to Sales Executive</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="package_id[]" id="package_id"multiple="multiple" required>
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            let assignedPackages = @json($assignedPackage); // Convert Laravel variable to JSON

function updatePackageOptions() {
    let selectedBoyId = $('#boy_id').val();
    let selectedBoy = assignedPackages.find(boy => boy.id == selectedBoyId);

    let $packageDropdown = $('#package_id');
    $packageDropdown.empty().append('<option value="">Select</option>');

    if (selectedBoy) {
        let packageIds = selectedBoy.package_id.split(',').map(id => Number(id.trim()));
        packageIds.forEach(id => {
            $packageDropdown.append(`<option value="${id}">${id}</option>`);
        });
    }
}

$('#boy_id').on('change', updatePackageOptions);

updatePackageOptions();
        });
    </script>
</div>
@endsection
