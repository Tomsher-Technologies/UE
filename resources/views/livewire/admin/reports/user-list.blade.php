<div class="container page__container">
    <div class="page-section">
        <div class="page-separator">
            <div class="page-separator__text">Edit Customer</div>
        </div>
        <div class="card mb-lg-32pt">
            <div class="table-responsive" data-toggle="lists">
                <div class="card-header">
                    <form class="form-inline">
                        <label class="mr-sm-2 form-label" for="inlineFormFilterBy">Filter by:</label>
                        <input wire:model="search" type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0"
                            id="inlineFormFilterBy" placeholder="Search ..." />

                        <div class="form-group mx-3" wire:ignore>
                            <label class="form-label" for="select01">Grade</label>
                            <select id="select01" wire:model="selectedGrade" data-toggle="select" class="form-control">
                                <option selected="" value="0">All Grades</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mx-3" wire:ignore>
                            <label class="form-label" for="select01">Per page</label>
                            <select id="select02" wire:model="pageCount" data-toggle="select" class="form-control">
                                <option selected="" value="1">15</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="0">All</option>
                            </select>
                        </div>
                        <div class="form-group mx-3" wire:ignore>
                            <label class="form-label" for="select01">Sort By</label>
                            <select id="select02" wire:model="sortBy" data-toggle="select" class="form-control">
                                <option selected="" value="name">Name</option>
                                <option value="searches_count">No:of Quotes</option>
                                <option value="orders_count">No:of Booking</option>
                            </select>
                            <select id="select02" wire:model="sortOrder" data-toggle="select" class="form-control">
                                <option selected="" value="DESC">Descending</option>
                                <option value="ASC">Ascending</option>

                            </select>
                        </div>
                    </form>
                </div>

                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <a href="javascript:void(0)">Name</a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">Email</a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    No:of Quotes
                                </a>
                            </th>
                            <th>
                                <a href="javascript:void(0)">
                                    No:of Booking
                                </a>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="clients">
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                                        <div class="media-body">
                                            <div class="d-flex flex-column">
                                                <p class="mb-0">
                                                    {{ $user->name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->searches_count }}
                                </td>
                                <td style="white-space: nowrap">
                                    {{ $user->orders_count }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.reports.user.details', $user) }}" class="btn btn-primary">
                                        <i class="material-icons">remove_red_eye</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer p-8pt">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
