@extends('layouts.adminauth')

@section('content')
    <form method="POST" action="{{ route('password.update') }}" class="col-md-5 p-0 mx-auto form p-5 text-left rounded">
        @csrf
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
        <x-form.input name="email" type="email" text="Email" required />
        <x-form.input name="password" type="password" text="Password " required />
        <x-form.input name="password_confirmation" type="password" text="Password confirmation" required />
        <input name="token" type="hidden" value="{{ $token }}" >
        <div class="text-center">
            <button type="submit" class="btn pl-4 pr-4 btn-rounded btn-primary">
                Reset Password
            </button>
        </div>
    </form>
@endsection
