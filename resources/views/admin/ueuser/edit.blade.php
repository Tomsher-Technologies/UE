@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Edit UE users</div>
            </div>
            @livewire('admin.ue-user.edit', ['user' => $user])
        </div>
    </div>
@endsection
