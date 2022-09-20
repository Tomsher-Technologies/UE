<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input wire:model="name" type="text" class="form-control mb-2">
            <x-form.error name="name" />
        </div>
        <div class="form-group">
            <label class="form-label">Code</label>
            <input wire:model="integrator_code" type="text" class="form-control mb-2">
            <x-form.error name="integrator_code" />
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
        <div class="col-md-12 p-0">
            <button class="btn btn-primary">Create User</button>
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
