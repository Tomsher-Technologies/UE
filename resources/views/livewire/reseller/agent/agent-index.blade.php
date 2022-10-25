<div class="page-section border-bottom-2">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-separator">
                    <div class="page-separator__text">Agents</div>
                </div>

                <div class="card mb-lg-32pt">
                    <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date"
                        data-lists-sort-desc="true" data-lists-values='["js-lists-values-name"]'>
                        <div class="card-header">
                            <form class="form-inline">
                                <label class="mr-sm-2 form-label" for="inlineFormFilterBy">Filter by:</label>
                                <input wire:model="search" type="text"
                                    class="form-control search mb-2 mr-sm-2 mb-sm-0" id="inlineFormFilterBy"
                                    placeholder="Search ..." />
                            </form>
                        </div>

                        <table class="table mb-0 thead-border-top-0 table-nowrap">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="javascript:void(0)" class="sort"
                                            data-sort="js-lists-values-name">Name</a>
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
                                    <th>
                                        <a href="javascript:void(0)">
                                            Status
                                        </a>
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="clients">
                                @foreach ($agents as $user)
                                    <tr>
                                        <td>
                                            <div class="media flex-nowrap align-items-center"
                                                style="white-space: nowrap;">
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
                                            {{ $user->customerDetails->phone }}
                                        </td>
                                        <td style="white-space: nowrap">
                                            {{ $user->customerDetails->address }}
                                        </td>
                                        <td>
                                            <div class="ml-auto mb-2 mb-sm-0 custom-control-inline mr-0">
                                                <div class="custom-control custom-checkbox-toggle ml-8pt">
                                                    {{-- <form action="" class="s-inline"> --}}
                                                    <input wire:click="toggleStatus({{ $user->id }})"
                                                        {{ $user->status == 1 ? 'checked' : '' }}
                                                        value="{{ $user->id }}" type="checkbox"
                                                        id="active{{ $loop->iteration }}"
                                                        class="custom-control-input" />
                                                    <label class="custom-control-label"
                                                        for="active{{ $loop->iteration }}">Active</label>
                                                    {{-- </form> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('reseller.agents.show', $user) }}"
                                                class="btn btn-secondary">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                            <a href="{{ route('reseller.agents.edit', $user) }}"
                                                class="btn btn-secondary">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                            <button wire:click="$emit('triggerDelete',{{ $user->id }})"
                                                class="btn btn-accent delete">
                                                <i class="material-icons">delete_forever</i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer p-8pt">
                            {{ $agents->links() }}
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                @this.on('triggerDelete', id => {
                                    Swal.fire({
                                        title: 'Are You Sure?',
                                        text: 'Agent will be deleted!',
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
                                    title: 'Agent deleted successfully!',
                                    icon: 'success'
                                });
                            })
                            window.addEventListener('modelDeletedFailed', e => {
                                Swal.fire({
                                    title: 'Agent delete failed, please try again!',
                                    icon: 'warning'
                                });
                            })

                            window.addEventListener('statusChange', e => {
                                $status = "Activated";
                                if (e.detail.status == false) {
                                    $status = "Deactivated";
                                }
                                Swal.fire({
                                    title: 'Agent ' + $status,
                                    icon: 'success'
                                });
                            })
                        </script>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('footer')
    <script>
        $(document).ready(function() {
            $('#select01').select2();
            $('#select01').on('change', function(e) {
                var data = $('#select01').select2("val");
                @this.set('selectedGrade', data);
            });
        });
    </script>
@endpush
