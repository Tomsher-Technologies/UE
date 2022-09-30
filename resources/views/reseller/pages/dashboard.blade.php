@extends('layouts.reseller.app')
@section('content')
    <div class="mdk-box mdk-box--bg-primary bg-dark js-mdk-box mb-0" data-effects="parallax-background blend-background">
        <div class="mdk-box__bg">
            <div class="mdk-box__bg-front"
                style="
                background-image: url({{ resellerAsset('images/globe.jpg') }});
                background-size: cover;
              ">
            </div>
        </div>
        <div class="mdk-box__content justify-content-center">
            <div class="hero container-fluid page__container text-center py-112pt">

                <div id="quick-search" class="card card-form d-flex flex-column flex-sm-row mb-lg-32pt bg-blur pb-4">
                    <div class="card-form__body card-body-form-group flex bg-transparent text-left">
                        <!-- <p class="lead measure-hero-lead mx-auto text-white text-shadow text-center"> Quick Search:</p> -->
                        <div class="row align-items-center">



                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="select01">From</label>
                                    <select id="select02" data-toggle="select" class="form-control">
                                        <option selected="">Select Country</option>
                                        <option>Afghanistan</option>
                                        <option>Algeria</option>
                                        <option>Argentina</option>
                                        <option>Australia</option>
                                        <option>Bangladesh</option>
                                        <option>Belgium</option>
                                        <option>Bhutan</option>
                                        <option>Brazil</option>
                                        <option>Canada</option>
                                        <option>China</option>
                                        <option>Denmark</option>
                                        <option>Ethiopia</option>
                                        <option>Finland</option>
                                        <option>France</option>
                                        <option>Germany</option>
                                        <option>Hungary</option>
                                        <option>Iceland</option>
                                        <option>India</option>
                                        <option>Indonesia</option>
                                        <option>Iran</option>
                                        <option>Italy</option>
                                        <option>Japan</option>
                                        <option>Malaysia</option>
                                        <option>Maldives</option>
                                        <option>Mexico</option>
                                        <option>Morocco</option>
                                        <option>Nepal</option>
                                        <option>Netherlands</option>
                                        <option>Nigeria</option>
                                        <option>Norway</option>
                                        <option>Pakistan</option>
                                        <option>Peru</option>
                                        <option>Russia</option>
                                        <option>Romania</option>
                                        <option>South Africa</option>
                                        <option>Spain</option>
                                        <option>Sri Lanka</option>
                                        <option>Sweden</option>
                                        <option>Switzerland</option>
                                        <option>Thailand</option>
                                        <option>Turkey</option>
                                        <option>Uganda</option>
                                        <option>Ukraine</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                        <option>Vietnam
                                        <option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="select01">To</label>
                                    <select id="select01" data-toggle="select" class="form-control">
                                        <option selected="">Select Country</option>
                                        <option>Afghanistan</option>
                                        <option>Algeria</option>
                                        <option>Argentina</option>
                                        <option>Australia</option>
                                        <option>Bangladesh</option>
                                        <option>Belgium</option>
                                        <option>Bhutan</option>
                                        <option>Brazil</option>
                                        <option>Canada</option>
                                        <option>China</option>
                                        <option>Denmark</option>
                                        <option>Ethiopia</option>
                                        <option>Finland</option>
                                        <option>France</option>
                                        <option>Germany</option>
                                        <option>Hungary</option>
                                        <option>Iceland</option>
                                        <option>India</option>
                                        <option>Indonesia</option>
                                        <option>Iran</option>
                                        <option>Italy</option>
                                        <option>Japan</option>
                                        <option>Malaysia</option>
                                        <option>Maldives</option>
                                        <option>Mexico</option>
                                        <option>Morocco</option>
                                        <option>Nepal</option>
                                        <option>Netherlands</option>
                                        <option>Nigeria</option>
                                        <option>Norway</option>
                                        <option>Pakistan</option>
                                        <option>Peru</option>
                                        <option>Russia</option>
                                        <option>Romania</option>
                                        <option>South Africa</option>
                                        <option>Spain</option>
                                        <option>Sri Lanka</option>
                                        <option>Sweden</option>
                                        <option>Switzerland</option>
                                        <option>Thailand</option>
                                        <option>Turkey</option>
                                        <option>Uganda</option>
                                        <option>Ukraine</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                        <option>Vietnam
                                        <option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group ">
                                    <label for="filter_name">Wieght</label>
                                    <input id="filter_name" type="text" class="form-control"
                                        placeholder="Add your wieght">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group ">
                                    <label for="filter_name">Quantity</label>
                                    <input id="filter_name" type="text" class="form-control"
                                        placeholder="Add your quantity">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <a href="" class="btn btn-sm btn-primary text-light w-100 pt-2 pb-2"
                                    style="margin-top:10px">Search</a>
                            </div>
                        </div>
                    </div>
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
@endpush
@push('footer')
@endpush
