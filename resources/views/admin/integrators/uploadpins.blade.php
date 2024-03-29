@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Upload Out Of Delivery Pincodes</div>
            </div>

            @if (session('import_errors') && count(session('import_errors')) > 0)
                <div class="alert alert-danger">
                    {{ count(session('import_errors')) }} Errors. Could not import data for
                    {{ Str::plural('zone', count(session('import_errors'))) }}
                    {{ implode(session('import_errors'), ', ') }},
                    because the {{ Str::plural('country', count(session('import_errors'))) }} does not exist. Please create
                    the
                    {{ Str::plural('country', count(session('import_errors'))) }} first and then try uploading again.
                </div>
            @endif

            <x-form.status />

            <form method="POST" action="{{ route('admin.integrator.uploadOdPin', $integrator) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Choose a file</label>
                    <input accept=".xlsx,.csv" type="file" name="importfile" class="form-control mb-2">
                    <x-form.error name="importfile" />
                </div>
                <input class="btn btn-primary" type="submit" value="Upload">
            </form>

        </div>
    </div>
@endsection
