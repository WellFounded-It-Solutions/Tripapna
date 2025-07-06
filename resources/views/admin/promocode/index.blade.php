@extends('layouts.admin_design')
@section('title', 'Promo Codes')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $page_name }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <button type="button" class="btn btn-info mb-3" onclick="window.location.href='{{ route('promocode_new') }}'">Create Promo Code</button>
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="callout callout-info">
                        <form action="{{ route('promocode_list') }}" method="GET">
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" class="form-control" name="title" placeholder="Search by promo code" value="{{ $title }}">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-info">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Promo Codes</h3>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 600px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Promo Code</th>
                                        <th>Discount</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promocodes as $promocode)
                                        <tr>
                                            <td>{{ $promocode->promo_code }}</td>
                                            <td>{{ $promocode->discount }}</td>
                                            <td>{{ $promocode->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>
                                                <form action="{{ route('promocode_delete', $promocode->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this promo code?');" data-toggle="tooltip" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $promocodes->appends(['title' => $title])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("[data-toggle='tooltip']").tooltip();
    });
</script>
@endpush