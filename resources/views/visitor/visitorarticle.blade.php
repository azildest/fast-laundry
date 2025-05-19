@extends('layouts.web')

@section('content')
<div class="container py-5">

  <div class="row justify-content-between mb-4 sticky-top py-2 sticky-filter">
    <form action="{{ route('artikel.index') }}" method="GET" class="d-flex align-items-center bg-white shadow-sm rounded-4 p-2 article-search-form">
      <div class="input-group me-2 article-search-input-group">
        <span class="input-group-text">
          <i class="bi bi-search"></i>
        </span>
        <input type="text" name="query" class="form-control article-search-input" placeholder="Cari Artikel..." value="{{ request('query') }}">
      </div>

      <select name="kategori" class="form-select me-2 article-category-select">
        <option value="">Pilih Kategori</option>
        @foreach ($categories as $kategori)
          <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
            {{ $kategori }}
          </option>
        @endforeach
      </select>

      <button type="submit" class="btn btn-info text-white article-search-btn">Cari</button>
    </form>
  </div>

  <div class="row justify-content-center mb-4">
    <div class="col-md-12">
      <div class="card flex-md-row shadow rounded-4 border-0 p-3">
        <img src="{{ asset('uang.png') }}" class="img-fluid rounded-4 me-md-3 mb-3 mb-md-0 article-highlight-img" alt="Potensi Bisnis Laundry">
        <div class="d-flex flex-column justify-content-center">
          <p class="text-muted mb-1 article-date">26/04/2025 <span class="badge badge-custom mb-2">Peluang Usaha</span></p>
          <h5 class="fw-semibold">Potensi Bisnis Laundry yang Bisa Menghasilkan 100 Juta per Tahun</h5>
          <a href="#" class="btn btn-sm btn-info text-white align-self-start mt-2">Baca Selengkapnya ></a>
        </div>
      </div>
    </div>
  </div>

  @if($articles->isEmpty())
    <div class="text-center py-5">
      <h5>Belum ada artikel ditambahkan.</h5>
    </div>
  @else
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      @foreach($articles as $item)
  <div class="col">
    <div class="card h-100 border-0 shadow rounded-4">
      <img src="{{ asset('home-laundry.png') }}" class="card-img-top rounded-top-4 small-article-img" alt="{{ $item->judul }}">
      <div class="card-body">
        <span class="badge badge-custom mb-2">{{ $item->kategori }}</span>
        <p class="text-muted mb-1 small-article-date">{{ \Carbon\Carbon::parse($item->tanggal_terbit)->format('d/m/Y') }}</p>
        <h6 class="fw-semibold">{{ $item->judul }}</h6>
      </div>
      <div class="card-footer bg-transparent border-0 mb-2">
        <a href="{{ route('artikel.show', $item->id_artikel) }}" class="btn btn-sm btn-info text-white">Baca Selengkapnya ></a>
      </div>
    </div>
  </div>
@endforeach

    </div>
  @endif

</div>
@endsection
