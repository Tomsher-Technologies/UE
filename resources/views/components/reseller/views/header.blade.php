<div class="navbar navbar-expand navbar-dark navbar-dark-pickled-bluewood navbar-shadow" id="default-navbar" data-primary>
    <!-- Navbar toggler -->
    <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0" type="button" data-toggle="sidebar">
        <span class="material-icons">short_text</span>
    </button>
    <!-- Navbar Brand -->
    <a href="index.html" class="navbar-brand mr-16pt d-lg-none">
        <!-- <img class="navbar-brand-icon" src="public/images/logo/white-100@2x.png" width="30" alt="Luma"> -->
        <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
            <span class="avatar-title rounded bg-primary"><img src="{{ resellerAsset('images/logo/logo2.png') }}"
                    alt="logo" class="img-fluid" style="width: 100px"></span>
        </span>
    </a>
    <ul class="nav navbar-nav ml-auto mr-0">
        <li class="nav-item">
            <a href="#" onclick="$('#logoutForm').submit()" class="nav-link" data-toggle="tooltip" data-title="Logout" data-placement="bottom"
                data-boundary="window" data-original-title="" title=""><i class="material-icons">logout</i></a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reseller.user.profile') }}" class="btn btn-outline-white">Profile</a>
        </li>
    </ul>
</div>
