<footer class="footer-container">
  <style>
    .footer-container {
      background-color: #ffffff;
      padding: 20px 0 0 0;
      color: #26AFE4;
      font-family: 'Roboto', sans-serif;
      box-shadow: 0 -4px 12px rgb(0 0 0 / 0.05);
    }

    .footer-content {
      max-width: 1100px;
      margin: 0 auto;
      text-align: center;
    }

    .footer-top {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 50px;
      flex-wrap: wrap;
     
    }

    .footer-logo {
      display: flex;
      align-items: center;
   
      min-width: 280px;
      justify-content: center;
    }

    .footer-logo img {
      width: 100px;
      height: auto;
      object-fit: contain;
      filter: drop-shadow(0 1px 1px rgb(0 0 0 / 0.1));
      transition: transform 0.3s ease;
    }
    .footer-logo img:hover {
      transform: scale(1.1);
    }

    .footer-logo-text {
      font-family: 'Poppins', sans-serif;
      font-size: 24px;
      font-style: italic;
      font-weight: 700;
      color: #26AFE4;
      line-height: 1.1;
      text-align: left;
      user-select: none;
      letter-spacing: 1.2px;
    }

    .footer-divider {
      width: 2px;
      height: 40px;
      background-color: #26AFE4;
      border-radius: 2px;
      flex-shrink: 0;
    }

    .footer-social {
      display: flex;
      align-items: center;
      gap: 24px;
      justify-content: center;
      min-width: 260px;
    }

    .footer-social a {
      display: inline-block;
      transition: transform 0.3s ease;
    }
    .footer-social a:hover {
      transform: scale(1.2);
    }

    .footer-social img {
      width: 40px;
      height: 40px;
      object-fit: contain;
      vertical-align: top;
      filter: drop-shadow(0 1px 1px rgb(0 0 0 / 0.1));
    }

    .footer-nav {
      margin: 30px 0 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      font-size: 24px;
      font-weight: 600;
      user-select: none;
    }

    .footer-nav a {
      color: #26AFE4;
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 6px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    .footer-nav a:hover,
    .footer-nav a:focus {
      background-color: #26AFE4;
      color: white;
      outline: none;
    }

    .footer-nav span {
      color: #26AFE4;
      user-select: none;
    }

    .footer-description {
      font-size: 16px;
      max-width: 800px;
      margin: 0 auto 30px;
      line-height: 1.6;
      color: #444;
      user-select: text;
    }

    .footer-copyright {
      margin-top: 10px;
      font-size: 14px;
      color: #888;
      user-select: none;
    }

    @media (max-width: 600px) {
      .footer-top {
        flex-direction: column;
        gap: 25px;
      }

      .footer-logo,
      .footer-social {
        min-width: auto;
        justify-content: center;
      }

      .footer-divider {
        display: none;
      }

      .footer-nav {
        gap: 12px;
        font-size: 16px;
      }

      .footer-description {
        font-size: 15px;
        padding: 0 10px;
      }
    }
  </style>

  <div class="footer-content">
    <div class="footer-top">
      <div class="footer-logo">
        <img src="{{ asset('Logonobackground.png') }}" alt="Company Logo" />
        <div class="footer-logo-text">
          FAST <br /> LAUNDRY
        </div>
      </div>

      <div class="footer-divider" aria-hidden="true"></div>

      <div class="footer-social" role="list">
        <a href="#" aria-label="Facebook" role="listitem"><img src="{{ asset('facebook.png') }}"/></a>
        <a href="#" aria-label="X" role="listitem"><img src="{{ asset('x.png') }}" alt="X" /></a>
        <a href="#" aria-label="LinkedIn" role="listitem"><img src="{{ asset('linkedin.png') }}" alt="LinkedIn" /></a>
        <a href="#" aria-label="Instagram" role="listitem"><img src="{{ asset('instagram.png') }}" alt="Instagram" /></a>
      </div>
    </div>

    <nav class="footer-nav" aria-label="Footer Navigation">
      <a href="/visitor/beranda">Beranda</a>
      <span aria-hidden="true">|</span>
      <a href="/visitor/artikel">Artikel</a>
      <span aria-hidden="true">|</span>
      <a href="/visitor/kemitraan">Kemitraan</a>
      <span aria-hidden="true">|</span>
      <a href="/visitor/hubungikami">Hubungi Kami</a>
    </nav>

    <p class="footer-description">
      Kami hadir untuk memberikan layanan laundry terbaik dengan hasil maksimal, proses cepat, dan harga terjangkau.
      Dapatkan pengalaman laundry yang lebih praktis dengan layanan antar-jemput gratis dan kualitas pencucian profesional.
      Hubungi kami untuk informasi lebih lanjut atau bergabung dalam kemitraan menguntungkan bersama Fast Laundry.
    </p>

    <p class="footer-copyright">
      © 2025 FastLaundry <span aria-hidden="true" style="margin: 0 10px;">|</span> Powered by <strong>FastLaundry</strong>
    </p>
  </div>
</footer>