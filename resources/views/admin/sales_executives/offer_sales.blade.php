@extends('layouts.admin_design')
@section('content')

<style>
    .form-group label {
        font-weight: 500;
        margin-bottom: 8px;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .select2-container {
        width: 100% !important;
    }
    .btn-submit-container {
        margin-top: 1.5rem;
        text-align: right;
    }
    .form-control {
        border-radius: 4px;
    }
    .content-wrapper {
        background-color: #f8f9fa;
        padding: 2rem;
    }
    .content-header h1 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #343a40;
    }
    @media (max-width: 768px) {
        .btn-submit-container {
            text-align: center;
        }
    }
</style>

<div class="content-wrapper">
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('sales_boy_offers.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="offer">Offer Name</label>
                                <input type="text" name="offer" id="offer" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="boy_id">Select Sales Boy</label>
                                <select class="form-control select2" name="package_id[]" id="boy_id" required>
                                    <option value="">Select</option>
                                    @foreach ($assignedPackages as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="commission">Commission (%)</label>
                                <input type="number" name="commission" id="commission" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="automatic_credit_commission">Automatic Credit Commission</label>
                                <select name="automatic_credit_commission" id="automatic_credit_commission" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="package_id">Assign Package to Sales Executive</label>
                                <select class="form-control select2" name="package_id[]" id="package_id" multiple="multiple" required>
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="btn-submit-container">
                                <button type="submit" class="btn btn-success px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            let assignedPackages = @json($assignedPackages);

            function updatePackageOptions() {
                let selectedBoyId = $('#boy_id').val();
                let selectedBoy = assignedPackages.find(boy => boy.id == selectedBoyId);

                let $packageDropdown = $('#package_id');
                $packageDropdown.empty().append('<option value="">Select</option>');

                if (selectedBoy) {
                    console.log(selectedBoy);
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