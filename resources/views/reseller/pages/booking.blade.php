@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="page-separator">
                <div class="page-separator__text">
                    <h4>Booking</h4>
                </div>
            </div>
            <form action="{{ route('reseller.search.booking.submit') }}" method="POST">
                @csrf

                <div class="page-separator">
                    <div class="page-separator__text">
                        Shipper Details
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Shipper Name</label>
                                    <input type="text" class="form-control" name="shipper_name"
                                        value="{{ old('shipper_name', auth()->user()->name) }}" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Shipper Phone</label>
                                    <input type="text" class="form-control" name="shipper_phone"
                                        value="{{ old('shipper_phone', $details->phone) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Shipper Address</label>
                                <textarea name="shipper_address" class="form-control" cols="30" rows="5">{{ old('shipper_address', $details->address) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">
                        Consignee Details
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Consignee Name</label>
                            <input type="text" class="form-control" name="receiver_name"
                                value="{{ old('receiver_name') }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Consignee Contact Person</label>
                            <input type="text" class="form-control" value="{{ old('receiver_contact_person') }}"
                                name="receiver_contact_person" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Consignee Email</label>
                            <input type="email" class="form-control" value="{{ old('receiver_email') }}"
                                name="receiver_email" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Consignee Phone</label>
                            <input type="text" class="form-control" value="{{ old('receiver_phone') }}"
                                name="receiver_phone" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Consignee Address</label>
                            <textarea name="receiver_address"class="form-control" cols="30" rows="5">{{ old('receiver_address') }}</textarea>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Consignee Town</label>
                            <input type="text" class="form-control" value="{{ old('receiver_town') }}"
                                name="receiver_town" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Consignee Province</label>
                            <input type="text" class="form-control" value="{{ old('receiver_province') }}"
                                name="receiver_province">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">Item Name</label>
                            <input type="text" class="form-control" value="{{ old('item_name') }}" name="item_name">
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <button class="btn btn-sm btn-primary text-light pt-2 pb-2" type="submit">Submit</button>
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
