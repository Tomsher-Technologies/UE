<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input wire:model="name" type="text" class="form-control mb-2">
            <x-form.error name="name" />
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input wire:model="email" type="email" class="form-control mb-2">
            <x-form.error name="email" />
        </div>
        <div class="form-group">
            <label class="form-label">Phone Number</label>
            <input wire:model="phone" type="text" class="form-control mb-2">
            <x-form.error name="phone" />
        </div>
        <div class="form-group">
            <label class="form-label">Address</label>
            <input wire:model="address" type="text" class="form-control mb-2">
            <x-form.error name="address" />
        </div>
        <div class="form-group">
            <label class="form-label">MSP</label>
            <input wire:model="msp" type="number" class="form-control mb-2">
            <x-form.error name="msp" />
        </div>
        <div class="form-group">
            <label class="form-label">MSP Type</label>
            <select wire:model="msp_type" class="form-control custom-select">
                <option value="percentage">Percentage</option>
                <option value="amount">Amount</option>
            </select>
            <x-form.error name="msp_type" />
        </div>
        <div class="form-group">
            <label class="form-label">Profit Margin</label>
            <input wire:model="profit_margin" type="number" class="form-control mb-2">
            <x-form.error name="profit_margin" />
        </div>
        <div class="form-group">
            <label class="form-label">Profit Margin</label>
            <select wire:model="profit_margin_type" class="form-control custom-select">
                <option value="percentage">Percentage</option>
                <option value="amount">Amount</option>
            </select>
            <x-form.error name="profit_margin_type" />
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input wire:model="password" type="password" class="form-control mb-2">
            <x-form.error name="password" />
        </div>
        <div class="form-group">
            <label class="form-label">Image</label>
            <input wire:model="image" type="file" accept=".jpg,.jpeg,.png,.gif,.webp" class="form-control mb-2">
            <x-form.error name="image" />
        </div>


        @if ($image && !$errors->get('image'))
            <div class="col-md-12 p-0 mb-3">
                Photo Preview:
                <img class="w-100" src="{{ $image->temporaryUrl() }}">
            </div>
        @endif

        <div class="col-md-12 p-0">
            <button class="btn btn-primary">Create Customer</button>
        </div>
    </form>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Customer created',
                icon: 'success'
            });
        })
    </script>
</div>
