@extends('layouts.web')

@section('content')

    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6 text-center text-md-start">
                <h2 class="fw-bold mb-3">Punya <span class="underline-text">Cucian Numpuk</span><br>
                    Tapi <span class="underline-text">Takut Mahal</span>?
                </h2>
                <p class="text-muted">Tenang, harga ramah kantong dan kualitas tetap nomor satu.</p>
                <a href="https://wa.me/08xxxxxxx" class="btn btn-info text-white me-2">Pesan Sekarang</a>
                <img src="{{ asset('whatsapp.png') }}" alt="WhatsApp" width="70" class="ms-2">
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('hello-img.png') }}" alt="Laundry Illustration" class="img-fluid">
            </div>
        </div>

        <div class="text-center my-5">
            <h3 class="fw-bold">Layanan Kami</h3>
        </div>

        <div class="row justify-content-center g-3">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="box-white d-flex align-items-center">
                    <img src="{{ asset('setrika-aja.png') }}" alt="Setrika Saja" width="50" class="mx-3">
                    <div>
                        <h6 class="fw-bold mb-1">Setrika Saja</h6>
                        <p class="text-muted small mb-0">Rp. 5.000/Kg</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 col-lg-4">
                <div class="box-white d-flex align-items-center mb-2">
                    <img src="{{ asset('cuci-kering.png') }}" alt="Cuci Kering tanpa Lipat" width="45" class="mx-3">
                    <div>
                        <h6 class="fw-bold mb-1">Cuci Kering tanpa Lipat</h6>
                        <p class="text-muted small mb-0">Rp. 5.000/Kg</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-3">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="box-white d-flex align-items-center">
                    <img src="{{ asset('cuci-kering-lipat.png') }}" alt="Cuci Kering Lipat" width="50" class="mx-3">
                    <div>
                        <h6 class="fw-bold mb-1">Cuci Kering Lipat</h6>
                        <p class="text-muted small mb-0">Rp. 6.000/Kg</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 col-lg-4">
                <div class="box-white d-flex align-items-center mt-1">
                    <img src="{{ asset('cuci-setrika.png') }}" alt="Cuci Kering Setrika" width="45" class="mx-3">
                    <div>
                        <h6 class="fw-bold mb-1">Cuci Kering Setrika</h6>
                        <p class="text-muted small mb-0">Rp. 6.500/Kg</p>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="text-center my-5">
            <h3 class="fw-bold">Keunggulan Kami</h3>
        </div>
        
        <div class="row justify-content-center g-4">
            <div class="col-6 col-md-3">
                <div class="border rounded-4 shadow p-3 text-center h-100 bg-white">
                    <img src="{{ asset('harga-murah.png') }}" alt="Harganya Murah" width="50" class="mt-3">
                    <p class="fw-medium">Harganya Murah</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="border rounded-4 shadow p-3 text-center h-100 bg-white">
                    <img src="{{ asset('pembayaran-mudah.png') }}" alt="Pembayaran Mudah" width="50" class="mt-3">
                    <p class="fw-medium">Pembayaran Mudah</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="border rounded-4 shadow p-3 text-center h-100 bg-white">
                    <img src="{{ asset('pengerjaan-cepat.png') }}" alt="Pengerjaan Cepat" width="50" class="mt-3">
                    <p class="fw-medium">Pengerjaan Cepat</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="border rounded-4 shadow p-3 text-center h-100 bg-white">
                    <img src="{{ asset('mesin-cuci.png') }}" alt="Mesin Yang Handal" width="45" class="mt-3">
                    <p class="fw-medium">Mesin Yang Handal</p>
                </div>
            </div>
        </div>

        <div class="text-center my-5">
            <h3 class="fw-bold">Artikel Menarik</h3>
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
          
          <div class="text-center mt-4">
            <button class="btn btn-info text-black bg-white border-0 px-5" onclick="window.location.href='/visitor/artikel'">
                Muat Lagi
            </button>
        </div>
        
          
        
    </div>
@endsection
