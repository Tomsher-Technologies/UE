<div class="page-section border-bottom-2">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-separator">
                    <div class="page-separator__text">Add New Agents</div>
                </div>
                <form wire:submit.prevent="save">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input wire:model="name" type="text" class="form-control mb-2">
                        <x-form.error name="name" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input wire:model="email" type="email" class="form-control mb-2">
                        <x-form.error name="email" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input wire:model="phone" type="text" class="form-control mb-2">
                        <x-form.error name="phone" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input wire:model="address" type="text" class="form-control mb-2">
                        <x-form.error name="address" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">MSP Type</label>
                        <select wire:model="msp_type" class="form-control custom-select">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        <x-form.error name="msp_type" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">MSP</label>
                        <input wire:model="msp" type="number" class="form-control mb-2">
                        <x-form.error name="msp" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Special request limit per day</label>
                        <input wire:model="request_limit" type="number" class="form-control mb-2">
                        <x-form.error name="request_limit" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Special request wight break</label>
                        <input wire:model="limit_weight" type="number" class="form-control mb-2">
                        <x-form.error name="limit_weight" />
                    </div>
                    {{-- <div class="form-group">
                        <label class="form-label">Profit Margin</label>
                        <input wire:model="profit_margin" type="number" class="form-control mb-2">
                        <x-form.error name="profit_margin" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Profit Margin</label>
                        <select wire:model="profit_margin_type" class="form-control custom-select">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        <x-form.error name="profit_margin_type" />
                    </div> --}}

                    <div class="form-group">
                        <label class="form-label">Can Download Rate Sheet</label>
                        <select wire:model="rate_sheet_status" class="form-control custom-select mb-2">
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        </select>
                        <x-form.error name="rate_sheet_status" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Grade</label>
                        <select wire:model="grade" class="form-control custom-select">
                            @foreach ($grades as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-form.error name="grade" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input wire:model="password" type="password" class="form-control mb-2">
                        <x-form.error name="password" />
                    </div>
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

                    <div class="col-md-12 p-0">
                        <button class="btn btn-primary">Create Sub-agent</button>
                    </div>
                </form>
                <script>
                    window.addEventListener('memberUpdated', e => {
                        Swal.fire({
                            title: 'Agent created',
                            icon: 'success'
                        });
                    })
                </script>
            </div>
        </div>
    </div>
</div>
