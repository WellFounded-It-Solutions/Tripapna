@extends('user.layouts.app_layout')

@section('title', 'Holiday Packages')
@section('description', 'Explore our curated holiday packages.')
@section('keywords', 'Holiday Packages, Travel, Vacation')
@section('canonical', url('/holiday-packages'))

@section('content')

<div class="page-title-area" style="background-image: url();">
    <div class="container">
        <h1>Holiday Packages</h1>
    </div>
</div>

<div class="popular-store-area ptb-100">
    <div class="container">
        <div class="popular-store-list">
            <div class="row">
                @forelse($holidayPackages as $package)
                <div class="col-lg-3 col-sm-4 col-6 col-md-4">
                    <div class="item text-center mb-4">
                        <a href="{{ url('/holiday-package-details') }}/{{ $package->id }}">
                            <img src="{{ url('/package') }}/{{ $package->image }}" alt="{{ $package->title }}" style="max-height: 150px; width: 100%; object-fit: cover;">
                            <h5 class="mt-2">{{ ucfirst($package->title) }}</h5>
                        </a>
                        <a href="{{ url('/holiday/customize') }}" class="btn btn-primary btn-sm mt-2">Customize</a>
                    </div>
                </div>
                @empty
                <div class="col-lg-12 col-sm-12 col-12 col-md-12">
                    <h2 class="error text-danger text-center">*No packages found</h2>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection