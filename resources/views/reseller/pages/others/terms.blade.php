@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-separator">
                        <div class="page-separator__text">{{ $data->heading }}</div>
                    </div>
                    <div>
                        {!! $data->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
