<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label class="form-label">User Name</label>
            <input value="{{ $rate->user->name }}" disabled type="text" class="form-control mb-2">
        </div>
        <div class="form-group">
            <label class="form-label">Weight</label>
            <input value="{{ $rate->total_weight }}" disabled type="number" class="form-control mb-2">
            <x-form.error name="rate.total_weight" />
        </div>
        <div class="form-group">
            <label class="form-label">Request Rate</label>
            <input value="{{ $rate->request_rate }}" disabled type="number" class="form-control mb-2">
            <x-form.error name="rate.request_rate" />
        </div>
        <div class="form-group">
            <label class="form-label">Approved Rate</label>
            <input wire:model="rate.approved_rate" type="number" class="form-control mb-2">
            <x-form.error name="rate.approved_rate" />
        </div>
        {{-- <div class="form-group">
            <label class="form-label">Rate Type</label>
            <select wire:model="rate.rate_type" class="form-control mb-2" id="">
                <option value="1">Fixed Amount</option>
                <option value="2">Percentage</option>
            </select>
            <x-form.error name="rate.rate_type" />
        </div> --}}
        <div class="form-group">
            <label class="form-label">Request Date</label>
            <input value="{{ $rate->request_date ? $rate->request_date->format('Y-m-d') : '' }}" disabled type="date"
                class="form-control mb-2">
        </div>
        <div class="form-group">
            <label class="form-label">Approve Date</label>
            <input value="{{ $rate->approval_date ? $rate->approval_date->format('Y-m-d') : '' }}" disabled
                type="date" class="form-control mb-2">
        </div>
        {{-- <div class="form-group">
            <label class="form-label">Expiry Date</label>
            <input wire:model="rate.expiry_date" min="{{ now()->toDateString('Y-m-d') }}" type="date"
                class="form-control mb-2">
            <x-form.error name="rate.expiry_date" />
        </div> --}}
        <div class="form-group">
            <label class="form-label">Status</label>
            <select wire:model="rate.status" class="form-control mb-2" id="">
                <option value="0">Pending</option>
                <option value="1">Approve</option>
                <option value="2">Reject</option>
            </select>
            <x-form.error name="rate.status" />
        </div>
        <div class="col-md-12 p-0">
            <button class="btn btn-primary">Update Special Rate</button>
        </div>
    </form>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Special Rate updated',
                icon: 'success'
            });
        })
    </script>
</div>
