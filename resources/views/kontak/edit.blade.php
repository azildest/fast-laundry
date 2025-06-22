@extends('layouts.admin')

@push('styles')
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    /* Body and font */
    body {
      background: linear-gradient(135deg, #e0e7ff 0%, #f9fafb 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #212529;
    }

    /* Breadcrumb */
    .breadcrumb-custom {
  width: 100%; /* ← ubah dari max-width ke width */
  margin-bottom: 2.5rem; /* ← hapus margin auto */
  border-radius: 0.75rem;
  padding: 0.6rem 1.25rem;
  font-size: 0.95rem;
  font-weight: 600;
  color: #495057;
  background-color: #ffffffcc;
  box-shadow: 0 4px 12px rgb(0 0 0 / 0.08);
  transition: box-shadow 0.3s ease;
}

    .breadcrumb-custom:hover {
      box-shadow: 0 6px 20px rgb(0 0 0 / 0.12);
    }
    .breadcrumb-custom a {
      color: #3b82f6;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .breadcrumb-custom a:hover {
      color: #2563eb;
      text-decoration: underline;
    }

    /* Title */
    h2.fw-bold {
      max-width: 960px;
      margin: 3rem auto 1rem auto;
      font-weight: 800;
      font-size: 2.5rem;
      letter-spacing: 0.04em;
      text-align: center;
      color: #1e293b;
      text-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
    }

    /* Card container */
    .card {
        max-width: 1140px;
      margin: 0 auto 4rem auto;
      border-radius: 1.25rem;
      box-shadow: 0 12px 36px rgb(0 0 0 / 0.12);
      border: none;
      background: #ffffff;
      padding: 3rem 4rem;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .card:hover {
      box-shadow: 0 18px 48px rgb(0 0 0 / 0.18);
      transform: translateY(-6px);
    }

    /* Labels */
    label.form-label {
      font-weight: 700;
      color: #334155;
      font-size: 1.1rem;
      margin-bottom: 0.6rem;
      display: block;
      letter-spacing: 0.02em;
    }

    /* Inputs and textarea */
    input.form-control,
    textarea.form-control {
      border-radius: 1rem;
      border: 1.8px solid #cbd5e1;
      padding: 0.85rem 1.25rem;
      font-size: 1.05rem;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      box-shadow: inset 0 2px 6px rgb(0 0 0 / 0.06);
      background-color: #f8fafc;
      color: #1e293b;
      font-weight: 500;
    }
    input.form-control::placeholder,
    textarea.form-control::placeholder {
      color: #94a3b8;
      font-style: italic;
    }
    input.form-control:focus,
    textarea.form-control:focus {
      border-color: #2563eb;
      box-shadow: 0 0 12px rgba(37, 99, 235, 0.4);
      outline: none;
      background-color: #fff;
      font-weight: 600;
    }
    textarea.form-control {
      resize: vertical;
      min-height: 140px;
    }

    /* Button */
    .btn-primary {
      background: linear-gradient(45deg, #2563eb, #3b82f6);
      border: none;
      border-radius: 3rem;
      padding: 0.75rem 3rem;
      font-weight: 800;
      font-size: 1.25rem;
      color: #f1f5f9;
      box-shadow: 0 8px 20px rgb(37 99 235 / 0.5);
      transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
      user-select: none;
    }
    
    .btn-primary:hover {
      background: linear-gradient(45deg, #3b82f6, #2563eb);
      box-shadow: 0 12px 28px rgb(59 130 246 / 0.7);
      transform: translateY(-3px);
      color: #e0e7ff;
    }
    .btn-primary:active {
      transform: translateY(0);
      box-shadow: 0 6px 16px rgb(37 99 235 / 0.6);
    }
   

    /* Responsive form row spacing */
    .form-row {
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
    }
    .form-row > .form-group {
      flex: 1 1 0;
      min-width: 320px;
    }

    /* Adjustments for smaller screens */
    @media (max-width: 992px) {
      .card {
        padding: 2.5rem 3rem;
        max-width: 90vw;
      }
      .breadcrumb-custom {
        max-width: 90vw;
      }
      h2.fw-bold {
        max-width: 90vw;
        margin-top: 3rem;
        margin-bottom: 2.5rem;
        font-size: 2rem;
      }
    }
    @media (max-width: 576px) {
      .card {
        padding: 2rem 1.5rem;
        max-width: 100vw;
        border-radius: 1rem;
      }
      .breadcrumb-custom {
        max-width: 100vw;
        margin-bottom: 1.5rem;
      }
      h2.fw-bold {
        max-width: 100vw;
        margin-top: 2rem;
        margin-bottom: 2rem;
        font-size: 1.75rem;
      }
      .form-row {
        flex-direction: column;
      }
      .form-row > .form-group {
        min-width: 100%;
      }
      .btn-primary {
        width: 100%;
        padding: 0.85rem 0;
        font-size: 1.3rem;
      }
      .d-flex.justify-content-end {
        justify-content: center !important;
      }
    }
  </style>
  @endpush

@section('content')
<div class="container-fluid px-4"> {{-- Tambahkan pembungkus --}}
  <!-- Breadcrumb -->
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
  <h7 class="text-secondary small">
    <a href="{{ route('dashboard') }}" class="text-primary text-decoration-none">Dashboard</a> /
    <span class="text-dark">Profile Information</span>
  </h7>
</div>
  <!-- Judul Halaman -->
  <h2 class="fw-bold">Edit Company Profile</h2>

  <!-- Form Edit Kontak -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <form action="{{ route('kontak.update', $kontak->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <!-- Row 1: Alamat & Nomor Telepon -->
        <div class="form-row mb-4">
          <div class="form-group">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ $kontak->address }}" required placeholder="Masukkan alamat lengkap" />
          </div>
          <div class="form-group">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $kontak->phone }}" required placeholder="Contoh: +62 812 3456 7890" />
          </div>
        </div>

        <!-- Email full width -->
        <div class="mb-4">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ $kontak->email }}" required placeholder="contoh@email.com" />
        </div>

        <!-- Google Maps Embed full width -->
        <div class="mb-4">
          <label for="maps_embed" class="form-label">Google Maps Embed HTML (iframe)</label>
          <textarea id="maps_embed" name="maps_embed" class="form-control" rows="5" placeholder="Masukkan kode iframe Google Maps">{{ $kontak->maps_embed }}</textarea>
        </div>

        <!-- Row 2: Facebook & Instagram -->
        <div class="form-row mb-4">
          <div class="form-group">
            <label for="facebook_url" class="form-label">Facebook URL</label>
            <input type="url" id="facebook_url" name="facebook_url" class="form-control" value="{{ $kontak->facebook_url }}" placeholder="https://facebook.com/username" />
          </div>
          <div class="form-group">
            <label for="instagram_url" class="form-label">Instagram URL</label>
            <input type="url" id="instagram_url" name="instagram_url" class="form-control" value="{{ $kontak->instagram_url }}" placeholder="https://instagram.com/username" />
          </div>
        </div>

        <!-- Row 3: LinkedIn & X (Twitter) -->
        <div class="form-row mb-4">
          <div class="form-group">
            <label for="linkedin_url" class="form-label">LinkedIn URL</label>
            <input type="url" id="linkedin_url" name="linkedin_url" class="form-control" value="{{ $kontak->linkedin_url }}" placeholder="https://linkedin.com/in/username" />
          </div>
          <div class="form-group">
            <label for="x_url" class="form-label">X (Twitter) URL</label>
            <input type="url" id="x_url" name="x_url" class="form-control" value="{{ $kontak->x_url }}" placeholder="https://twitter.com/username" />
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary px-5">Simpan</button>
        </div>
      </form>
  </div>
</div>
</div>
@endsection
