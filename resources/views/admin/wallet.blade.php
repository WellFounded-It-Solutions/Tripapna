@extends('layouts.admin_design')
@section('content')
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
<div class="content-wrapper">
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="card-title">Wallet Management</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Search Form -->
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Search</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('administrator_wallet') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by user name, email, or amount" value="{{ request()->input('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                {{-- </form> --}}
            </div>
        </div>

        <!-- Wallet List --> 
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payoffs</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Wallet Amount</th>
                            <th>Updated At</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = ($wallets->currentPage() - 1) * $wallets->perPage() + 1; @endphp
                        @foreach ($wallets as $wallet)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{ $wallet->name ?? 'N/A' }}</td>
                                <td>{{ $wallet->email ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $wallet->role == 1 ? 'active' : 'bg-info' }}">
                                        {{ $wallet->role == 1 ? 'Admin' : 'User' }}
                                    </span>
                                </td>
                                <td>{{ number_format($wallet->wallet_amount, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($wallet->updated_at)->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    @if($wallet->wallet_amount > 0)
                                        <a href="{{ route('administrator_wallet_pay', $wallet->id) }}" 
                                           class="btn btn-sm btn-danger pay-btn"
                                           onclick="return confirm('Are you sure you want to deduct the entire amount ({{ number_format($wallet->wallet_amount, 2)}} from this wallet?') "
                                        >Pay
                                        </a>
                                    @else
                                        <span class="text-muted">No Balance</span>
                                    @endif
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                            <tr>
                                <td colspan="7" class="text-center">No wallets found.</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $wallets->links() }}
            </div>
        </div>
    </div>
</section>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    // Additional JavaScript for confirmation
    document.querySelectorAll('.pay-btn').forEach(button => {
        button.addEventListener('click', function(e) => {
            e.preventDefault();
            const href = this.getAttribute('href');
            const amount = this.textContent.match(/[\d+\.?\d*)$/)[0];
            if (confirm(`Confirm deduction of ${amount} from wallet?`)) {
                window.location.href = href;
            }
        });
    });
</script>
@endpush
@endif