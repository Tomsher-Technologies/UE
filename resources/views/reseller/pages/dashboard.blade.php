@extends('layouts.reseller.app')
@section('content')
    <div class="mdk-box  search-banner  js-mdk-box mb-0">
        {{-- mdk-box--bg-primary data-effects="parallax-background blend-background" --}}
        <div class="mdk-box__bg">
            <div class="mdk-box__bg-front">
            </div>
        </div>
        <div class="mdk-box__content justify-content-center">
            <div class="hero container-fluid page__container text-center py-112pt">

                <div id="quick-search" class="">
                    <form id="searchForm" action="{{ route('reseller.search.search') }}" method="POST">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Shipment Type</label>
                                    <div>
                                        <div class="autocomplete">
                                            <select autofocus tabindex="1" class="form-control" id="type"
                                                name="shipping_type" required>
                                                <option value="" disabled selected>Select a shipment type</option>
                                                <option value="import">Import</option>
                                                <option value="export">Export</option>
                                                <option value="transit">Transit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Package Type</label>
                                    <div>
                                        <div class="autocomplete">
                                            <select tabindex="2" class="form-control" id="package_type"
                                                name="package_type" required>
                                                <option value="" disabled selected>Select a package type</option>
                                                <option value="letter">Letter / Envelope</option>
                                                <option value="doc">Document</option>
                                                <option value="package">Package / Non-Doc</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Pickup Country</label>
                                    <div>
                                        <div class="autocomplete" id="fromCountryCont">
                                            <select tabindex="3" id="fromCountry" class="form-control select2"
                                                name="fromCountry" required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Pickup City</label>
                                    <div>

                                        <div class="searchable">
                                            <input tabindex="4" name="fromCity" id="fromCity" type="text"
                                                placeholder="search city" onkeyup="delayCity(this,event,'from')"
                                                placeholder="off">
                                            <ul></ul>
                                        </div>

                                        {{-- <div class="autocomplete">
                                            <select id="fromCity" class="form-control select2" name="fromCity"></select>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Pickup Pincode</label>
                                    <div>

                                        <div class="searchable">
                                            <input tabindex="5" name="fromPincode" id="fromPincode" type="text"
                                                placeholder="search pincode" onkeyup="filterPin(this,event,'from')"
                                                placeholder="off">
                                            <ul></ul>
                                        </div>

                                        {{-- <div class="autocomplete">
                                            <select id="fromPincode" class="form-control select2"
                                                name="fromPincode"></select>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Delivery Country</label>
                                    <div>
                                        <div class="autocomplete" id="toCountryCont">
                                            <select tabindex="6" id="toCountry" class="form-control" name="toCountry"
                                                required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Delivery City</label>
                                    <div>

                                        <div class="searchable">
                                            <input tabindex="7" name="toCity" id="toCity" type="text"
                                                placeholder="search city" onkeyup="delayCity(this,event,'to')"
                                                placeholder="off">
                                            <ul></ul>
                                        </div>

                                        {{-- <div class="autocomplete">
                                            <select id="toCity" class="form-control select2" name="toCity"></select>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Delivery Pincode</label>
                                    <div>
                                        <div class="searchable">
                                            <input tabindex="8" name="toPincode" id="toPincode" type="text"
                                                placeholder="search pincode" onkeyup="filterPin(this,event,'to')"
                                                placeholder="off">
                                            <ul></ul>
                                        </div>
                                        {{-- <div class="autocomplete">
                                            <select id="toPincode" class="form-control select2" name="toPincode"></select>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <label class="text-black" for="filter_name">Total Number of Pieces</label>
                                    <div>
                                        <div class="autocomplete">
                                            <input readonly="readonly" value="1" class="form-control"
                                                type="number" name="no_pieces" id="no_pieces"
                                                placeholder="Total Number of Pieces">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="packgaeContainer">
                            <div class="row text-left">
                                <div class="col-12">
                                    <label class="text-black" for="filter_name">Package - Dimensions(CM)</label>
                                </div>
                                <div class="col-2">
                                    <div class="form-group text-left">
                                        <label class="text-black" for="filter_name">Length</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input tabindex="9" class="form-control" min='.1' step=".1"
                                                    type="number" name="length[1]" placeholder="Length"
                                                    onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 43 )"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group text-left">
                                        <label class="text-black" for="filter_name">Height</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input tabindex="10" class="form-control" min='.1' step=".1"
                                                    type="number" name="height[1]" placeholder="Height"
                                                    onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 43 )"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group text-left">
                                        <label class="text-black" for="filter_name">Width</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input tabindex="11" class="form-control" min='.1' step=".1"
                                                    type="number" name="width[1]" placeholder="Width"
                                                    onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 43 )"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-black" for="filter_name">Actual Weight</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input tabindex="12" class="form-control" min='.1' type="number"
                                                    step=".1" name="weight[1]" placeholder="Actual Weight"
                                                    onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 43 )"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-black" for="filter_name">Number Of Pieces</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input tabindex="13" class="form-control no_piece"
                                                    onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 46 && event.charCode != 43 )"
                                                    min='1' value="1" type="number" step="1"
                                                    name="no_piece[1]" placeholder="Number Of Pieces" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col-sm-12 text-left">
                                <button class="btn btn-sm btn-primary text-light pt-2 pb-2 main-btn" type="button"
                                    id="addPackage">Add
                                    Package</button>
                            </div>
                        </div>

                        <input type="hidden" id="search_token" name="search_token">

                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <button tabindex="14" class="btn btn-sm btn-primary main-btn text-light pt-2 pb-2"
                                    type="submit" id="formSubmit">Quote</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="row">
                {{-- <div class="col-lg-4">
                    <div class="card text-center mb-lg-0 bg-grd1 text-light">
                        <div class="card-body">
                            <h4 class="h2 mb-0 text-light">{{ $total_customer }}</h4>
                            <div>Total Sub Agents</div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-6">
                    <div class="card text-center mb-lg-0 bg-grd2 text-light">
                        <div class="card-body">
                            <h4 class="h2 mb-0 text-light">{{ $total_search }}</h4>
                            <div>Total Searches</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card text-center mb-lg-0 bg-grd3 text-light">
                        <div class="card-body">
                            <h4 class="h2 mb-0 text-light">{{ $total_orders }}</h4>
                            <div>Total Bookings</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                {{-- <div class="col-lg-4">
                    <div class="card mb-md-0">
                        <div class="card-body">
                            <div class="text-50 mb-16pt">
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">This month</small>
                                        <small class="lh-24pt">{{ $total_customer_month }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd1" role="progressbar"
                                            style="width: {{ $total_customer == 0 ? 0 : ($total_customer_month / $total_customer) * 100 }}%"
                                            aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">This week</small>
                                        <small class="lh-24pt">{{ $total_customer_week }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd1" role="progressbar"
                                            style="width: {{ $total_customer == 0 ? 0 : ($total_customer_week / $total_customer) * 100 }}%"
                                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">Today</small>
                                        <small class="lh-24pt">{{ $total_customer_day }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd1" role="progressbar"
                                            style="width: {{ $total_customer == 0 ? 0 : ($total_customer_day / $total_customer) * 100 }}%"
                                            aria-valuenow="1.06" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('reseller.agents.index') }}"
                                    class="btn btn-sm btn-outline-secondary">View Sub Agents</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-6">
                    <div class="card mb-md-0">
                        <div class="card-body">
                            <div class="text-50 mb-16pt">
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">This month</small>
                                        <small class="lh-24pt">{{ $total_search_month }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd2" role="progressbar"
                                            style="width: {{ $total_search == 0 ? 0 : ($total_search_month / $total_search) * 100 }}%"
                                            aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">This week</small>
                                        <small class="lh-24pt">{{ $total_search_week }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd2" role="progressbar"
                                            style="width: {{ $total_search == 0 ? 0 : ($total_search_week / $total_search) * 100 }}%"
                                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">Today</small>
                                        <small class="lh-24pt">{{ $total_search_day }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd2" role="progressbar"
                                            style="width: {{ $total_search == 0 ? 0 : ($total_search_day / $total_search) * 100 }}%"
                                            aria-valuenow="1.06" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('reseller.search.history') }}"
                                    class="btn btn-sm btn-outline-secondary">View Searches</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-md-0">
                        <div class="card-body">
                            <div class="text-50 mb-16pt">
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">This month</small>
                                        <small class="lh-24pt">{{ $total_orders_month }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd3" role="progressbar"
                                            style="width: {{ $total_orders == 0 ? 0 : ($total_orders_month / $total_orders) * 100 }}%"
                                            aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">This week</small>
                                        <small class="lh-24pt">{{ $total_orders_week }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd3" role="progressbar"
                                            style="width: {{ $total_orders == 0 ? 0 : ($total_orders_day / $total_orders) * 100 }}%"
                                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">Today</small>
                                        <small class="lh-24pt">{{ $total_orders_day }}</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd3" role="progressbar"
                                            style="width: {{ $total_orders == 0 ? 0 : ($total_orders_day / $total_orders) * 100 }}%"
                                            aria-valuenow="1.06" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('reseller.booking.history') }}"
                                    class="btn btn-sm btn-outline-secondary">View Bookings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        select:focus,
        input:focus {
            box-shadow: inset 0 1px 1px rgba(39, 44, 51, 0.075), 0 0 0 1px #006b6e !important
        }

        .main-btn {
            font-size: 16px;
            padding: 10px 40px !important;
            line-height: 16px;
            transition: all .2s ease-in
        }

        .main-btn:focus,
        .main-btn:hover,
        .main-btn:active {
            color: #2f45ff !important;
            background: #fff !important;
            ;
        }

        .search-banner {
            background-image: url(https://blackswancapital.eu/wp-content/uploads/2020/03/20_03-scaled.jpg);
            background-size: cover;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        div.searchable {
            width: 100% float: left;
            background: #fff;
            border-radius: 5px;
        }

        .searchable input {
            width: 100%;
            height: 40px;
            font-size: 15px;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            display: block;
            font-weight: 400;
            line-height: 1.6;
            color: #000;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            outline: none;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            background: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center/8px 10px;
        }

        .searchable ul {
            position: absolute;
            z-index: 1000;
            width: 92%;
            display: none;
            list-style-type: none;
            background-color: #fff;
            border-radius: 0 0 5px 5px;
            border: 1px solid #add8e6;
            border-top: none;
            max-height: 180px;
            margin: 0;
            overflow-y: scroll;
            overflow-x: hidden;
            padding: 0;
        }

        .searchable ul li {
            padding: 7px 9px;
            border-bottom: 1px solid #e1e1e1;
            cursor: pointer;
            color: #6e6e6e;
        }

        .searchable ul li.selected {
            background-color: #e8e8e8;
            color: #333;
        }

        #searchForm label.text-black {
            font-size: 17px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered,
        .form-control,
        .power_grid,
        select {
            font-size: 16px !important;
        }
    </style>
@endpush
@push('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function filterFunction(that, event) {
            let container, input, filter, li, input_val;
            container = $(that).closest(".searchable");
            input_val = $(that).val().toUpperCase();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                method: "POST",
                url: '{{ route('getCountries') }}',
                dataType: 'json',
                data: {
                    name: input_val
                }
            }).done(function(data) {
                container.find("ul").empty()
                var results = $.map(data, function(obj) {
                    return {
                        id: obj.id,
                        text: obj.text
                    };
                })
                results.forEach(element => {
                    container.find("ul").append('<li data-val="' + element.id + '">' + element.text +
                        '</li>');
                });
            });
            container.find("ul li").removeClass("selected");
            setTimeout(function() {
                container.find("ul li:visible").first().addClass("selected");
            }, 100)

        }


        let timeout = null;

        function delayCity(that, event, type) {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                filterCity(that, event, type);
            }, 1500);
        }

        function filterCity(that, event, type) {
            let container, input, filter, li, input_val;
            container = $(that).closest(".searchable");
            input_val = $(that).val().toUpperCase();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            if (type == 'from') {
                country = $('#fromCountry').val();
                // console.log(country);
            } else {
                country = $('#toCountry').val();
            }

            $.ajax({
                method: "POST",
                url: '{{ route('getCities') }}',
                dataType: 'json',
                data: {
                    country: country,
                    name: input_val
                }
            }).done(function(data) {
                container.find("ul").empty()
                var results = $.map(data, function(obj) {
                    return {
                        id: obj.id,
                        text: obj.text
                    };
                })
                results.forEach(element => {
                    container.find("ul").append('<li data-val="' + element.id + '">' + element.text +
                        '</li>');
                });
            });
            container.find("ul li").removeClass("selected");
            setTimeout(function() {
                container.find("ul li:visible").first().addClass("selected");
            }, 100)

        }

        function filterPin(that, event, type) {
            let container, input, filter, li, input_val;
            container = $(that).closest(".searchable");
            input_val = $(that).val().toUpperCase();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            if (type == 'from') {
                country = $('#fromCountry').val();
                city = $('#fromCity').val();
            } else {
                country = $('#toCountry').val();
                city = $('#toCity').val();
                // console.log(city);
            }

            $.ajax({
                method: "POST",
                url: '{{ route('getPincode') }}',
                dataType: 'json',
                data: {
                    country: country,
                    city: city,
                    name: input_val
                }
            }).done(function(data) {
                container.find("ul").empty()
                var results = $.map(data, function(obj) {
                    return {
                        id: obj.id,
                        text: obj.text
                    };
                })
                results.forEach(element => {
                    container.find("ul").append('<li data-val="' + element.id + '">' + element.text +
                        '</li>');
                });
            });
            container.find("ul li").removeClass("selected");
            setTimeout(function() {
                container.find("ul li:visible").first().addClass("selected");
            }, 100)
        }

        function onSelect(val) {
            alert(val)
        }

        $(".searchable input").focus(function() {
            $(this).closest(".searchable").find("ul").show();
            $(this).closest(".searchable").find("ul li").show();
        });
        $(".searchable input").blur(function() {
            let that = this;
            setTimeout(function() {
                $(that).closest(".searchable").find("ul").hide();
            }, 300);
        });

        $(document).on('click', '.searchable ul li', function() {
            $(this).closest(".searchable").find("input").val($(this).text()).blur();
        });

        $(".searchable ul li").hover(function() {
            $(this).closest(".searchable").find("ul li.selected").removeClass("selected");
            $(this).addClass("selected");
        });
    </script>

    <script>
        $(document).on('focus', '.select2', function() {
            $(this).siblings('select').select2('open');
        });
    </script>

    <script>
        $id = 2;

        function addElement($id) {
            $("#packgaeContainer").append(`<div class="row text-left">
                                <div class="col-12">
                                    <label class="text-white" for="filter_name">Package - Dimensions(CM)</label>
                                    <button class="btn btn-sm btn-primary text-light ml-2 remove-package"
                                        type="button">Remove Package</button>
                                </div> 
                                <div class="col-2">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Length</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step='.1' min='.1' type="number" name="length[]"
                                                    placeholder="Length" onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 43 )" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Height</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step='.1' min='.1' type="number" name="height[]"
                                                    placeholder="Height" onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 43 )" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Width</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step='.1' min='.1' type="number" name="width[]"
                                                    placeholder="Width" onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 43 )" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Actual Weight</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" min='.1' step='.1' onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 43 )" required name="weight[]"
                                                    placeholder="Actual Weight">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-black" for="filter_name">Number Of Pieces</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control no_piece" type="number" onkeypress="return ( event.charCode != 45 && event.charCode != 101 && event.charCode != 46 && event.charCode != 43 )" min='1' value="1" step="1"
                                                    name="no_piece[]" placeholder="Number Of Pieces" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
        }

        function getPackageCount() {
            count = 0;
            $('.no_piece').each(function(i, o) {
                count += parseInt(o.value);
            })
            $('#no_pieces').val(count);
        }

        $(document).on('change', '.no_piece', function() {
            getPackageCount();
        });

        $('#addPackage').on('click', function() {
            addElement($id);
            // $('#no_pieces').get(0).value++
            getPackageCount()
            $id++;
        });

        $('body').on('click', '.remove-package', function() {
            $(this).closest('.row').remove();
            // $('#no_pieces').get(0).value--
            getPackageCount()
            $id--;
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#searchForm').trigger("reset");
            $('#search_token').val(Math.floor(Math.random() * 26) + Date.now());
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $('#fromCountry').select2({
            ajax: {
                url: '{{ route('getCountries') }}',
                dataType: 'json',
                method: 'POST',
                placeholder: 'Search for a repository',
                delay: 250,
                data: function(params) {
                    var query = {
                        name: params.term,
                    }
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.text,
                            };
                        })
                    };
                }
            },
        });
        $('#toCountry').select2({
            ajax: {
                url: '{{ route('getCountries') }}',
                dataType: 'json',
                method: 'POST',
                delay: 250,
                data: function(params) {
                    var query = {
                        name: params.term,
                    }
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.text
                            };
                        })
                    };
                }
            },
            minimumResultsForSearch: 10
        });

        $('#fromCountry').on('select2:select', function(e) {
            $('#fromCity').val("")
            $('#fromPincode').val("")
        });
        $('#toCountry').on('select2:select', function(e) {
            $('#toCity').val("")
            $('#toPincode').val("")
        });
    </script>

    <script>
        $('#type').on('change', function() {
            val = $(this).val();
            if (val == 'import') {

                $('#toCountry')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="1237" selcted>United Arab Emirates</option>')
                    .val('1237');

                // $('#toCountry').prop('readonly',  false);
                // $('#fromCountry').prop('readonly', true);
                $('#toCountryCont .select2').css('pointer-events', 'none');
                $('#fromCountryCont .select2').css('pointer-events', 'auto');

                // $('#toCountry').append('<option value="1237" selcted>United Arab Emirates</option>');
                $("#fromCountry option[value='1237']").remove();
                $('#toCity').val("")
                $('#toPincode').val("")
                $('#fromCity').val("")
                $('#fromPincode').val("")
            } else if (val == 'export') {
                $('#fromCountry')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="1237" selcted>United Arab Emirates</option>')
                    .val('1237');

                // $('#fromCountry').prop('readonly', true);
                // $('#toCountry').prop('readonly', false);

                $('#toCountryCont .select2').css('pointer-events', 'auto');
                $('#fromCountryCont .select2').css('pointer-events', 'none');

                $("#toCountry option[value='1237']").remove();
                $('#toCity').val("")
                $('#toPincode').val("")
                $('#fromCity').val("")
                $('#fromPincode').val("")
            } else {

                // $('#fromCountry').prop('readonly', false);
                // $('#toCountry').prop('readonly', false);


                $('#toCountryCont .select2').css('pointer-events', 'auto');
                $('#fromCountryCont .select2').css('pointer-events', 'auto');

                $("#toCountry option[value='1237']").remove();
                $('#toCity').val("")
                $('#toPincode').val("")
                $('#fromCity').val("")
                $('#fromPincode').val("")

                $("#fromCountry option[value='1237']").remove();
                $('#toCity').val("")
                $('#toPincode').val("")
                $('#fromCity').val("")
                $('#fromPincode').val("")

            }
            // if (val == 'export') {
            //     $('#fromCountry').append('<option value="1237" selcted>United Arab Emirates</option>');
            //     $("#toCountry option[value='1237']").remove();
            //     $('#toCity').val("")
            //     $('#toPincode').val("")
            //     $('#fromCity').val("")
            //     $('#fromPincode').val("")
            // }
            // if (val == 'transit') {
            //     $('#fromCountry').append('<option value="1237" selcted>United Arab Emirates</option>');
            //     $("#toCountry option[value='1237']").remove();
            //     $('#toCity').val("")
            //     $('#toPincode').val("")
            //     $('#fromCity').val("")
            //     $('#fromPincode').val("")
            // }
        });
    </script>

    <script>
        function storeData() {
            var shipping_type = document.getElementById("type").value;
            var package_type = document.getElementById("package_type").value;

            var fromCountry = document.getElementById("fromCountry").value;
            var fromCountry_text = $("#fromCountry option:selected").text();
            var fromCity = document.getElementById("fromCity").value;
            var fromPincode = document.getElementById("fromPincode").value;

            var toCountry = document.getElementById("toCountry").value;
            var toCountry_text = $("#toCountry option:selected").text();
            var toCity = document.getElementById("toCity").value;
            var toPincode = document.getElementById("toPincode").value;

            var lengthArry = $('input[name="length[]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            var height = $('input[name="height[]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            var width = $('input[name="width[]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            var weight = $('input[name="weight[]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            var no_piece = $('input[no_piece="length[]"]').map(function() {
                return this.value; // $(this).val()
            }).get();

            sessionStorage.shipping_type = shipping_type;
            sessionStorage.package_type = package_type;

            sessionStorage.fromCountry = fromCountry;
            sessionStorage.fromCountry_text = fromCountry_text;
            sessionStorage.fromCity = fromCity;
            sessionStorage.fromPincode = fromPincode;

            sessionStorage.toCountry = toCountry;
            sessionStorage.toCountry_text = toCountry_text;
            sessionStorage.toCity = toCity;
            sessionStorage.toPincode = toPincode;

            sessionStorage.lengthArry = length;
            sessionStorage.height = height;
            sessionStorage.width = width;
            sessionStorage.weight = weight;
            sessionStorage.no_piece = no_piece;

            sessionStorage.clearData = 1
        }

        function getData() {
            if (sessionStorage.clearData == 1) {

                if (
                    sessionStorage.shipping_type &&
                    sessionStorage.package_type &&
                    sessionStorage.fromCountry_text &&
                    sessionStorage.fromCountry &&
                    sessionStorage.fromCity &&
                    sessionStorage.fromPincode &&
                    sessionStorage.toCountry_text &&
                    sessionStorage.toCountry &&
                    sessionStorage.toCity &&
                    sessionStorage.toPincode
                    // sessionStorage.lengthArry &&
                    // sessionStorage.height &&
                    // sessionStorage.width &&
                    // sessionStorage.weight &&
                    // sessionStorage.no_piece
                ) {

                    document.getElementById("type").value = sessionStorage.shipping_type;
                    document.getElementById("package_type").value = sessionStorage.package_type;

                    var newOption = new Option(sessionStorage.fromCountry_text, sessionStorage.fromCountry, false, false);
                    $('#fromCountry').append(newOption).trigger('change');
                    document.getElementById("fromCity").value = sessionStorage.fromCity;
                    document.getElementById("fromPincode").value = sessionStorage.fromPincode;

                    var newOption = new Option(sessionStorage.toCountry_text, sessionStorage.toCountry, false, false);
                    $('#toCountry').append(newOption).trigger('change');
                    document.getElementById("toCity").value = sessionStorage.toCity;
                    document.getElementById("toPincode").value = sessionStorage.toPincode;

                    // sessionStorage.lengthArry.forEach(function(value, i) {
                    //     console.log('%d: %s', i, value);
                    // });

                    sessionStorage.clearData = 0
                }
            }
        }

        $(document).ready(function() {
            getData();
        });

        $('#searchForm').submit(function() {
            storeData();
            // console.log(sessionStorage.clearData);
        });

        // $('#formSubmit').on('click', function() {

        //     $('#searchForm').submit();

        // });
    </script>
@endpush
