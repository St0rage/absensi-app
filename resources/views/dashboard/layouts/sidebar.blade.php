<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="layout"></span>
                Dashboard
                </a>
            </li>
            @can('lecture')    
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/attendance/recap*') ? 'active' : '' }}" href="/dashboard/attendance/recap">
                <span data-feather="book"></span>
                Rekap
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/attendance') ? 'active' : '' }}" href="/dashboard/attendance">
                <span data-feather="file-plus"></span>
                Buat Absensi
                </a>
            </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/profil*') ? 'active' : '' }}" href="/dashboard/profile">
                <span data-feather="user"></span>
                Profil
                </a>
            </li>
        </ul>

        @can('admin')
            
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Administrator</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/user*') ? 'active' : '' }}" href="/dashboard/user">
                <span data-feather="users"></span>
                User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/classroom*') ? 'active' : '' }}" href="/dashboard/classroom">
                <span data-feather="home"></span>
                Kelas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/subject*') ? 'active' : '' }}" href="/dashboard/subject">
                <span data-feather="book-open"></span>
                Mata Kuliah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/recap*') ? 'active' : '' }}" href="/dashboard/recap">
                <span data-feather="book"></span>
                Rekap
                </a>
            </li>
        </ul>
        @endcan
        <ul class="nav flex-column mb-2">
            <li class="nav-item">                
                <form class="d-flex" action="/logout" method="post">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-white"><span data-feather="log-out"></span>Logout</a></button>
                </form>
            </li>
        </ul>
    </div>
    </nav>