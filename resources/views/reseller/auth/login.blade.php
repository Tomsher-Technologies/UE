


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} - {{ $title ?? '' }}</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="{{ adminAsset('vendor/spinkit.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('vendor/perfect-scrollbar.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/material-icons.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/fontawesome.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ adminAsset('css/select2.css') }}" rel="stylesheet">

</head>

<body class="layout-boxed ">

    <div>
        <div class="">

            <section class="ue-template-animation ue-template-layout1">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-12 ue-bg-color">
                            <div class="ue-content">
                                <div class="ue-header">
                                    <a href="login.html" class="ue-logo"><img width="180"
                                            src="{{ adminAsset('images/logo/logo2.png') }}" alt="Logo"></a>

                                </div>
                                <div class="ue-form">
                                    <h2>Log In</h2>
                                    <p>Log in to continue in our website</p>
                                    <form method="POST" action="{{ route('reseller.login') }}">
                                        @csrf
                                        <x-form.error name="login" />
                                        <div class="form-group">
                                            <div class=" ue-transition-delay-1">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Email Address" value="pudapyres@mailinator.com">
                                                <i class="flaticon-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class=" ue-transition-delay-2">
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Password" value="password">
                                                <i class="flaticon-padlock"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class=" ue-transition-delay-3">
                                                <div class="ue-content-between">
                                                    <button type="submit" class="btn pl-4 pr-4 btn-rounded btn-primary">Login</button>
                                                    <a href="forgot-password-1.html" class="switcher-text2">Forgot
                                                        Password</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="ue-footer">

                                    <div class="bg-white border-top-2 ">
                                        <div class=" d-flex flex-column pl-0 pt-3">


                                            <p class="mb-8pt d-flex">
                                                <a href="" class="text-70 text-underline mr-8pt small">UE
                                                    Terms</a>
                                                <a href="" class="text-70 text-underline small">UE Privacy
                                                    policy</a>
                                            </p>
                                            <p class="text-50 small mt-n1 mb-0">Copyright 2022 &copy; All rights
                                                reserved.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 ue-none-767 ue-bg-img"
                            style="background-image:url(https://www.universalexpressgroup.com/wp-content/uploads/2020/02/deliveryvanoncountrysideroadonsunset-universal-express.png)">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- // END Drawer Layout -->

    <style>
        .ue-template-layout1 .ue-content {
            max-width: 450px;
            width: 100%;
        }

        .ue-template-layout1 .ue-header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-bottom: 100px;
        }

        .ue-template-layout1 .ue-bg-color {
            background-color: #ffffff;
            min-height: 100vh;
            background-size: cover;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            padding: 50px 30px 42px;
        }

        .ue-template-layout1 .ue-header .ue-logo {
            display: block;
            margin-bottom: 30px;
            max-width: 40vw;
            margin-right: 30px;
        }

        .ue-template-layout1 .ue-header .ue-page-switcher {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 15px;
        }


        .ue-template-layout1 .ue-header .ue-page-switcher .switcher-text1.active {
            color: #ff0000;
        }

        .ue-template-layout1 .ue-header .ue-page-switcher .switcher-text1 {
            color: #111111;
            font-size: 18px;
            margin-right: 15px;
            padding-right: 15px;
            margin-bottom: 10px;
            border-right: 1px solid #9f9f9f;
            line-height: 1;
            -webkit-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }




        .ue-template-layout1 .ue-header .ue-page-switcher .switcher-text1:last-child {
            margin-right: 0;
            padding-right: 0;
            border-right: 0;
        }

        .ue-template-layout1 .ue-form {
            margin-bottom: 40px;
        }

        .ue-template-layout1 .ue-form h2 {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .ue-template-layout1 .ue-form p {
            margin-bottom: 30px;
            font-size: 17px;
        }

        .ue-template-layout1 .ue-form .form-group {
            position: relative;
            z-index: 1;
            margin-bottom: 15px;
        }


        .ue-template-layout1 .ue-bg-img {
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            min-height: 100vh;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
    </style>

    <script src="{{ adminAsset('vendor/jquery.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/popper.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/bootstrap.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/dom-factory.js') }}"></script>
    <script src="{{ adminAsset('vendor/material-design-kit.js') }}"></script>
    <script src="{{ adminAsset('js/app.js') }}"></script>
    <script src="{{ adminAsset('js/preloader.js') }}"></script>
    <script src="{{ adminAsset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ adminAsset('js/select2.js') }}"></script>
</body>

</html>
