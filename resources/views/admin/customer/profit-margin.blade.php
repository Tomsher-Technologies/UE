@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            @livewire('admin.customer.profit-margin', [
                'user' => $user,
            ])
        </div>
    </div>
@endsection
