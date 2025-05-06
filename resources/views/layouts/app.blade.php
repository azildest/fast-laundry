<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Potensi Laundry')</title>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;700&display=swap" rel="stylesheet" />
    @stack('styles') <!-- Untuk tambahan CSS jika diperlukan -->
</head>
<body>
    @include('layouts.components.header') <!-- Header -->

    <main class="main-wrapper">
        @yield('content') <!-- Konten halaman -->
    </main>

    @include('layouts.components.footer') <!-- Footer -->

    @stack('scripts') <!-- Untuk tambahan JS jika diperlukan -->
</body>

</html>
