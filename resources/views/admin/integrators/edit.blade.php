@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Edit integrators</div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    @livewire('admin.integrator.edit', ['integrator' => $integrator])
                </div>
                <div class="col-lg-4">
                    <div class="list-group list-group-form">
                        <div class="list-group-item py-1 ">
                            <div class="form-group row align-items-center mb-0">
                                <label class="col-form-label form-label col-sm-12">Actions</label>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="form-group row align-items-center mb-0">
                                <div class="col-sm-12 d-flex align-items-center">
                                    <div class="flex pc-text-right">
                                        <a href="{{ route('admin.integrator.uploadRates', $integrator) }}"
                                            class="btn btn-secondary w-100 mb-2">
                                            Upload Rates
                                        </a>
                                        <a href="{{ route('admin.integrator.uploadZones', $integrator) }}"
                                            class="btn btn-secondary w-100 mb-2">
                                            Upload Zones
                                        </a>
                                        <a href="{{ route('admin.integrator.uploadOdPin', $integrator) }}"
                                            class="btn btn-secondary w-100 mb-2">
                                            Upload Out of Delivery Pincodes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('header')
    <style>
        .logoimg{
            width: 350px;
            display: block;
        }
    </style>
@endpush