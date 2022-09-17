@extends('layouts.admin')

@section('content')
    @livewire('ue-user.create', ['user' => $user])
@endsection
