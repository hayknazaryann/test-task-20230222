<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'clients' ? 'active' : '' }}" href="{{ route('clients.index') }}">
                    View all clients
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(1) == 'report' ? 'active' : '' }}" href="{{ route('report.index') }}">
                    View report
                </a>
            </li>

        </ul>
    </div>
</nav>