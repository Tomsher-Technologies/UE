<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>
            <!-- Sidebar Content -->
            <a href="index.html" class="sidebar-brand sidebar-brand-dark bg-primary-pickled-bluewood">
                <!-- <img class="sidebar-brand-icon" src="public/images/illustration/student/128/white.svg" alt="Luma"> -->
                <span class="logo avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-transparent">
                        <img src="{{ resellerAsset('images/logo/logo2.png') }}" class="img-fluid"
                            alt="logo" /></span>
                </span>
                <span class="font-size-16pt" style="line-height: 1;"> {{ auth()->user()->name }} </span>
            </a>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="index.html">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dashboard</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu-item ">
                    <a class="sidebar-menu-button" href="search.html">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
                        <span class="sidebar-menu-text">Search Rate</span>
                    </a>
                </li>
                <li class="sidebar-menu-item ">
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
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#enterprise_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">extension</span>
                        Sub Agents
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="all-agents.html">
                                <span class="sidebar-menu-text">All Agents</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="new-agents.html">
                                <span class="sidebar-menu-text">Add New Agents</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-menu-item ">
                    <a class="sidebar-menu-button disabled" href="#">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">group</span>
                        <span class="sidebar-menu-text">Users</span>
                    </a>
                </li>
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
