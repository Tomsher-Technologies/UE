@extends('layouts.admin')

@section('content')
    <x-form.status />
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-form.input name="email" text="Emial" required />
        <input type="submit" value="Reset Password">
    </form>
@endsection
