<div>
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Create Grades</div>
            </div>

            <form wire:submit.prevent="save">
                <div class="form-row">
                    <div class="col-12 form-group mb-0">
                        <label class="form-label">Grade Name</label>
                        <input wire:model="name" type="text" class="form-control mb-2">
                        <x-form.error name="name" />
                    </div>
                </div>
                {{-- <div class="form-row">
                    <div class="col-6 form-group">
                        <label class="form-label">MSP Type</label>
                        <select wire:model="msp_type" class="form-control custom-select">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        <x-form.error name="msp_type" />
                    </div>
                    <div class="col-6 form-group mb-0">
                        <label class="form-label">MSP</label>
                        <input wire:model="msp" type="number" step=".1" class="form-control mb-2">
                        <x-form.error name="msp" />
                    </div>
                </div> --}}
                <div class="form-row">
                    <div class="col-6 form-group">
                        <label class="form-label">Profit Margin</label>
                        <select wire:model="profit_margin_type" class="form-control custom-select">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        <x-form.error name="profit_margin_type" />
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label">Profit Margin</label>
                        <input wire:model="profit_margin" type="number" step=".1" class="form-control mb-2">
                        <x-form.error name="profit_margin" />
                    </div>
                </div>
                <div class="col-2 p-0">
                    <button class="btn btn-primary w-100">Create Grade</button>
                </div>
            </form>


            <div class="page-separator mt-3">
                <div class="page-separator__text">Manage Grades</div>
            </div>

            <div class="card mb-lg-32pt">
                <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date"
                    data-lists-sort-desc="true" data-lists-values='["js-lists-values-name"]'>

                    <div class="card-header">
                        <form class="form-inline">
                            <label class="mr-sm-2 form-label" for="inlineFormFilterBy">Filter by:</label>
                            <input wire:model="search" type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0"
                                id="inlineFormFilterBy" placeholder="Search ...">
                        </form>
                    </div>

                    <table class="table mb-0 thead-border-top-0 table-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <a href="javascript:void(0)">Name</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">
                                        Profit Margin</a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">
                                        Profit Margin Type
                                    </a>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="clients">
                            @foreach ($grades as $grade)
                                <tr>
                                    <td>
                                        {{ $grade->name }}
                                    </td>
                                    <td>
                                        {{ $grade->profit_margin }}
                                    </td>
                                    <td style="text-transform:capitalize">
                                        {{ $grade->profit_margin_type }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.grades.edit', $grade) }}" class="btn btn-secondary">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        @if ($grade->id !== 1)
                                            <button wire:click="$emit('triggerDelete',{{ $grade->id }})"
                                                class="btn btn-accent delete">
                                                <i class="material-icons">delete_forever</i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer p-8pt">
                        {{ $grades->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('triggerDelete', id => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'Grade will be deleted! Existing customers will be moved to the General grade',
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Delete!'
                }).then((result) => {
                    if (result.value) {
                        @this.call('deleteGrade', id)
                    }
                });
            });
        })

        window.addEventListener('modelDeleted', e => {
            Swal.fire({
                title: 'Grade deleted successfully!',
                icon: 'success'
            });
        })
        window.addEventListener('modelCreated', e => {
            Swal.fire({
                title: 'Grade created successfully!',
                icon: 'success'
            });
        })
        window.addEventListener('modelDeletedFailed', e => {
            Swal.fire({
                title: 'Grade delete failed, please try again!',
                icon: 'warning'
            });
        })
        window.addEventListener('modelNoDelete', e => {
            Swal.fire({
                title: 'Sorry can\'t delete this grade!',
                icon: 'warning'
            });
        })
    </script>
</div>
