@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Edit integrators</div>
            </div>
            @livewire('admin.integrator.edit', ['integrator' => $integrator])
        </div>
    </div>
@endsection
