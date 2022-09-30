@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Edit Customer</div>
            </div>
            @livewire('admin.customer.edit', ['user' => $user])
        </div>
    </div>
@endsection
