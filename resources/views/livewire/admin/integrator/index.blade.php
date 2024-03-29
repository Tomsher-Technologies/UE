<div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date" data-lists-sort-desc="true"
    data-lists-values='["js-lists-values-name"]'>
    <div class="card-header">
        <form class="form-inline">
            <label class="mr-sm-2 form-label" for="inlineFormFilterBy">Filter by:</label>
            <input wire:model="search" type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0"
                id="inlineFormFilterBy" placeholder="Search ..." />
        </form>
    </div>

    <table class="table mb-0 thead-border-top-0 table-nowrap">
        <thead>
            <tr>
                <th>
                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Name</a>
                </th>
                <th>
                    <a href="javascript:void(0)">Code</a>
                </th>
                <th>
                    <a href="javascript:void(0)">Email</a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Phone
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Address
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="list" id="clients">
            @foreach ($integrators as $integrator)
                <tr>
                    <td>
                        <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                            <div class="media-body">
                                <div class="d-flex flex-column">
                                    <p class="mb-0">
                                        <strong class="js-lists-values-name">
                                            {{ $integrator->name }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                            <div class="media-body">
                                <div class="d-flex flex-column">
                                    <p class="mb-0">
                                        <strong class="js-lists-values-name">
                                            {{ $integrator->integrator_code }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                            <div class="media-body">
                                <div class="d-flex flex-column">
                                    <small class="js-lists-values-company"><strong>
                                            {{ $integrator->email }}
                                        </strong></small>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                            <div class="media-body">
                                <div class="d-flex flex-column">
                                    <small class="js-lists-values-company"><strong>
                                            {{ $integrator->phone }}
                                        </strong></small>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="white-space: nowrap">
                        {{ $integrator->address }}
                    </td>
                    <td>
                        <a href="{{ route('admin.integrator.edit', $integrator) }}" class="btn btn-secondary">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        <button wire:click="$emit('triggerDelete',{{ $integrator->id }})" class="btn btn-accent delete">
                            <i class="material-icons">delete_forever</i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer p-8pt">
        {{ $integrators->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('triggerDelete', id => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'Integrator will be deleted!',
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Delete!'
                }).then((result) => {
                    if (result.value) {
                        @this.call('deleteUser', id)
                    }
                });
            });
        })

        window.addEventListener('modelDeleted', e => {
            Swal.fire({
                title: 'Integrator deleted successfully!',
                icon: 'success'
            });
        })
        window.addEventListener('modelDeletedFailed', e => {
            Swal.fire({
                title: 'Integrator delete failed, please try again!',
                icon: 'warning'
            });
        })

    </script>

</div>
