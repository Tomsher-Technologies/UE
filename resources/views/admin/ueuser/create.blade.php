@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Create Admin users</div>
            </div>
            @livewire('ue-user.create')
        </div>
    </div>
@endsection
