@extends('layouts.admin_error')
@section('title','404')
@section('content')
<div style="min-height: 1604.54px;">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                    <h1>404 Error Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">404 Error Page</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
            <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
            <p>
            We could not find the page you were looking for.
            Meanwhile, you may return to Login
            </p>
        </div>
    </div>
</section>
</div>
@endsection