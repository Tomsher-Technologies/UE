<div class="mdk-drawer js-mdk-drawer layout-compact__drawer" id="default-drawer">
    <div class="mdk-drawer__content js-sidebar-mini" data-responsive-width="992px" data-layout="compact">
        <div class="sidebar sidebar-mini sidebar-dark-pickled-bluewood sidebar-left d-flex flex-column">
            <a href="index.html" class="sidebar-brand p-0 navbar-height d-flex justify-content-center">
                <span class="avatar avatar-sm ">
                    <span class="avatar-title rounded bg-primary ">
                        <img src="{{ adminAsset('images/logo/logo.png') }}" class="img-fluid rotate-img"
                            alt="logo" />
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
                                manage_accounts
                            </span>
                            <span class="sidebar-menu-text">Dashboard </span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item" data-placement="right" data-boundary="window">
                        <a class="sidebar-menu-button" href="#sm_admin" data-toggle="tab" role="tab"
                            aria-controls="sm_admin" aria-selected="true">
                            <span
                                class="material-symbols-outlined sidebar-menu-icon sidebar-menu-icon--left material-icons">
                                manage_accounts
                            </span>
                            <span class="sidebar-menu-text">Admin </span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item" data-placement="right" data-container="body" data-boundary="window">
                        <a class="sidebar-menu-button" href="#sm_vendors" data-toggle="tab" role="tab"
                            aria-controls="sm_vendors" aria-selected="false">
                            <span
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons material-symbols-outlined">
                                category
                            </span>
                            <span class="sidebar-menu-text">Vendors</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item" data-placement="right" data-container="body" data-boundary="window">
                        <a class="sidebar-menu-button" href="#sm_agents" data-toggle="tab" role="tab"
                            aria-controls="sm_agents" aria-selected="false">
                            <span
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons material-symbols-outlined">
                                person_pin_circle
                            </span>
                            <span class="sidebar-menu-text">Agents</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item " data-placement="right" data-container="body" data-boundary="window">
                        <a class="sidebar-menu-button" href="#sm_countries" data-toggle="tab" role="tab"
                            aria-controls="sm_countries">
                            <span
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons material-symbols-outlined">
                                tour
                            </span>
                            <span class="sidebar-menu-text">Countries</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item" data-placement="right" data-container="body" data-boundary="window">
                        <a class="sidebar-menu-button" href="#sm_users" data-toggle="tab" role="tab"
                            aria-controls="sm_users">
                            <span
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons material-symbols-outlined">
                                group
                            </span>
                            <span class="sidebar-menu-text">Users</span>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="nav flex-column sidebar-menu align-items-center mb-12pt js-sidebar-mini-tabs" role="tablist">
                <li class="sidebar-account" style="width: 40px;">
                    <a href="#sm_countries_1" class="p-4pt d-flex align-items-center justify-content-center"
                        data-toggle="tab" role="tab" aria-controls="sm_countries_1" aria-selected="true">
                        <img width="32" height="32" class="rounded-circle"
                            src="{{ adminAsset('images/people/50/guy-3.jpg') }}" alt="account" />
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar sidebar-light sidebar-left flex sidebar-secondary pt-16pt" data-perfect-scrollbar>
            <div class="tab-content">
                <div class="tab-pane" id="sm_agents">
                    <div class="sidebar-heading">Agents</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="vendors-list.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    recent_actors
                                </span>
                                <span class="sidebar-menu-text">Agents List</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="add-new-vendors.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    add_box
                                </span>
                                <span class="sidebar-menu-text">Add New Vendors</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane " id="sm_admin">
                    <div class="sidebar-heading">administrator</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="admin-users.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    supervisor_account
                                </span>
                                <span class="sidebar-menu-text">Admin Users</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="add-admin-users.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    person_add
                                </span>
                                <span class="sidebar-menu-text">Add Admin Users</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane " id="sm_vendors">
                    <div class="sidebar-heading">Vendors</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="vendors-list.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    dynamic_feed
                                </span>
                                <span class="sidebar-menu-text">Vendors List</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="add-new-vendors.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    add_box
                                </span>
                                <span class="sidebar-menu-text">Add New Vendors</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane " id="sm_countries">
                    <div class="sidebar-heading">Countries</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="countries-list.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    flag_circle
                                </span>
                                <span class="sidebar-menu-text">Countries List</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="add-countries.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    add_circle
                                </span>
                                <span class="sidebar-menu-text">Add New Countries</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="sm_users">
                    <div class="sidebar-heading">Users</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="users-list.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    flag_circle
                                </span>
                                <span class="sidebar-menu-text">Users List</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="add_user.html">
                                <span
                                    class="material-icons sidebar-menu-icon sidebar-menu-icon--left material-symbols-outlined">
                                    supervisor_account
                                </span>
                                <span class="sidebar-menu-text">Add New Users</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="sm_countries_1">
                    <div class="sidebar-heading">Account</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="edit-account.html">
                                <span class="sidebar-menu-text">Edit Account</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="billing.html">Billing</a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="billing-history.html">Payments</a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="login.html">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
