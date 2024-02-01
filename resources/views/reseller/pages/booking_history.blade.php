@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="page-separator">
                <div class="page-separator__text">Booking History</div>
            </div>
            <div class="search-result">
                <div class="card mb-0">
                    @if ($bookings->count() > 0)
                        <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-employee-name"
                            data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>
                            <table class="table mb-0 thead-border-top-0 table-nowrap">
                                <thead>
                                    <tr class="text-uppercase small">
                                        <th>
                                            <a href="javascript:void(0)">Shipment type</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">Package type</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">From Address</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">To Address</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">
                                                Rate
                                            </a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">
                                                Status
                                            </a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">
                                                &nbsp;
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="users">
                                    @foreach ($bookings as $booking)
                                        <tr class="selected">
                                            <td>
                                                {{ ucfirst($booking->search->shipment_type) }}
                                            </td>
                                            <td>
                                                {{ ucfirst($booking->search->package_type) }}
                                            </td>
                                            <td>
                                                {{ $booking->search->fromCountry->name }} <br>
                                                {{ $booking->search->from_city }} <br>
                                                {{ $booking->search->from_pin }}
                                            </td>
                                            <td>
                                                {{ $booking->search->toCountry->name }} <br>
                                                {{ $booking->search->to_city }} <br>
                                                {{ $booking->search->to_pin }}
                                            </td>
                                            <td>
                                                AED {{ ucfirst($booking->rate) }}
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-sm btn-rounded text-light {{ $booking->order_status == '1' ? 'btn-success' : 'btn-danger' }}">
                                                    {{ $booking->status_text() }}
                                                </button>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary text-light pt-2 pb-2"
                                                    href="{{ route('reseller.booking.history.details', $booking) }}">
                                                    View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="p-2 mb-0 text-center">
                            No data found
                        </p>
                    @endif

                    {{ $bookings->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
    <style>
        .pagination-nav {
            padding: 15px 0;
        }

        .pagination-nav .pagination {
            justify-content: center !important;
        }
    </style>
@endpush
@push('footer')
@endpush
