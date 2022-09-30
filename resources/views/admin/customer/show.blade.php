@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Show Customer</div>
            </div>
            @livewire('admin.customer.show', ['user' => $user])
        </div>
    </div>
@endsection
