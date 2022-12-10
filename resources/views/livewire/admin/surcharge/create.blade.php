<div>
    <form wire:submit.prevent="save">

        <div class="form-group">
            <label class="form-label">Name</label>
            <input wire:model="name" type="text" class="form-control mb-2">
            <x-form.error name="name" />
        </div>

        <div class="form-group">
            <label class="form-label">Integrator</label>
            <select wire:model="integrator_id" class="form-control mb-2" id="">
                @foreach ($integrators as $integrator)
                    <option value="{{ $integrator->id }}">{{ $integrator->name }}</option>
                @endforeach
            </select>
            <x-form.error name="integrator_id" />
        </div>

        <div class="form-group">
            <label class="form-label">Rate</label>
            <input wire:model="rate" type="number" class="form-control mb-2">
            <x-form.error name="rate" />
        </div>

        <div class="form-group">
            <label class="form-label">Start Weight</label>
            <input wire:model="start_weight" type="number" step="0.1" class="form-control mb-2">
            <x-form.error name="start_weight" />
        </div>
        <div class="form-group">
            <label class="form-label">End Weight</label>
            <input wire:model="end_weight" type="number" step="0.1" class="form-control mb-2">
            <x-form.error name="end_weight" />
        </div>

        <div class="form-group">
            <label class="form-label">Rate Type</label>
            <select wire:model="rate_type" class="form-control mb-2" id="">
                <option value="1">Fixed Amount</option>
                <option value="2">Percentage</option>
            </select>
            <x-form.error name="rate_type" />
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
