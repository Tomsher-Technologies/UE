@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">


            <div class="page-separator">
                <div class="page-separator__text">Search Result</div>
            </div>
            <div class="search-result">
                <div class="card mb-0">
                    @if ($integrators->count() > 0)
                        <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-employee-name"
                            data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>
                            <table class="table mb-0 thead-border-top-0 table-nowrap">
                                <thead>
                                    <tr class="text-uppercase small">
                                        <th>
                                            <a href="javascript:void(0)">Integrator</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">Total Weight</a>
                                        </th>
                                        <th class="text-center">
                                            <a href="javascript:void(0)">Amount</a>
                                        </th>
                                        <th class="text-center">
                                            <a href="javascript:void(0)">Action</a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="users">
                                    @foreach ($integrators as $integrator)
                                        <tr class="selected">
                                            <td>
                                                <div class="flex d-flex align-items-center mr-sm-16pt mb-8pt mb-sm-0">
                                                    <div class="avatar avatar-4by3 mr-12pt">
                                                        @if ($integrator->logo)
                                                            <img src="{{ $integrator->getLogoImage() }}"
                                                                alt="{{ $integrator->name }}" class="avatar-img rounded" />
                                                        @endif
                                                        <span class="overlay__content"></span>
                                                    </div>
                                                    <div class="flex">
                                                        <span class="card-title mb-4pt"
                                                            href="">{{ $integrator->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center text-70">
                                                {{ $total_weight }}
                                            </td>
                                            <td class="text-center text-70">
                                                <div class="mr-sm-16pt mb-8pt mb-sm-0">
                                                    <span class="card-title mb-4pt btn btn-dark text-white" disabled>AED
                                                        {{ $integrator->zone->first()->rate }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center text-70">
                                                <div class="align-items-center mr-16pt">
                                                    <a href="booking.html" class="btn btn-primary">Book Now</a>
                                                    <a href="#" data-toggle="modal" data-target="#exampleModal"
                                                        class="btn btn-primary">Request Special Price</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No results found
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
@endpush
@push('footer')
@endpush
@push('modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>uname</label>
                            <input type="text" class="form-control" placeholder="User Name" />
                            <label>upwd</label>
                            <input type="password" class="form-control" placeholder="password" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Login</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush
