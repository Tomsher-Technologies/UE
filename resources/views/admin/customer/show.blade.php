@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Show Customer</div>
            </div>

            <div class="row">
                <div class="col-8">
                    @livewire('admin.customer.show', ['user' => $user])
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.special_rates.create', $user) }}" class="btn btn-primary w-100 mb-2">Special
                                rate</a>
                            <a href="{{ route('admin.customer.profitMargin', $user) }}" class="btn btn-primary w-100 mb-2">
                                Profit Margin
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            {{-- <div class="page-separator">
                <div class="page-separator__text">Special rate</div>
            </div>
            <div class="mb-lg-32pt">
                <a href="{{ route('admin.special_rates.create', $user) }}" class="btn btn-primary w-auto">Add Special rate</a>
                <div class="card mt-2">
                    @livewire('admin.special-rates.listing', ['user' => $user])
                </div>
            </div> --}}

            <hr>
        </div>
    </div>
@endsection
