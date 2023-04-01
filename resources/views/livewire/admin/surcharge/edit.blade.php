<div>
    <form wire:submit.prevent="save">

        <div class="form-group">
            <label class="form-label">Name</label>
            <input wire:model="surcharge.name" type="text" class="form-control mb-2">
            <x-form.error name="surcharge.name" />
        </div>


        <div class="form-row">
            <div class="col-6 form-group">
                <label class="form-label">Shippment Type</label>
                <select wire:model="surcharge.type" class="form-control mb-2" id="">
                    <option value="0">All</option>
                    <option value="import">Import</option>
                    <option value="export">Export</option>
                    <option value="transit">Transit</option>
                </select>
                <x-form.error name="surcharge.type" />
            </div>
            <div class="col-6 form-group">
                <label class="form-label">Integrator</label>
                <select wire:model="surcharge.integrator_id" class="form-control mb-2" id="">
                    <option value="0">All</option>
                    @foreach ($integrators as $integrator)
                        <option value="{{ $integrator->id }}">{{ $integrator->name }}</option>
                    @endforeach
                </select>
                <x-form.error name="surcharge.integrator_id" />

            </div>
        </div>

        <div class="form-row">
            <div class="col-6 form-group">
                <label class="form-label">Applied For</label>
                <select wire:model="surcharge.applied_for" class="form-control custom-select">
                    <option value="all">All Orders</option>
                    <option value="zone">Zones</option>
                    <option value="country">Countries</option>
                </select>
                <x-form.error name="surcharge.applied_for" />
            </div>
            <div class="col-6 form-group mb-0">
                <label class="form-label">{!! $applied_for_txt !!}</label>
                <select id="applied_for_id" wire:model="surcharge.applied_for_id" class="form-control custom-select">
                    @if ($applied_for_items !== null && $applied_for_items->count())
                        @foreach ($applied_for_items as $items)
                            <option value="{{ $items->id }}">{{ $items->name }}</option>
                        @endforeach
                    @else
                        <option value="0">All</option>
                    @endif
                </select>
                <x-form.error name="surcharge.applied_for_id" />
            </div>
        </div>


        <div class="form-row">
            <div class="col-6 form-group mb-0">
                <label class="form-label">Start Weight</label>
                <input wire:model="surcharge.start_weight" type="number" step="0.1" class="form-control mb-2">
                <x-form.error name="surcharge.start_weight" />
            </div>
            <div class="col-6 form-group">
                <label class="form-label">End Weight</label>
                <input wire:model="surcharge.end_weight" type="number" step="0.1" class="form-control mb-2">
                <x-form.error name="surcharge.end_weight" />
            </div>
        </div>



        <div class="form-row">
            <div class="col-6 form-group mb-0">
                <label class="form-label">Rate Type</label>
                <select wire:model="surcharge.rate_type" class="form-control mb-2" id="">
                    <option value="1">Fixed Amount</option>
                    <option value="2">Percentage</option>
                </select>
                <x-form.error name="surcharge.rate_type" />
            </div>
            <div class="col-6 form-group">
                <div class="form-group">
                    <label class="form-label">Rate</label>
                    <input wire:model="surcharge.rate" type="number" step=".1" class="form-control mb-2">
                    <x-form.error name="surcharge.rate" />
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-6 form-group mb-0">
                <label class="form-label">Start Date</label>
                <input wire:model="surcharge.start_date" type="date" class="form-control mb-2">
                <x-form.error name="surcharge.start_date" />
            </div>
            <div class="col-6 form-group">
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input wire:model="surcharge.end_date" type="date" class="form-control mb-2">
                    <x-form.error name="surcharge.end_date" />
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-6 form-group mb-0">
                <label class="form-label">Applied Per Weight</label>
                <select wire:model="surcharge.per_weight" class="form-control custom-select">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <x-form.error name="surcharge.per_weight" />
            </div>
            <div class="col-6 form-group">
                <div class="form-group">
                    <label class="form-label">Order</label>
                    <input wire:model="surcharge.sort_order" type="number" class="form-control mb-2">
                    <x-form.error name="surcharge.sort_order" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Status</label>
            <select wire:model="surcharge.status" class="form-control mb-2" id="">
                <option value="1">Enabled</option>
                <option value="0">Disabled</option>
            </select>
            <x-form.error name="surcharge.status" />
        </div>

        <div class="col-md-12 p-0">
            <button class="btn btn-primary">Update Surcharge</button>
        </div>
    </form>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Surcharge updated',
                icon: 'success'
            });
        })

        // $('#applied_for_id').on('change', function() {
        //     console.log($(this).val());
        //     @this.set('surcharge.applied_for_id', $(this).val())
        // });
    </script>
</div>
