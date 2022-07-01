<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('organization') }}" class="brand-link">
        <span class="brand-text font-weight-light d-flex justify-content-center">Organisasi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
        
        <div class="info">
            <a href="{{ route('organization.profile') }}" class="d-block d-flex justify-content-center">{{ Auth::user()->name }}</a>
            <a class="d-block d-flex justify-content-center" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
            </button>
            </div>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="{{ route('organization') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
            </li>
            
            <li class="nav-header">PENGGALANGAN DANA</li>    
            <li class="nav-item">
                <a href="{{ route('organization.program.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                    Program
                    <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('organization.withdraw.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-donate"></i>
                    <p>
                    Penarikan Dana
                    <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>