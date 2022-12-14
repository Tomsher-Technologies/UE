@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">
                    Dynamic Contents
                </div>
            </div>
            <x-form.status />
            <div class="card mb-lg-32pt">
                @livewire('admin.dynamic-content.index')
            </div>
        </div>
    </div>
@endsection
