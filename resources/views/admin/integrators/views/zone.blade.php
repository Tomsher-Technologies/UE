@extends('layouts.admin')
@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Integrators Zones</div>
            </div>

            @foreach ($zones as $index => $zone)
                <div class="accordion js-accordion accordion--boxed mb-24pt" id="parent">
                    <div class="accordion__item">
                        <a href="#" class="accordion__toggle collapsed" data-toggle="collapse"
                            data-target="#{{ $index }}" data-parent="#parent">
                            <span class="flex">{{ ucfirst($index) }}</span>
                            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                        </a>
                        <div class="accordion__menu collapse" id="{{ $index }}">
                            <div class="table-responsive p-2" data-toggle="lists" data-lists-sort-by="js-lists-values-name"
                                data-lists-sort-desc="true"
                                data-lists-values='["js-lists-values-name","js-lists-values-country","js-lists-values-country-code"]'>

                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="javascript:void(0)" class="sort"
                                                    data-sort="js-lists-values-name">Zone</a>
                                            </th>
                                            <th>
                                                <a href="javascript:void(0)" class="sort"
                                                    data-sort="js-lists-values-country">Country
                                                    Name</a>
                                            </th>
                                            <th>
                                                <a href="javascript:void(0)" class="sort"
                                                    data-sort="js-lists-values-country-code">Country Code</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="clients">
                                        @foreach ($zone as $zon)
                                            @if ($zon->country)
                                                <tr>
                                                    <td>
                                                        <div class="media flex-nowrap align-items-center"
                                                            style="white-space: nowrap;">
                                                            <div class="media-body">
                                                                <div class="d-flex flex-column">
                                                                    <p class="mb-0">
                                                                        <strong class="js-lists-values-name">
                                                                            {{ $zon->zone_code }}
                                                                        </strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media flex-nowrap align-items-center"
                                                            style="white-space: nowrap;">
                                                            <div class="media-body">
                                                                <div class="d-flex flex-column">
                                                                    <p class="mb-0">
                                                                        <strong class="js-lists-values-country">
                                                                            {{ $zon->country->name }}
                                                                        </strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media flex-nowrap align-items-center"
                                                            style="white-space: nowrap;">
                                                            <div class="media-body">
                                                                <div class="d-flex flex-column">
                                                                    <p class="mb-0">
                                                                        <strong class="js-lists-values-country-code">
                                                                            {{ $zon->country->code }}
                                                                        </strong>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
@endsection
