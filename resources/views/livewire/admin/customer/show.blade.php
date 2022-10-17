<div>
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
        <input value="{{ $user->customerDetails->phone }}" disabled type="text" class="form-control mb-2">
    </div>
    <div class="form-group">
        <label class="form-label">Address</label>
        <input value="{{ $user->customerDetails->address }}" disabled type="text" class="form-control mb-2">
    </div>
    <div class="form-group">
        <label class="form-label">MSP</label>
        <input value="{{ $user->customerDetails->msp }}" disabled type="number" class="form-control mb-2">
    </div>
    <div class="form-group">
        <label class="form-label">MSP Type</label>
        <select class="form-control custom-select" disabled>
            <option {{ $user->customerDetails->msp_type == 'percentage' ? 'selected' : '' }} value="percentage">
                Percentage</option>
            <option {{ $user->customerDetails->msp_type == 'amount' ? 'selected' : '' }} value="amount">Amount</option>
        </select>
    </div>

    <div class="form-group">
        <label class="form-label">Special request limit per day</label>
        <input value="{{ $user->customerDetails->request_limit }}" disabled type="number" class="form-control mb-2">
    </div>
    <div class="form-group">
        <label class="form-label">Special request wight break</label>
        <input value="{{ $user->customerDetails->limit_weight }}" disabled  type="number" class="form-control mb-2">
    </div>

    <div class="form-group">
        <label class="form-label">Profit Margin</label>
        <input value="{{ $user->customerDetails->profit_margin }}" type="number" class="form-control mb-2" disabled>
    </div>
    <div class="form-group">
        <label class="form-label">Profit Margin</label>
        <select class="form-control custom-select" disabled>
            <option {{ $user->customerDetails->profit_margin_type == 'percentage' ? 'selected' : '' }}
                value="percentage">Percentage</option>
            <option {{ $user->customerDetails->profit_margin_type == 'amount' ? 'selected' : '' }} value="amount">Amount
            </option>
        </select>
    </div>
    @if ($user->customerDetails->image)
        <div class="col-md-12 p-0 mb-3">
            Photo Preview:
            <img class="w-100" src="{{ $user->customerDetails->getProfileImage() }}">
        </div>
    @endif
</div>
