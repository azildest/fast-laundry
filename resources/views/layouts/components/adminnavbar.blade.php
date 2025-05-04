<nav class="navbar navbar-dark bg-dark px-3 d-flex justify-content-end" style="height: 60px;">
    <div class="dropdown">
        <a href="#" 
           class="d-flex align-items-center text-secondary text-decoration-none dropdown-toggle" 
           id="userDropdown" 
           data-bs-toggle="dropdown" 
           aria-expanded="false">
           <i class="fas fa-user-circle fa-lg me-2"></i>
           <span class="d-none d-sm-inline">John Doe</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small" aria-labelledby="userDropdown">
            <li>
                <a class="dropdown-item small" href="#" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt me-2"></i> Log Out
                </a>
            </li>
        </ul>
    </div>

    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form> --}}
</nav>