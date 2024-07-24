<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    @if (Auth::user()->role_id == 3)
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link {{ Request::routeIs('beranda_index') ? 'active' : '' }}"
                            href="{{ route('beranda_index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Beranda
                        </a>
                    @elseif(Auth::user()->role_id == 4)
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link {{ Request::routeIs('beranda_index') ? 'active' : '' }}"
                            href="{{ route('beranda_index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Beranda
                        </a>
                        <div class="sb-sidenav-menu-heading">Auth</div>
                        <a class="nav-link {{ Request::routeIs('user_index') ? 'active' : '' }}"
                            href="{{ route('user_index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            User
                        </a>
                        <div class="sb-sidenav-menu-heading">Alumni</div>
                        <a class="nav-link {{ Request::routeIs('alumni_index') ? 'active' : '' }} "
                            href="{{ route('alumni_index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            Data Alumni
                        </a>
                        <a class="nav-link {{ Request::routeIs('tracking_alumni_index') ? 'active' : '' }}"
                            href="{{ route('tracking_alumni_index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                            Tracking Alumni
                        </a>
                    @elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link {{ Request::routeIs('beranda_index') ? 'active' : '' }}"
                            href="{{ route('beranda_index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Beranda
                        </a>
                        <div class="sb-sidenav-menu-heading">Alumni</div>
                        <a class="nav-link {{ Request::routeIs('alumni_index') ? 'active' : '' }} "
                            href="{{ route('alumni_index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            Data Alumni
                        </a>
                        <a class="nav-link {{ Request::routeIs('tracking_alumni_index') ? 'active' : '' }}"
                            href="{{ route('tracking_alumni_index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                            Tracking Alumni
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
