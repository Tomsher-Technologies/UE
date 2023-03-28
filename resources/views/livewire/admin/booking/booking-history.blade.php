<div class="container page__container">
    <div class="page-section">

        <div class="page-separator">
            <div class="page-separator__text">Booking History</div>
        </div>


        <div class="card mb-lg-32pt">
            <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date"
                data-lists-sort-desc="true" data-lists-values='["js-lists-values-name"]'>
                <div class="card-header">
                    <form class="form-inline" wire:ignore>
                        <div class="form-row">
                            <div class="col-4 mb-2">
                                <label class="mr-sm-2 mb-2 form-label justify-content-start"
                                    for="inlineFormFilterBy">Filter
                                    by user:</label>
                                <select style="width: 80%" wire:model="user_id" name="user"
                                    class="form-control search mb-2 mr-sm-2 mb-sm-0 select2" id="user">
                                    <option value="0">All Users</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="clearSelec2('#user')"
                                    class="btn btn-secondary">Clear</button>
                            </div>
                            <div class="col-4 mb-2">
                                <label class="mr-sm-2 mb-2 form-label justify-content-start"
                                    for="inlineFormFilterBy">Filter
                                    by from
                                    country:</label>
                                <select style="width: 80%" wire:model="from_country_id" name="from_country_id"
                                    class="form-control search mb-2 mr-sm-2 mb-sm-0 select2" id="from_country_id">
                                    <option value="0">All Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="clearSelec2('#from_country_id')"
                                    class="btn btn-secondary">Clear</button>
                            </div>
                            <div class="col-4 mb-2">
                                <label class="mr-sm-2 mb-2 form-label justify-content-start"
                                    for="inlineFormFilterBy">Filter
                                    by to
                                    country:</label>
                                <select style="width: 80%" wire:model="to_country_id" name="to_country_id"
                                    class="form-control search mb-2 mr-sm-2 mb-sm-0 select2" id="to_country_id">
                                    <option value="0">All Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="clearSelec2('#to_country_id')"
                                    class="btn btn-secondary">Clear</button>
                            </div>
                            <div class="col-4 mb-2">
                                <label class="mr-sm-2 mb-2 form-label justify-content-start"
                                    for="inlineFormFilterBy">Filter
                                    by shipment type:</label>
                                <select style="width: 80%" wire:model="shipping_type" name="shipping_type"
                                    class="form-control search mb-2 mr-sm-2 mb-sm-0 select2" id="shipping_type">
                                    <option value="0">All Types</option>
                                    <option value="import">Import</option>
                                    <option value="export">Export</option>
                                    <option value="transit">Transit</option>
                                </select>
                                <button type="button" onclick="clearSelec2('#shipping_type')"
                                    class="btn btn-secondary">Clear</button>
                            </div>
                            <div class="col-4 mb-2">
                                <label class="mr-sm-2 mb-2 form-label justify-content-start"
                                    for="inlineFormFilterBy">Filter
                                    by package type:</label>
                                <select style="width: 80%" wire:model="package_type" name="package_type"
                                    class="form-control search mb-2 mr-sm-2 mb-sm-0 select2" id="package_type">
                                    <option value="0">All Types</option>
                                    <option value="letter">Letter / Envelope</option>
                                    <option value="doc">Document</option>
                                    <option value="package">Package / Non-Doc</option>
                                </select>
                                <button type="button" onclick="clearSelec2('#package_type')"
                                    class="btn btn-secondary">Clear</button>
                            </div>
                            <div class="col-4 mb-2">
                                <label class="mr-sm-2 mb-2 form-label justify-content-start"
                                    for="inlineFormFilterBy">Filter
                                    by date:</label>
                                <input style="width: 80%" class="flatpickr flatpickr-input form-control" type="hidden"
                                    placeholder="Select Date.." id="altinput">
                                <button type="button" onclick="clearDate()" class="btn btn-secondary">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <a href="javascript:void(0)">
                                    Booked By
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    From
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    To
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Weight
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Rate
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Shippment / Package Type
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Satus
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Refernce Number
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    Date
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    &nbsp;
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" id="clients">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    {{ $booking->user->name }}
                                </td>
                                <td>
                                    {{ $booking->search->fromCountry->name }}
                                </td>
                                <td>
                                    {{ $booking->search->toCountry->name }}
                                </td>
                                <td>
                                    {{ $booking->billable_weight }}
                                </td>
                                <td>
                                    {{ $booking->rate }}
                                </td>
                                <td>
                                    {{ ucfirst($booking->search->shipment_type) }} /
                                    {{ ucfirst($booking->search->package_type) }}
                                </td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-rounded text-light {{ $booking->order_status == '1' ? 'btn-success' : 'btn-danger' }}">
                                        {{ $booking->status_text() }}
                                    </button>
                                </td>
                                <td>
                                    {{ $booking->hawbNumber }}
                                </td>
                                <td>
                                    {{ $booking->created_at->format('d/m/Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.bookings.details', $booking) }}"
                                        class="btn btn-sm btn-primary text-light pt-2 pb-2">
                                        Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer p-8pt">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('footer')
    <script>
        $(document).ready(function() {
            $('#user').select2();
            $('#user').on('change', function(e) {
                var data = $('#user').select2("val");
                @this.set('user_id', data);
            });

            $('#from_country_id').select2();
            $('#from_country_id').on('change', function(e) {
                var data = $('#from_country_id').select2("val");
                @this.set('from_country_id', data);
            });

            $('#to_country_id').select2();
            $('#to_country_id').on('change', function(e) {
                var data = $('#to_country_id').select2("val");
                @this.set('to_country_id', data);
            });

            $('#shipping_type').select2();
            $('#shipping_type').on('change', function(e) {
                var data = $('#shipping_type').select2("val");
                @this.set('shipping_type', data);
            });
            $('#package_type').select2();
            $('#package_type').on('change', function(e) {
                var data = $('#package_type').select2("val");
                @this.set('package_type', data);
            });

            $("#altinput").flatpickr({
                mode: "range",
                dateFormat: "d-m-Y",
                onChange: function(selectedDates, dateStr, instance) {
                    dts = dateStr.split(' to ')
                    @this.set('start_date', dts[0]);
                    @this.set('end_date', dts[1] ?? dts[0]);
                },
            });
        });

        function clearSelec2(id) {
            $(id).val(0).trigger('change');
        }

        function clearDate() {
            $("#altinput")[0]._flatpickr.clear();
            @this.set('start_date', null);
            @this.set('end_date', null);
        }
    </script>
@endpush
