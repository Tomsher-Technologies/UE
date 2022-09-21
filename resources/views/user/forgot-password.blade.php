@extends('layouts.adminauth')

@section('content')
    
    <form method="POST" action="{{ route('password.email') }}" class="col-md-5 p-0 mx-auto form p-5 text-left rounded">
        @csrf
        <x-form.status />
        <x-form.input name="email" text="Emial" required />
        <div class="text-center">
            <button type="submit" class="btn pl-4 pr-4 btn-rounded btn-primary">
                Request Reset
            </button>
        </div>
    </form>
@endsection
