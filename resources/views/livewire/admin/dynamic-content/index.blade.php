<div class="table-responsive" data-toggle="lists" data-lists-sort-by="js-lists-values-date" data-lists-sort-desc="true"
    data-lists-values='["js-lists-values-name"]'>
    <div class="card-header">
        <form class="form-inline">
            <label class="mr-sm-2 form-label" for="inlineFormFilterBy">Filter by:</label>
            <input wire:model="search" type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0"
                id="inlineFormFilterBy" placeholder="Search ..." />
        </form>
    </div>

    <table class="table mb-0 thead-border-top-0 table-nowrap">
        <thead>
            <tr>
                <th>
                    <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Name</a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="list" id="clients">
            @foreach ($contents as $content)
                <tr>
                    <td style="white-space: nowrap">
                        {{ $content->heading }}
                    </td>
                    <td>
                        <a href="{{ route('admin.dynamic-content.edit', $content) }}" class="btn btn-secondary">
                            <i class="material-icons">mode_edit</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer p-8pt">
        {{ $contents->links() }}
    </div>
</div>
