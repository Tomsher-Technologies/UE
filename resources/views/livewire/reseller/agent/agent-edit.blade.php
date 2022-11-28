<div class="page-section border-bottom-2">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-8">
                <div class="page-separator">
                    <div class="page-separator__text">Edit Agent</div>
                </div>
                <form wire:submit.prevent="save">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input wire:model="agent.name" type="text" class="form-control mb-2">
                        <x-form.error name="name" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input wire:model="agent.email" type="email" class="form-control mb-2">
                        <x-form.error name="agent.email" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input wire:model="customerDetails.phone" type="text" class="form-control mb-2">
                        <x-form.error name="customerDetails.phone" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input wire:model="customerDetails.address" type="text" class="form-control mb-2">
                        <x-form.error name="customerDetails.address" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">MSP Type</label>
                        <select wire:model="customerDetails.msp_type" class="form-control custom-select">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        <x-form.error name="customerDetails.msp_type" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">MSP</label>
                        <input wire:model="customerDetails.msp" type="number" class="form-control mb-2">
                        <x-form.error name="customerDetails.msp" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Special request limit per day</label>
                        <input wire:model="customerDetails.request_limit" type="number" class="form-control mb-2">
                        <x-form.error name="customerDetails.request_limit" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Special request wight break</label>
                        <input wire:model="customerDetails.limit_weight" type="number" class="form-control mb-2">
                        <x-form.error name="customerDetails.limit_weight" />
                    </div>
                    {{-- <div class="form-group">
                        <label class="form-label">Profit Margin</label>
                        <input wire:model="customerDetails.profit_margin" type="number" class="form-control mb-2">
                        <x-form.error name="customerDetails.profit_margin" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Profit Margin</label>
                        <select wire:model="customerDetails.profit_margin_type" class="form-control custom-select">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        <x-form.error name="customerDetails.profit_margin_type" />
                    </div> --}}
                    <div class="form-group">
                        <label class="form-label">Reset Password</label>
                        <input wire:model="agent.password" type="password" class="form-control mb-2">
                        <x-form.error name="agent.password" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Grade</label>
                        <select wire:model="agent.grade_id" class="form-control custom-select">
                            @foreach ($grades as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-form.error name="agent.grade_id" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select wire:model="agent.status" class="form-control mb-2">
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                        {{-- <input wire:model="agent.password" type="password" class="form-control mb-2"> --}}
                        <x-form.error name="agent.status" />
                    </div>


                    @if ($c_image)
                        <div class="col-md-12 p-0 mb-3">
                            Current Photo:
                            <img class="w-auto d-block mw-100" src="{{ $c_image }}">
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <input wire:model="image" type="file" accept=".jpg,.jpeg,.png,.gif,.webp"
                            class="form-control mb-2">
                        <x-form.error name="image" />
                    </div>

                    @if ($image && !$errors->get('image'))
                        <div class="col-md-12 p-0 mb-3">
                            Photo Preview:
                            <img class="w-auto d-block mw-100" src="{{ $image->temporaryUrl() }}">
                        </div>
                    @endif


                    <div class="row no-gutters">
                        <div class="col-md-6 p-0">
                            <button class="btn btn-primary">Update Customer</button>
                        </div>

                        @if (!$agent->verified)
                            <div class="col-md-6 p-0 text-right" id="approveCustomer">
                                <button wire:click="approveCustomer()" class="btn btn-success">Approve
                                    Agent</button>
                            </div>
                        @endif
                    </div>

                </form>
                <script>
                    window.addEventListener('memberUpdated', e => {
                        Swal.fire({
                            title: 'Agent updated',
                            icon: 'success'
                        });
                    })

                    window.addEventListener('memberApproved', e => {
                        Swal.fire({
                            title: 'Agent approved',
                            icon: 'success'
                        });
                    })
                </script>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        {{-- <a href="{{ route('admin.special_rates.create', $user) }}" class="btn btn-primary w-100 mb-2">Special
                                rate</a> --}}
                        <a href="{{ route('reseller.agents.profitMargin', $agent) }}" class="btn btn-primary w-100 mb-2">
                            Profit Margin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
