
<div id="sidebar" class="d-flex flex-column flex-shrink-0 bg-dark text-white sidebar sidebar-expanded">
    <div class="d-flex justify-content-between align-items-center logo-container">
        <a href="/" class="text-decoration-none w-100">
            <img src="{{ asset('logo.png') }}" alt="Company Logo" class="logo-img">
        </a>
    </div>

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
            <a href="{{ route('graphics') }}" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('graphics') ? 'active' : '' }}">
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
                    {{-- <li><a href="#" class="nav-link {{ request()->routeIs('sales.add') ? 'active' : '' }}"><i class="fas fa-plus me-3"></i> <span class="label">Add Data</span></a></li> --}}
                    <li><a href="{{ route('sales.records') }}" class="nav-link {{ request()->routeIs('sales.records') ? 'active' : '' }}"><i class="fas fa-list me-3"></i> <span class="label">Records</span></a></li>
                    <li><a href="{{ route('services.records') }}" class="nav-link {{ request()->routeIs('services.records') ? 'active' : '' }}"><i class="fas fa-boxes me-3"></i> <span class="label">Services</span></a></li>
                </ul>
            </div>
        </li>
        <li>
            <a data-bs-toggle="collapse" href="#articlesMenu" role="button" class="nav-link d-flex justify-content-between align-items-center dropdown-toggle {{ request()->is('artikel*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fas fa-newspaper me-3"></i> <span class="label">Articles</span>
                </div>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>
           <div class="collapse {{ request()->is('artikel*') ? 'show' : '' }}" id="articlesMenu">
                <ul class="list-unstyled ps-3">
                    <li>
                        <a href="{{ route('admin.artikel.kelola') }}" 
                        class="nav-link {{ request()->routeIs('admin.artikel.kelola') ? 'active' : '' }}">
                            <i class="fas fa-list me-3"></i> <span class="label">Manage Articles</span>
                        </a>
                    </li>
                    <li>
                        @if(Auth::check() && Auth::user()->level == 2)    
                            <a href="{{ route('admin.artikel.publikasi') }}" 
                            class="nav-link {{ request()->routeIs('admin.artikel.publikasi') ? 'active' : '' }}">
                                <i class="fas fa-list-check me-3"></i> <span class="label">Publish Articles</span>
                            </a>        
                        @endif
                    </li>
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
                    <li><a href="{{ route('allfaq') }}"  class="nav-link {{ request()->routeIs('allfaq') ? 'active' : '' }}"><i class="fas fa-list me-3"></i> <span class="label">All FAQs</span></a></li>
                    <li>
                    @if(Auth::check() && Auth::user()->level == 2)
                        <li><a href="{{ route('faq.approval') }}" class="nav-link {{ request()->routeIs('faq.approval') ? 'active' : '' }}">
                            <i class="fas fa-list-check me-3"></i> 
                            <span class="label">Publish FAQs</span>
                        </a></li>
                    @endif
                    </li>
                </ul>
            </div>
        </li>

    @if(Auth::check() && Auth::user()->level == 2)
        <li class="menu-section text-uppercase px-3 mt-3">Settings</li>
        <li>
            <a href="{{ route('kontak.edit', 1) }}" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('kontak.edit') ? 'active' : '' }}">
                <span class="d-flex align-items-center">
                    <i class="fas fa-building me-3"></i> <span class="label">Company Profile</span>
                </span>
            </a>
        </li>

        <li>
            <a href="{{ route('users.list') }}" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('users.list') ? 'active' : '' }}">
                <span class="d-flex align-items-center">
                    <i class="fas fa-users me-3"></i> <span class="label">Manage Users</span>
                </span>
            </a>
        </li>
    @endif
    </ul>
</div>

<div id="sidebarToggleWrapper">
    <button id="toggleSidebar" class="btn btn-sm btn-dark p-2">☰</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('toggleSidebar');
        const navLinksWithDropdown = sidebar.querySelectorAll('[data-bs-toggle="collapse"]');

        function isDescendant(parent, child) {
            let node = child;
            while (node !== null) {
                if (node === parent) {
                    return true;
                }
                node = node.parentNode;
            }
            return false;
        }

        navLinksWithDropdown.forEach(link => {
            const targetId = link.getAttribute('href');
            const collapseElement = document.querySelector(targetId);
            const isActiveParent = link.classList.contains('active');
            const activeChild = collapseElement ? collapseElement.querySelector('.nav-link.active') : null;

            if (isActiveParent || activeChild) {
                const bsCollapse = new bootstrap.Collapse(collapseElement, { show: true });
            }
        });
    });
</script>