@extends('layouts.admin_design')
@section('content')
<div class="content-wrapper pl-3 pb-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Track Sales</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row pl-2">
            <div class="col-md-8">
                <h3>Filter:</h3>
                <form action="{{ route('sales_boy_offers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Enter the Sales Boy Name</label>
                        <input type="text" name="offer" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Filter</button>
                </form>
            </div>
        </div>
        <div>
            <table class="card-body table table-bordered">
                <thead>
                    <tr>
                        <th>SrNo</th>
                        <th>Package Name</th>
                        <th>Customer Name</th>
                        <th>Sales Boy Name</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Complete</th>
                    </tr>
                </thead>
                {{-- <tbody>
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
                </tbody> --}}
            </table>
        </div>
    </section>
</div>
@endsection
