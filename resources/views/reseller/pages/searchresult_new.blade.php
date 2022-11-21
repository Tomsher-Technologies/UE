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
                                                {{ $integrator->billable_weight }}
                                            </td>
                                            <td class="text-center text-70">
                                                <div class="mr-sm-16pt mb-8pt mb-sm-0">
                                                    <span class="card-title mb-4pt btn btn-dark text-white" disabled>AED
                                                        {{ $integrator->zones->weight->rate }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center text-70">
                                                <div class="align-items-center mr-16pt">
                                                    {{-- <input type="button" value="Book Now" class="btn btn-primary"> --}}

                                                    <form class="d-inline" action="{{ route('reseller.booking.view') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="integrator"
                                                            value="{{ $integrator->id }}">
                                                        <input type="hidden" name="rate"
                                                            value="{{ $integrator->zones->weight->rate }}">
                                                        <input type="hidden" name="search_id" value="{{ $search_id }}">
                                                        <input type="hidden" name="totalweight"
                                                            value="{{ $integrator->billable_weight }}">
                                                        <input type="submit" value="Book Now" class="btn btn-primary">
                                                    </form>

                                                    @if ($hasSpecialRequest)
                                                        <a href="#" data-iid="{{ $integrator->id }}"
                                                            data-rate="{{ $integrator->zones->weight->rate }}"
                                                            data-sid="{{ $search_id }}"
                                                            data-totalweight="{{ $integrator->billable_weight }}"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            class="btn btn-primary">Request Special
                                                            Price</a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="p-2 mb-0 text-center">
                            No results found
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
@endpush
@push('footer')
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var iid = button.data('iid')
            var sid = button.data('sid')
            var rate = button.data('rate')
            var total_weight = button.data('totalweight')
            var modal = $(this)
            modal.find('#iid').val(iid)
            modal.find('#sid').val(sid)
            modal.find('#rate').val(rate)
            modal.find('#total_weight').val(total_weight)
        });

        $('#requstForm').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            data = $('#requstForm').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('reseller.search.specialRequest') }}",
                data: data,
                success: function(resultData) {
                    resultData = JSON.parse(resultData);
                    if (resultData.status == 'ok') {
                        $('#exampleModal').modal('hide');
                        new swal('Request Submitted', '', 'success');
                    }
                }
            });

        });
    </script>
@endpush
@push('modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Resquest Special Rate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="requstForm">
                        <div class="form-group">
                            <input type="hidden" id="sid" name="sid" class="form-control" />
                            <input type="hidden" id="iid" name="iid" class="form-control" />
                            <input type="hidden" id="rate" name="rate" class="form-control" />
                            <input type="hidden" id="total_weight" name="total_weight" class="form-control" />
                            <label>Resquest Rate</label>
                            <input type="number" name="request_rate" required step=".1" class="form-control"
                                placeholder="Resquest Rate" />
                        </div>
                        <button type="submit" id="requestBtn" class="btn btn-success">Request</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
