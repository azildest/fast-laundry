
<div id="sidebar" class="d-flex flex-column flex-shrink-0 bg-dark text-white sidebar sidebar-expanded">
    <div class="d-flex justify-content-between align-items-center logo-container">
        <a href="/" class="text-decoration-none w-100">
            <img src="{{ asset('logo.png') }}" alt="Company Logo" class="logo-img">
        </a>
    </div>

    {{-- <hr> --}}
    <ul class="nav nav-pills flex-column mb-3">
        <li class="menu-section text-uppercase px-3 mt-4">Main</li>
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="d-flex align-items-center">
                    <i class="fas fa-tachometer-alt me-3"></i> <span class="label">Dashboard</span>
                </span>
            </a>
        </li>
        <li>
            <a class="nav-link d-flex justify-content-between align-items-center">
                <span class="d-flex align-items-center">
                    <i class="fas fa-chart-line me-3"></i> <span class="label"> Graphics </span>
                </span>
            </a>
        </li>

        <li class="menu-section text-uppercase px-3 mt-3">Content</li>
        <li>
            <a data-bs-toggle="collapse" href="#salesMenu" role="button" class="nav-link d-flex justify-content-between align-items-center dropdown-toggle {{ request()->is('sales*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fas fa-cash-register me-3"></i>
                    <span class="label">Sales</span>
                </div>                
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>
            <div class="collapse {{ request()->is('sales*') ? 'show' : '' }}" id="salesMenu">
                <ul class="list-unstyled ps-3">
                    <li><a href="#" class="nav-link"><i class="fas fa-plus me-3"></i> <span class="label">Add Data</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-list me-3"></i> <span class="label">History</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-boxes me-3"></i> <span class="label">Services</span></a></li>
                </ul>
            </div>
        </li>
        <li>
            <a data-bs-toggle="collapse" href="#articlesMenu" role="button" class="nav-link d-flex justify-content-between align-items-center dropdown-toggle {{ request()->is('articles*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fas fa-newspaper me-3"></i> <span class="label">Articles</span>
                </div>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>
            <div class="collapse {{ request()->is('articles*') ? 'show' : '' }}" id="articlesMenu">
                <ul class="list-unstyled ps-3">
                    <li><a href="#" class="nav-link"><i class="fas fa-plus me-3"></i> <span class="label">Create</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-list me-3"></i> <span class="label">All Articles</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-list-check me-3"></i> <span class="label">Publication</span></a></li>
                </ul>
            </div>
        </li>
        <li>
            <a data-bs-toggle="collapse" href="#faqsMenu" role="button" class="nav-link d-flex justify-content-between align-items-center dropdown-toggle {{ request()->is('faqs*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fas fa-question me-3"></i> <span class="label">FAQs</span>
                </div>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>
            <div class="collapse {{ request()->is('faqs*') ? 'show' : '' }}" id="faqsMenu">
                <ul class="list-unstyled ps-3">
                    {{-- <li><a href="#" class="nav-link"><i class="fas fa-plus me-3"></i> <span class="label">Add</span></a></li> --}}
                    <li><a href="#" class="nav-link"><i class="fas fa-list me-3"></i> <span class="label">All FAQs</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-list-check me-3"></i> <span class="label">Publication</span></a></li>
                </ul>
            </div>
        </li>

        <li class="menu-section text-uppercase px-3 mt-3">Others</li>
        <li>
            <a class="nav-link d-flex justify-content-between align-items-center">
                <span class="d-flex align-items-center">
                    <i class="fas fa-phone me-3"></i> <span class="label">Contact</span>
                </span>
            </a>
        </li>
        <li>
            <a class="nav-link d-flex justify-content-between align-items-center">
                <span class="d-flex align-items-center">
                    <i class="fas fa-user-circle me-3"></i> <span class="label">Accounts</span>
                </span>
            </a>
        </li>
    </ul>
</div>

<div id="sidebarToggleWrapper">
    <button id="toggleSidebar" class="btn btn-sm btn-dark p-2">☰</button>
</div>

{{-- <script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('sidebar-collapsed');
        sidebar.classList.toggle('sidebar-expanded');

        document.body.classList.toggle('sidebar-collapsed-body');
    });
</script> --}}