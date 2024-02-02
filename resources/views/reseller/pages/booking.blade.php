@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="page-separator">
                <div class="page-separator__text">
                    <h4>Booking</h4>
                </div>
            </div>
            <form action="{{ route('reseller.booking.submit') }}" id="bookForm" method="POST">
                @csrf

                <input type="hidden" name="integrator" value="{{ old('integrator', $orequest->integrator) }}">
                <input type="hidden" name="rate" value="{{ old('rate', $orequest->rate) }}">
                <input type="hidden" name="search_id" value="{{ old('search_id', $orequest->search_id) }}">
                <input type="hidden" name="totalweight" value="{{ old('totalweight', $orequest->totalweight) }}">

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
                            <textarea name="receiver_address"class="form-control" cols="30" rows="5" required>{{ old('receiver_address') }}</textarea>
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
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">Item Name</label>
                            <input type="text" class="form-control" value="{{ old('item_name') }}" name="item_name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">Declare value</label>
                            <input class="form-control" type="number" name="declare_value" id=""
                                {{ old('declare_value') }}>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">Currency</label>
                            <select class="form-control select2" name="currency" id="currency">
                                @foreach (App\Models\CurrencyCode::all() as $item)
                                    <option value="{{ $item->code }}">{{ $item->code }} - {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <button class="btn btn-sm btn-primary text-light pt-2 pb-2 d-none" id="submitRealButton"
                            type="submit">Book Now</button>
                        <button class="btn btn-sm btn-primary text-light pt-2 pb-2" id="submitButton" type="button">Book
                            Now</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('header')
    <style>
        @media (min-width: 1024px) {
            .modal-dialog {
                max-width: 1000px;
            }
        }

        .term-content {
            max-height: 75vh;
            overflow-y: scroll;
            margin-bottom: 15px;
        }

        @media (min-width: 1024px) {
            .term-content {
                max-height: 60vh;
                overflow-y: scroll;
            }
        }
    </style>
@endpush
@push('footer')
    <script>
        $('#currency').select2();

        $('#submitButton').on('click', function(e) {
            e.preventDefault();
            $("#customCheck01").prop("checked", false);
            $('#exampleModal').modal('show');
        });
        $('#requestBtn').on('click', function(e) {
            e.preventDefault();

            if ($('#customCheck01').is(':checked')) {
                $('#exampleModal').modal('hide');
                $('#submitRealButton').trigger('click');
            } else {
                alert("Please agree to the terms and conditions");
            }

        });
    </script>
@endpush
@push('modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Terms and conditions</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="term-content">
                        {!! $terms->content !!}
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input id="customCheck01" type="checkbox" class="custom-control-input">
                            <label for="customCheck01" class="custom-control-label">I have read and agree with the terms
                                and conditions</label>
                        </div>
                    </div>

                    <button type="submit" id="requestBtn" class="btn btn-success">
                        Proceed to booking
                    </button>
                    <a href="{{ route('reseller.dashboard') }}" class="btn btn-danger float-right">Cancel</a>
                </div>
            </div>
        </div>
    </div>
@endpush
