@if(count($enabledFilters))
    <div class="col-md-12 d-flex" style="margin-top: 5px">
        @if(count($enabledFilters) > 1)
            <div wire:click.prevent="clearAllFilters()"
                 style="cursor: pointer; padding-right: 4px">
            <span class="badge rounded-pill bg-secondary">{{ trans('livewire-powergrid::datatable.buttons.clear_all_filters') }}
                 <svg class="ml-2" width="10" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                    <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"/>
                </svg>
            </span>
            </div>
        @endif
        @foreach($enabledFilters as $field => $filter)
            <div wire:click.prevent="clearFilter('{{ $field }}')"
                 style="cursor: pointer; padding-right: 4px">
            <span class="badge badge-pill badge-primary">{{ $filter['label'] }}
                 <svg class="ml-2" width="10" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                    <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"/>
                </svg>
            </span>
            </div>
        @endforeach
    </div>
@endif
