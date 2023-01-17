<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} - {{ $title ?? '' }}</title>

    <meta name="robots" content="noindex">

    <link type="text/css" href="{{ resellerAsset('vendor/spinkit.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ resellerAsset('vendor/perfect-scrollbar.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ resellerAsset('css/material-icons.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ resellerAsset('css/fontawesome.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ resellerAsset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ resellerAsset('vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ resellerAsset('css/select2.css') }}" rel="stylesheet">

    <script src="{{ resellerAsset('vendor/jquery.min.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">

    @livewireStyles
    @powerGridStyles
    @stack('header')
</head>

<body class="layout-boxed">

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <x-reseller.views.header />
            @yield('content')
            <x-reseller.views.footer />
        </div>
        <x-reseller.views.sidebar />
        @stack('modals')
    </div>

    <script src="{{ resellerAsset('vendor/popper.min.js') }}"></script>
    <script src="{{ resellerAsset('vendor/bootstrap.min.js') }}"></script>
    <script src="{{ resellerAsset('vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ resellerAsset('vendor/dom-factory.js') }}"></script>
    <script src="{{ resellerAsset('vendor/material-design-kit.js') }}"></script>
    <script src="{{ resellerAsset('js/app.js') }}"></script>
    {{-- <script src="{{ resellerAsset('js/preloader.js') }}"></script> --}}
    <script src="{{ resellerAsset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ resellerAsset('js/select2.js') }}"></script>
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireScripts
    @powerGridScripts

    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
        @csrf
    </form>
    @stack('footer')
</body>

</html>
