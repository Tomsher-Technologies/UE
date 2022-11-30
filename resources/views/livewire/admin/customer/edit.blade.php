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
            <label class="form-label">Grade</label>
            <select wire:model="user.grade_id" class="form-control custom-select">
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
            <x-form.error name="user.grade_id" />
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
            <label class="form-label">Can Download Rate Sheet</label>
            <select wire:model="customerDetails.rate_sheet_status" class="form-control custom-select mb-2">
                <option value="1" selected>Yes</option>
                <option value="0">No</option>
            </select>
            <x-form.error name="customerDetails.rate_sheet_status" />
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <input wire:model="password" type="password" class="form-control mb-2">
            <x-form.error name="password" />
        </div>

        @if ($c_image)
            <div class="col-md-12 p-0 mb-3">
                Current Photo:
                <img class="w-auto d-block mw-100" src="{{ $c_image }}">
            </div>
        @endif

        <div class="form-group">
            <label class="form-label">Image</label>
            <input wire:model="image" type="file" accept=".jpg,.jpeg,.png,.gif,.webp" class="form-control mb-2">
            <x-form.error name="image" />
        </div>

        @if ($image && !$errors->get('image'))
            <div class="col-md-12 p-0 mb-3">
                Photo Preview:
                <img class="w-auto d-block mw-100" src="{{ $image->temporaryUrl() }}">
            </div>
        @endif

        <div class="form-group">
            <label class="form-label">Status</label>
            <select wire:model="user.status" class="form-control custom-select">
                <option value="1">Active</option>
                <option value="0">Disabled</option>
            </select>
            <x-form.error name="user.status" />
        </div>

        <div class="row no-gutters">
            <div class="col-md-6 p-0">
                <button class="btn btn-primary">Update Customer</button>
            </div>
            @if (!$user->verified)
                <div class="col-md-6 p-0 text-right" id="approveCustomer">
                    <button wire:click="approveCustomer()" class="btn btn-success">Approve Customer</button>
                </div>
            @endif

        </div>
    </form>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Customer updated',
                icon: 'success'
            });
        })
        window.addEventListener('memberApproved', e => {
            Swal.fire({
                title: 'Customer approved',
                icon: 'success'
            });
        })
    </script>
</div>
