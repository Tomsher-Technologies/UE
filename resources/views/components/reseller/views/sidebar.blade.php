<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>
            <!-- Sidebar Content -->
            <a href="{{ route('reseller.dashboard') }}"
                class="sidebar-brand sidebar-brand-dark bg-primary-pickled-bluewood">
                <!-- <img class="sidebar-brand-icon" src="public/images/illustration/student/128/white.svg" alt="Luma"> -->
                <span class="logo avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-transparent">
                        <img src="{{ resellerAsset('images/logo/logo2.png') }}" class="img-fluid"
                            alt="{{ auth()->user()->name }}" /></span>
                </span>
                <span class="font-size-16pt" style="line-height: 1;"> {{ auth()->user()->name }} </span>
            </a>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item {{ request()->routeIs('reseller.dashboard*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('reseller.dashboard') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dashboard</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ request()->routeIs('reseller.search.history*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('reseller.search.history') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
                        <span class="sidebar-menu-text">Search History</span>
                    </a>
                </li>
                {{-- <li class="sidebar-menu-item {{ request()->routeIs('reseller.search.search*') ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('reseller.search.search') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
                        <span class="sidebar-menu-text">Search Rate</span>
                    </a>
                </li> --}}
                {{-- <li class="sidebar-menu-item ">
                    <a class="sidebar-menu-button" href="bookings.html">
                        <span
                            class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment_turned_in</span>
                        <span class="sidebar-menu-text">Bookings</span>
                    </a>
                </li>
                <li class="sidebar-menu-item ">
                    <a class="sidebar-menu-button" href="enquiry.html">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">star_half
                        </span>
                        <span class="sidebar-menu-text">Enquiry</span>
                    </a>
                </li> --}}

                @if (auth()->user()->isA('reseller'))
                    <li class="sidebar-menu-item {{ request()->routeIs('reseller.agents*') ? 'active open' : '' }}">
                        <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse"
                            href="#enterprise_menu">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">extension</span>
                            Sub Agents
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu">
                            <li
                                class="sidebar-menu-item {{ request()->routeIs('reseller.agents.index') ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('reseller.agents.index') }}">
                                    <span class="sidebar-menu-text">All Agents</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-menu-item {{ request()->routeIs('reseller.agents.create') ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('reseller.agents.create') }}">
                                    <span class="sidebar-menu-text">Add New Agents</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- <li class="sidebar-menu-item {{ request()->routeIs('reseller.users*') ? 'active open' : '' }}">
                    <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#user_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">extension</span>
                        Users
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="user_menu">
                        <li class="sidebar-menu-item {{ request()->routeIs('reseller.users.index') ? 'active' : '' }}">
                            <a class="sidebar-menu-button" href="{{ route('reseller.users.index') }}">
                                <span class="sidebar-menu-text">All Users</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-menu-item {{ request()->routeIs('reseller.users.create') ? 'active' : '' }}">
                            <a class="sidebar-menu-button" href="{{ route('reseller.users.create') }}">
                                <span class="sidebar-menu-text">Add New User</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
