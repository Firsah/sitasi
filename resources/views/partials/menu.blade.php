<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
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
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                        Tracking Alumni
                    </a>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
