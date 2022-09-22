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

    <style>
        .form {
            position: relative;
            z-index: 1;
            background: #ffffff;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgb(0 0 0 / 20%),
                0 5px 5px 0 rgb(0 0 0 / 24%);
        }
    </style>

</head>

<body class="layout-compact layout-compact"
    style="
    background-image: url(https://www.raffles.com/assets/0/72/76/103/1734/4e94f8d9-687e-4066-b1d2-282dabe66cef.jpg);
    background-size: cover;
    background-repeat: no-repeat;
">
    <div class="pt-32pt pt-sm-64pt pb-32pt mt-auto mb-auto">
        <div class="container page__container mt-auto mb-auto">
            @yield('content')
        </div>
    </div>
    <!-- Bootstrap -->
    <script defer src="{{ adminAsset('vendor/popper.min.js') }}"></script>
    <script defer src="{{ adminAsset('vendor/bootstrap.min.js') }}"></script>
    <script defer src="{{ adminAsset('vendor/perfect-scrollbar.min.js') }}"></script>
    <script defer src="{{ adminAsset('vendor/dom-factory.js') }}"></script>
    <script defer src="{{ adminAsset('vendor/material-design-kit.js') }}"></script>
    <script defer src="{{ adminAsset('js/app.js') }}"></script>
    <script defer src="{{ adminAsset('js/settings.js') }}"></script>
    <script defer src="{{ adminAsset('vendor/list.min.js') }}"></script>
    <script defer src="{{ adminAsset('js/list.js') }}"></script>
    <script defer src="{{ adminAsset('js/toggle-check-all.js') }}"></script>
    <script defer src="{{ adminAsset('js/check-selected-row.js') }}"></script>
    <script defer src="{{ adminAsset('js/sidebar-mini.js') }}"></script>
</body>

</html>
