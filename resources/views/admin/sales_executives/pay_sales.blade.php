@extends('layouts.admin_design')

@section('content')
<div class="content-wrapper pl-3 pb-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment Status</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Form -->
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('sales_executive_payment') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by sales boy name or email" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Payment Status Table -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SrNo</th>
                        <th>Sales Boy Name</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Complete</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = ($salesExecutives->currentPage() - 1) * $salesExecutives->perPage() + 1; @endphp
                    @forelse ($salesExecutives as $salesExecutive)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $salesExecutive->name }}</td>
                            <td>{{ number_format($salesExecutive->wallet_amount ?? 0, 2) }}</td>
                            <td>Cash</td> <!-- Assuming cash as default; adjust as needed -->
                            <td>
                                @if($salesExecutive->wallet_amount > 0)
                                    <a href="{{ route('sales_executive.pay', $salesExecutive->id) }}" 
                                       class="btn btn-sm btn-danger pay-btn"
                                       onclick="return confirm('Are you sure you want to deduct the entire amount ({{ number_format($salesExecutive->wallet_amount, 2) }}) from {{ $salesExecutive->name }}\'s wallet?')">
                                       Pay
                                    </a>
                                @else
                                    <span class="badge bg-success">Noting to Pay</span>
                                @endif
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No sales executives found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $salesExecutives->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Enhanced confirmation for payment
    document.querySelectorAll('.pay-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            const amountMatch = this.textContent.match(/\d+\.?\d*/);
            const nameMatch = this.textContent.match(/from (.+?)'s/);
            const amount = amountMatch ? amountMatch[0] : '0';
            const name = nameMatch ? nameMatch[1] : 'this sales executive';
            if (confirm(`Are you sure you want to deduct the entire amount (${amount}) from ${name}'s wallet?`)) {
                window.location.href = href;
            }
        });
    });
</script>
@endpush