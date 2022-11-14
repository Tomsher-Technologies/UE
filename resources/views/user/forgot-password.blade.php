@extends('layouts.adminauth')

@section('content')
    
    <form method="POST" action="{{ route('password.email') }}" class="col-md-5 p-0  form  p-5 text-left rounded">
        @csrf
        <center>  <h3>Forgot your password</h3> </center>   
        <x-form.status />
        <x-form.input name="email" text="Emial" required />
        <div class="text-center">
            <button type="submit" class="btn pl-4 pr-4 btn-rounded btn-primary">
                Request Reset
            </button>
        </div>
    </form>
@endsection
