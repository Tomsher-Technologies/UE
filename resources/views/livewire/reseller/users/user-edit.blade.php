<div class="page-section border-bottom-2">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-separator">
                    <div class="page-separator__text">Add New User</div>
                </div>
                <form wire:submit.prevent="save">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input wire:model="user.name" type="text" class="form-control mb-2">
                        <x-form.error name="user.name" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input value="{{ $user->email }}" disabled type="email" class="form-control mb-2">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Parent User</label>
                        <select wire:model="user.parent_id" class="form-control custom-select">
                            <option value="{{ auth()->user()->id }}">Self</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->email }} - {{ $parent->name }}</option>
                            @endforeach
                        </select>
                        <x-form.error name="user.parent_id" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input wire:model="password" type="password" class="form-control mb-2">
                        <x-form.error name="password" />
                    </div>

                    <div class="col-md-12 p-0">
                        <button class="btn btn-primary">Update User</button>
                    </div>
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
        </div>
    </div>
</div>
