<head>

    <meta http-equiv="refresh" content="1; url={{ route($link) }}">
</head>
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
<div class="content-wrapper">

    <div class="container">
        <div class="text-xs-center display-3">
            <div class="alert alert-success" role="alert">
                {{ $msg }}
            </div>
        </div>
    </div>
</div>

@include('layouts.footers.auth.footer')
</div>
@endsection