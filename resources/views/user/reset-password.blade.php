@extends('layouts.admin')

@section('content')
    <x-form.status />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0 p-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            <p class="mb-0">{{ session('error') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <x-form.input name="email" type="email" text="Email" required />
        <x-form.input name="password" type="password" text="Password " required />
        <x-form.input name="password_confirmation" type="password" text="Password confirmation" required />
        <x-form.input name="token" type="hidden" value="{{ $token }}" />
        <input type="submit" value="Reset Password">
    </form>
@endsection
