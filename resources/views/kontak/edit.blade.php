@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            width: 100%;
            margin-bottom: 1.5rem;
            padding: 0.75rem 1.25rem;
            font-size: 0.9rem;
            color: #555;
            background-color: #e9ecef; 
            border-radius: 0.25rem;
        }

        .breadcrumb-custom a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        h2.fw-bold {
            max-width: 960px; 
            margin: 2rem auto 1.5rem auto;
            font-weight: 700; 
            font-size: 2rem;
            text-align: center;
            color: #343a40; 
            text-shadow: none;
        }

        .content-container {
            max-width: 960px; 
            margin: 0 auto 3rem auto; 
            background-color: #fff; 
            padding: 2.5rem;
            border-radius: 0.5rem; 
            border: 1px solid #dee2e6; 
        }

        label.form-label {
            font-weight: 600;
            color: #495057;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        input.form-control,
        textarea.form-control {
            border-radius: 0.5rem; 
            border: 1px solid #ced4da; 
            padding: 0.75rem 1rem;
            font-size: 1rem;
            box-shadow: none; 
            background-color: #fff;
            color: #495057;
            font-weight: 400;
        }

        input.form-control::placeholder,
        textarea.form-control::placeholder {
            color: #6c757d;
            font-style: italic;
        }

        input.form-control:focus,
        textarea.form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            outline: none;
            background-color: #fff;
            font-weight: 400; 
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .btn-primary {
            background: #007bff; 
            border: 1px solid #007bff;
            border-radius: 0.5rem;
            padding: 0.5rem 1.5rem;
            font-weight: 600; 
            font-size: 1rem;
            color: #fff;
            box-shadow: none; 
            transition: background-color 0.2s ease, border-color 0.2s ease;
            user-select: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
            box-shadow: none;
            transform: none; 
            color: #fff;
        }

        .btn-primary:active {
            transform: none;
            box-shadow: none;
        }

        .form-row {
            display: flex;
            gap: 1.5rem; 
            flex-wrap: wrap;
        }

        .form-row > .form-group {
            flex: 1 1 0;
            min-width: 300px; 
        }

        @media (max-width: 992px) {
            .content-container {
                padding: 2rem;
                max-width: 90vw;
            }
            .breadcrumb-custom {
                max-width: 90vw;
            }
            h2.fw-bold {
                max-width: 90vw;
                font-size: 1.8rem;
            }
        }
        @media (max-width: 576px) {
            .content-container {
                padding: 1.5rem;
                max-width: 100vw;
                border-radius: 0; 
                border-left: none;
                border-right: none;
            }
            .breadcrumb-custom {
                max-width: 100vw;
                margin-bottom: 1rem;
                border-radius: 0;
            }
            h2.fw-bold {
                max-width: 100vw;
                margin-top: 1.5rem;
                margin-bottom: 1.5rem;
                font-size: 1.5rem;
            }
            .form-row {
                flex-direction: column;
            }
            .form-row > .form-group {
                min-width: 100%;
            }
            .btn-primary {
                width: 100%;
                padding: 0.75rem 0;
                font-size: 1.1rem;
            }
            .d-flex.justify-content-end {
                justify-content: center !important;
            }
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <nav class="breadcrumb-custom" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Company Profile</li>
        </ol>
    </nav>

    <h2 class="fw-bold">Edit Company Profile</h2>

    <div class="content-container">
        <form action="{{ route('kontak.update', $kontak->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="form-row mb-3">
                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ $kontak->address }}" required placeholder="Enter full address" />
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $kontak->phone }}" required placeholder="Example: +62 812 3456 7890" />
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $kontak->email }}" required placeholder="example@email.com" />
            </div>

            <div class="mb-4">
                <label for="maps_embed" class="form-label">Google Maps Embed HTML (iframe)</label>
                <textarea id="maps_embed" name="maps_embed" class="form-control" rows="4" placeholder="Paste Google Maps iframe code here">{{ $kontak->maps_embed }}</textarea>
            </div>

            <div class="form-row mb-3">
                <div class="form-group">
                    <label for="facebook_url" class="form-label">Facebook URL</label>
                    <input type="url" id="facebook_url" name="facebook_url" class="form-control" value="{{ $kontak->facebook_url }}" placeholder="https://facebook.com/username" />
                </div>
                <div class="form-group">
                    <label for="instagram_url" class="form-label">Instagram URL</label>
                    <input type="url" id="instagram_url" name="instagram_url" class="form-control" value="{{ $kontak->instagram_url }}" placeholder="https://instagram.com/username" />
                </div>
            </div>

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
                <button type="submit" class="btn btn-primary px-5">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection