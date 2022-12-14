@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Create integrators</div>
            </div>
            @livewire('admin.integrator.create')
        </div>
    </div>
@endsection
