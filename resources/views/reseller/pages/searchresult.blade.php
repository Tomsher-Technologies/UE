@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="page-separator">
                <div class="page-separator__text">Search Result</div>
            </div>

            <div class="search-result">
                <div class="card stack">
                    <div class="list-group list-group-flush">
                        @foreach ($integrators as $integrator)
                            <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center px-12pt">
                                <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                                    <div class="flex">
                                        <span class="card-title mb-4pt" href="">{{ $integrator->name }}</span>
                                    </div>
                                </div>
                                <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                                    <div class="flex">
                                        <span class="card-title mb-4pt btn btn-dark text-white" disabled>
                                           AED {{ $integrator->zone->first()->rate }}
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex text-center d-flex align-items-center mr-16pt">
                                        <a href="#" class="btn btn-primary">Book Now</a>
                                    </div>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i
                                                class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="javascript:void(0)" class="dropdown-item">Request Special Rate</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
@endpush
@push('footer')
@endpush
