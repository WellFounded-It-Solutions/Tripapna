@extends('layouts.admin_design')
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
@section('content')
<div class="content-wrapper pl-3">
    <h1>Sales Executives</h1>
    <a href="{{ route('sales_executives.create') }}" class="btn btn-primary mb-3">Add New</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <table class="card-body table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesExecutives as $salesExecutive)
                <tr>
                    <td>{{ $salesExecutive->name }}</td>
                    <td>{{ $salesExecutive->email }}</td>
                    <td>{{ $salesExecutive->mobile }}</td>
                    <td>
                        <a href="{{ route('sales_executives.show', $salesExecutive->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('sales_executives.destroy', $salesExecutive->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endif
@endsection
