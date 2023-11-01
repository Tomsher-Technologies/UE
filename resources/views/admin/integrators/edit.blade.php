@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Edit integrators</div>
            </div>

            <x-form.status />
            @if (session('import_errors') && count(session('import_errors')) > 0)
                <div class="alert alert-danger">
                    {{ count(session('import_errors')) }} Errors. Could not import data for
                    {{ Str::plural('zone', count(session('import_errors'))) }}
                    {{ implode(', ',session('import_errors')) }},
                    because the {{ Str::plural('country', count(session('import_errors'))) }} does not exist. Please create
                    the
                    {{ Str::plural('country', count(session('import_errors'))) }} first and then try uploading again.
                </div>
            @endif
            @if (session('zone_import_errors') && count(session('zone_import_errors')) > 0)
                <div class="alert alert-danger">
                    Could not import data for {{ Str::plural('zone', count(session('zone_import_errors'))) }}
                    {{ implode(', ',session('zone_import_errors')) }},
                    because the {{ Str::plural('zone', count(session('zone_import_errors'))) }} does not exist. Please
                    create the
                    {{ Str::plural('zone', count(session('zone_import_errors'))) }} first and then try uploading again.
                </div>
            @endif

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


                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{ route('admin.integrator.uploadRates', $integrator) }}"
                                                    class="btn btn-secondary w-100 mb-2">
                                                    Upload Rates
                                                </a>
                                            </div>

                                            <div class="col-6">
                                                <div class="btn-group w-100" role="group">
                                                    <button id="btnGroupDrop1" type="button"
                                                        class="btn btn-primary w-100 mb-2 dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        View Rates
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.integrator.rates', [
                                                                'integrator' => $integrator,
                                                                'type' => 'import',
                                                            ]) }}">
                                                            Import Rates
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.integrator.rates', [
                                                                'integrator' => $integrator,
                                                                'type' => 'export',
                                                            ]) }}">
                                                            Export Rates
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.integrator.rates', [
                                                                'integrator' => $integrator,
                                                                'type' => 'transit',
                                                            ]) }}">
                                                            Transit Rates
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{ route('admin.integrator.uploadZones', $integrator) }}"
                                                    class="btn btn-secondary w-100 mb-2">
                                                    Upload Zones
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('admin.integrator.zones', $integrator) }}"
                                                    class="btn btn-primary w-100 mb-2">
                                                    View Zones
                                                </a>
                                            </div>
                                        </div>

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
        .logoimg {
            width: 350px;
            display: block;
        }
    </style>
@endpush
