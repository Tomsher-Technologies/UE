@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="page-separator">
                <div class="page-separator__text">Booking History</div>
            </div>
            <div class="search-result">
                <div class="card mb-0">
                    <livewire:reseller.booking-history-table/>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
    <style>
        .pagination-nav {
            padding: 15px 0;
        }

        .pagination-nav .pagination {
            justify-content: center !important;
        }
    </style>
@endpush
@push('footer')
@endpush
