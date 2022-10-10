@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Create Special Rates</div>
            </div>
            @livewire('admin.special-rates.create',[
                'user' => $user
            ])
        </div>
    </div>
@endsection
