<!DOCTYPE html>
<html lang="en"
    data-layout="vertical"
    data-topbar="light"
    data-sidebar="light"
    data-sidebar-size="lg"
    data-sidebar-image="none"
    data-preloader="disable"
    data-theme="classic"
    data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>@yield('title','Winngoo Coin - Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/images/coin-globe.png') }}">

    <!-- CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>

{{-- AUTH CONTENT --}}
@yield('content')

{{-- JS --}}
<script src="{{ asset('assets/js/layout.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
     <script src="{{asset('assets/js/pages/password-addon.init.js')}}"></script>
     <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>


@stack('scripts')

</body>
</html>