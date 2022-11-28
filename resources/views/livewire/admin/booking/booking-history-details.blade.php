<div class="container page__container">
    <div class="page-section">

        <div class="page-separator">
            <div class="page-separator__text">Order Details</div>
        </div>
        <div class="card mb-lg-32pt">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h5>Shipper Details:</h5>
                        <p>
                            <b>Name:</b> {{ $order->shipper_name }}, <br>
                            <b>Address:</b> {{ $order->shipper_address }}, <br>
                            <b>Country:</b> {{ $order->search->fromCountry->name }}, <br>
                            <b>Phone:</b> {{ $order->shipper_phone }}
                        </p>
                    </div>
                    <div class="col-6">
                        <h5>Consignee Details:</h5>
                        <p>
                            <b>Name:</b> {{ $order->consignee_name }}, <br>
                            <b>Address:</b> {{ $order->consignee_address }}, <br>
                            <b>Town:</b> {{ $order->consignee_town }}, <br>
                            <b>Province:</b> {{ $order->consignee_province }}, <br>
                            <b>Country:</b> {{ $order->search->toCountry->name }}, <br>
                            <b>Email:</b> {{ $order->consignee_email }}, <br>
                            <b>Phone:</b> {{ $order->consignee_phone }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
