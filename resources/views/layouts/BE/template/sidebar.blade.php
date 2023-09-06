<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Tes Kerja</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Tes</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            {{-- <li class="dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
            <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
          </ul>
        </li> --}}
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i>
                    Dashboard</a>
            </li>
            <li class="nav-item {{ request()->is('oneToOne') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('oneToOne') }}"><i class="fas fa-user"></i>
                    One to one</a>
            </li>

            <li class="nav-item {{ request()->is('oneToMany') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('oneToMany') }}"><i class="fas fa-user"></i>
                    One to many</a>
            </li>
            <li class="nav-item {{ request()->is('manytomany') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manytomany') }}"><i class="fas fa-user"></i>
                    Many to many</a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
