<style>
    .navbar-brand img {
        width: 32px;
        height: 32px;
    }

    .navbar-brand .brand-text {
        line-height: 1;
        font-size: 14px;
        color: #0DAAC9;
    }

    .navbar .nav-link {
        font-size: 14px;
        font-weight: 400; 
        color: #000000;
        padding: 0 12px;
        transition: color 0.2s;
    }

    /* .navbar .nav-link:hover {
        color: #0d6efd;
    } */

    @media (max-width: 768px) {
        .navbar .nav-link {
            padding: 0 8px;
            font-size: 13px;
        }
    }
</style>

<nav class="navbar navbar-light bg-white px-4" style="height: 60px;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand d-flex align-items-center mb-0 h1" href="#">
            <img src="{{ asset('logo.png') }}" alt="Company Logo" class="logo-img">
            <div class="d-flex flex-column lh-1 brand-text">
                <span class="fw-bold fst-italic">FAST</span>
                <span class="fw-bold fst-italic">LAUNDRY</span>
            </div>
        </a>
        <div class="d-flex align-items-center">
            <a class="nav-link" href="/visitor/beranda">Beranda</a>
            <a class="nav-link" href="/visitor/artikel">Artikel</a>
            <a class="nav-link" href="/visitor/kemitraan">Kemitraan</a>
            <a class="nav-link" href="/visitor/hubungikami">Hubungi Kami</a>
        </div>
    </div>
</nav>