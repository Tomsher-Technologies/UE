<div class="container page__container">
    <div class="page-section">

        <div class="page-separator">
            <div class="page-separator__text">Search History Details</div>
        </div>

        <div class="form-group">
            <label class="form-label">User Name</label>
            <input value="{{ $search->user->name }}" disabled type="text" class="form-control mb-2">
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Shippment Type</label>
                    <input value="{{ ucfirst($search->shipment_type) }}" disabled type="text"
                        class="form-control mb-2">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Package Type</label>
                    <input value="{{ packageTypes($search->package_type) }}" disabled type="text"
                        class="form-control mb-2">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label class="form-label">From Country</label>
                    <input value="{{ $search->fromCountry->name }}" disabled type="text" class="form-control mb-2">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label class="form-label">From City</label>
                    <input value="{{ ucfirst($search->from_city) }}" disabled type="text" class="form-control mb-2">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label class="form-label">From Pincode</label>
                    <input value="{{ $search->from_pin }}" disabled type="text" class="form-control mb-2">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label class="form-label">To Country</label>
                    <input value="{{ $search->toCountry->name }}" disabled type="text" class="form-control mb-2">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label class="form-label">To City</label>
                    <input value="{{ ucfirst($search->to_city) }}" disabled type="text" class="form-control mb-2">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label class="form-label">To Pincode</label>
                    <input value="{{ $search->to_pin }}" disabled type="text" class="form-control mb-2">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Number of pieces</label>
                    <input value="{{ $search->number_of_pieces }}" disabled type="text" class="form-control mb-2">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Search Date</label>
                    <input value="{{ $search->created_at->format('d/m/Y h:i:s a') }}" disabled type="text"
                        class="form-control mb-2">
                </div>
            </div>
        </div>

        @if ($this->search->items)
            <div class="card">
                <h5 class="mt-4 px-2">Search Items</h5>
                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <a href="javascript:void(0)">
                                    Length
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Height
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Width
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Weight
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Number of pieces
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($this->search->items as $item)
                            <tr>
                                <td>
                                    {{ $item->length }}
                                </td>
                                <td>
                                    {{ $item->height }}
                                </td>
                                <td>
                                    {{ $item->width }}
                                </td>
                                <td>
                                    {{ $item->weight }}
                                </td>
                                <td>
                                    {{ $item->no_pieces }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
