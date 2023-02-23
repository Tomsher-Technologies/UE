@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Integrators Zones</div>
            </div>

            @if ($import->count())
                <div class="accordion js-accordion accordion--boxed mb-24pt" id="parent">
                    <div class="accordion__item">
                        <a href="#" class="accordion__toggle collapsed" data-toggle="collapse" data-target="#import"
                            data-parent="#parent">
                            <span class="flex">Import</span>
                            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                        </a>
                        <div class="accordion__menu collapse" id="import">
                            <div class="table-responsive p-2" data-toggle="lists" data-lists-sort-by="js-lists-values-name"
                                data-lists-sort-desc="true"
                                data-lists-values='["js-lists-values-name","js-lists-values-country","js-lists-values-country-code"]'>

                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="javascript:void(0)" class="sort"
                                                    data-sort="js-lists-values-name">Weight</a>
                                            </th>
                                            <th>
                                                <a href="javascript:void(0)" class="sort"
                                                    data-sort="js-lists-values-country">Package</a>
                                            </th>
                                            @foreach ($import_zones as $item)
                                                <th>
                                                    <a href="javascript:void(0)" class="sort"
                                                        data-sort="js-lists-values-country-code">{{ $item->zone_code }}</a>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="clients">
                                        @foreach ($import as $zon)
                                            <tr>
                                                @foreach ($zon as $item)
                                                    <td>
                                                        <div class="media flex-nowrap align-items-center"
                                                            style="white-space: nowrap;">
                                                            <div class="media-body">
                                                                <div class="d-flex flex-column">
                                                                    <p class="mb-0">
                                                                        <strong class="js-lists-values-name">
                                                                            {{ $item }}
                                                                        </strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            @if ($export->count())
                <div class="accordion js-accordion accordion--boxed mb-24pt" id="parent2">
                    <div class="accordion__item">
                        <a href="#" class="accordion__toggle collapsed" data-toggle="collapse" data-target="#export"
                            data-parent="#parent2">
                            <span class="flex">Export</span>
                            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                        </a>
                        <div class="accordion__menu collapse" id="export">
                            <div class="table-responsive p-2" data-toggle="lists" data-lists-sort-by="js-lists-values-name"
                                data-lists-sort-desc="true"
                                data-lists-values='["js-lists-values-name","js-lists-values-country","js-lists-values-country-code"]'>

                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="javascript:void(0)" class="sort"
                                                    data-sort="js-lists-values-name">Weight</a>
                                            </th>
                                            <th>
                                                <a href="javascript:void(0)" class="sort"
                                                    data-sort="js-lists-values-country">Package</a>
                                            </th>
                                            @foreach ($export_zones as $item)
                                            
                                                <th>
                                                    <a href="javascript:void(0)" class="sort"
                                                        data-sort="js-lists-values-country-code">{{ $item->zone_code }}</a>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="clients">
                                        @foreach ($export as $zon)
                                            <tr>
                                                @foreach ($zon as $item)
                                                    <td>
                                                        <div class="media flex-nowrap align-items-center"
                                                            style="white-space: nowrap;">
                                                            <div class="media-body">
                                                                <div class="d-flex flex-column">
                                                                    <p class="mb-0">
                                                                        <strong class="js-lists-values-name">
                                                                            {{ $item }}
                                                                        </strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            @if ($transit->count())
                <div class="accordion js-accordion accordion--boxed mb-24pt" id="parent3">
                    <div class="accordion__item">
                        <a href="#" class="accordion__toggle collapsed" data-toggle="collapse" data-target="#transit"
                            data-parent="#parent3">
                            <span class="flex">Transit</span>
                            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                        </a>
                        <div class="accordion__menu collapse" id="transit">
                            <div class="table-responsive p-2">

                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="javascript:void(0)" >Weight</a>
                                            </th>
                                            <th>
                                                <a href="javascript:void(0)" >Package</a>
                                            </th>
                                            @foreach ($transit_zones as $item)
                                                <th>
                                                    <a href="javascript:void(0)" >{{ $item }}</a>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="clients">
                                        @foreach ($transit as $zon)
                                            <tr>
                                                @foreach ($zon as $item)
                                                    <td>
                                                        <div class="media flex-nowrap align-items-center"
                                                            style="white-space: nowrap;">
                                                            <div class="media-body">
                                                                <div class="d-flex flex-column">
                                                                    <p class="mb-0">
                                                                        <strong class="js-lists-values-name">
                                                                            {{ $item }}
                                                                        </strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>
@endsection
