@extends('layouts.reseller.app')
@section('content')
    <nav
        class="navbar navbar-light border-bottom border-top px-0 mb-0 alert {{ $order->order_status == '1' ? 'alert-success' : 'alert-danger' }}">
        <div class="container-fluid page__container">
            <h3 class="mb-0 alert-heading text-center w-100">
                Booking {{ $order->status_text() }}
            </h3>
            @if ($order->order_status !== 1)
                <p class="mt-2 text-center w-100">
                    {{ $order->invoice_url }}
                </p>
            @endif
        </div>
    </nav>
    <div class="page-section bg-primary border-bottom-2">
        <div class="container-fluid page__container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mb-24pt mb-lg-0">
                            <p class="text-white-70 mb-0"><strong>Shipper Info:</strong></p>
                            <h2 class="text-white">
                                {{ $order->shipper_name }}
                            </h2>
                            <p class="text-white">
                                {{ $order->shipper_address }} <br>
                                {{ $search->from_city }} <br>
                                {{ $search->from_pin }} <br>
                                {{ $search->fromCountry->name }} <br>
                                {{ $order->shipper_phone }} <br>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-white-70 mb-0"><strong>Consignee Info:</strong></p>
                            <h2 class="text-white">
                                {{ $order->consignee_name }}
                            </h2>
                            <p class="text-white">
                                {{ $order->consignee_address }} <br>
                                {{ $order->consignee_town }} <br>
                                {{ $order->consignee_province }} <br>
                                {{ $search->to_city }} <br>
                                {{ $search->to_pin }} <br>
                                {{ $search->toCountry->name }} <br>
                                {{ $order->consignee_phone }} <br>
                                {{ $order->consignee_email }}
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-4 text-lg-right d-flex flex-lg-column mb-24pt mb-lg-0 border-bottom border-lg-0 pb-16pt pb-lg-0">
                    <div class="flex">
                        <p class="text-white-70 mb-8pt "><strong>Booking Details</strong></p>
                        <p class="text-white icon-16pt">
                            <strong class="font-weight-bolder ">Booking Id :
                            </strong>#{{ Str::padLeft($order->id, 4, '0') }} <br>
                            <strong class="font-weight-bolder ">Booking date :
                            </strong>{{ $order->created_at->format('d/m/Y h:i:s A') }}

                            @if ($order->hawbNumber)
                                <br>
                                <strong class="font-weight-bolder ">Tracking Code : </strong>{{ $order->hawbNumber }}
                            @endif

                            <br>
                            <strong class="font-weight-bolder ">Integrator : </strong>{{ $integrator->name }}
                        </p>
                    </div>

                    @if ($order->order_status == 1)
                        <div>
                            <a target="new" href="{{ $order->invoice_url }}" class="btn btn-outline-white"> Download
                                Shipping
                                label
                                <i class="material-icons icon--right">file_download</i></a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    {{-- <div class="page-section container-fluid page__container">
        <div class="page-separator">
            <div class="page-separator__text">Booking Summary</div>
        </div>

        <div class="card table-responsive mb-24pt">
            <table class="table table-flush table--elevated">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Length</th>
                        <th>Height</th>
                        <th>Width</th>
                        <th>Actual Weight</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-flush">
                <tfoot>
                    <tr>
                        <td class="text-right text-70"><strong>Number Of Packages</strong></td>
                        <td style="width: 150px;" class="text-right">
                            <strong>{{ $order->search->number_of_pieces }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-right text-70"><strong>Total Billable Weight</strong></td>
                        <td style="width: 150px;" class="text-right">
                            <strong>{{ $order->billable_weight }} Kg</strong></td>
                    </tr>
                    <tr>
                        <td class="text-right text-70"><strong>Total Shipping Charge</strong></td>
                        <td style="width: 150px;" class="text-right"><strong>AED {{ $order->rate }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div> --}}
@endsection
