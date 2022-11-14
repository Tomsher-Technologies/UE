@extends('layouts.reseller.app')
@section('content')
    <div class="page-section border-bottom-2">
        <div class="container-fluid page__container">
            <div class="page-separator">
                <div class="page-separator__text">Search History</div>
            </div>
            <div class="search-result">
                <div class="card mb-0">
                    @if ($searches->count() > 0)
                        <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-employee-name"
                            data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>
                            <table class="table mb-0 thead-border-top-0 table-nowrap">
                                <thead>
                                    <tr class="text-uppercase small">
                                        <th>
                                            <a href="javascript:void(0)">Shipment type</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">Package type</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">From Address</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">To Address</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">Number of Pieces
                                            </a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)">View Packages
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="users">
                                    @foreach ($searches as $search)
                                        <tr class="selected">
                                            <td>
                                                {{ ucfirst($search->shipment_type) }}
                                            </td>
                                            <td>
                                                {{ ucfirst($search->package_type) }}
                                            </td>
                                            <td>
                                                {{ $search->fromCountry->name }} <br>
                                                {{ $search->from_city }} <br>
                                                {{ $search->from_pin }}
                                            </td>
                                            <td>
                                                {{ $search->toCountry->name }} <br>
                                                {{ $search->to_city }} <br>
                                                {{ $search->to_pin }}
                                            </td>
                                            <td>
                                                {{ ucfirst($search->number_of_pieces) }}
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary text-light pt-2 pb-2" type="button"
                                                    onclick="showModal({{ $search->id }})">
                                                    Show
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="p-2 mb-0 text-center">
                            No data found
                        </p>
                    @endif

                    {{ $searches->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
    <style>
        .pagination-nav {
            padding: 15px 0;
        }

        .pagination-nav .pagination {
            justify-content: center !important;
        }
    </style>
@endpush
@push('footer')
    <script>
        function showModal(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            jQuery.ajax({
                url: "{{ route('reseller.search.history.items') }}",
                method: 'POST',
                data: {
                    id: data,
                },
                success: function(result) {
                    result = JSON.parse(result);
                    $("#packages").empty();
                    result.forEach(element => {
                        rowContent = "<tr><td class='text-center'>" + element['length'] +
                            "</td><td class='text-center'>" + element['height'] +
                            "</td><td class='text-center'>" + element['width'] +
                            "</td><td class='text-center'>" + element['weight'] + "</td></tr>";
                        $('#packages').append(rowContent);
                    });
                    $('#exampleModal').modal('show');
                }
            });
        }
    </script>
@endpush

@push('modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Packages
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table mb-0 thead-border-top-0 table-nowrap">
                        <thead>
                            <tr class="text-uppercase small">
                                <th>
                                    <a href="javascript:void(0)">
                                        Length
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">Height</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">Width</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">Actual Weight</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" id="packages">

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush
