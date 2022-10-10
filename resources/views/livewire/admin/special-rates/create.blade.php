<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input wire:model="name" type="text" class="form-control mb-2">
            <x-form.error name="name" />
        </div>
        <div class="form-group">
            <label class="form-label">Rate</label>
            <input wire:model="approved_rate" type="number" class="form-control mb-2">
            <x-form.error name="approved_rate" />
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
        <div class="form-group">
            <label class="form-label">Expiry Date</label>
            <input wire:model="expiry_date" min="{{ now()->toDateString('Y-m-d') }}" type="date"
                class="form-control mb-2">
            <x-form.error name="expiry_date" />
        </div>
        <div class="col-md-12 p-0">
            <button class="btn btn-primary">Create Special Rate</button>
        </div>
    </form>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Special Rate created',
                icon: 'success'
            });
        })
    </script>
</div>
