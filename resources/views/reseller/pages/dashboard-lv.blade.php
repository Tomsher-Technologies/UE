@extends('layouts.reseller.app')
@section('content')
    <div class="mdk-box mdk-box--bg-primary bg-dark js-mdk-box mb-0" data-effects="parallax-background blend-background">
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
                                    <label class="text-white" for="filter_name">Shipment Type</label>
                                    <div>
                                        <div class="autocomplete">
                                            <select class="form-control" id="type" name="shipping_type" required>
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
                                    <label class="text-white" for="filter_name">Package Type</label>
                                    <div>
                                        <div class="autocomplete">
                                            <select class="form-control" id="type" name="package_type" required>
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

                        @livewire('reseller.search-inputs')

                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <label class="text-white" for="filter_name">Number of Pieces</label>
                                    <div>
                                        <div class="autocomplete">
                                            <input readonly="readonly" value="1" class="form-control" type="number"
                                                name="no_pieces" id="no_pieces" placeholder="Number of Pieces">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="packgaeContainer">
                            <div class="row text-left">
                                <div class="col-12">
                                    <label class="text-white" for="filter_name">Package - Dimensions(CM)</label>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Length</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step=".1" type="number" name="length[1]"
                                                    placeholder="Length" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Height</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step=".1" type="number" name="height[1]"
                                                    placeholder="Height" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Width</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step=".1" type="number" name="width[1]"
                                                    placeholder="Width" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Actual Weight</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" step=".1" name="weight[1]"
                                                    placeholder="Actual Weight" required>
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

                        {{-- <input type="hidden" name="search_token" value="{{ $search_token }}"> --}}
                        <input type="hidden" id="search_token" name="search_token">

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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        div.searchable {
            width: 300px;
            float: left;
            margin: 0 15px;
        }

        .searchable input {
            width: 100%;
            height: 50px;
            font-size: 18px;
            padding: 10px;
            -webkit-box-sizing: border-box;
            /* Safari/Chrome, other WebKit */
            -moz-box-sizing: border-box;
            /* Firefox, other Gecko */
            box-sizing: border-box;
            /* Opera/IE 8+ */
            display: block;
            font-weight: 400;
            line-height: 1.6;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            background: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center/8px 10px;
        }

        .searchable ul {
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
    </style>
@endpush
@push('footer')

    <script>
        $id = 2;

        function addElement($id) {
            $("#packgaeContainer").append(`<div class="row text-left">
                                <div class="col-12">
                                    <label class="text-white" for="filter_name">Package - Dimensions(CM)</label>
                                    <button class="btn btn-sm btn-primary text-light ml-2 remove-package"
                                        type="button">Remove Package</button>
                                </div> 
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Length</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step='.1' type="number" name="length[]"
                                                    placeholder="Length" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Height</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step='.1' type="number" name="height[]"
                                                    placeholder="Height" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Width</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" step='.1' type="number" name="width[]"
                                                    placeholder="Width" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group text-left">
                                        <label class="text-white" for="filter_name">Actual Weight</label>
                                        <div>
                                            <div class="autocomplete">
                                                <input class="form-control" type="number" step='.1' required name="weight[]"
                                                    placeholder="Actual Weight">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
        }

        $('#addPackage').on('click', function() {
            addElement($id);
            $('#no_pieces').get(0).value++
            $id++;
        });

        $('body').on('click', '.remove-package', function() {
            $(this).closest('.row').remove();
            $('#no_pieces').get(0).value--
            $id--;
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#searchForm').trigger("reset");
            $('#search_token').val(Math.floor(Math.random() * 26) + Date.now());
        });
    </script>
@endpush
