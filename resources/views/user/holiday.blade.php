@extends('user.layouts.app_layout')

@section('title', 'Customize Your Holiday')
@section('description', 'Plan your perfect holiday with us.')
@section('keywords', 'Holiday, Custom Holiday, Travel Package')
@section('canonical', url('/holiday'))

@section('content')

<div class="container py-5">
    
    <h2 class="mb-4">Customize Your Holiday</h2>
    <form action="{{ route('holiday.request.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Full Name *</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number *</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="col-md-6">
                <label for="destination" class="form-label">Preferred Destination *</label>
                <input type="text" class="form-control" id="destination" name="destination" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="travel_date" class="form-label">Travel Date *</label>
                <input type="date" class="form-control" id="travel_date" name="travel_date" required>
            </div>
            <div class="col-md-6">
                <label for="duration" class="form-label">Duration (in days) *</label>
                <input type="number" class="form-control" id="duration" name="duration" min="1" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="travelers" class="form-label">Number of Travelers *</label>
            <input type="number" class="form-control" id="travelers" name="travelers" min="1" required>
        </div>
        <div class="mb-3">
            <label for="budget" class="form-label">Budget (INR) *</label>
            <input type="number" class="form-control" id="budget" name="budget" min="0" required>
        </div>
        <div class="mb-3">
            <label for="preferences" class="form-label">Travel Preferences</label>
            <textarea class="form-control" id="preferences" name="preferences" rows="4" placeholder="E.g., Adventure, Relaxation, Cultural Experiences"></textarea>
        </div>
     
        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</div>
@endsection
