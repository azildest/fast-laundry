<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAST LAUNDRY</title>

  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&family=Poppins:wght@700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Karla', sans-serif;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
      padding: 10px 20px;
      height: 100px;
    }

    .logo-container {
      display: flex;
      align-items: center;
    }

    .logo-img {
      width: 60px;
      height: 60px;
      margin-right: 1px;
    }

    .logo-text {
      font-family: 'Poppins', sans-serif;
      font-size: 26px;
      font-style: italic;
      font-weight: 700;
      color: #0DAAC9;
      line-height: 1.1;
    }

    .nav {
      display: flex;
      gap: 30px;
    }

    .nav a {
      text-decoration: none;
      color: black;
      font-size: 20px;
      font-weight: 400;
    }

    .nav a:hover {
      color: #0DAAC9;
    }
  </style>
</head>
<body style="width: 100%; background: linear-gradient(to bottom, rgba(255,255,255,0.25), rgba(109,201,236,0.25), rgba(38,175,228,0.25));">

  @include('components.header')

  <main style="min-height: 100vh;">
    @yield('content')
  </main>

  @include('components.footer')

</body>
</html>
