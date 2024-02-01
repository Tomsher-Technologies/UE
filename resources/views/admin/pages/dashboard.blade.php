@extends('layouts.admin')
@section('content')
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
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
                                <div class="h2 mb-0 mr-3">{{ $customer }}</div>
                                <div class="flex">
                                    <div class="card-title">Customers</div>
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
                                <div class="h2 mb-0 mr-3">{{ $searches }}</div>
                                <div class="flex">
                                    <div class="card-title">Total Searches</div>
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
                                <div class="h2 mb-0 mr-3">{{ $bookings }}</div>
                                <div class="flex">
                                    <div class="card-title">Total Booking</div>
                                </div>
                            </div>
                            {{-- <i class="material-icons icon-32pt text-20 ml-8pt">perm_identity</i> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row card-group-row">
                <div class="col-lg-6 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-row align-items-center flex-0">
                            <div class="h2 mb-0 mr-3">{{ $seaches_this_week }}</div>
                            <div class="flex">
                                <div class="card-title">Searches This Week</div>
                                <!-- <div class="card-subtitle text-50 d-flex align-items-center">2.6% <i
                                                                                                                                                                                                                                                        class="material-icons text-accent icon-16pt ml-4pt">keyboard_arrow_up</i>
                                                                                                                                                                                                                                                </div> -->
                            </div>
                            {{-- <div class="ml-3 align-self-start">
                                <div class="dropdown mb-2">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" data-caret="false"><i
                                            class="material-icons text-50">more_horiz</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="" class="dropdown-item">View report</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-body text-muted flex d-flex flex-column align-items-center justify-content-center">
                            <div class="chart w-100" style="height: 150px;">
                                {!! $searchchartjs->render() !!}
                            </div>
                            <div id="totalSalesChartLegend" class="chart-legend chart-legend--horizontal mt-16pt"></div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex flex-row align-items-center flex-0">
                            <div class="h2 mb-0 mr-3">{{ $bookings_this_week->count() }}</div>
                            <div class="flex">
                                <div class="card-title">Bookings This Week</div>
                            </div>
                        </div>
                        <div class="card-body text-muted flex d-flex flex-column align-items-center justify-content-center">
                            <div class="chart w-100" style="height: 200px;">
                                {!! $bookingchartjs->render() !!}
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
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-orders-from">From
                                        Country</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-orders-to">To
                                        Country</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">Vendor</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-orders-weight">Billable Weight</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-orders-amount">Amount</a>
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" id="orders">
                            @if ($recent_booking->count())
                                @foreach ($recent_booking as $booking)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a class="js-lists-values-orders-name"
                                                    href="{{ route('admin.customer.show', $booking->user) }}">
                                                    {{ $booking->user->name }}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="js-lists-values-orders-date text-50">
                                            {{ $booking->search->fromCountry->name }}
                                        </td>
                                        <td class="js-lists-values-orders-date text-50">
                                            {{ $booking->search->toCountry->name }}
                                        </td>
                                        <td>
                                            <a class="js-lists-values-orders-amount" href="#">
                                                <img style="width: 100px"
                                                    src="{{ $booking->integrator->getLogoImage() }}">
                                            </a>
                                        </td>
                                        <td>
                                            {{ $booking->billable_weight }}
                                        </td>
                                        <td>
                                            {{ $booking->rate }}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary w-100">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('header')
@endpush
@push('footer')
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            (function() {
                "use strict";
                var ctx = document.getElementById("bookingchartjs");
                window.bookingchartjs = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday",
                            "Saturday"
                        ],
                        datasets: [{
                            "label": "Total Booking This Week",
                            "backgroundColor": "rgb(0, 107, 110,0.31)",
                            "borderColor": "rgba(0, 107, 110, 0.7)",
                            "pointBorderColor": "rgba(0, 107, 110, 0.7)",
                            "pointBackgroundColor": "rgba(0, 107, 110, 0.7)",
                            "pointHoverBackgroundColor": "#fff",
                            "pointHoverBorderColor": "rgba(220,220,220,1)",
                            "data": [1, 2, 2, 0, 0, 0, 0]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            },
                            title: {
                                display: true,
                                text: 'Chart.js Line Chart'
                            }
                        },
                        hover: {
                            mode: 'index',
                            intersec: false
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Month'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Value'
                                },
                                min: 0,
                                max: 100,
                                ticks: {
                                    // forces step size to be 50 units
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            })();
        });
    </script> --}}
@endpush
