@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">UE users</div>
            </div>
            <div class="card mb-lg-32pt">
                @livewire('admin.ue-user.index')
            </div>
        </div>
    </div>
@endsection
