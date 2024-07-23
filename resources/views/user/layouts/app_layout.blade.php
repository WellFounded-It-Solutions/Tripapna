<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('user/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/toastr.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"  />
</head>

<body>

    @include('user.layouts.topheader')
    @include('user.layouts.header')

    @yield('content')

    @include('user.layouts.footer')

    @include('user.layouts.scripts')

    @yield('scripts')

</body>

</html>
