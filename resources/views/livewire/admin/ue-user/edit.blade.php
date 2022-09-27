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

    <div class="page-separator mt-4">
        <div class="page-separator__text">Permissions</div>
    </div>
    <form wire:submit.prevent="savePermission">
        @foreach ($permissions as $permission)
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input wire:model="selectedPermission.{{ $permission->id }}" type="checkbox"
                        class="custom-control-input" id="customCheck{{ $permission->id }}">
                    <label class="custom-control-label"
                        for="customCheck{{ $permission->id }}">{{ $permission->title }}</label>
                </div>
            </div>
        @endforeach
        <button class="btn btn-primary">Save changes</button>
    </form>


    <div class="page-separator mt-4">
        <div class="page-separator__text">Assign Customer</div>
    </div>

    <div class="card mb-lg-32pt mt-2">
        <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date"
            data-lists-sort-desc="true" data-lists-values='["js-lists-values-name"]'>
            <div class="card-header">
                <form class="form-inline">
                    <label class="mr-sm-2 form-label" for="inlineFormFilterBy">Filter by:</label>
                    <input wire:model.defer="search" type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0"
                        id="inlineFormFilterBy" placeholder="Search ..." />
                </form>
            </div>

            <table class="table mb-0 thead-border-top-0 table-nowrap">
                <thead>
                    <tr>
                        <th style="width: 18px;" class="pr-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input js-toggle-check-all"
                                    data-target="#toggle" id="customCheckAlltoggle">
                                <label class="custom-control-label" for="customCheckAlltoggle"><span
                                        class="text-hide">Toggle all</span></label>
                            </div>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Name</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Current UE
                                User</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)">Email</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="list" id="toggle">
                    @foreach ($customers as $user)
                        <tr>
                            <td class="pr-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" value="{{ $user->id }}"
                                        class="custom-control-input js-check-selected-row"
                                        id="customCheck1_toggle{{ $loop->iteration }}" wire:model="selectedUsers">
                                    <label class="custom-control-label"
                                        for="customCheck1_toggle{{ $loop->iteration }}"><span
                                            class="text-hide">Check</span></label>
                                </div>
                            </td>
                            <td>
                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                                    <div class="media-body">
                                        <div class="d-flex flex-column">
                                            <p class="mb-0">
                                                <strong class="js-lists-values-name">
                                                    {{ $user->name }}
                                                </strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->parent ? $user->parent->name : '---' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer p-8pt">
                {{ $customers->links() }}

                <button class="btn btn-primary mt-2" wire:click="assignUsers">Save changes</button>
            </div>
        </div>
    </div>


    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'User updated',
                icon: 'success'
            });
        })
        window.addEventListener('permissionUpdated', e => {
            Swal.fire({
                title: 'Permissions updated',
                icon: 'success'
            });
        })
    </script>

</div>
