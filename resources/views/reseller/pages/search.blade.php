@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="page-separator">
                <div class="page-separator__text">Search rates</div>
            </div>

            <form action="{{ route('reseller.search.search') }}" method="POST">
                @csrf
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label" for="select01">Pickup Country</label>
                            <select id="fromCountry" class="form-control select2" name="fromCountry" required></select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label" for="select02">Pickup City</label>
                            <select id="fromCity" class="form-control select2" name="fromCity"></select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label" for="select03">Pickup Pincode</label>
                            <select id="fromPincode" class="form-control select2" name="fromPincode"></select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label" for="select03">Delivery Country</label>
                            <select id="toCountry" class="form-control" name="toCountry" required></select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label" for="select03">Delivery City</label>
                            <select id="toCity" class="form-control select2" name="toCity"></select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label" for="select03">Delivery Pincode</label>
                            <select id="toPincode" class="form-control select2" name="toPincode"></select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group ">
                            <label for="filter_name">
                                Number of Pieces
                            </label>
                            <input class="form-control" type="number" name="no_pieces" placeholder="Number of Pieces">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="package-details">
                        <div class="package-details-card row mt-20">
                            <div class="col-sm-12">
                                <div class="mb-16pt d-flex align-items-center">
                                    <small class="text-70 text-headings text-uppercase mr-3">Package -
                                        Dimensions(CM)</small>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label class="form-label" for="filter_name">Length</label>
                                    <input step=".1" type="number" name="length[1]" class="form-control"
                                        placeholder="Length">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label class="form-label" for="filter_name">Height</label>
                                    <input step=".1" type="number" name="height[1]" placeholder="Height"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label class="form-label" for="filter_name">Width</label>
                                    <input step=".1" type="number" name="width[1]" placeholder="Width"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label class="form-label" for="filter_name">Actual Weight</label>
                                    <input class="form-control" type="number" step=".1" name="weight[1]"
                                        placeholder="Actual Weight" required>
                                </div>
                            </div>
                        </div>
                        <div id="packgaeContainer">

                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="mb-pt d-flex align-items-center">
                        <button type="button" id="addPackage" class="btn btn-sm btn btn-success ml-8pt ml-auto">
                            <i class="material-icons icon--left">add</i> Add Package
                        </button>
                        <a href=""></a>
                    </div>
                </div>

                <div class="col-sm-12 ml-auto">
                    <div class="mb-16pt text-center">
                        <button type="submit" class="btn btn-sm btn btn-primary ml-8pt pl-5 pr-5 ">
                            <i class="material-icons icon--left">search</i> Search
                        </button>
                    </div>
                </div>

            </form>

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
            $("#packgaeContainer").append(`<div class="package-details-card row mt-20">
                            <div class="col-sm-12">
                                <div class="mb-16pt d-flex align-items-center">
                                    <small class="text-70 text-headings text-uppercase mr-3">Package -
                                        Dimensions(CM)</small>
                                    <button type="button" class="btn btn-sm btn btn-danger ml-8pt ml-auto remove-package">
                                        <i class="material-icons icon--left">delete</i> Remove
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label class="form-label" for="filter_name">Length</label>
                                    <input  class="form-control" step='.1' type="number" name="length[]"
                                                    placeholder="Length">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label class="form-label" for="filter_name">Height</label>
                                    <input  class="form-control" step='.1' type="number" name="height[]"
                                                    placeholder="Height">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label class="form-label" for="filter_name">Width</label>
                                    <input class="form-control" step='.1' type="number" name="width[]"
                                                    placeholder="Width">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group ">
                                    <label class="form-label" for="filter_name">Actual Weight</label>
                                    <input class="form-control" type="number" step='.1' required name="weight[]"
                                                    placeholder="Actual Weight">
                                </div>
                            </div>
                        </div>`);
        }

        $('#addPackage').on('click', function() {
            addElement($id);
            $id++;
        });

        $('body').on('click', '.remove-package', function() {
            $(this).closest('.package-details-card').remove();
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
            tags: true,
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
            },
            minimumResultsForSearch: 10
        });
        $('#toCountry').select2({
            tags: true,
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

        $('#fromCity').select2({
            tags: true,
            ajax: {
                url: '{{ route('getCities') }}',
                dataType: 'json',
                method: 'POST',
                delay: 250,
                data: function(params) {
                    console.log(params.term);
                    var query = {
                        name: params.term,
                        country: $('#fromCountry').val()
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
        $('#toCity').select2({
            tags: true,
            ajax: {
                url: '{{ route('getCities') }}',
                dataType: 'json',
                method: 'POST',
                delay: 250,
                data: function(params) {
                    console.log(params.term);
                    var query = {
                        name: params.term,
                        country: $('#toCountry').val()
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

        $('#fromPincode').select2({
            tags: true,
            ajax: {
                url: '{{ route('getPincode') }}',
                dataType: 'json',
                method: 'POST',
                delay: 250,
                data: function(params) {
                    console.log(params.term);
                    var query = {
                        name: params.term,
                        country: $('#fromCountry').val(),
                        city: $('#fromCity option:selected').text()
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
        $('#toPincode').select2({
            tags: true,
            ajax: {
                url: '{{ route('getPincode') }}',
                dataType: 'json',
                method: 'POST',
                delay: 250,
                data: function(params) {
                    console.log(params.term);
                    var query = {
                        name: params.term,
                        country: $('#toCountry').val(),
                        city: $('#toCity option:selected').text()
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
    </script>
@endpush
