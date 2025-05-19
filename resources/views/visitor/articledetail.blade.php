@extends('layouts.web')

@section('content')
<div class="container-fluid py-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <img src="{{ asset('home-laundry.png') }}" class="img-fluid w-100 article-detail-img" alt="{{ $article->judul }}">

        <div class="p-4">
          <div class="row">
            <div class="col-md-4 col-lg-3 border-end pe-4">

              <div class="mb-4">
                <a href="{{ route('artikel.index') }}" class="text-decoration-none text-info fw-semibold d-inline-flex align-items-center">
                  <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
              </div>

              <div class="mb-4">
                <h6 class="fw-semibold text-uppercase text-muted">Tanggal</h6>
                <p class="mb-0">{{ \Carbon\Carbon::parse($article->tanggal_terbit)->format('d F Y') }}</p>
              </div>

              <div>
                <h6 class="fw-semibold text-uppercase text-muted">Bagikan</h6>
                <div class="d-flex gap-3 mt-2">
                  <a href="javascript:void(0)" onclick="copyLink()" title="Copy Link">
                    <i class="bi bi-clipboard fs-5 text-secondary"></i>
                  </a>
                </div>
              </div>

            </div>

            <div class="col-md-8 col-lg-9 ps-md-4 mt-4 mt-md-0">
              <span class="badge badge-custom mb-4 article-detail-badge">
                {{ $article->kategori }}
              </span>

              <h2 class="fw-bold mb-3">{{ $article->judul }}</h2>

              <div class="article-content text-muted article-detail-content">
                {!! nl2br(e($article->isi)) !!}
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function copyLink() {
    navigator.clipboard.writeText("{{ Request::url() }}")
      .then(() => alert('Link berhasil disalin!'))
      .catch(() => alert('Gagal menyalin link.'));
  }
</script>
@endpush
