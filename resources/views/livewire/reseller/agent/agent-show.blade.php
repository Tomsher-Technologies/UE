<div class="page-section border-bottom-2">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-separator">
                    <div class="page-separator__text">Show Sub user</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input value="{{ $user->name }}" disabled type="text" class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input value="{{ $user->email }}" disabled type="email" class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input value="{{ $customerDetails->phone }}" disabled type="text" class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input disabled value="{{ $customerDetails->address }}" type="text" class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label class="form-label">MSP Type</label>
                    <select disabled class="form-control custom-select">
                        <option {{ $customerDetails->msp_type == 'percentage' ? 'selected' : '' }} value="percentage">
                            Percentage</option>
                        <option {{ $customerDetails->msp_type == 'amount' ? 'selected' : '' }} value="amount">Amount
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">MSP</label>
                    <input disabled value="{{ $customerDetails->msp }}" type="number" class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label class="form-label">Special request limit per day</label>
                    <input disabled value="{{ $customerDetails->request_limit }}" type="number"
                        class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label class="form-label">Special request wight break</label>
                    <input disabled value="{{ $customerDetails->limit_weight }}" type="number"
                        class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label class="form-label">Profit Margin</label>
                    <input disabled value="{{ $customerDetails->profit_margin }}" type="number"
                        class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label class="form-label">Profit Margin</label>
                    <select disabled class="form-control custom-select">
                        <option {{ $customerDetails->profit_margin_type == 'percentage' ? 'selected' : '' }}
                            value="percentage">Percentage</option>
                        <option {{ $customerDetails->profit_margin_type == 'amount' ? 'selected' : '' }}
                            value="amount">Amount</option>
                    </select>
                </div>
                @if ($c_image)
                    <div class="col-md-12 p-0 mb-3">
                        Current Photo:
                        <img class="w-auto d-block mw-100" src="{{ $c_image }}">
                    </div>
                @endif
            </div>

            <div class="col-12">
                <div class="page-separator mt-4">
                    <div class="page-separator__text">Assign Customer</div>
                </div>
                <div class="card mb-lg-32pt mt-2">
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
                                    <th style="width: 18px;" class="pr-0">
                                        <div class="custom-control custom-checkbox">
                                            <input wire:model="checkall" type="checkbox"
                                                class="custom-control-input js-toggle-check-all"
                                                id="customCheckAlltoggle">
                                            <label class="custom-control-label" for="customCheckAlltoggle"><span
                                                    class="text-hide">Toggle all</span></label>
                                        </div>
                                    </th>
                                    <th>
                                        <a href="javascript:void(0)" class="sort"
                                            data-sort="js-lists-values-name">Name</a>
                                    </th>
                                    <th>
                                        <a href="javascript:void(0)">Email</a>
                                    </th>
                                    <th>
                                        <a href="javascript:void(0)" class="sort"
                                            data-sort="js-lists-values-name">Current UE
                                            User</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="list" id="toggle">
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="pr-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" value="{{ $customer->id }}"
                                                    class="custom-control-input js-check-selected-row"
                                                    id="customCheck1_toggle{{ $loop->iteration }}"
                                                    wire:model="selectedUsers">
                                                <label class="custom-control-label"
                                                    for="customCheck1_toggle{{ $loop->iteration }}"><span
                                                        class="text-hide">Check</span></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media flex-nowrap align-items-center"
                                                style="white-space: nowrap;">
                                                <div class="media-body">
                                                    <div class="d-flex flex-column">
                                                        <p class="mb-0">
                                                            <strong class="js-lists-values-name">
                                                                {{ $customer->name }}
                                                            </strong>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $customer->email }}
                                        </td>
                                        <td>
                                            {{ $customer->parent ? $customer->parent->name : '---' }}
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
            </div>
            <script>
                window.addEventListener('assigned', e => {
                    Swal.fire({
                        title: 'Customers assigned',
                        icon: 'success'
                    });
                })
            </script>
        </div>
    </div>
</div>
