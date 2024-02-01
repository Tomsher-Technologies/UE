<div class="table-responsive mt-2" data-toggle="lists" data-lists-sort-by="js-lists-values-date" data-lists-sort-desc="true"
    data-lists-values='["js-lists-values-name"]'>
    <div class="card-header">
        <form class="form-inline">
            {{-- <label class="mr-sm-2 form-label" for="inlineFormFilterBy">Filter by:</label> --}}
            {{-- <input wire:model="search" type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0"
                id="inlineFormFilterBy" placeholder="Search ..." /> --}}
        </form>
    </div>

    <table class="table mb-0 thead-border-top-0 table-nowrap">
        <thead>
            <tr>
                <th>
                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">
                        User Name
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Request Rate
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Approved Rate
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0)">
                        Rate Type
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
                        {{ $rate->user->name }}
                    </td>
                    <td>
                        {{ $rate->request_rate }}
                    </td>
                    <td>
                        {{ $rate->approved_rate }}
                    </td>
                    <td>
                        {{ $rate->rate_type ? 'Fixed amount' : 'Percentage' }}
                    </td>
                    <td>
                        {{ $rate->status() }}
                    </td>
                    <td>
                        @if ($rate->status == 0)
                            {{-- <button wire:click="$emit('triggerApprove',{{ $rate->id }})" class="btn btn-success">
                                <i class="material-icons">check</i>
                            </button> --}}
                            <button wire:click="$emit('triggerDelete',{{ $rate->id }})"
                                class="btn btn-accent delete">
                                <i class="material-icons">delete_forever</i>
                            </button>
                        @endif
                        <a href="{{ route('admin.special_rates.edit', ['special_rate' => $rate]) }}"
                            class="btn btn-secondary">
                            <i class="material-icons">mode_edit</i>
                        </a>
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
                    title: 'Reject Rate?',
                    text: 'Rate will be rejected!',
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Reject!'
                }).then((result) => {
                    if (result.value) {
                        @this.call('deleteUser', id)
                    }
                });
            });
            @this.on('triggerApprove', id => {
                Swal.fire({
                    title: 'Approve Rate?',
                    text: 'Rate will be approved!',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Approve!'
                }).then((result) => {
                    if (result.value) {
                        @this.call('approveRate', id)
                    }
                });
            });
        })

        window.addEventListener('rateApproved', e => {
            Swal.fire({
                title: 'Rate approved successfully!',
                icon: 'success'
            });
        })
        window.addEventListener('modelDeleted', e => {
            Swal.fire({
                title: 'Rate rejected!',
                icon: 'success'
            });
        })
    </script>
</div>
