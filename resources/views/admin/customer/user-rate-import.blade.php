@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Import Customer Rates</div>
            </div>

            @if (session('error_missing') && count(session('error_missing')) > 0)
                <div class="alert alert-danger">
                    @foreach (session('error_missing') as $key => $errors)
                        In row {{ $key }}: <br>
                        @foreach ($errors as $error)
                            {{ $error }} <br>
                        @endforeach
                        <hr />
                    @endforeach
                </div>
            @endif

            <x-form.status />

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.customer.newRate', $user) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Integrator</label>
                                            <select name="integrator" id=""
                                                class="form-control custom-select mb-2">
                                                @foreach ($integrators as $integrator)
                                                    <option value="{{ $integrator->id }}">{{ $integrator->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-form.error name="integrator" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Type</label>
                                            <select name="type" class="form-control custom-select">
                                                <option value="import">Import</option>
                                                <option value="export">Export</option>
                                                <option value="transit">Transit</option>
                                            </select>
                                            <x-form.error name="type" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Choose a file</label>
                                            <input accept=".xlsx,.csv" type="file" name="importfile"
                                                class="form-control mb-2">
                                            <x-form.error name="importfile" />
                                        </div>
                                    </div>
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
