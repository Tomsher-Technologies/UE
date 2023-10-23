@extends('layouts.admin')

@section('content')
    <div class="pt-32pt">
        <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">User Report</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ URL::previous() }}">Back</a></li>
                    </ol>
                </div>
            </div>

        </div>
    </div>
    <div class="container page__container">
        <div class="page-section">
            <div class="row card-group-row mb-lg-8pt">
                <div class="col-lg-6 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex d-flex align-items-center">
                                <div class="h2 mb-0 mr-3">{{ $quotes->count() }}</div>
                                <div class="flex">
                                    <div class="card-title">Total Quotes</div>
                                </div>
                            </div>
                            {{-- <i class="material-icons icon-32pt text-20 ml-8pt">assessment</i> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex d-flex align-items-center">
                                <div class="h2 mb-0 mr-3">{{ $bookings->count() }}</div>
                                <div class="flex">
                                    <div class="card-title">Total Booking</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex d-flex align-items-center">
                                <div class="h2 mb-0 mr-3">{{ $top_countries['import'] }}</div>
                                <div class="flex">
                                    <div class="card-title">Top Import Country</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex d-flex align-items-center">
                                <div class="h2 mb-0 mr-3">{{ $top_countries['export'] }}</div>
                                <div class="flex">
                                    <div class="card-title">Top Export Country</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex d-flex align-items-center">
                                <div class="h2 mb-0 mr-3">{{ $bookings->count() }}</div>
                                <div class="flex">
                                    <div class="card-title">Top Transit Country</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="flatpickr-wrapper flex">
                        <div id="recent_orders_date" data-toggle="flatpickr" data-flatpickr-wrap="true"
                            data-flatpickr-static="true" data-flatpickr-mode="range" data-flatpickr-alt-format="d/m/Y"
                            data-flatpickr-date-format="d/m/Y">
                            <strong class="card-title d-block">Recent Quotes</strong>
                            <input class="d-none" type="hidden" value="13/03/2018 to 20/03/2018" data-input>
                        </div>
                    </div>
                    <a href="" class="btn btn-primary">View all</a>
                </div>
                <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-orders-from"
                    data-lists-values='["js-lists-values-orders-from", "js-lists-values-orders-to", "js-lists-values-orders-weight", "js-lists-values-orders-rate"]'>
                    <table class="table mb-0 table-nowrap thead-border-top-0">
                        <thead>
                            <tr>
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
                                        data-sort="js-lists-values-orders-rate">Amount</a>
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" id="orders">
                            @if ($bookings->count())
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td class="js-lists-values-orders-from text-50">
                                            {{ $booking->search->fromCountry->name }}
                                        </td>
                                        <td class="js-lists-values-orders-to text-50">
                                            {{ $booking->search->toCountry->name }}
                                        </td>
                                        <td>
                                            <a href="#">
                                                <img style="width: 100px" src="{{ $booking->integrator->getLogoImage() }}">
                                            </a>
                                        </td>
                                        <td class="js-lists-values-orders-weight">
                                            {{ $booking->billable_weight }}
                                        </td>
                                        <td class="js-lists-values-orders-rate">
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

            <div class="card mb-0">
                <div class="card-header d-flex align-items-center">
                    <div class="flatpickr-wrapper flex">
                        <div id="recent_orders_date" data-toggle="flatpickr" data-flatpickr-wrap="true"
                            data-flatpickr-static="true" data-flatpickr-mode="range" data-flatpickr-alt-format="d/m/Y"
                            data-flatpickr-date-format="d/m/Y">
                            <strong class="card-title d-block">Recent Booking</strong>
                            <input class="d-none" type="hidden" value="13/03/2018 to 20/03/2018" data-input>
                        </div>
                    </div>
                    <a href="" class="btn btn-primary">View all</a>
                </div>
                <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-orders-from"
                    data-lists-values='["js-lists-values-orders-from", "js-lists-values-orders-to", "js-lists-values-orders-weight", "js-lists-values-orders-rate"]'>
                    <table class="table mb-0 table-nowrap thead-border-top-0">
                        <thead>
                            <tr>
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-orders-from">From
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
                                        data-sort="js-lists-values-orders-rate">Amount</a>
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" id="orders">
                            @if ($bookings->count())
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td class="js-lists-values-orders-from text-50">
                                            {{ $booking->search->fromCountry->name }}
                                        </td>
                                        <td class="js-lists-values-orders-to text-50">
                                            {{ $booking->search->toCountry->name }}
                                        </td>
                                        <td>
                                            <a href="#">
                                                <img style="width: 100px"
                                                    src="{{ $booking->integrator->getLogoImage() }}">
                                            </a>
                                        </td>
                                        <td class="js-lists-values-orders-weight">
                                            {{ $booking->billable_weight }}
                                        </td>
                                        <td class="js-lists-values-orders-rate">
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
