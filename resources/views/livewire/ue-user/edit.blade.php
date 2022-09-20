<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input wire:model="user.name" type="text" class="form-control mb-2">
            <x-form.error name="user.name" />
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input wire:model="user.email" type="email" class="form-control mb-2">
            <x-form.error name="user.email" />
        </div>

        <div class="form-group">
            <label class="form-label">Reset Password</label>
            <input wire:model="password" type="password" class="form-control mb-2">
            <x-form.error name="password" />
        </div>

        <div class="form-group">
            <label class="form-label">Status</label>
            <select wire:model="user.status" class="form-control custom-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <x-form.error name="user.status" />
        </div>
        <button class="btn btn-primary">Save changes</button>
    </form>

    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'User updated',
                icon: 'success'
            });
        })
    </script>

</div>
