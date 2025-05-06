@extends('layouts.web')

@section('content')
    <div class="container py-5">

        <div class="row justify-content-center mb-4">
            <div class="col-md-12">
              <div class="card flex-md-row shadow rounded-4 border-0 p-3">
                <img src="{{ asset('uang.png') }}" class="img-fluid rounded-4 me-md-3 mb-3 mb-md-0" style="width: 250px; object-fit: cover;" alt="Potensi Bisnis Laundry">
                <div class="d-flex flex-column justify-content-center">
                  <p class="text-muted mb-1" style="font-size: 14px;">26/04/2025 <span class="badge badge-custom mb-2">Peluang Usaha</span></p>
                  <h5 class="fw-semibold">Potensi Bisnis Laundry yang Bisa Menghasilkan 100 Juta per Tahun</h5>
                  <a href="#" class="btn btn-sm btn-info text-white align-self-start mt-2">Baca Selengkapnya ></a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">

            <div class="col">
              <div class="card h-100 border-0 shadow rounded-4">
                <img src="{{ asset('eco-laundry.png') }}" class="card-img-top rounded-top-4" alt="Eco Laundry">
                <div class="card-body">
                    <span class="badge badge-custom mb-2">Eco-Friendly</span>
                    <p class="text-muted mb-1" style="font-size: 14px;">19/05/2025</p>
                    <h6 class="fw-semibold">Laundry Ramah Lingkungan: Solusi Bersih Tanpa Merusak Alam</h6>
                </div>
                <div class="card-footer bg-transparent border-0 mb-2">
                    <a href="#" class="btn btn-sm btn-info text-white">Baca Selengkapnya ></a>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card h-100 border-0 shadow rounded-4">
                <img src="{{ asset('smart-laundry.png') }}" class="card-img-top rounded-top-4" alt="Smart Laundry">
                <div class="card-body">
                    <span class="badge badge-custom mb-2">Teknologi & Inovasi</span>
                    <p class="text-muted mb-1" style="font-size: 14px;">22/05/2025</p>
                    <h6 class="fw-semibold">Inovasi Teknologi di Dunia Laundry: Mesin Cuci Cerdas dan Aplikasi</h6>
                </div>
                <div class="card-footer bg-transparent border-0 mb-2">
                    <a href="#" class="btn btn-sm btn-info text-white">Baca Selengkapnya ></a>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card h-100 border-0 shadow rounded-4">
                <img src="{{ asset('home-laundry.png') }}" class="card-img-top rounded-top-4" alt="Home Laundry">
                <div class="card-body">
                    <span class="badge badge-custom mb-2">Inspirasi & Kisah Sukses</span>
                    <p class="text-muted mb-1" style="font-size: 14px;">22/05/2025</p>
                    <h6 class="fw-semibold">Dari Laundry Rumahan Hingga Omzet Puluhan Juta</h6>
                </div>
                <div class="card-footer bg-transparent border-0 mb-2">
                    <a href="#" class="btn btn-sm btn-info text-white">Baca Selengkapnya ></a>
                </div>
              </div>
            </div>
          </div>

          <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center mt-2">

            <div class="col">
              <div class="card h-100 border-0 shadow rounded-4">
                <img src="{{ asset('eco-laundry.png') }}" class="card-img-top rounded-top-4" alt="Eco Laundry">
                <div class="card-body">
                    <span class="badge badge-custom mb-2">Eco-Friendly</span>
                    <p class="text-muted mb-1" style="font-size: 14px;">19/05/2025</p>
                    <h6 class="fw-semibold">Laundry Ramah Lingkungan: Solusi Bersih Tanpa Merusak Alam</h6>
                </div>
                <div class="card-footer bg-transparent border-0 mb-2">
                    <a href="#" class="btn btn-sm btn-info text-white">Baca Selengkapnya ></a>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card h-100 border-0 shadow rounded-4">
                <img src="{{ asset('smart-laundry.png') }}" class="card-img-top rounded-top-4" alt="Smart Laundry">
                <div class="card-body">
                    <span class="badge badge-custom mb-2">Teknologi & Inovasi</span>
                    <p class="text-muted mb-1" style="font-size: 14px;">22/05/2025</p>
                    <h6 class="fw-semibold">Inovasi Teknologi di Dunia Laundry: Mesin Cuci Cerdas dan Aplikasi</h6>
                </div>
                <div class="card-footer bg-transparent border-0 mb-2">
                    <a href="#" class="btn btn-sm btn-info text-white">Baca Selengkapnya ></a>
                </div>
              </div>
            </div>
            

            <div class="col">
              <div class="card h-100 border-0 shadow rounded-4">
                <img src="{{ asset('home-laundry.png') }}" class="card-img-top rounded-top-4" alt="Home Laundry">
                <div class="card-body">
                    <span class="badge badge-custom mb-2">Inspirasi & Kisah Sukses</span>
                    <p class="text-muted mb-1" style="font-size: 14px;">22/05/2025</p>
                    <h6 class="fw-semibold">Dari Laundry Rumahan Hingga Omzet Puluhan Juta</h6>
                </div>
                <div class="card-footer bg-transparent border-0 mb-2">
                    <a href="#" class="btn btn-sm btn-info text-white">Baca Selengkapnya ></a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="text-center mt-4">
            <button class="btn btn-info text-black bg-white border-0 px-5">Muat Lagi</button>
          </div>
          
        
    </div>
@endsection
