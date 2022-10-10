@extends('layouts.reseller.app')
@section('content')
    <div class="mdk-box mdk-box--bg-primary bg-dark js-mdk-box mb-0" data-effects="parallax-background blend-background">
        <div class="mdk-box__bg">
            <div {{-- style="
            background-image: url({{ resellerAsset('images/globe.jpg') }});
            background-size: cover;" --}} class="mdk-box__bg-front">
            </div>
        </div>
        <div class="mdk-box__content justify-content-center">
            <div class="hero container-fluid page__container text-center py-112pt">

                <div id="quick-search" class="">
                    <form action="{{ route('reseller.search') }}" method="POST">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-white" for="filter_name">Pickup country</label>
                                    <div>
                                        <div class="autocomplete">
                                            <select id="fromCountry" class="form-control" name="fromCountry"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-white" for="filter_name">Pickup City</label>
                                    <div>
                                        <div class="autocomplete">
                                            <select id="fromCity" class=" form-control" name="fromCity"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-white" for="filter_name">Pickup Pincode</label>
                                    <div>
                                        <div class="autocomplete">
                                            <input id="" class="form-control" type="text" name="fromPincode"
                                                placeholder="Pickup Pincode">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-white" for="filter_name">Delivery country</label>
                                    <div>
                                        <div class="autocomplete">
                                            <input id="toCountry" class="form-control" type="text" name="toCountry"
                                                placeholder="Delivery country">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-white" for="filter_name">Delivery City</label>
                                    <div>
                                        <div class="autocomplete">
                                            <input class="form-control" type="text" name="toCity"
                                                placeholder="Delivery City">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group text-left">
                                    <label class="text-white" for="filter_name">Delivery Pincode</label>
                                    <div>
                                        <div class="autocomplete">
                                            <input class="form-control" type="text" name="toPincode"
                                                placeholder="Delivery Pincode">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <label class="text-white" for="filter_name">Number of pieces</label>
                                    <div>
                                        <div class="autocomplete">
                                            <input class="form-control" type="number" name="no_pieces"
                                                placeholder="Number of pieces">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="packgaeContainer">
                            <div class="row text-left">
                                <div class="col-12">
                                    <label class="text-white" for="filter_name">Package 1 - Dimensions(CM)</label>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Length</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" name="length[1]"
                                                    placeholder="Length">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Height</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" name="height[1]"
                                                    placeholder="Height">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Width</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" name="width[1]"
                                                    placeholder="Width">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Actual Weight</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" name="weight[1]"
                                                    placeholder="Actual Weight">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col-sm-12 text-left">
                                <button class="btn btn-sm btn-primary text-light pt-2 pb-2" type="button"
                                    id="addPackage">Add
                                    Package</button>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <button class="btn btn-sm btn-primary text-light pt-2 pb-2" type="submit">Search</button>
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
                <div class="col-lg-4">
                    <div class="card text-center mb-lg-0 bg-grd1 text-light">
                        <div class="card-body">
                            <h4 class="h2 mb-0 text-light">200</h4>
                            <div>Total Customers</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-center mb-lg-0 bg-grd2 text-light">
                        <div class="card-body">
                            <h4 class="h2 mb-0 text-light">3,917</h4>
                            <div>Total Enquiry</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-center mb-lg-0 bg-grd3 text-light">
                        <div class="card-body">
                            <h4 class="h2 mb-0 text-light">10,211</h4>
                            <div>Total Bookings</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-4">
                    <div class="card mb-md-0">
                        <div class="card-body">
                            <div class="text-50 mb-16pt">
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">30 Days</small>
                                        <small class="lh-24pt">60</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd1" role="progressbar" style="width: 91%"
                                            aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">15 Days</small>
                                        <small class="lh-24pt">15</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd1" role="progressbar" style="width: 22%"
                                            aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">7 Days</small>
                                        <small class="lh-24pt">4</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd1" role="progressbar" style="width: 5%"
                                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">Today</small>
                                        <small class="lh-24pt">1</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd1" role="progressbar" style="width: 1.06%"
                                            aria-valuenow="1.06" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-sm btn-outline-secondary">View Customers</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-md-0">
                        <div class="card-body">
                            <div class="text-50 mb-16pt">
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">30 Days</small>
                                        <small class="lh-24pt">60</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd2" role="progressbar" style="width: 91%"
                                            aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">15 Days</small>
                                        <small class="lh-24pt">15</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd2" role="progressbar" style="width: 22%"
                                            aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">7 Days</small>
                                        <small class="lh-24pt">4</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd2" role="progressbar" style="width: 5%"
                                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">Today</small>
                                        <small class="lh-24pt">1</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd2" role="progressbar" style="width: 1.06%"
                                            aria-valuenow="1.06" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-sm btn-outline-secondary">View Enquiry</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-md-0">
                        <div class="card-body">
                            <div class="text-50 mb-16pt">
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">30 Days</small>
                                        <small class="lh-24pt">60</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd3" role="progressbar" style="width: 91%"
                                            aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">15 Days</small>
                                        <small class="lh-24pt">15</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd3" role="progressbar" style="width: 22%"
                                            aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4pt">
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">7 Days</small>
                                        <small class="lh-24pt">4</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd3" role="progressbar" style="width: 5%"
                                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="d-flex align-items-center mb-0">
                                        <small class="flex lh-24pt">Today</small>
                                        <small class="lh-24pt">1</small>
                                    </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar bg-grd3" role="progressbar" style="width: 1.06%"
                                            aria-valuenow="1.06" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-sm btn-outline-secondary">View Bookings</a>
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
@endpush
@push('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $id = 2;

        function addElement($id) {
            $("#packgaeContainer").append(`<div class="row text-left">
                                <div class="col-12">
                                    <label class="text-white" for="filter_name">Package ` + $id + ` - Dimensions(CM)</label>
                                    <button class="btn btn-sm btn-primary text-light ml-2 remove-package"
                                        type="button">Remove Package</button>
                                </div> 
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Length</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" name="length[]"
                                                    placeholder="Length">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Height</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" name="height[]"
                                                    placeholder="Height">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Width</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" name="width[]"
                                                    placeholder="Width">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Actual Weight</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" name="weight[]"
                                                    placeholder="Actual Weight">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
        }

        $('#addPackage').on('click', function() {
            addElement($id);
            $id++;
        });

        $('body').on('click', '.remove-package', function() {
            $(this).closest('.row').remove();
            $id--;
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
                                text: obj.text
                            };
                        })
                    };
                }
            }
        });
    </script>
@endpush
