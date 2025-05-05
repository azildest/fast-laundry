<footer class="footer-container">
  <style>
    .footer-container {
      background-color: white;
      padding: 40px 20px;
      text-align: center;
      color: #26AFE4;
      font-family: 'Roboto', sans-serif;
    }

    .footer-content {
      max-width: 1000px;
      margin: 0 auto;
    }

    .footer-top {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .footer-logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .footer-logo-text {
      font-family: 'Poppins', sans-serif;
      font-size: 22px;
      font-style: italic;
      font-weight: 700;
      color: #0DAAC9;
      line-height: 1.1;
      text-align: left;
    }

    .footer-divider {
      width: 1px;
      height: 60px;
      background-color: #26AFE4;
    }

    .footer-social {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .footer-social img {
    width: 32px;
    height: 32px;
    object-fit: contain;
    vertical-align: top;
  }

    .footer-nav {
      margin: 30px 0;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
      font-size: 18px;
    }

    .footer-nav a {
      color: #26AFE4;
      text-decoration: none;
    }

    .footer-description {
      font-size: 16px;
      max-width: 800px;
      margin: 0 auto 20px;
      line-height: 1.6;
    }

    .footer-copyright {
      margin-top: 30px;
      font-size: 14px;
    }
  </style>

  <div class="footer-content">
    <div class="footer-top">
      <div class="footer-logo">
        <img src="{{ asset('logo.png') }}" alt="Company Logo" width="60">
        <div class="footer-logo-text">
          FAST <br> LAUNDRY
        </div>
      </div>

      <div class="footer-divider"></div>

      <div class="footer-social">
        <a href="#"><img src="images/facebook.svg" alt="Facebook"></a>
        <a href="#"><img src="images/x.svg" alt="X"></a>
        <a href="#"><img src="images/linkedin.svg" alt="LinkedIn"></a>
        <a href="#"><img src="images/instagram.svg" alt="Instagram"></a>
      </div>
      
      
    </div>

    <nav class="footer-nav">
      <a href="/">Beranda</a>
      <span>|</span>
      <a href="/artikel">Artikel</a>
      <span>|</span>
      <a href="/kemitraan">Kemitraan</a>
      <span>|</span>
      <a href="/kontak">Hubungi Kami</a>
    </nav>

    <p class="footer-description">
      Kami hadir untuk memberikan layanan laundry terbaik dengan hasil maksimal, proses cepat, dan harga terjangkau.
      Dapatkan pengalaman laundry yang lebih praktis dengan layanan antar-jemput gratis dan kualitas pencucian profesional.
      Hubungi kami untuk informasi lebih lanjut atau bergabung dalam kemitraan menguntungkan bersama Fast Laundry.
    </p>

    <p class="footer-copyright">
      © 2025 FastLaundry <span style="margin: 0 10px;">|</span> Powered by <strong>FastLaundry</strong>
    </p>
  </div>
</footer>
