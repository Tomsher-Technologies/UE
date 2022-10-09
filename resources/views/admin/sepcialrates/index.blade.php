@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Special Rates</div>
            </div>
            <div class="card mb-lg-32pt">
                @livewire('admin.special-rates.listing')
            </div>
        </div>
    </div>
@endsection
