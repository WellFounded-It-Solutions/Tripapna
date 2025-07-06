@extends('user.layouts.app_layout')

@section('title', 'Coming Soon')
@section('description', 'Something exciting is coming soon! Stay tuned for updates.')
@section('keywords', 'Coming Soon, Updates, New Features')
@section('canonical', url('/coming-soon'))

@section('content')

<div class="page-title-area" style="background-image: url();">
    <div class="container">
        <h1>Coming Soon</h1>
    </div>
</div>

<div class="coming-soon-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12 text-center">
                <h2>Something Awesome Is On Its Way!</h2>
                <p>We're working on something new and exciting. Stay tuned for updates and be the first to experience it!</p>
                <div class="mt-4">
                    <a href="{{ url('/') }}" class="btn btn-secondary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection