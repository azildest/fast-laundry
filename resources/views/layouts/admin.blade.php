<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        @stack('styles')


        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminnavbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        {{-- DataTables, a.k.a formatting table --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
    </head>
    
<body>
    @include('layouts.components.adminnavbar')
    <div class="d-flex">
        @include('layouts.components.sidebar')
        <div class="flex-grow-1 p-4 bg-light content-wrapper">
            @yield('content')
        </div>
    </div>

    <style>
        .content-wrapper {
            max-width: 100vw;
            overflow-x: hidden;
        }
    </style>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-expanded');

            // document.body.classList.toggle('sidebar-collapsed-body');
        });
    </script>

    @stack('scripts')
    
</body>
</html>