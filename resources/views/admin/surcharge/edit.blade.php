@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Edit Surcharge</div>
            </div>
            @livewire('admin.surcharge.edit', [
                'surcharge' => $surcharge,
            ])
        </div>
    </div>
@endsection
