{{-- @extends('layouts.app')

@section('content') --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Potensi Laundry</title>
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Karla', sans-serif;
      background: linear-gradient(to bottom, rgba(255,255,255,0.25), rgba(109,201,236,0.25), rgba(38,175,228,0.25));
      color: black;
      width: 100vw;
      overflow-x: hidden;
    }

    .section-top {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin-bottom: 100px;
      width: 100%;
    }

    .section-top img {
      width: 500px;
      height: auto;
      object-fit: cover;
      flex-shrink: 0;
    }

    .section-top .text-content {
      flex: 1;
      padding-right: 30px;
    }

    .section-top h1 {
      font-size: 64px;
      font-weight: 700;
    }

    .section-top p {
      font-size: 36px;
      font-weight: 500;
      margin-top: 20px;
      text-align: justify;
    }

    .keuntungan-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      width: 100%;
      gap: 30px;
    }

    .keuntungan {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 30px;
      padding-left: 0;
    }

    .keuntungan h2 {
      font-size: 64px;
      font-weight: 700;
      line-height: 1;
      padding-left: 40px
    }

    .card {
      display: flex;
      align-items: center;
      background: white;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      border-radius: 25px;
      padding: 20px 30px;
      gap: 20px;
    }

    .card img {
      width: 80px;
      height: 80px;
      object-fit: cover;
    }

    .card-text {
      font-size: 32px;
      font-weight: 700;
      color: black;
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
    }

    .faq-section {
      padding: 60px 20px;
      max-width: 1000px;
      margin: 0 auto;
    }

    .faq-section h2 {
      font-size: 64px;
      font-weight: 700;
      text-align: center;
      margin-bottom: 40px;
    }

    details {
      margin-bottom: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
    }

    summary {
      font-size: 28px;
      font-weight: 700;
      cursor: pointer;
    }

    details p {
      margin-top: 10px;
    }

    @media (max-width: 900px) {
      .section-top {
        flex-direction: column;
        align-items: center;
      }

      .keuntungan-wrapper {
        flex-direction: column;
      }

      .gambar-kanan {
        justify-content: center;
      }

      .gambar-kanan img {
        width: 90vw;
        height: auto;
      }
    }
  </style>
</head>
<body>

  <!-- Bagian Atas -->
  <div class="section-top">
    <img src="mitra.png" alt="Ilustrasi">
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
        <img src="images/market.png" alt="icon">
        <div class="card-text">Brand dan Sistem Teruji</div>
      </div>
      
      <div class="card">
        <img src="images/training.png" alt="icon">
        <div class="card-text">Training dan <br>Pendampingan</div>
      </div>
      
      <div class="card">
        <img src="images/tools.png" alt="icon">
        <div class="card-text">Peralatan dan <br>Bahan Berkualitas</div>
      </div>
      
      <div class="card">
        <img src="images/promosi.png" alt="icon">
        <div class="card-text">Pemasaran Digital & <br>Materi Promosi</div>
      </div>
      
    </div>

    <!-- Gambar Kanan -->
    <div class="gambar-kanan">
      <img src="sikat.png" alt="Gambar Besar">
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

</body>
</html>
{{-- @endsection --}}