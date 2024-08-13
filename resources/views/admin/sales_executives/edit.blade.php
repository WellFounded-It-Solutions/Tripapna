@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Sales Executive</h2>
    <form id="editSalesExecutiveForm">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $salesExecutive->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $salesExecutive->email }}" required>
        </div>
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" name="mobile" class="form-control" value="{{ $salesExecutive->mobile }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" class="form-control" required>{{ $salesExecutive->address }}</textarea>
        </div>
        <div class="form-group">
            <label for="id_proof">ID Proof</label>
            <input type="text" name="id_proof" class="form-control" value="{{ $salesExecutive->id_proof }}" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" class="form-control" value="{{ $salesExecutive->age }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

<script>
    $('#editSalesExecutiveForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('sales_executives.update', $salesExecutive->id) }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(data) {
                alert('Sales Executive updated successfully!');
                window.location.href = "{{ route('sales_executives.index') }}";
            },
            error: function(xhr) {
                alert('An error occurred while updating the Sales Executive.');
            }
        });
    });
</script>
@endsection
