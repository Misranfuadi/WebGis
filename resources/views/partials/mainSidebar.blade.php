<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('adminLte/dist/img/TosranLogo.png') }}" alt="Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminLte/dist/img/avatar3.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ Request::segment(1) === 'home' ? 'active' : null }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('shp') }}" class="nav-link {{ Request::segment(1) === 'shp' ? 'active' : null }}">
                        <i class="nav-icon fas fa-map-marked"></i>
                        <p>
                            SHP Management
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('support') }}"
                        class="nav-link {{ Request::segment(1) === 'support' ? 'active' : null }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Data Support
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user') }}"
                        class="nav-link {{ Request::segment(1) === 'user' ? 'active' : null }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User Management
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
