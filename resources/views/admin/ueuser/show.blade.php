@extends('layouts.admin')

@section('content')
    @livewire('admin.ue-user.create', ['user' => $user])
@endsection
