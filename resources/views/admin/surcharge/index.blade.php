@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Surcharge</div>
            </div>
            <div class="card mb-lg-32pt">
                @livewire('admin.surcharge.listing')
            </div>
        </div>
    </div>
@endsection
