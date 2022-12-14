@extends('layouts.admin')
@section('content')
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div>

        </div>
    </div>
    <div class="container page__container">
        <div class="page-section">
            <div class="row card-group-row mb-lg-8pt">
                <div class="col-lg-4 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex d-flex align-items-center">
                                <div class="h2 mb-0 mr-3">{{ $ueusers }}</div>
                                <div class="flex">
                                    <div class="card-title">UE Admin Users</div>
                                </div>
                            </div>
                            {{-- <i class="material-icons icon-32pt text-20 ml-8pt">assessment</i> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex d-flex align-items-center">
                                <div class="h2 mb-0 mr-3">{{ $vendors }}</div>
                                <div class="flex">
                                    <div class="card-title">Customers</div>
                                </div>
                            </div>
                            {{-- <i class="material-icons icon-32pt text-20 ml-8pt">shopping_basket</i> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex d-flex align-items-center">
                                <div class="h2 mb-0 mr-3">{{ $customer }}</div>
                                <div class="flex">
                                    <div class="card-title">Users</div>
                                </div>
                            </div>
                            {{-- <i class="material-icons icon-32pt text-20 ml-8pt">perm_identity</i> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row card-group-row">
                <div class="col-lg-4 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-row align-items-center flex-0">
                            <div class="h2 mb-0 mr-3">82</div>
                            <div class="flex">
                                <div class="card-title">Total request</div>
                                <!-- <div class="card-subtitle text-50 d-flex align-items-center">2.6% <i
                                                                                                                        class="material-icons text-accent icon-16pt ml-4pt">keyboard_arrow_up</i>
                                                                                                                </div> -->
                            </div>
                            <div class="ml-3 align-self-start">
                                <div class="dropdown mb-2">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" data-caret="false"><i
                                            class="material-icons text-50">more_horiz</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="" class="dropdown-item">View report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-muted flex d-flex flex-column align-items-center justify-content-center">
                            <div class="chart w-100" style="height: 150px;">
                                <canvas class="chart-canvas js-update-chart-line js-update-chart-area" id="totalSalesChart"
                                    data-chart-legend="#totalSalesChartLegend"
                                    data-chart-line-background-color="gradient:primary"
                                    data-chart-line-background-opacity="0.24" data-chart-line-border-color="primary"
                                    data-chart-prefix="$" data-chart-dark-mode="false">
                                    <span style="font-size: 1rem;"><strong>Total request</strong> chart goes
                                        here.</span>
                                </canvas>
                            </div>
                            <div id="totalSalesChartLegend" class="chart-legend chart-legend--horizontal mt-16pt"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-row align-items-center flex-0">
                            <div class="h2 mb-0 mr-3">5.63%</div>
                            <div class="flex">
                                <div class="card-title">Conversion rate</div>
                                <!-- <div class="card-subtitle text-50 d-flex align-items-center">3.6% <i
                                                                                                                        class="material-icons text-accent icon-16pt ml-4pt">keyboard_arrow_up</i>
                                                                                                                </div> -->
                            </div>
                            <div class="ml-3 align-self-start">
                                <div class="dropdown mb-2">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" data-caret="false"><i
                                            class="material-icons text-50">more_horiz</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="" class="dropdown-item">View report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center">
                            <small class="text-muted text-uppercase mb-3 d-block font-weight-bold">Conversion
                                Funnel</small>
                            <small class="d-flex align-items-start font-weight-bold text-muted mb-2">
                                <span class="flex d-flex flex-column">
                                    <span class="text-body">Booking request</span>
                                    5 visits
                                </span>
                                <span class="mx-3">7.04%</span>
                            </small>
                            <small class="d-flex align-items-start font-weight-bold text-muted mb-2">
                                <span class="flex d-flex flex-column">
                                    <span class="text-body">Quoates Submitted</span>
                                    5 visits
                                </span>
                                <span class="mx-3">7.04%</span>
                            </small>
                            <small class="d-flex align-items-start font-weight-bold text-muted">
                                <span class="flex d-flex flex-column">
                                    <span class="text-body">Booked</span>
                                    4 orders
                                </span>
                                <span class="mx-3">5.63%</span>
                            </small>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-4 col-md-12 card-group-row__col">
                                                                                                    <div class="card card-group-row__card">
                                                                                                        <div class="card-body d-flex flex-row align-items-center flex-0">
                                                                                                            <div class="h2 mb-0 mr-3">3645</div>
                                                                                                            <div class="flex">
                                                                                                                <div class="card-title">Average Booking</div>
                                                                                                                <div class="card-subtitle text-50 d-flex align-items-center">6.7% <i
                                                                                                                        class="material-icons text-accent icon-16pt ml-4pt">keyboard_arrow_up</i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="ml-3 align-self-start">
                                                                                                                <div class="dropdown mb-2">
                                                                                                                    <a href="" class="dropdown-toggle" data-toggle="dropdown"
                                                                                                                        data-caret="false"><i class="material-icons text-50">more_horiz</i></a>
                                                                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                                                                        <a href="" class="dropdown-item">View report</a>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="card-body text-muted flex d-flex flex-column align-items-center justify-content-center">
                                                                                                            <div class="chart w-100" style="height: 150px;">
                                                                                                                <canvas class="chart-canvas js-update-chart-line" id="averageOrderValueChart"
                                                                                                                    data-chart-legend="#averageOrderValueChartLegend"
                                                                                                                    data-chart-line-border-color="primary" data-chart-prefix="$"
                                                                                                                    data-chart-dark-mode="false">
                                                                                                                    <span style="font-size: 1rem;"><strong>Average Order Value</strong> chart
                                                                                                                        goes here.</span>
                                                                                                                </canvas>
                                                                                                            </div>
                                                                                                            <div id="averageOrderValueChartLegend"
                                                                                                                class="chart-legend chart-legend--horizontal mt-16pt"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> -->
                <div class="col-lg-4 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-row align-items-center flex-0">
                            <div class="h2 mb-0 mr-3">452</div>
                            <div class="flex">
                                <div class="card-title">Avarage Booking</div>
                            </div>
                            <div class="ml-3 align-self-start">
                                <div class="dropdown mb-2">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown"
                                        data-caret="false"><i class="material-icons text-50">more_horiz</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="" class="dropdown-item">View report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="card-body text-muted flex d-flex flex-column align-items-center justify-content-center">
                            <div class="chart w-100" style="height: 200px;">
                                <canvas class="chart-canvas js-update-chart-bar" id="totalVisitorsChart"
                                    data-chart-legend="#totalVisitorsChartLegend"
                                    data-chart-line-background-color="gradient:primary" data-chart-suffix="k"
                                    data-chart-dark-mode="false">
                                    <span style="font-size: 1rem;"><strong>Total Visitors</strong> chart goes
                                        here.</span>
                                </canvas>
                            </div>
                            <div id="totalVisitorsChartLegend" class="chart-legend chart-legend--horizontal mt-16pt">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row card-group-row">

            </div>
            <div class="row card-group-row">

            </div>
            <div class="card mb-0">
                <div class="card-header d-flex align-items-center">
                    <div class="flatpickr-wrapper flex">
                        <div id="recent_orders_date" data-toggle="flatpickr" data-flatpickr-wrap="true"
                            data-flatpickr-static="true" data-flatpickr-mode="range" data-flatpickr-alt-format="d/m/Y"
                            data-flatpickr-date-format="d/m/Y">
                            <strong class="card-title d-block">Recent Bookings</strong>

                            <input class="d-none" type="hidden" value="13/03/2018 to 20/03/2018" data-input>
                        </div>
                    </div>
                    {{-- <i class="material-icons text-20">help_outline</i> --}}
                </div>
                <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-orders-name"
                    data-lists-values='["js-lists-values-orders-name", "js-lists-values-orders-date", "js-lists-values-orders-amount"]'>
                    <table class="table mb-0 table-nowrap thead-border-top-0">
                        <thead>
                            <tr>
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-orders-name">Name</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-orders-name">Countries</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-orders-name">Vendor</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-orders-date">Date</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-orders-amount">Amount</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" id="orders">
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="js-lists-values-orders-name" href="">Jenell D. Matney</a>
                                    </div>
                                </td>
                                <td class="js-lists-values-orders-date text-50">USA</td>
                                <td>
                                    <a class="js-lists-values-orders-amount" href=""><img
                                            src="{{ adminAsset('images/aramex.png') }}"></a>
                                </td>
                                <td>
                                    12/05/2022
                                </td>
                                <td>
                                    320</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="js-lists-values-orders-name" href="">Sherri J. Cardenas</a>
                                    </div>
                                </td>
                                <td class="js-lists-values-orders-date text-50">UK</td>
                                <td>
                                    <a class="js-lists-values-orders-amount" href=""><img
                                            src="{{ adminAsset('images/aramex.png') }}"></a>
                                </td>
                                <td>
                                    12/05/2022
                                </td>
                                <td>
                                    320</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="js-lists-values-orders-name" href="">Joseph S. Ferland</a>
                                    </div>
                                </td>
                                <td class="js-lists-values-orders-date text-50">CANADA</td>
                                <td>
                                    <a class="js-lists-values-orders-amount" href=""><img
                                            src="{{ adminAsset('images/fedx.png') }}"></a>
                                </td>
                                <td>
                                    12/05/2022
                                </td>
                                <td>
                                    562
                                </td>
                            </tr>
                            <tr class="selected">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="js-lists-values-orders-name" href="">Bryan K. Davis</a>
                                    </div>
                                </td>
                                <td class="js-lists-values-orders-date text-50">USA</td>
                                <td>
                                    <a class="js-lists-values-orders-amount" href=""><img
                                            src="{{ adminAsset('images/ups.png') }}"></a>
                                </td>
                                <td>
                                    12/05/2022
                                </td>
                                <td>
                                    246
                                </td>
                            </tr>
                            <tr class="selected">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="js-lists-values-orders-name" href="">Elizabeth J. Ohara</a>
                                    </div>
                                </td>
                                <td class="js-lists-values-orders-date text-50">USA</td>
                                <td>
                                    <a class="js-lists-values-orders-amount" href=""><img
                                            src="{{ adminAsset('images/ups.png') }}"></a>
                                </td>
                                <td>
                                    12/05/2022
                                </td>
                                <td>
                                    246
                                </td>
                            </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Page 1">
                                <span>1</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Page 2">
                                <span>2</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span>Next</span>
                                <span aria-hidden="true" class="material-icons">chevron_right</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
@endpush
@push('footer')
@endpush
