@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Export</div>
            </div>
            <x-form.status />
            <div class="card mb-lg-32pt">
                <div class="container page__container">
                    <div class="page-section">
                        <div class="page-separator">
                            <div class="page-separator__text">Export Rates</div>
                        </div>

                        <form method="POST" action="{{ route('admin.integrator.export') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Export by</label>
                                <select name="export_by" id="export_by" class="form-control mb-2">
                                    <option value="integrator" selected>Integrator</option>
                                    <option value="weight">Weight</option>
                                </select>
                                <x-form.error name="export_by" />
                            </div>
                            <div class="form-group" id="integrator">
                                <label class="form-label">Choose an integrator</label>
                                <select name="integrator" id="" class="form-control mb-2">
                                    @foreach ($integrators as $index => $integrator)
                                        <option {{ old('integrator') == $integrator->id ? 'selected' : '' }}
                                            {{ $index == 0 ? 'selected' : '' }} value="{{ $integrator->id }}">
                                            {{ $integrator->name }}</option>
                                    @endforeach
                                </select>
                                <x-form.error name="integrator" />
                            </div>
                            <div class="form-group" id="weight" style="display: none">
                                <label class="form-label">Weight</label>
                                <input name="weight" step=".1" type="number" class="form-control mb-2" value="{{ old('weight') }}">
                                <x-form.error name="user.email" />
                            </div>
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
                            <input class="btn btn-primary" type="submit" value="Export">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('footer')

    @if (old('export_by') == 'weight')
        <script>
            $('#weight').show();
            $('#integrator').hide();
        </script>
    @endif

    <script>
        $('#export_by').on('change', function() {
            val = $(this).find(":selected").val()
            if (val == 'weight') {
                $('#weight').show();
                $('#integrator').hide();
            } else {
                $('#weight').hide();
                $('#integrator').show();
            }
        })
    </script>
@endpush
