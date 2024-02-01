@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Reports</div>
            </div>
            <div class="card mb-lg-32pt">
                <livewire:admin.reports.search-report />
            </div>
        </div>
    </div>
@endsection
@push('header')
    @powerGridStyles
    @powerGridScripts
@endpush
