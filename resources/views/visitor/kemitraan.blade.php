@extends('layouts.web')

@section('content')
<div class="container py-5">
  <!-- Bagian Atas -->
  <div class="section-top">
    <img src="{{ asset('mitra.png') }}" alt="Ilustrasi" />
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

      <div class="card-mitra">
        <img src="{{ asset('market.png') }}" alt="icon" />
        <div class="card-text-mitra">Brand dan Sistem Teruji</div>
      </div>
      
      <div class="card-mitra">
        <img src="{{ asset('training.png') }}" alt="icon" />
        <div class="card-text-mitra">Training dan Pendampingan</div>
      </div>
      
      <div class="card-mitra">
        <img src="{{ asset('tools.png') }}" alt="icon" />
        <div class="card-text-mitra">Peralatan dan Bahan Berkualitas</div>
      </div>
      
      <div class="card-mitra">
        <img src="{{ asset('promosi.png') }}" alt="icon" />
        <div class="card-text-mitra">Pemasaran Digital & Materi Promosi</div>
      </div>
      
    </div>

    <!-- Gambar Kanan -->
    <div class="gambar-kanan">
      <img src="{{ asset('sikat.png') }}"alt="Gambar Besar" />
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
  </div>
  @endsection