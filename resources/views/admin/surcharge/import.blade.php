@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Import Surcharge</div>
            </div>

            @if (session('import_errors') && count(session('import_errors')) > 0)
                <div class="alert alert-danger">
                    {{ count(session('import_errors')) }} Errors. Could not import data for
                    {{ Str::plural('surcharge', count(session('import_errors'))) }}
                    {{ implode(', ', session('import_errors')) }}
                </div>
            @endif

            <x-form.status />

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.surcharge.import') }}"
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
                </div>
            </div>

        </div>
    </div>
@endsection
