@extends('user.layouts.app_layout')

@section('title', '{{ ucfirst($response["data"]["title"] ?? "Holiday Package") }} - Holiday Package Details')
@section('description', 'Discover details of {{ ucfirst($response["data"]["title"] ?? "a holiday package") }}.')
@section('keywords', 'Holiday Package, {{ ucfirst($response["data"]["title"] ?? "Travel") }}, Travel, Vacation')
@section('canonical', url('/holiday-package-details/' . ($response["data"]["id"] ?? 0)))

@section('content')

<div class="page-title-area" style="background-image: url();">
    <div class="container">
        <h1>{{ ucfirst($response['data']['title'] ?? 'Holiday Package') }}</h1>
    </div>
</div>

<div class="container py-5">
    @if(!$response['success'])
    <div class="alert alert-danger text-center">
        {{ $response['message'] ?? 'Unable to load package details.' }}
    </div>
    @elseif(!empty($response['data']))
    <div class="row">
        <div class="col-lg-6">
            <img src="{{ !empty($response['data']['image']) ? url('/package/' . $response['data']['image']) : asset('images/placeholder.jpg') }}" alt="{{ $response['data']['title'] ?? 'Package' }}" class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
        </div>
        <div class="col-lg-6">
            <h2 class="mb-3">{{ ucfirst($response['data']['title'] ?? 'N/A') }}</h2>
            <p><strong>Amount:</strong> ₹{{ number_format($response['data']['amount'] ?? 0, 2) }}</p>
            <p><strong>Discount:</strong> {{ !empty($response['data']['discount']) ? $response['data']['discount'] . '%' : 'None' }}</p>
            <p><strong>Valid Until:</strong> {{ !empty($response['data']['valid_date']) ? date('d-m-Y', strtotime($response['data']['valid_date'])) : (!empty($response['data']['variable_month']) ? $response['data']['variable_month'] . ' Months' : 'N/A') }}</p>
            <p><strong>Limit:</strong> {{ $response['data']['limit'] ?? 0 }} bookings</p>
            <p><strong>Status:</strong> {{ ucfirst($response['data']['status'] ?? 'N/A') }}</p>
            <a href="{{ url('/holiday/customize') }}" class="btn btn-primary mt-3">Customize This Package</a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <h3>Description</h3>
            <p>{!! $response['data']['description'] ?? 'No description available.' !!}</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <h3>Terms and Conditions</h3>
            <p>{!! $response['data']['term_conditions'] ?? 'No terms available.' !!}</p>
        </div>
    </div>
    @if(!empty($response['items']))
    <div class="row mt-4">
        <div class="col-12">
            <h3>Available Coupons</h3>
            <ul class="list-unstyled">
                @foreach($response['items'] as $item)
                @php $coupon = !empty($item['coupon_id']) ? couponDetails($item['coupon_id']) : null @endphp
                @if($coupon)
                <li><span class="badge badge-primary">{{ ucfirst($coupon->title ?? 'N/A') }}</span></li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if(!empty($response['items']))
    <div class="row mt-4">
        <div class="col-12">
            <h3>Hotel</h3>
            @php $hotel = !empty($response['items'][0]['hotel_id']) ? hotelDetails($response['items'][0]['hotel_id']) : null @endphp
            <p>{{ ucfirst($hotel->name ?? 'N/A') }}</p>
        </div>
    </div>
    @endif
    @if(!empty($response['items']))
    <div class="row mt-4">
        <div class="col-12">
            <h3>Package Items</h3>
            <ul class="list-unstyled">
                @foreach($response['items'] as $item)
                <li>
                    <strong>Coupon:</strong> {{ !empty($item['coupon_id']) ? couponDetails($item['coupon_id'])->title : 'N/A' }} 
                    (Hotel: {{ !empty($item['hotel_id']) ? hotelDetails($item['hotel_id'])->name : 'N/A' }}, 
                    Category: {{ !empty($item['category_id']) ? categoryDetails($item['category_id'])->title : 'N/A' }})
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @else
    <div class="alert alert-warning text-center">
        Package not found.
    </div>
    @endif
</div>

@endsection