<div class="container page__container">
    <div class="page-section">

        <div class="page-separator">
            <div class="page-separator__text">Booking History</div>
        </div>

        <nav
            class="navbar navbar-light border-bottom border-top px-0 mb-0 alert {{ $order->order_status == '1' ? 'alert-success' : 'alert-danger' }}">
            <div class="container-fluid page__container">
                <h3 class="mb-0 alert-heading text-center w-100">
                    Booking {{ $order->status_text() }}
                </h3>
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
                                    {{ $order->search->from_city }} <br>
                                    {{ $order->search->from_pin }} <br>
                                    {{ $order->search->fromCountry->name }} <br>
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
                                    {{ $order->search->to_city }} <br>
                                    {{ $order->search->to_pin }} <br>
                                    {{ $order->search->toCountry->name }} <br>
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
                                    <strong class="font-weight-bolder ">Tracking Code :
                                    </strong>{{ $order->hawbNumber }}
                                @endif

                                <br>
                                <strong class="font-weight-bolder ">Integrator :
                                </strong>{{ $order->integrator->name }}
                            </p>
                        </div>

                        @if ($order->order_status == 1)
                            <div>
                                <a target="new" href="{{ $order->invoice_url }}" class="btn btn-outline-white">
                                    Download
                                    Shipping
                                    label
                                    <i class="material-icons icon--right">file_download</i></a>
                            </div>
                        @else
                            <div class="flex">
                                <p class="text-white icon-16pt"><strong>HubEz Status:</strong> <br>
                                    {{ $order->invoice_url }} </p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
