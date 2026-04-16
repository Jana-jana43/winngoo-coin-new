 <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                    <img src="{{ asset('assets/images/Coin.png') }}" class="d-md-none d-block" alt="logo" height="50">
                    <div class="d-flex align-items-center">
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>

                        <!--<a href="notifications.html" type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown">-->
                        <!--    <i class='bx bx-bell fs-22'></i>-->
                        <!--    <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3<span class="visually-hidden">unread messages</span></span>-->
                        <!--</a>-->

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            @php
$admin = Auth::guard('admin')->user();
$image = $admin->profile 
    ? asset('assets/adminprofile/'.$admin->profile) 
    : asset('assets/images/users/avatar-1.jpg');
@endphp
                            <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{ $image }}" alt="Header Avatar">
                                     <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ $admin->username }}</span>
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Admin</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome {{ $admin->username }}</h6>
                                <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                                <!-- <a class="dropdown-item" href="{{route('login')}}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a> -->
                               <a class="dropdown-item" href="#"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
    <span class="align-middle">Logout</span>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>