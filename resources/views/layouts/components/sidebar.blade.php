<style>
    .nav-link.active {
        color: #0d6efd !important;
        background-color: transparent !important;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.548) !important;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar {
        transition: all 0.3s ease;
    }

    .sidebar-collapsed {
        width: 85px !important;
        overflow-x: hidden;
    }

    .sidebar-expanded {
        width: 250px;
    }

    .logo-img {
        width: 100%;
        max-height: 50px;
        object-fit: contain;
    }

    #toggleSidebar {
        display: inline-block;
    }

    .sidebar-collapsed .label {
        display: none;
    }

    .sidebar-collapsed .nav-link {
        text-align: left;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .sidebar-collapsed .nav-link i {
        margin-right: 0;
    }

    .sidebar-collapsed .logo-img {
        display: none;
    }

    /* @media (max-width: 768px) {
        #sidebar {
            position: fixed;
            z-index: 1000;
            height: 100vh;
        }

        #content {
            margin-left: 250px;
        }

        .sidebar-collapsed + #content {
            margin-left: 80px;
        }

        .sidebar-collapsed {
            display: block;
            width: 80px;
        }

        #toggleSidebar {
            display: inline-block;
        }
    } */
</style>

<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white sidebar sidebar-expanded" style="height: 100vh;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/" class="text-decoration-none w-100">
            <img src="{{ asset('logo.png') }}" alt="Company Logo" class="logo-img">
        </a>
        <button id="toggleSidebar" class="btn btn-sm btn-outline-light ms-2">☰</button>
    </div>

    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> <span class="label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="nav-link">
                <i class="fas fa-chart-line me-2"></i> <span class="label"> Grafik </span>
            </a>
        </li>
        <li>
            <a class="nav-link">
                <i class="fas fa-building me-2"></i> <span class="label">Profil Perusahaan</span>
            </a>
        </li>
        <li>
            <a data-bs-toggle="collapse" href="#penjualanMenu" role="button" class="nav-link dropdown-toggle {{ request()->is('penjualan*') ? 'active' : '' }}">
                <i class="fas fa-cash-register me-2"></i> <span class="label">Penjualan</span>
            </a>
            <div class="collapse {{ request()->is('penjualan*') ? 'show' : '' }}" id="penjualanMenu">
                <ul class="list-unstyled ps-3">
                    <li><a href="#" class="nav-link"><i class="fas fa-file-alt me-2"></i> <span class="label">Laporan</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-chart-pie me-2"></i> <span class="label">Grafik</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-boxes me-2"></i> <span class="label">Data Produk</span></a></li>
                </ul>
            </div>
        </li>
        <li>
            <a data-bs-toggle="collapse" href="#artikelMenu" role="button" class="nav-link dropdown-toggle {{ request()->is('artikel*') ? 'active' : '' }}">
                <i class="fas fa-newspaper me-2"></i> <span class="label">Artikel</span>
            </a>
            <div class="collapse {{ request()->is('artikel*') ? 'show' : '' }}" id="artikelMenu">
                <ul class="list-unstyled ps-3">
                    <li><a href="#" class="nav-link"><i class="fas fa-list me-2"></i> <span class="label">Semua Artikel</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-plus me-2"></i> <span class="label">Tambah Artikel</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-tags me-2"></i> <span class="label">Kategori</span></a></li>
                </ul>
            </div>
        </li>
        <li>
            <a data-bs-toggle="collapse" href="#faqMenu" role="button" class="nav-link dropdown-toggle {{ request()->is('faq*') ? 'active' : '' }}">
                <i class="fas fa-question-circle me-2"></i> <span class="label">FAQ</span>
            </a>
            <div class="collapse {{ request()->is('faq*') ? 'show' : '' }}" id="faqMenu">
                <ul class="list-unstyled ps-3">
                    <li><a href="#" class="nav-link"><i class="fas fa-question me-2"></i> <span class="label">Semua FAQ</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-plus me-2"></i> <span class="label">Tambah FAQ</span></a></li>
                    <li><a href="#" class="nav-link"><i class="fas fa-tags me-2"></i> <span class="label">Kategori</span></a></li>
                </ul>
            </div>
        </li>
        <li>
            <a class="nav-link">
                <i class="fas fa-user-circle me-2"></i> <span class="label">Akun</span>
            </a>
        </li>
    </ul>
</div>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('sidebar-collapsed');
        sidebar.classList.toggle('sidebar-expanded');
    });
</script>