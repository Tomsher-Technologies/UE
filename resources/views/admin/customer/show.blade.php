@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Show Customer</div>
            </div>
            @livewire('admin.customer.show', ['user' => $user])

            <div class="mb-lg-32pt">
                <a href="{{ route('admin.special_rates.create', $user) }}" class="btn btn-primary w-auto">Add Special rate /
                    Discount</a>
                @livewire('admin.special-rates.listing', ['user' => $user])
            </div>

        </div>
    </div>
@endsection
