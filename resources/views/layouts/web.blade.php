<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/visitordashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitorarticle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/articledetail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitornavbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hubungikami.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kemitraan.css') }}">
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>

    @stack('scripts')

<body>

    @include('layouts.components.visitornavbar')

    @yield('content')

    @include('layouts.components.visitorfooter')
</body>
</html>
