@extends('layouts.admin')

@section('content')
    @livewire('ue-user.edit', ['user' => $user])
@endsection
