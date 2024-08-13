@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sales Executive Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>Name:</th>
            <td>{{ $salesExecutive->name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $salesExecutive->email }}</td>
        </tr>
        <tr>
            <th>Mobile:</th>
            <td>{{ $salesExecutive->mobile }}</td>
        </tr>
        <tr>
            <th>Address:</th>
            <td>{{ $salesExecutive->address }}</td>
        </tr>
        <tr>
            <th>ID Proof:</th>
            <td>{{ $salesExecutive->id_proof }}</td>
        </tr>
        <tr>
            <th>Age:</th>
            <td>{{ $salesExecutive->age }}</td>
        </tr>
    </table>
    <a href="{{ route('sales_executives.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
