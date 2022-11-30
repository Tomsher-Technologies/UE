@extends('layouts.reseller.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Edit Profile</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <x-form.status />

                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('reseller.user.profile-update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h5>Edit Details</h5>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" disabled id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ auth()->user()->email }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" autocomplete="name" class="form-control"
                                    value="{{ auth()->user()->name }}">
                            </div>
                            <input type="hidden" name="details" value="1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" name="phone" autocomplete="tel" class="form-control"
                                    value="{{ $details->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" name="address" autocomplete="address-level1" class="form-control"
                                    value="{{ $details->address }}">
                            </div>

                            @if ($details->image)
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <img class="d-block" style="width: 500px;"
                                        src="{{ URL::to($details->getProfileImage()) }}" alt="">
                                    <input type="file" name="logoimage" class="form-control">
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary mb-0">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('reseller.user.password-update') }}">
                            @method('PUT')
                            @csrf
                            <h5>Reset Password</h5>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Current Password</label>
                                <input type="password" name="current_password" class="form-control"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Comfirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary mb-0">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Security</h5>
                        <h6>Log Out Everywhere Else</h6>
                        <form method="POST" action="{{ route('reseller.user.logout-everywhere') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-danger mb-0 h-100">Log Out</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
