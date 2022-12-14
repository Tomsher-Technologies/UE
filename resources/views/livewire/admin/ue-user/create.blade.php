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

        <div class="permissions">
            <label class="form-label">Permissions</label>

            @php
                $pGroups = $permissions->pluck('group')->unique();
            @endphp

            <div class="row">
                @foreach ($pGroups as $pGroup)
                    <div class="col-md-3">
                        <h6>
                            {{ $pGroup ?? 'Others' }}
                        </h6>
                        @php
                            $abilities = $permissions->where('group', $pGroup);
                        @endphp
                        @foreach ($abilities as $permission)
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input wire:model="selectedPermission.{{ $permission->id }}" type="checkbox"
                                        class="custom-control-input" id="customCheck{{ $permission->id }}">
                                    <label class="custom-control-label"
                                        for="customCheck{{ $permission->id }}">{{ $permission->title }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
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
