@extends('user.layouts.app_layout')

@section('content')

    @include('user.comp.homebanner')
    @include('user.comp.bestdeal')
    @include('user.comp.dealwithtabs')
    @include('user.comp.todays-hot-deals')
    @include('user.comp.popular-store')
    @include('user.comp.join-now')
    @include('user.comp.blog')
    @include('user.comp.why-choose-us')

@endsection
