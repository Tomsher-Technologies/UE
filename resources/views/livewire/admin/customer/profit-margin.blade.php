<div>
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Add Profit Margin</div>
            </div>

            <form wire:submit.prevent="save">
                <div class="form-row">
                    <div class="col-6 form-group mb-0">
                        <label class="form-label">Type</label>
                        <select wire:model="type" class="form-control custom-select">
                            <option value="import">Import</option>
                            <option value="export">Export</option>
                            <option value="transit">Transit</option>
                        </select>
                        <x-form.error name="name" />
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label">Integrator</label>
                        <select id="integrator" wire:model="integrator" class="form-control custom-select">
                            @foreach ($integrators as $integrator)
                                <option value="{{ $integrator->id }}">{{ $integrator->name }}</option>
                            @endforeach
                        </select>
                        <x-form.error name="integrator" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6 form-group">
                        <label class="form-label">Applied For</label>
                        <select wire:model="applied_for" class="form-control custom-select">
                            <option value="all">All Orders</option>
                            <option value="zone">Zones</option>
                            <option value="country">Countries</option>
                        </select>
                        <x-form.error name="applied_for" />
                    </div>
                    <div class="col-6 form-group mb-0">
                        <label class="form-label">{!! $applied_for_txt !!}</label>
                        <select id="applied_for_id" wire:model="applied_for_id" class="form-control custom-select">
                            @if ($applied_for_items !== null && $applied_for_items->count())
                                @foreach ($applied_for_items as $items)
                                    <option value="{{ $items->id }}">{{ $items->name }}</option>
                                @endforeach
                            @else
                                <option value="0">No data found</option>
                            @endif
                        </select>
                        <x-form.error name="applied_for_id" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6 form-group">
                        <label class="form-label">Start Weight</label>
                        <input wire:model="weight" type="number" step=".1" class="form-control mb-2">
                        <x-form.error name="weight" />
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label">End Weight</label>
                        <input wire:model="end_weight" type="number" step=".1" class="form-control mb-2">
                        <x-form.error name="end_weight" />
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label">Rate Type</label>
                        <select wire:model="rate_type" class="form-control custom-select">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        <x-form.error name="rate_type" />
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label">Rate</label>
                        <input wire:model="rate" type="number" step=".1" class="form-control mb-2">
                        <x-form.error name="rate" />
                    </div>
                </div>
                <div class="col-4 p-0">
                    <button class="btn btn-primary">Create Profit Margin</button>
                </div>
            </form>

            <div class="page-separator mt-3">
                <div class="page-separator__text">Manage Profit Margin</div>
            </div>

            <div class="card">
                <div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date"
                    data-lists-sort-desc="true" data-lists-values='["js-lists-values-name"]'>

                    <table class="table mb-0 thead-border-top-0 table-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">
                                        Type
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">
                                        Integrator
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">
                                        Applied For
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">
                                        Weight Break
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">
                                        Rate type
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">
                                        Rate
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript:void(0)">
                                        Action
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list" id="clients">
                            @foreach ($margins as $margin)
                                <tr>
                                    <td>
                                        {{ ucfirst($margin->type) }}
                                    </td>
                                    <td>
                                        {{ $margin->integrator ? $margin->integrator->name : 'All' }}
                                    </td>
                                    <td>
                                        {{ ucfirst($margin->applied_for) }} {{ $margin->getAppliedFor() }}
                                    </td>
                                    <td>
                                        {{ $margin->weight }} - {{ $margin->end_weight }}
                                    </td>
                                    <td>
                                        {{ ucfirst($margin->rate_type) }}
                                    </td>
                                    <td>
                                        {{ $margin->rate }}
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.profitMargin.edit', $margin) }}"
                                            class="btn btn-secondary">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <button wire:click="$emit('triggerDelete',{{ $margin->id }})"
                                            class="btn btn-accent delete">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('triggerDelete', id => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'User will be deleted!',
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Delete!'
                }).then((result) => {
                    if (result.value) {
                        @this.call('deleteRate', id)
                    }
                });
            });
        })

        window.addEventListener('modelDeleted', e => {
            Swal.fire({
                title: 'Customer deleted successfully!',
                icon: 'success'
            });
        })
        window.addEventListener('modelDeletedFailed', e => {
            Swal.fire({
                title: 'Customer delete failed, please try again!',
                icon: 'warning'
            });
        })

        window.addEventListener('memberUpdated', e => {
            Swal.fire({
                title: 'Profit Margin created',
                icon: 'success'
            });
        })
    </script>

    <script>
        selectInit = () => {
            $('#integrator').select2();
            $('#integrator').on('change', function(e) {
                var data = $('#integrator').select2("val");
                @this.set('integrator', data);
            });

            $('#applied_for_id').select2();
            $('#applied_for_id').on('change', function(e) {
                var data = $('#applied_for_id').select2("val");
                @this.set('applied_for_id', data);
            });
        }

        window.addEventListener('contentChanged', event => {
            selectInit();
        })

        document.addEventListener('DOMContentLoaded', function() {
            selectInit();
        })
    </script>

</div>
