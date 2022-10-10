@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Edit Special Rates</div>
            </div>
            @livewire('admin.special-rates.edit', [
                'specialRate' => $specialRate,
                'user' => $user,
            ])
        </div>
    </div>
@endsection
