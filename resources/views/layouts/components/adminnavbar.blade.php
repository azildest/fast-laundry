

<nav class="navbar navbar-dark bg-dark px-3 d-flex justify-content-end" style="height: 40px;">
    <a href="#" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
       class="text-secondary d-flex align-items-center text-decoration-none custom-logout">
       <i class="fas fa-sign-out-alt me-1"></i> <span class="ms-1">Log Out</span>
    </a>

    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form> --}}
</nav>

<style>
    .custom-logout {
        font-size: 14px;
    }

    .custom-logout i {
        margin-right: 8px;
    }
</style>
