<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input wire:model="integrator.name" type="text" class="form-control mb-2">
            <x-form.error name="user.name" />
        </div>
        <div class="form-group">
            <label class="form-label">Code</label>
            <input wire:model="integrator.integrator_code" type="text" class="form-control mb-2">
            <x-form.error name="user.email" />
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input wire:model="integrator.email" type="email" class="form-control mb-2">
            <x-form.error name="user.email" />
        </div>
        <div class="form-group">
            <label class="form-label">Phone</label>
            <input wire:model="integrator.phone" type="text" class="form-control mb-2">
            <x-form.error name="password" />
        </div>
        <div class="form-group">
            <label class="form-label">Address</label>
            <input wire:model="integrator.address" type="text" class="form-control mb-2">
            <x-form.error name="password" />
        </div>

        @if ($c_image)
            <div class="col-md-12 p-0 mb-3">
                Current Logo:
                <img class="w-auto d-block mw-100" src="{{ $c_image }}">
            </div>
        @endif

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

        <button class="btn btn-primary">Save changes</button>
    </form>

    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Integrator updated',
                icon: 'success'
            });
        })
    </script>

</div>
