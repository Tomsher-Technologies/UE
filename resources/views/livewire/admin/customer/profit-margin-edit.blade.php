<div>
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Add Profit Margin</div>
            </div>

            <form wire:submit.prevent="save">
                <div class="form-row">
                    <div class="col-6 form-group mb-0">
                        <label class="form-label">Type</label>
                        <select wire:model="margin.type" wire:change="typeUpdated($event.target.value)"
                            class="form-control custom-select">
                            <option value="import">Import</option>
                            <option value="export">Export</option>
                            <option value="transit">Transit</option>
                        </select>
                        <x-form.error name="margin.name" />
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label">Integrator</label>
                        <select wire:model="margin.integrator_id" id="integrator" wire:change="integratorUpdated($event.target.value)"
                            class="form-control custom-select">
                            @foreach ($integrators as $integrator)
                                <option value="{{ $integrator->id }}">{{ $integrator->name }}</option>
                            @endforeach
                        </select>
                        <x-form.error name="margin.integrator_id" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6 form-group">
                        <label class="form-label">Applied For</label>
                        <select wire:model="margin.applied_for" wire:change="appliedForUpdated($event.target.value)"
                            name="applied_for" class="form-control custom-select">
                            <option value="all">All Orders</option>
                            <option value="zone">Zones</option>
                            <option value="country">Countries</option>
                        </select>
                        <x-form.error name="margin.applied_for" />
                    </div>
                    <div class="col-6 form-group mb-0">
                        <label class="form-label">{!! $applied_for_txt !!}</label>
                        <select id="applied_for_id" wire:model="margin.applied_for_id" class="form-control custom-select">
                            @if ($applied_for_items !== null && $applied_for_items->count())
                                @foreach ($applied_for_items as $items)
                                    <option value="{{ $items->id }}">{{ $items->name }}</option>
                                @endforeach
                            @else
                                <option value="0">No data found</option>
                            @endif
                        </select>
                        <x-form.error name="margin.applied_for_id" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 form-group">
                        <label class="form-label">Weight BREAK</label>
                        <input wire:model="margin.weight" type="number" step=".1" class="form-control mb-2">
                        <x-form.error name="margin.weight" />
                    </div>
                    <div class="col-4 form-group">
                        <label class="form-label">Rate Type</label>
                        <select wire:model="margin.rate_type" class="form-control custom-select">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        <x-form.error name="margin.rate_type" />
                    </div>
                    <div class="col-4 form-group">
                        <label class="form-label">Rate</label>
                        <input wire:model="margin.rate" type="number" step=".1" class="form-control mb-2">
                        <x-form.error name="margin.rate" />
                    </div>
                </div>
                <div class="col-4 p-0">
                    <button class="btn btn-primary">Update Profit Margin</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Profit margin updated',
                icon: 'success'
            });
        })
    </script>

    <script>
        selectInit = () => {
            $('#integrator').select2();
            $('#integrator').on('change', function(e) {
                var data = $('#integrator').select2("val");
                @this.set('margin.integrator_id', data);
            });

            $('#applied_for_id').select2();
            $('#applied_for_id').on('change', function(e) {
                var data = $('#applied_for_id').select2("val");
                @this.set('margin.applied_for_id', data);
            });
        }

        window.addEventListener('contentChanged', event => {
            selectInit();
        })

        document.addEventListener('DOMContentLoaded', function() {
            selectInit();
        })
    </script>

</div>
