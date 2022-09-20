@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Admin users</div>
            </div>
            <div class="card mb-lg-32pt">
                @livewire('ue-user.index')
            </div>
        </div>
    </div>
@endsection
