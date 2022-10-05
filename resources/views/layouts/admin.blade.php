<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} - {{ $title ?? '' }}</title>

    <meta name="robots" content="noindex">

    <link type="text/css" href="{{ adminAsset('vendor/spinkit.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('vendor/perfect-scrollbar.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/material-icons.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/fontawesome.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/flatpickr.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/flatpickr-airbnb.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/custom.css') }}" rel="stylesheet">
    <script src="{{ adminAsset('vendor/jquery.min.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet" rel="preload" as="style">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap"
        rel="stylesheet" rel="preload" as="style" />
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" /> --}}

    @livewireScripts
    @livewireStyles

    <style>
        .sidebar-menu-text {
            text-align: center;
        }
    </style>

    @stack('header')
</head>

<body class="layout-compact layout-compact">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">
            <x-admin.views.header />
            @yield('content')
            <x-admin.views.footer />
        </div>
        <x-admin.views.sidebar />
    </div>

    <script src="{{ adminAsset('vendor/popper.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/bootstrap.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/dom-factory.js') }}"></script>
    <script src="{{ adminAsset('vendor/material-design-kit.js') }}"></script>
    <script src="{{ adminAsset('js/app.js') }}"></script>
    <script src="{{ adminAsset('js/preloader.js') }}"></script>
    <script src="{{ adminAsset('js/settings.js') }}"></script>
    <script src="{{ adminAsset('vendor/moment.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/moment-range.js') }}"></script>
    <script src="{{ adminAsset('vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ adminAsset('js/flatpickr.js') }}"></script>
    <script src="{{ adminAsset('vendor/Chart.min.js') }}"></script>
    <script src="{{ adminAsset('js/chartjs.js') }}"></script>
    <script src="{{ adminAsset('js/chartjs-rounded-bar.js') }}"></script>
    <script src="{{ adminAsset('js/page.ecommerce.js') }}"></script>
    <script src="{{ adminAsset('vendor/list.min.js') }}"></script>
    <script src="{{ adminAsset('js/list.js') }}"></script>
    <script src="{{ adminAsset('js/toggle-check-all.js') }}"></script>
    <script src="{{ adminAsset('js/check-selected-row.js') }}"></script>
    <script src="{{ adminAsset('js/sidebar-mini.js') }}"></script>

    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            'use strict';
            // ENABLE sidebar menu tabs
            $('.js-sidebar-mini-tabs [data-toggle="tab"]').on('click', function(e) {
                e.preventDefault()
                $(this).tab('show')
            })
            $('.js-sidebar-mini-tabs').on('show.bs.tab', function(e) {
                $('.js-sidebar-mini-tabs > .active').removeClass('active')
                $(e.target).parent().addClass('active')
            })
        })()
    </script>
    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
        @csrf
    </form>
    @stack('footer')
</body>

</html>
