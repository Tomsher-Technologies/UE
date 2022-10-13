<div>
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Manage Profit Margin</div>
            </div>

            <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date"
                data-lists-sort-desc="true" data-lists-values='["js-lists-values-name"]'>

                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Name</a>
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
                        @foreach ($users as $user)
                            <tr>
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
                                                {{ $user->status == 1 ? 'checked' : '' }} value="{{ $user->id }}"
                                                type="checkbox" id="active{{ $loop->iteration }}"
                                                class="custom-control-input" />
                                            <label class="custom-control-label"
                                                for="active{{ $loop->iteration }}">Active</label>
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customer.show', $user) }}" class="btn btn-primary">
                                        <i class="material-icons">remove_red_eye</i>
                                    </a>
                                    <a href="{{ route('admin.customer.edit', $user) }}" class="btn btn-secondary">
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
                    {{ $users->links() }}
                </div>

            </div>

        </div>
    </div>
</div>
