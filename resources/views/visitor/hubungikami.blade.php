@extends('layouts.web')

@section('content')
<div class="container py-5">
  <!-- Bagian Tentang Kami -->
  <div class="about-section " role="region" aria-labelledby="about-title">
    <div class="about-text ">
      <h1 id="about-title">Tentang Kami</h1>
      <p>
        Fast Laundry adalah layanan laundry terpercaya yang telah melayani masyarakat dengan sistem profesional dan teknologi modern. Kami hadir untuk memberikan solusi praktis, cepat, dan berkualitas untuk kebutuhan kebersihan pakaian Anda.
      </p>
    </div>
    <div class="about-logo  d-flex align-items-center mb-0 h1  " aria-label="Logo Fast Laundry and text" style="gap: 24px;">
      <img src="{{ asset('Logonobackground.png') }}" alt="Logo Fast Laundry" />
      <div class="about-logo-text" aria-hidden="true">
        <span>FAST</span>
        <span>LAUNDRY</span>
      </div>
    </div>
  </div>

  <!-- Spacer -->
  <div class="divider1" aria-hidden="true"></div>

  <!-- Peta dan Kontak -->
  <div class="map-contact-wrapper">
  <div class="main-content">
    <div class="map-container" aria-label="Lokasi Fast Laundry di peta Google Maps">
      {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d495.1226222379527!2d107.64407904857318!3d-6.892878370996931!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7a265468f3f%3A0xda241b330fa5f9ef!2sFast%20Laundry%20Satu%20Hari%20Selesai!5e0!3m2!1sen!2sid!4v1746882545928!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>    </div> --}}
     
     @if ($kontakData->first() && $kontakData->first()->maps_embed)
    {!! $kontakData->first()->maps_embed !!}
    @endif
</div>

    <div class="contact-info" role="contentinfo" aria-label="Informasi kontak Fast Laundry">
      <h1>Hubungi Kami</h1>

      @foreach ($kontakData as $kontak)
        <p>
          <img src="{{ asset('location.png') }}" alt="Lokasi" style="width: 40px; vertical-align: middle; margin-right: 8px;" />
          {{ $kontak->address }}
        </p>
        <p>
          <img src="{{ asset('telephone.png') }}" alt="Telepon" style="width: 40px; vertical-align: middle; margin-right: 8px;" />
          {{ $kontak->phone }}
        </p>
        <p>
          <img src="{{ asset('email.png') }}" alt="Email" style="width: 40px; vertical-align: middle; margin-right: 8px;" />
          {{ $kontak->email }}
        </p>
      @endforeach


    </div>
  </div>
  </div>
</div>
  @endsection