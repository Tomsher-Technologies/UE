<div>
    <form wire:submit.prevent="save">

        <div class="form-row">
            <div class="col-12 form-group">
                <label class="form-label">Name</label>
                <input wire:model="name" type="text" class="form-control mb-2">
                <x-form.error name="name" />
            </div>
        </div>


        <div class="form-row">
            <div class="col-6 form-group">
                <label class="form-label">Shippment Type</label>
                <select wire:model="type" class="form-control mb-2" id="">
                    <option value="0">All</option>
                    <option value="import">Import</option>
                    <option value="export">Export</option>
                    <option value="transit">Transit</option>
                </select>
                <x-form.error name="type" />
            </div>
            <div class="col-6 form-group">
                <label class="form-label">Integrator</label>
                <select wire:model="integrator" class="form-control mb-2" id="">
                    <option value="0">All</option>
                    @foreach ($integrators as $integrator)
                        <option value="{{ $integrator->id }}">{{ $integrator->name }}</option>
                    @endforeach
                </select>
                <x-form.error name="integrator" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-6 form-group mb-0">
                <label class="form-label">Start Weight</label>
                <input wire:model="start_weight" type="number" step="0.1" class="form-control mb-2">
                <x-form.error name="start_weight" />
            </div>
            <div class="col-6 form-group">
                <label class="form-label">End Weight</label>
                <input wire:model="end_weight" type="number" step="0.1" class="form-control mb-2">
                <x-form.error name="end_weight" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-6 form-group">
                <label class="form-label">Applied For</label>
                <select wire:model="applied_for" class="form-control custom-select">
                    <option value="all">All Orders</option>
                    <option value="zone">Zones</option>
                    <option value="country">Countries</option>
                </select>
                <x-form.error name="applied_for" />
            </div>
            <div class="col-6 form-group mb-0">
                <label class="form-label">{!! $applied_for_txt !!}</label>
                <select id="applied_for_id" wire:model="applied_for_id" class="form-control custom-select">
                    @if ($applied_for_items !== null && $applied_for_items->count())
                        @foreach ($applied_for_items as $items)
                            <option value="{{ $items->id }}">{{ $items->name }}</option>
                        @endforeach
                    @else
                        <option value="0">All</option>
                    @endif
                </select>
                <x-form.error name="applied_for_id" />
            </div>
        </div>


        <div class="form-row">
            <div class="col-6 form-group mb-0">
                <label class="form-label">Rate Type</label>
                <select wire:model="rate_type" class="form-control mb-2" id="">
                    <option value="1">Fixed Amount</option>
                    <option value="2">Percentage</option>
                </select>
                <x-form.error name="rate_type" />
            </div>
            <div class="col-6 form-group">
                <div class="form-group">
                    <label class="form-label">Rate</label>
                    <input wire:model="rate" type="number" class="form-control mb-2">
                    <x-form.error name="rate" />
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-6 form-group mb-0">
                <label class="form-label">Start Date</label>
                <input wire:model="start_date" type="date" class="form-control mb-2">
                <x-form.error name="start_date" />
            </div>
            <div class="col-6 form-group">
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input wire:model="end_date" type="date" class="form-control mb-2">
                    <x-form.error name="end_date" />
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="form-label">Status</label>
            <select wire:model="status" class="form-control mb-2" id="">
                <option value="1">Enabled</option>
                <option value="0">Disabled</option>
            </select>
            <x-form.error name="status" />
        </div>

        <div class="col-md-12 p-0">
            <button class="btn btn-primary">Create Surcharge</button>
        </div>
    </form>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Surcharge created',
                icon: 'success'
            });
        })
    </script>
</div>
