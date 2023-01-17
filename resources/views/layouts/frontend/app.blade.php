<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} - {{ $title ?? '' }}</title>


    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/color-2.css') }}" rel="stylesheet" />

    {{-- <link rel="shortcut icon" href="assets/images/favicon-2.png" type="image/x-icon" /> --}}

    @stack('header')
</head>

<body class="color-style-two">

    <div class="page-wrapper">
        @yield('content')
    </div>

    <div class="scroll-to-top scroll-to-target" data-target="html">
        <span class="flaticon-right-arrow-6"></span>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('js/isotope.js') }}"></script>
    <script src="{{ asset('js/owl.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/smoothscrolling.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('js/script.js') }}"></script>

    {{-- <script type="text/javascript">
        function darken_screen(yesno) {
            if (yesno == true) {
                document
                    .querySelector(".screen-darken")
                    .classList.add("active");
            } else if (yesno == false) {
                document
                    .querySelector(".screen-darken")
                    .classList.remove("active");
            }
        }

        function close_offcanvas() {
            darken_screen(false);
            document
                .querySelector(".mobile-offcanvas.show")
                .classList.remove("show");
            document.body.classList.remove("offcanvas-active");
        }

        function show_offcanvas(offcanvas_id) {
            darken_screen(true);
            document.getElementById(offcanvas_id).classList.add("show");
            document.body.classList.add("offcanvas-active");
        }

        document.addEventListener("DOMContentLoaded", function() {
            document
                .querySelectorAll("[data-trigger]")
                .forEach(function(everyelement) {
                    let offcanvas_id =
                        everyelement.getAttribute("data-trigger");

                    everyelement.addEventListener("click", function(e) {
                        e.preventDefault();
                        show_offcanvas(offcanvas_id);
                    });
                });

            document
                .querySelectorAll(".btn-close")
                .forEach(function(everybutton) {
                    everybutton.addEventListener("click", function(e) {
                        e.preventDefault();
                        close_offcanvas();
                    });
                });

            document
                .querySelector(".screen-darken")
                .addEventListener("click", function(event) {
                    close_offcanvas();
                });
        });
        // DOMContentLoaded  end
    </script> --}}

    @stack('footer')
</body>

</html>
