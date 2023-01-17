@extends('layouts.adminauth')

@section('content')
    <form method="POST" action="{{ route('admin.login') }}" class="col-md-5 p-0 form p-5 text-left rounded">
        @csrf
        <center>
            <img width="150" class="mb-5" src="{{ adminAsset('images/logo/logo2.png') }}" alt="" />
        </center>
        <x-form.error name="login" />
        <x-form.input name="email" type="email" text="Email" />
        <x-form.input name="password" type="password" text="Password" />
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="1" id="invalidCheck01" name="remember_me" />
                <label class="custom-control-label" for="invalidCheck01">
                    Remember Me
                </label>
            </div>
        </div>
        <div class="form-group">
            <p class="text-right">
                <a href="{{ route('password.request') }}" class="small">Forgot your password?</a>
            </p>
        </div>
        <div class="text-center">
            <button type="submit" class="btn pl-4 pr-4 btn-rounded btn-primary">
                Login
            </button>
        </div>
    </form>
@endsection
