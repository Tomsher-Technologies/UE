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
                    <a href="javascript:void(0)">
                        Integrator
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Start weight
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        End weight
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Rate
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Status
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="list" id="clients">
            @foreach ($surcharges as $surcharge)
                <tr>
                    <td>
                        {{ $surcharge->name }}
                    </td>
                    <td>
                        {{ $surcharge->integrator == null ? "All" : $surcharge->integrator->name }}
                    </td>
                    <td>
                        {{ $surcharge->start_weight }}
                    </td>
                    <td>
                        {{ $surcharge->end_weight }}
                    </td>
                    <td>
                        {{ $surcharge->rate }}
                    </td>
                    <td>
                        <div class="ml-auto mb-2 mb-sm-0 custom-control-inline mr-0">
                            <div class="custom-control custom-checkbox-toggle ml-8pt">
                                {{-- <form action="" class="s-inline"> --}}
                                <input wire:click="toggleStatus({{ $surcharge->id }})"
                                    {{ $surcharge->status == 1 ? 'checked' : '' }} value="{{ $surcharge->id }}"
                                    type="checkbox" id="active{{ $loop->iteration }}" class="custom-control-input" />
                                <label class="custom-control-label" for="active{{ $loop->iteration }}">Active</label>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.surcharge.edit', $surcharge) }}" class="btn btn-secondary">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        <button wire:click="$emit('triggerDelete',{{ $surcharge->id }})" class="btn btn-accent delete">
                            <i class="material-icons">delete_forever</i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer p-8pt">
        {{ $surcharges->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('triggerDelete', id => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'Surcharge will be deleted!',
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
                title: 'Surcharge deleted successfully!',
                icon: 'success'
            });
        })
        window.addEventListener('modelDeletedFailed', e => {
            Swal.fire({
                title: 'Surcharge delete failed, please try again!',
                icon: 'warning'
            });
        })

        window.addEventListener('statusChange', e => {
            $status = "Enabled";
            if (e.detail.status == false) {
                $status = "Disabled";
            }
            Swal.fire({
                title: 'Surcharge ' + $status,
                icon: 'success'
            });
        })
    </script>

</div>
