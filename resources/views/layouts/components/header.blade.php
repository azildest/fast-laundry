<header class="header">
  <div class="logo-container">
      <img src="{{ asset('logo.png') }}" alt="Company Logo" class="logo-img">
    <div class="logo-text">
      FAST <br> LAUNDRY
    </div>
  </div>
  <nav class="nav">
    <a href="/">Beranda</a>
    <a href="/artikel">Artikel</a>
    <a href="/kemitraan">Kemitraan</a>
    <a href="/HubungiKami">Hubungi Kami</a>
  </nav>
</header>

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
      gap: 40px;
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
