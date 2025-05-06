@extends('layouts.app')

@section('title', 'HubungiKami - Potensi Laundry')

@push('styles')
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Karla', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #b2ebf2);
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      
    }

    .about-section {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      flex-wrap: wrap;
      max-width: 1100px;
      margin: 0 auto 60px;
      background: #ffffffcc;
      border-radius: 16px;
      padding: 40px 50px;
      box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
      transition: box-shadow 0.3s ease;
    }
    .about-section:hover {
      box-shadow: 0 12px 30px rgb(0 0 0 / 0.15);
    }

    .about-text {
      flex: 1 1 320px;
      max-width: 600px;
    }

    .about-text h1 {
      font-size: 2.5rem;
      margin-bottom: 16px;
      color: #007c91;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .about-text p {
      font-size: 1.125rem;
      color: #444;
    }

    .about-logo {
      flex: 1 1 280px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      min-width: 280px;
    }

    .about-logo img {
      width: 120px;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
      transition: transform 0.3s ease;
    }
    .about-logo img:hover {
      transform: scale(1.05);
    }

    .about-logo-text {
      display: flex;
      flex-direction: column;
      font-size: 2.5rem;
      font-weight: 700;
      color: #007c91;
      line-height: 1;
      user-select: none;
      letter-spacing: 2px;
    }

    .divider {
      height: 80px;
      max-width: 1100px;
      margin: 0 auto 40px;
      border-bottom: 2px solid #007c91;
      border-radius: 2px;
      opacity: 0.3;
    }

    .main-content {
      display: flex;
      flex-wrap: nowrap;
      justify-content: flex-start;
      align-items: flex-start;
      max-width: 1100px;
      margin: 0 auto;
      gap: 100px;
      padding: 0 20px;
      padding-bottom: 80px; 
    }

    .map-container {
      flex: 1 1 65%;
      max-width: 720px;
    }

    .map-container iframe {
      border: none;
      border-radius: 16px;
      width: 100%;
      height: 400px;
      box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
      transition: box-shadow 0.3s ease;
    }
    .map-container iframe:hover {
      box-shadow: 0 12px 36px rgb(0 0 0 / 0.15);
    }

    .contact-info {
      flex: 1 1 50%;
      max-width: 500px;
      font-size: 1.125rem;
      color: #333;
      padding-top: 20px;
      display: flex;
      flex-direction: column;
      gap: 40px;
    }

    .contact-info h1 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #007c91;
      font-weight: 700;
      border-left: 6px solid #007c91;
      padding-left: 12px;
      user-select: none;
    }

    .contact-info p {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #555;
      transition: color 0.3s ease;
    }
    .contact-info p:hover {
      color: #007c91;
    }

    .contact-info i {
      color: #007c91;
      min-width: 28px;
      text-align: center;
      font-size: 1.3rem;
    }

    @media (max-width: 1024px) {
      .main-content {
        flex-wrap: wrap;
        justify-content: center;
      }
      .map-container {
        flex: 1 1 100%;
        max-width: 100%;
        margin-bottom: 30px;
      }
      .contact-info {
        flex: 1 1 100%;
        max-width: 100%;
        padding-top: 0;
        text-align: center;
      }
      .contact-info h1 {
        border-left: none;
        padding-left: 0;
      }
      .contact-info p {
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      body {
        padding: 30px 15px;
      }
      .about-section {
        flex-direction: column;
        padding: 30px 25px;
        text-align: center;
      }
      .about-logo {
        justify-content: center;
        flex-direction: column;
        gap: 12px;
      }
      .about-logo-text {
        font-size: 2rem;
        margin-top: 8px;
      }
    }
  </style>
@endpush
@section('content')
  <!-- Bagian Tentang Kami -->
  <div class="about-section" role="region" aria-labelledby="about-title">
    <div class="about-text">
      <h1 id="about-title">Tentang Kami</h1>
      <p>
        Fast Laundry adalah layanan laundry terpercaya yang telah melayani masyarakat dengan sistem profesional dan teknologi modern. Kami hadir untuk memberikan solusi praktis, cepat, dan berkualitas untuk kebutuhan kebersihan pakaian Anda.
      </p>
    </div>
    <div class="about-logo" aria-label="Logo Fast Laundry and text">
      <img src="Logonobackground.png" alt="Logo Fast Laundry" />
      <div class="about-logo-text" aria-hidden="true">
        <span>FAST</span>
        <span>LAUNDRY</span>
      </div>
    </div>
  </div>

  <!-- Spacer -->
  <div class="divider" aria-hidden="true"></div>

  <!-- Peta dan Kontak -->
  <div class="main-content">
    <div class="map-container" aria-label="Lokasi Fast Laundry di peta Google Maps">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15861.111885145591!2d107.6229432!3d-6.9024681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e8c7ec93a815%3A0xf0ca0261d75ed396!2sSukapada%2C%20Cibeunying%20Kidul%2C%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sen!2sid!4v1639386000555!5m2!1sen!2sid"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Peta lokasi Fast Laundry"
      ></iframe>
    </div>

    <div class="contact-info" role="contentinfo" aria-label="Informasi kontak Fast Laundry">
      <h1>Hubungi Kami</h1>
      <p><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Sukapada, Cibeunying Kidul, Bandung, Jawa Barat</p>
      <p><i class="fas fa-phone" aria-hidden="true"></i> 08XXXXXXXXXXXX</p>
      <p><i class="fas fa-envelope" aria-hidden="true"></i> fastlaundry@gmail.com</p>
    </div>
  </div>
  @endsection