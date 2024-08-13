@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Sales Executive</h2>
    <form id="createSalesExecutiveForm">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" name="mobile" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="id_proof">ID Proof</label>
            <input type="text" name="id_proof" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<script>
    $('#createSalesExecutiveForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('sales_executives.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(data) {
                alert('Sales Executive created successfully!');
                window.location.href = "{{ route('sales_executives.index') }}";
            },
            error: function(xhr) {
                alert('An error occurred while creating the Sales Executive.');
            }
        });
    });
</script>
@endsection
