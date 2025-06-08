@extends('layouts.admin_design')
@section('content')
{{-- {{ dd($invites) }} --}}
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
                        <th>Sales Boy ID</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invites as $index => $invite)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ ucfirst($invite->cart_type) ?? 'N/A' }}</td>
                            <td>{{ $invite->customer_name }}</td>
                            <td>{{ $invite->invite_sales_id ?? 'N/A' }}</td>
                            <td>{{ $invite->cart_amount }}</td>
                            <td>{{ $invite->payment_method ?? 'N/A' }}</td>
                            <td>{{ $invite->invite_status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
