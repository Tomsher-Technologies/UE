<div class="container page__container">
    <div class="page-section">
        <div class="row">
            <div class="col-8">
                <div class="page-separator">
                    <div class="page-separator__text">Edit Grade</div>
                </div>
                <form wire:submit.prevent="save">
                    <div class="form-row">
                        <div class="col-12 form-group mb-0">
                            <label class="form-label">Grade Name</label>
                            <input wire:model="grade.name" type="text" class="form-control mb-2">
                            <x-form.error name="grade.name" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6 form-group">
                            <label class="form-label">MSP Type</label>
                            <select wire:model="grade.msp_type" class="form-control custom-select">
                                <option value="percentage">Percentage</option>
                                <option value="grade.amount">Amount</option>
                            </select>
                            <x-form.error name="msp_type" />
                        </div>
                        <div class="col-6 form-group mb-0">
                            <label class="form-label">MSP</label>
                            <input wire:model="grade.msp" type="number" step=".1" class="form-control mb-2">
                            <x-form.error name="grade.msp" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6 form-group">
                            <label class="form-label">Profit Margin</label>
                            <select wire:model="grade.profit_margin_type" class="form-control custom-select">
                                <option value="percentage">Percentage</option>
                                <option value="amount">Amount</option>
                            </select>
                            <x-form.error name="grade.profit_margin_type" />
                        </div>
                        <div class="col-6 form-group">
                            <label class="form-label">Default Profit Margin</label>
                            <input wire:model="grade.profit_margin" type="number" step=".1"
                                class="form-control mb-2">
                            <x-form.error name="grade.profit_margin" />
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <button class="btn btn-primary w-auto">Update Grade</button>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.grades.profitMargin', $grade) }}" class="btn btn-primary w-100 mb-2">
                            Profit Margin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Grade updated',
                icon: 'success'
            });
        })
    </script>
</div>
