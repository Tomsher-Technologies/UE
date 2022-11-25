@extends('layouts.frontend.app')

@section('content')
    <header class="main-header header-style-two">
        <!-- Header Upper -->
        <div class="header-upper mx-4">
            <div class="auto-container p-0">
                <div class="inner-container p-0">
                    <div class="right-column">
                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="" /></a>
                        </div>
                        <!--Nav Box-->
                        <div class="nav-outer">
                            <span class="screen-darken"></span>

                            <a data-trigger="navbar_main" class="mobile__nav d-lg-none p-0" href="#"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="21" viewBox="0 0 30 21">
                                    <g id="Icon_feather-menu" data-name="Icon feather-menu" transform="translate(-3 -7.5)">
                                        <path id="Path_1" data-name="Path 1" d="M4.5,18h27" fill="none" stroke="#000"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                                        <path id="Path_2" data-name="Path 2" d="M4.5,9h27" fill="none" stroke="#000"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                                        <path id="Path_3" data-name="Path 3" d="M4.5,27h27" fill="none" stroke="#000"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                                    </g>
                                </svg>
                            </a>

                            <nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
                                <div class="offcanvas-header">
                                    <button class="btn-close float-end"></button>
                                </div>
                                <a class="navbar-brand" href="{{ route('home') }}">
                                    <img src="{{ asset('images/logo.png') }}" alt="" />
                                </a>

                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#home">
                                            Home
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#about">
                                            About
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#services">
                                            Services
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#network">
                                            Work Process 
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#customer-zone">
                                            Customer Zone
                                        </a>
                                    </li>
                                    <li  class="nav-item">
                                        <a class="nav-link" href="#contact">
                                            Contact
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="navbar-right-info">
                            @if (auth()->user())
                                <a href="{{ auth()->user()->isAn('admin')? route('admin.dashboard'): route('reseller.dashboard') }}"
                                    class="theme-btn btn-style-one">
                                    <span>
                                        Dashboard
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('reseller.login') }}" class="theme-btn btn-style-one">
                                    <span>
                                        <img class="mr-3" src="{{ asset('images/user.svg') }}" alt="" />
                                        Login / Register
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->
    </header>
    <!-- End Main Header -->

    <!-- Bnner Section -->
    <section class="banner-section mt-0 style-three mx-4" id="home">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">
                <!-- Slide Item -->
                <div class="swiper-slide"
                    style="
                    background-image: url({{ asset('images/banner.jpg') }});
                ">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h1>
                                    Neutral <span>Express</span> <br />
                                    Solutions
                                </h1>
                                <p class="text">
                                    Our wholesale network is absolutely
                                    unmatched and neutrality is
                                    guaranteed.
                                </p>

                                <div class="link-box">
                                    <a href="#" class="link_button"><span>MORE DETAILS</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Item -->
                <div class="swiper-slide"
                    style="
                    background-image: url({{ asset('images/banner.jpg') }});
                ">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h1>
                                    Neutral <span>Express</span> <br />
                                    Solutions
                                </h1>
                                <div class="text">
                                    Our wholesale network is absolutely
                                    unmatched and neutrality is
                                    guaranteed.
                                </div>
                                <div class="link-box">
                                    <a href="#" class="link_button"><span>MORE DETAILS</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Item -->
                <div class="swiper-slide"
                    style="
                    background-image: url({{ asset('images/banner.jpg') }});
                ">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h1>
                                    Neutral <span>Express</span> <br />
                                    Solutions
                                </h1>
                                <div class="text">
                                    Our wholesale network is absolutely
                                    unmatched and neutrality is
                                    guaranteed.
                                </div>
                                <div class="link-box">
                                    <a href="#" class="link_button"><span>MORE DETAILS</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-slider-nav style-three">
            <div class="banner-slider-control banner-slider-button-prev">
                <span><i class="flaticon-right-arrow-6"></i></span>
            </div>
            <div class="banner-slider-control banner-slider-button-next">
                <span><i class="flaticon-right-arrow-6"></i></span>
            </div>
        </div>
        <div class="banner-slider-pagination"></div>
    </section>
    <!-- End Bnner Section -->

    <!-- About Section Two -->
    <section class="about-section-two" id="about">
        <div class="auto-container">
            <div class="sec-title text-center">
                <div class="sub-title">About Company</div>
                <h2>
                    Global Logistics Solution Provider <br />
                    Since 1942
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="image-box wow fadeInUp" data-wow-duration="1500ms">
                        <div class="shape">
                            <img src="{{ asset('images/resource/image-9.png') }}" alt="" />
                        </div>
                        <div class="image-one" data-parallax='{"y": -70}'>
                            <img src="{{ asset('images/about_img1.jpg') }}" alt="" />
                        </div>
                        <div class="image-two" data-parallax='{"y": 70}'>
                            <img src="{{ asset('images/about_img2.jpg') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content">
                        <h3>
                            We are proud to be one of the largest
                            independent Linehaul <br />
                            networks in the world. We also work
                        </h3>
                        <div class="text wow fadeInUp" data-wow-duration="1500ms">
                            The Linex network was established in 1989
                            when Linehaul Express (HK) Ltd was appointed
                            Wholesale Courier General Sales Agent (GSA)
                            for Cathay Pacific and since then has been
                            awarded with further exclusive GSAs with
                            Cathay Dragon (formerly Dragon Air) in 1995
                            and Air China is 2006.
                        </div>

                        <div class="text wow fadeInUp" data-wow-duration="1500ms">
                            We are proud to be one of the largest
                            independent Linehaul networks in the world.
                            We also work closely with many other quality
                            airlines. Our network of wholly owned
                            subsidiaries, joint ventures and agents is
                            available to any company in the
                            transportation industry requiring a top
                            quality neutral express sales and
                            distribution solution.
                        </div>

                        <div class="link-box">
                            <a href="#" class="link_button"><span>MORE DETAILS</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Work-process Section -->
    <section class="work-process-section" id="network">
        <div class="bg" style="background-image: url({{ asset('images/we_work_img.jpg') }})"></div>
        <div class="auto-container">
            <div class="sec-title text-center light">
                <div class="sub-title text-center">How We Work</div>
                <h2>
                    We Aim to Contribute Well to <br />
                    Your Company
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 work-process-block">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms">
                        <div class="count">01</div>
                        <div class="icon">
                            <span class="flaticon-shipping"></span>
                        </div>
                        <h4>
                            Replenishment <br />
                            & Picking
                        </h4>
                        <div class="text">
                            Dolores quas molestias <br />
                            excepturi occaecati cupiditated <br />
                            non provident.
                        </div>
                        <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More
                            Details</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 work-process-block">
                    <div class="inner-box wow fadeInDwon" data-wow-duration="1500ms">
                        <div class="count">02</div>
                        <div class="icon">
                            <span class="flaticon-warehouse"></span>
                        </div>
                        <h4>
                            Warehousing <br />
                            Operation
                        </h4>
                        <div class="text">
                            It will frequently occur that pleasures have
                            to repudiated annoyances accepted.
                        </div>
                        <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More
                            Details</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 work-process-block">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms">
                        <div class="count">03</div>
                        <div class="icon">
                            <span class="flaticon-packing-list"></span>
                        </div>
                        <h4>
                            Packaging <br />
                            & Distribution
                        </h4>
                        <div class="text">
                            Ever undertakes laborious physical exercise
                            excepts obtain some advantage right.
                        </div>
                        <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More
                            Details</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 work-process-block">
                    <div class="inner-box wow fadeInDown" data-wow-duration="1500ms">
                        <div class="count">04</div>
                        <div class="icon">
                            <span class="flaticon-delivery-1"></span>
                        </div>
                        <h4>
                            Transportation <br />
                            Process
                        </h4>
                        <div class="text">
                            Nothing prevents our being able to do what
                            like work best every pleasure
                        </div>
                        <a href="#" class="readmore-link"><i class="flaticon-up-arrow"></i>More
                            Details</a>
                    </div>
                </div>
            </div>
            <div class="bottom-text">
                Simplifying Your Freight & Logistics Needs With a
                Personal Approach. <a href="#"> Get In Touch</a>
            </div>
        </div>
    </section>

    <!-- Whychooseus section two -->
    <section class="whychooseus-section-two service_section" id="customer-zone" >
        <div class="auto-container">
            <div class="sec-title text-center">
                <div class="sub-title">OUR SERVICES</div>
                <h2>
                    6 Reasons Why to Choose Our <br />
                    Freight Services
                </h2>
            </div>

            <div class="row">
                <div class="col-12 col-xl-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                            role="tab" aria-controls="v-pills-home" aria-selected="true">
                            <div class="image_block">
                                <img src="{{ asset('images/svc_icon1.png') }}" alt="" />
                            </div>
                            <span>E-commerce</span>
                        </a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                            role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <div class="image_block">
                                <img src="{{ asset('images/svc_icon2.png') }}" alt="" />
                            </div>
                            <span>Express Services</span>
                        </a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                            role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            <div class="image_block">
                                <img src="{{ asset('images/svc_icon3.png') }}" alt="" />
                            </div>
                            <span>Gateway Logistics</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-xl-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <h5>One Stop Solution for e-Merchants</h5>

                            <p>
                                Linex provides unique access to
                                authorized channels into China and
                                Europe for personal-use items. Bundled
                                with proven linehaul from our overseas
                                gateways, and final-mile solutions,
                                there are several end-to-end channels to
                                this enormous and fast-growing
                                market-place: by 2016, China is expected
                                to have more digital buyers than Western
                                Europe and North America combined.
                            </p>

                            <h5>One Stop Solution for e-Merchants</h5>

                            <p>
                                Linex provides unique access to
                                authorized channels into China and
                                Europe for personal-use items. Bundled
                                with proven linehaul from our overseas
                                gateways, and final-mile solutions,
                                there are several end-to-end channels to
                                this enormous and fast-growing
                                market-place: by 2016, China is expected
                                to have more digital buyers than Western
                                Europe and North America combined.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <h5>One Stop Solution for e-Merchants</h5>

                            <p>
                                Linex provides unique access to
                                authorized channels into China and
                                Europe for personal-use items. Bundled
                                with proven linehaul from our overseas
                                gateways, and final-mile solutions,
                                there are several end-to-end channels to
                                this enormous and fast-growing
                                market-place: by 2016, China is expected
                                to have more digital buyers than Western
                                Europe and North America combined.
                            </p>

                            <h5>One Stop Solution for e-Merchants</h5>

                            <p>
                                Linex provides unique access to
                                authorized channels into China and
                                Europe for personal-use items. Bundled
                                with proven linehaul from our overseas
                                gateways, and final-mile solutions,
                                there are several end-to-end channels to
                                this enormous and fast-growing
                                market-place: by 2016, China is expected
                                to have more digital buyers than Western
                                Europe and North America combined.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            <h5>One Stop Solution for e-Merchants</h5>

                            <p>
                                Linex provides unique access to
                                authorized channels into China and
                                Europe for personal-use items. Bundled
                                with proven linehaul from our overseas
                                gateways, and final-mile solutions,
                                there are several end-to-end channels to
                                this enormous and fast-growing
                                market-place: by 2016, China is expected
                                to have more digital buyers than Western
                                Europe and North America combined.
                            </p>

                            <h5>One Stop Solution for e-Merchants</h5>

                            <p>
                                Linex provides unique access to
                                authorized channels into China and
                                Europe for personal-use items. Bundled
                                with proven linehaul from our overseas
                                gateways, and final-mile solutions,
                                there are several end-to-end channels to
                                this enormous and fast-growing
                                market-place: by 2016, China is expected
                                to have more digital buyers than Western
                                Europe and North America combined.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="auto-container">
            <div class="sec-title text-center">
                <div class="sub-title">Why Choose Us</div>
                <h2>
                    Moving Your Products Across <br />
                    All Borders
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-3 service-block-one">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms">
                        <h4>Payment & Billing</h4>
                        <div class="text">
                            Lorem Ipsum is simply dummy text of the
                            printing
                        </div>
                        <div class="read-more-btn">
                            <a href="#" class="link"><i class="flaticon-up-arrow"></i>Read
                                More</a>
                        </div>
                        <div class="image" data-parallax='{"y": 30}'>
                            <img src="{{ asset('images/card.png') }}" width="160" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 service-block-one">
                    <div class="inner-box wow fadeInDown" data-wow-duration="1500ms">
                        <h4>Platform Integration</h4>
                        <div class="text">
                            Lorem Ipsum is simply dummy text of the
                            printing
                        </div>
                        <div class="read-more-btn">
                            <a href="#" class="link"><i class="flaticon-up-arrow"></i>Read
                                More</a>
                        </div>

                        <div class="image" data-parallax='{"y": 30}'>
                            <img src="{{ asset('images/menu.png') }}" width="140" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 service-block-one">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms">
                        <h4>Order Management</h4>
                        <div class="text">
                            Lorem Ipsum is simply dummy text of the
                            printing
                        </div>
                        <div class="read-more-btn">
                            <a href="#" class="link"><i class="flaticon-up-arrow"></i>Read
                                More</a>
                        </div>

                        <div class="image" data-parallax='{"y": 30}'>
                            <img src="{{ asset('images/schedule.png') }}" width="160" alt="" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 service-block-one">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms">
                        <h4>Label Printing</h4>
                        <div class="text">
                            Lorem Ipsum is simply dummy text of the
                            printing
                        </div>
                        <div class="read-more-btn">
                            <a href="#" class="link"><i class="flaticon-up-arrow"></i>Read
                                More</a>
                        </div>

                        <div class="image" data-parallax='{"y": 30}'>
                            <img src="{{ asset('images/tag.png') }}" width="160" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servcies section two -->
    <section class="services-section-two mx-30">
        <div class="auto-container">
            <div class="row">
                <div class="theme_carousel owl-theme owl-carousel"
                    data-options='{"loop": true, "center": false, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 1000, "responsive":{ "0" :{ "items": "1" }, "600" :{ "items" : "1" }, "768" :{ "items" : "1" } , "992":{ "items" : "1" }, "1200":{ "items" : "6" }}}'>
                    <div class="service-block-two">
                        <div class="logo-box">
                            <img src="{{ asset('images/client_img1.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="service-block-two">
                        <div class="logo-box">
                            <img src="{{ asset('images/client_img2.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="service-block-two">
                        <div class="logo-box">
                            <img src="{{ asset('images/client_img3.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="service-block-two">
                        <div class="logo-box">
                            <img src="{{ asset('images/client_img4.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="service-block-two">
                        <div class="logo-box">
                            <img src="{{ asset('images/client_img1.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="service-block-two">
                        <div class="logo-box">
                            <img src="{{ asset('images/client_img3.png') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Main Footer-->
    <footer id="contact" class="main-footer style-two"
        style="
        background-image: url({{ asset('images/background/bg-10.jpg') }});
    ">
        <div class="footer-top">
            <div class="auto-container">
                <div class="wrapper-box">
                    <div class="we_help">
                        <h3>How can we help?</h3>
                        <p>
                            Customer service hotline 24 Hours Global
                            Coverage​
                        </p>
                    </div>
                    <div class="download-app">
                        <h5>Contact Now</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="upper-box">
            <div class="auto-container">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="widget links-widget">
                            <h4 class="widget_title">Company</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget-content">
                                        <ul class="list">
                                            <li>
                                                <a href="#">About LINEX
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Get In Touch</a>
                                            </li>
                                            <li>
                                                <a href="#">Industries
                                                    Served</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="widget links-widget">
                            <h4 class="widget_title">Company</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget-content">
                                        <ul class="list">
                                            <li>
                                                <a href="#">About LINEX
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Get In Touch</a>
                                            </li>
                                            <li>
                                                <a href="#">Industries
                                                    Served</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="widget links-widget">
                            <h4 class="widget_title">Useful Links</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="widget-content">
                                        <ul class="list">
                                            <li>
                                                <a href="#">Register</a>
                                            </li>
                                            <li>
                                                <a href="#">Faq </a>
                                            </li>
                                            <li>
                                                <a href="#">Help center
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget-content">
                                        <ul class="list">
                                            <li>
                                                <a href="#">Blog Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Clients &
                                                    Partners</a>
                                            </li>
                                            <li>
                                                <a href="#">Get a Quote</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <div class="widget links-widget">
                            <h4 class="widget_title">Company</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget-content">
                                        <ul class="list">
                                            <li>
                                                <a href="#">About LINEX
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Get In Touch</a>
                                            </li>
                                            <li>
                                                <a href="#">Industries
                                                    Served</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom style-two">
            <div class="auto-container">
                <div class="bg copyright">
                    <div class="row m-0 align-items-center justify-content-between">
                        <div class="copyright-text">
                            © Copyright 2022 All Rights Reserved.
                            Designed by
                            <a href="https://www.tomsher.com/" target="_blank">Tomsher</a>
                        </div>

                        <div class="wrapper-box">
                            <ul class="social-icon">
                                <li>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>

                        <ul class="menu">
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
