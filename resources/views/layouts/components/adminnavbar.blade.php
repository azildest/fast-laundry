<nav class="navbar navbar-dark bg-dark px-3 d-flex justify-content-end" style="height: 60px;">
    <div class="dropdown">
        <a href="#" 
           class="d-flex align-items-center text-secondary text-decoration-none dropdown-toggle" 
           id="userDropdown" 
           data-bs-toggle="dropdown" 
           aria-expanded="false">
           <i class="fas fa-user-circle fa-lg me-2"></i>
           <span class="d-none d-sm-inline">{{ Auth::user()->username ?? 'Username' }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="userDropdown">
            <li class="px-3 py-2">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-circle fa-2x text-muted me-3"></i> 

                    <div>
                        <p class="mb-0 fw-bold">{{ Auth::user()->username ?? 'Username' }}</p>
                        <p class="mb-0 small text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                    </div>
                </div>
            </li>
            
            <li><hr class="dropdown-divider"></li>

            <li>
                <a class="dropdown-item" href="#"
                    data-bs-toggle="modal" data-bs-target="#editUserProfileModal">
                    <i class="fas fa-user fa-fw me-2"></i> View Profile
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#"
                    data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    <i class="fas fa-key fa-fw me-2"></i> Change Password
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                {{-- <a class="dropdown-item text-danger" href="#" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-fw me-2"></i> Log Out
                </a> --}}
                <a class="dropdown-item text-danger" href="#"
                    data-bs-toggle="modal" data-bs-target="#logoutConfirmationModal">
                    <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                </a>
                {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form> --}}
            </li>
        </ul>
    </div>

    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form> --}}
</nav>