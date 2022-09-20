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
            <label class="form-label">Password</label>
            <input wire:model="password" type="password" class="form-control mb-2">
            <x-form.error name="password" />
        </div>
        <div class="col-md-12 p-0">
            <button class="btn btn-primary">Create User</button>
        </div>
    </form>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'User created',
                icon: 'success'
            });
        })
    </script>
</div>
