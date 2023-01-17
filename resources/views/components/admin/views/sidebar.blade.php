<div class="mdk-drawer js-mdk-drawer layout-compact__drawer" id="default-drawer">
    <div class="mdk-drawer__content js-sidebar-mini" data-responsive-width="992px" data-layout="compact">
        <div class="sidebar sidebar-mini sidebar-dark-pickled-bluewood sidebar-left d-flex flex-column">
            <a href="{{ route('admin.dashboard') }}"
                class="sidebar-brand p-0 navbar-height d-flex justify-content-center">
                <span class=" ">
                    <span class="avatar-title rounded bg-primary ">
                        <img src="{{ asset('images/logo-white.png') }}" class="img-fluid" alt="logo" />
                    </span>
                </span>
            </a>
            <div class="flex d-flex flex-column justify-content-start" data-perfect-scrollbar>
                <ul class="nav flex-shrink-0 flex-nowrap flex-column sidebar-menu mb-0 sm-item-bordered js-sidebar-mini-tabs"
                    role="tablist">
                    <li class="sidebar-menu-item {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('admin.dashboard') }}">
                            <span
                                class="material-symbols-outlined sidebar-menu-icon sidebar-menu-icon--left material-icons">
                                dashboard
                            </span>
                            <span class="sidebar-menu-text">Dashboard </span>
                        </a>
                    </li>

                    @if (auth()->user()->hasUeUserPrivilages())
                        <li class="sidebar-menu-item {{ request()->routeIs('admin.ueusers*') ? 'active' : '' }}"
                            data-placement="right" data-boundary="window">
                            <a class="sidebar-menu-button" href="#sm_admin" data-toggle="tab" role="tab"
                                aria-controls="sm_admin" aria-selected="true">
                                <span
                                    class="material-symbols-outlined sidebar-menu-icon sidebar-menu-icon--left material-icons">
                                    manage_accounts
                                </span>
                                <span class="sidebar-menu-text">UE Users </span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasIntegratorPrivilages())
                        <li class="sidebar-menu-item {{ request()->routeIs('admin.integrator*') ? 'active' : '' }}"
                            data-placement="right" data-container="body" data-boundary="window">
                            <a class="sidebar-menu-button" href="#sm_Integrators" data-toggle="tab" role="tab"
                                aria-controls="sm_Integrators" aria-selected="false">
                                <span
                                    class="sidebar-menu-icon sidebar-menu-icon--left material-icons material-symbols-outlined">
                                    category
                                </span>
                                <span class="sidebar-menu-text">Integrators</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->hasCustomerPrivilages())
                        <li class="sidebar-menu-item {{ request()->routeIs('admin.customer*') || request()->routeIs('admin.grades*') ? 'active' : '' }}"
                            data-placement="right" data-container="body" data-boundary="window">
                            <a class="sidebar-menu-button" href="#sm_agents" data-toggle="tab" role="tab"
                                aria-controls="sm_agents" aria-selected="false">
                                <span
                                    class="sidebar-menu-icon sidebar-menu-icon--left material-icons material-symbols-outlined">
                                    person_pin_circle
                                </span>
                                <span class="sidebar-menu-text">Customers</span>
                            </a>
                        </li>
                    @endif


                    @if (auth()->user()->hasSpecialRatesPrivilages())
                        <li class="sidebar-menu-item {{ request()->routeIs('admin.surcharge*') ? 'active' : '' }}"
                            data-placement="right" data-container="body" data-boundary="window">
                            <a class="sidebar-menu-button" href="#surcharge" data-toggle="tab" role="tab"
                                aria-controls="surcharge" aria-selected="false">
                                <span
                                    class="sidebar-menu-icon sidebar-menu-icon--left material-icons material-symbols-outlined">
                                    local_gas_station
                                </span>
                                <span class="sidebar-menu-text">Surcharge</span>
                            </a>
                        </li>
                    @endif


                    @if (auth()->user()->can('manage-dynamic-content'))
                        <li class="sidebar-menu-item {{ request()->routeIs('admin.dynamic-content*') ? 'active' : '' }}"
                            data-placement="right" data-container="body" data-boundary="window">
                            <a class="sidebar-menu-button" href="{{ route('admin.dynamic-content.index') }}">
                                <span
                                    class="sidebar-menu-icon sidebar-menu-icon--left material-icons material-symbols-outlined">
                                    note
                                </span>
                                <span class="sidebar-menu-text">Dynamic Content</span>
                            </a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
        <div class="sidebar sidebar-light sidebar-left flex sidebar-secondary pt-16pt" data-perfect-scrollbar>
            <div class="tab-content">
                @if (auth()->user()->hasUeUserPrivilages())
                    <div class="tab-pane" id="sm_admin">
                        <div class="sidebar-heading">UE Users</div>
                        <ul class="sidebar-menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.ueusers.index') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        supervisor_account
                                    </span>
                                    <span class="sidebar-menu-text">View All</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.ueusers.create') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        person_add
                                    </span>
                                    <span class="sidebar-menu-text">Add UE Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
                @if (auth()->user()->hasIntegratorPrivilages())
                    <div class="tab-pane" id="sm_Integrators">
                        <div class="sidebar-heading">Integrators</div>
                        <ul class="sidebar-menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.integrator.index') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        dynamic_feed
                                    </span>
                                    <span class="sidebar-menu-text">Integrators List</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.integrator.create') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        add_box
                                    </span>
                                    <span class="sidebar-menu-text">Add New Integrators</span>
                                </a>
                            </li>
                            {{-- <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.integrator.export') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        file_download
                                    </span>
                                    <span class="sidebar-menu-text">Export Rates</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                @endif
                @if (auth()->user()->hasCustomerPrivilages())
                    <div class="tab-pane" id="sm_agents">
                        <div class="sidebar-heading">Customers</div>
                        <ul class="sidebar-menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.customer.index') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        dynamic_feed
                                    </span>
                                    <span class="sidebar-menu-text">Customers List</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.customer.create') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        add_box
                                    </span>
                                    <span class="sidebar-menu-text">Add New Customers</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.grades.index') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        bar_chart
                                    </span>
                                    <span class="sidebar-menu-text">Grades</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.special_rates.index') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        av_timer
                                    </span>
                                    <span class="sidebar-menu-text">Special Requests</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.searches') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        search
                                    </span>
                                    <span class="sidebar-menu-text">Search History</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.bookings') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        history
                                    </span>
                                    <span class="sidebar-menu-text">Booking History</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.user.import') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        file_upload
                                    </span>
                                    <span class="sidebar-menu-text">Import Customers</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.profitMargin.import') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        file_upload
                                    </span>
                                    <span class="sidebar-menu-text">Import Profit Margin</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif

                @if (auth()->user()->hasSpecialRatesPrivilages())
                    <div class="tab-pane" id="surcharge">
                        <div class="sidebar-heading">Surcharge</div>
                        <ul class="sidebar-menu">
                            @if (auth()->user()->can('list-special-rates'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('admin.surcharge.index') }}">
                                        <span
                                            class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                            dynamic_feed
                                        </span>
                                        <span class="sidebar-menu-text">Surcharge List</span>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->can('create-special-rates'))
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="{{ route('admin.surcharge.create') }}">
                                        <span
                                            class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                            add_box
                                        </span>
                                        <span class="sidebar-menu-text">Add New Surcharge</span>
                                    </a>
                                </li>
                            @endif
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('admin.surcharge.import') }}">
                                    <span
                                        class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                        file_upload
                                    </span>
                                    <span class="sidebar-menu-text">Upload Surcharge</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>
