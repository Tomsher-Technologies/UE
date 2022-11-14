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
            <label class="form-label">Logo</label>
            <input wire:model="image" type="file" accept=".jpg,.jpeg,.png,.gif,.webp" class="form-control mb-2">
            <x-form.error name="image" />
        </div>

        @if ($image && !$errors->get('image'))
            <div class="col-md-12 p-0 mb-3">
                Logo Preview:
                <img class="w-auto d-block mw-100" src="{{ $image->temporaryUrl() }}">
            </div>
        @endif

        <div class="col-md-12 p-0">
            <button class="btn btn-primary">Create Integrator</button>
        </div>
    </form>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Integrator created',
                icon: 'success'
            });
        })
    </script>
</div>
