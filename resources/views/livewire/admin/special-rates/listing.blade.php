<div class="table-responsive mt-2" data-toggle="lists" data-lists-sort-by="js-lists-values-date" data-lists-sort-desc="true"
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
                        Reuest Rate
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Approved Rate
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
            @foreach ($specialrate as $rate)
                <tr>
                    <td>
                        {{ $rate->name }}
                    </td>
                    <td>
                        {{ $rate->rate }}
                    </td>

                    <td>
                        <a href="{{ route('admin.special_rates.edit', ['user' => $user, 'special_rate' => $rate]) }}"
                            class="btn btn-secondary">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        <button wire:click="$emit('triggerDelete',{{ $rate->id }})" class="btn btn-accent delete">
                            <i class="material-icons">delete_forever</i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer p-8pt">
        {{ $specialrate->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('triggerDelete', id => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'Rate will be deleted!',
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
                title: 'Rate deleted successfully!',
                icon: 'success'
            });
        })
        window.addEventListener('modelDeletedFailed', e => {
            Swal.fire({
                title: 'Rate delete failed, please try again!',
                icon: 'warning'
            });
        })
    </script>
</div>
