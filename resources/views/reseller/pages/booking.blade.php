@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="page-separator">
                <div class="page-separator__text">Booking</div>
            </div>
            <form action="{{ route('reseller.search.booking') }}" method="POST">
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
            </form>
        </div>
    </div>
@endsection

@push('header')
@endpush
@push('footer')
@endpush
