@extends('layouts.app')

@section('title', 'Kemitraan - Potensi Laundry')

@push('styles')
 <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Karla', sans-serif;
      background: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(109, 201, 236, 0.3), rgba(38, 175, 228, 0.3));
      color: #111;
      width: 100vw;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      line-height: 1.5;
      padding-top: 20px;
    }

    .section-top {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin-bottom: 100px;
      width: 100%;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
      
      align-items: center;
    }

    .section-top img {
      width: 500px;
      height: auto;
      object-fit: cover;
      flex-shrink: 0;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
      transition: transform 0.3s ease;
    }
    .section-top img:hover {
      transform: scale(1.03);
    }

    .section-top .text-content {
      flex: 1;
      padding-right: 30px;
      color: #0a0a0a;
    }

    .section-top h1 {
      font-size: 56px;
      font-weight: 700;
      line-height: 1.1;
      margin-bottom: 24px;
      letter-spacing: -0.02em;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .section-top p {
      font-size: 28px;
      font-weight: 500;
      margin-top: 20px;
      text-align: justify;
      color: #222;
      text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
    }

    .keuntungan-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      width: 100%;
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto 80px;
      padding: 0 20px;
    }

    .keuntungan {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 30px;
      padding-left: 0;
    }

    .keuntungan h2 {
      font-size: 56px;
      font-weight: 700;
      line-height: 1;
      padding-left: 40px;
      color: #0b72b9;
      text-shadow: 0 1px 3px rgba(11, 114, 185, 0.3);
      margin-bottom: 20px;
    }

    .card {
      display: flex;
      align-items: center;
      background: #fff;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
      border-radius: 25px;
      padding: 24px 36px;
      gap: 24px;
      transition: box-shadow 0.3s ease;
      cursor: default;
    }
    .card:hover {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
    }

    .card img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      filter: drop-shadow(0 1px 1px rgba(0,0,0,0.1));
    }

    .card-text {
      font-size: 30px;
      font-weight: 700;
      color: #111;
      line-height: 1.1;
      user-select: none;
    }

    .gambar-kanan {
      flex: 1;
      display: flex;
      justify-content: flex-end;
      align-items: flex-end;
    }

    .gambar-kanan img {
      width: 800px;
      height: 680px;
      object-fit: cover;
      max-width: 100%;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease;
    }
    .gambar-kanan img:hover {
      transform: scale(1.02);
    }

    .faq-section {
      padding: 60px 20px;
      max-width: 1000px;
      margin: 0 auto 80px;
    }

    .faq-section h2 {
      font-size: 56px;
      font-weight: 700;
      text-align: center;
      margin-bottom: 40px;
      color: #0b72b9;
      text-shadow: 0 1px 3px rgba(11, 114, 185, 0.3);
    }

    details {
      margin-bottom: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
      padding: 24px 30px;
      transition: box-shadow 0.3s ease;
      cursor: pointer;
    }
    details[open] {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
    }

    summary {
      font-size: 28px;
      font-weight: 700;
      cursor: pointer;
      outline-offset: 4px;
      user-select: none;
      color: #0b72b9;
    }

    details p {
      margin-top: 12px;
      font-size: 20px;
      color: #222;
      line-height: 1.4;
    }

    @media (max-width: 900px) {
      .section-top {
        flex-direction: column;
        align-items: center;
      }

      .section-top img {
        width: 90vw;
        max-width: 500px;
      }

      .section-top .text-content {
        padding-right: 0;
      }

      .keuntungan-wrapper {
        flex-direction: column;
        padding: 0 10px;
      }

      .gambar-kanan {
        justify-content: center;
        margin-top: 40px;
      }

      .gambar-kanan img {
        width: 90vw;
        height: auto;
      }
    }
  </style>

@endpush

@section('content')
  <!-- Bagian Atas -->
  <div class="section-top">
    <img src="mitra.png" alt="Ilustrasi" />
    <div class="text-content">
      <h1>Potensi Laundry Sebagai Peluang Usaha</h1>
      <p>
        Industri laundry memiliki potensi besar sebagai peluang usaha yang menjanjikan di era modern ini. Gaya hidup masyarakat yang semakin sibuk dan padat membuat banyak orang tidak lagi memiliki waktu untuk mencuci dan merawat pakaian sendiri. Hal ini menciptakan kebutuhan akan layanan laundry yang cepat, praktis, dan berkualitas. Menariknya, usaha laundry dapat dimulai dengan modal yang relatif terjangkau, yakni sekitar Rp30 juta. Dengan modal tersebut, pelaku usaha sudah bisa memulai bisnis skala kecil dengan peralatan dasar seperti mesin cuci, pengering, setrika uap, dan perlengkapan pendukung lainnya. Selain itu, operasional yang fleksibel menjadikan bisnis laundry sangat cocok bagi pemula maupun pelaku usaha yang ingin mengembangkan bisnis jasa. Dengan strategi pemasaran yang tepat, layanan yang profesional, serta konsistensi dalam kualitas, usaha laundry memiliki peluang besar untuk berkembang pesat dan menghasilkan keuntungan yang stabil dalam jangka panjang.
      </p>
    </div>
  </div>

  <!-- Keuntungan + Gambar -->
  <div class="keuntungan-wrapper">

    <!-- Keuntungan -->
    <div class="keuntungan">
      <h2>Keuntungan</h2>

      <div class="card">
        <img src="images/market.png" alt="icon" />
        <div class="card-text">Brand dan Sistem Teruji</div>
      </div>

      <div class="card">
        <img src="images/training.png" alt="icon" />
        <div class="card-text">Training dan <br />Pendampingan</div>
      </div>

      <div class="card">
        <img src="images/tools.png" alt="icon" />
        <div class="card-text">Peralatan dan <br />Bahan Berkualitas</div>
      </div>

      <div class="card">
        <img src="images/promosi.png" alt="icon" />
        <div class="card-text">Pemasaran Digital & <br />Materi Promosi</div>
      </div>
    </div>

    <!-- Gambar Kanan -->
    <div class="gambar-kanan">
      <img src="sikat.png" alt="Gambar Besar" />
    </div>
  </div>

  <!-- FAQ -->
  <div class="faq-section">
    <h2>Pertanyaan Umum</h2>

    <details>
      <summary>Apa saja layanan laundry yang tersedia?</summary>
      <p>Kami menyediakan layanan cuci kering, setrika, antar jemput...</p>
    </details>

    <details>
      <summary>Bagaimana cara menghindari pakaian saya hilang atau rusak?</summary>
      <p>Kami menggunakan sistem tag dan inspeksi...</p>
    </details>

    <details>
      <summary>Apa yang harus saya lakukan jika ada barang tertinggal?</summary>
      <p>Segera hubungi kami dalam 1x24 jam...</p>
    </details>
  </div>
  @endsection