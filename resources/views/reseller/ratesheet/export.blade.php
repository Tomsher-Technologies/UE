@extends('layouts.reseller.app')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Download Rate Sheet</div>
            </div>
            <x-form.status />
            <div class="card mb-lg-32pt">
                <div class="container page__container">
                    <div class="page-section">
                        <form method="POST" id="form" action="{{ route('reseller.ratesheet.export') }}">
                            @csrf

                            <div class="form-group" wire:ignore>
                                <label class="form-label">Choose a type</label>
                                <select name="type" id="" class="form-control mb-2">
                                    <option {{ old('type') == 'import' ? 'selected' : '' }} value="import" selected>Import
                                    </option>
                                    <option {{ old('type') == 'export' ? 'selected' : '' }} value="export">Export</option>
                                    <option {{ old('type') == 'transit' ? 'selected' : '' }} value="transit">Transit
                                    </option>
                                </select>
                                <x-form.error name="type" />
                            </div>

                            <div class="form-group" id="integrator">
                                <label class="form-label">Choose an integrator</label>
                                <select name="integrator" id="" class="form-control mb-2">
                                    @foreach ($integrators as $integrator)
                                        <option {{ old('integrator') == $integrator->id ? 'selected' : '' }}
                                            value="{{ $integrator->id }}">
                                            {{ $integrator->name }}</option>
                                    @endforeach
                                </select>
                                <x-form.error name="integrator" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Weight</label>
                                <input name="weight" step=".1" type="number" class="form-control mb-2"
                                    value="{{ old('weight') }}">
                                <x-form.error name="weight" />
                            </div>

                            <div class="form-group" id="integrator">
                                <label class="form-label">Choose an country</label>
                                <select name="country" id="country" class="form-control mb-2">
                                    <option selected value="0">All</option>
                                    @foreach ($countries as $country)
                                        <option {{ old('country') == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}">
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <x-form.error name="country" />
                            </div>

                            <input class="btn btn-primary" type="submit" value="Export">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script>
        $("#country").select2();

        window.onblur = function() {
            swal.close()
        }

        $('#form').on('submit', function() {
            new swal({
                title: "Loading...",
                imageUrl: "{{ asset('images/786.gif') }}",
                showConfirmButton: false,
            });
        });
    </script>
@endpush
