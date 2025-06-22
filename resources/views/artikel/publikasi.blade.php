@extends('layouts.admin')

@push('styles')
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}"> --}}

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Optional: DataTables Bootstrap Integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    {{-- Buttons for DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
<style>
  #dataTableLengthContainer label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0;
  }

  #dataTableLengthContainer label select {
    margin: 0;
  }
  .buttons-colvis::before {
    content: '';
}

.buttons-colvis {
    color: rgb(255, 255, 255) !important; /* Ubah sesuai tema, misal 'white' jika dark */
}
/* Reset efek shadow atau gradien */
.dataTables_wrapper .dataTables_paginate .paginate_button {
  background: transparent !important;
  box-shadow: none !important;
  border: 1px solid #dee2e6;
  color: #0d6efd;
  padding: 0.375rem 0.75rem;
  margin-left: 4px;
  border-radius: 0.375rem;
}

/* Hover */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background-color: #0b5ed7 !important;
  color: white !important;
  border-color: #0b5ed7 !important;
}

/* Aktif */
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
  background-color: #0d6efd !important;
  color: white !important;
  border-color: #0d6efd !important;
}

/* Disabled */
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
  opacity: 0.5;
  pointer-events: none;
}
.modal-header {
  background-color: #000; /* Warna hitam */
}

.modal-header .modal-title {
  color: #fff; /* Warna teks putih */
}


</style>

    @endpush

@section('content')

<!-- Breadcrumb -->
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
  <h7 class="text-secondary small">
    <a href="{{ route('dashboard') }}" class="text-primary text-decoration-none">Dashboard</a> /
    <span class="text-dark">Publikasi Artikel</span>
  </h7>
</div>

<div class="row mb-3">
  <div class="col-md-12">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div class="d-flex align-items-center gap-2 flex-wrap">
        <div id="dataTableLengthContainer" class="d-flex align-items-center"></div>
        <div id="customColVisContainer" class="d-flex align-items-center"></div>
      </div>
      <div>
        <input type="text" id="searchInput" placeholder="Cari artikel..." class="form-control form-control-sm" style="min-width: 200px;">
      </div>
    </div>
  </div>
</div>

<div class="table-responsive">
 <table id="tabelArtikel" class="display nowrap" style="width:100%">
    <thead class="table-secondary">
      <tr>
        <th style="width: 40px;">No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th style="width: 120px;">Action</th>
      </tr>
    </thead>
    <tbody id="artikelTable">
      @foreach($artikels as $index => $artikel)
      <tr>
        <td><strong>{{ $index + 1 }}</strong></td>
        <td>{{ $artikel->judul }}</td>
        <td>{{ $artikel->kategori }}</td>
        <td>{{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('d/m/Y') }}</td>

        <td>
          @if($artikel->status === 'approve')
            <span class="badge bg-success">Approved</span>
          @elseif($artikel->status === 'draft')
            <span class="badge bg-warning text-dark">Draft</span>
          @elseif($artikel->status === 'blocked')
            <span class="badge bg-danger">Blocked</span>
          @else
            <span class="badge bg-secondary">{{ ucfirst($artikel->status) }}</span>
          @endif
        </td>
       <td class="text-center">
  <button 
    class="btn btn-sm btn-info preview-btn" 
    data-judul="{{ $artikel->judul }}"
    data-kategori="{{ $artikel->kategori }}"
    data-isi="{{ $artikel->isi }}"
   data-gambar="{{ $artikel->gambar ? asset('storage/' . $artikel->gambar) : '' }}"
    data-id="{{ $artikel->id_artikel }}"
    data-tanggal="{{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('d/m/Y') }}"
    data-highlight="{{ $artikel->is_highlight ? 'Ya' : 'Tidak' }}"
    >
    <i class="bi bi-eye"></i>
  </button>
</td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal Preview Artikel -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="previewModalLabel">Preview Artikel</h5>
         <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
     <div class="modal-body">
  <div class="row">
    <!-- Kolom Kiri -->
    <div class="col-md-6">
      <div class="mb-3">
        <label class="form-label fw-bold">Judul Artikel</label>
        <input type="text" id="previewJudul" class="form-control" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Kategori</label>
        <input type="text" id="previewKategori" class="form-control" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Highlight</label>
        <input type="text" id="previewHighlight" class="form-control" readonly>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Isi Artikel</label>
        <textarea id="previewIsi" class="form-control" rows="8" readonly></textarea>
      </div>
    </div>

    <!-- Kolom Kanan -->
    <div class="col-md-6">
      <label class="form-label fw-bold">Gambar Artikel</label>
      <div id="previewGambarContainer" class="border rounded p-2">
        <img id="previewGambar" src="" alt="Gambar Artikel" class="img-fluid rounded w-100">
      </div>
      </div>
    </div>
    <div class="modal-footer">
  <form id="approveForm" method="POST" class="d-inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success">Approve</button>
  </form>

  <form id="blockForm" method="POST" class="d-inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-danger">Blocked</button>
  </form>

  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</div>

  </div>
</div>


@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    {{-- Buttons for DataTables --}}
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>


<script>
  document.getElementById('searchInput').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#artikelTable tr');
    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(searchValue) ? '' : 'none';
    });
  });
 const approveForm = document.getElementById('approveForm');
const blockForm = document.getElementById('blockForm');
const previewGambarContainer = document.getElementById('previewGambarContainer');
const previewGambar = document.getElementById('previewGambar');

document.querySelectorAll('.preview-btn').forEach(button => {
  button.addEventListener('click', () => {
    document.getElementById('previewJudul').value = button.dataset.judul;
    document.getElementById('previewKategori').value = button.dataset.kategori;
    document.getElementById('previewIsi').value = button.dataset.isi;
     document.getElementById('previewHighlight').value = button.dataset.highlight;


    const gambarUrl = button.dataset.gambar;
    if (gambarUrl) {
      previewGambar.src = gambarUrl;
      previewGambarContainer.style.display = 'block';
      
    } else {
      previewGambarContainer.style.display = 'none';
      previewGambar.src = '';
    }

    approveForm.action = `/admin/artikel/${button.dataset.id}/approve`;
    blockForm.action = `/admin/artikel/${button.dataset.id}/block`;

    new bootstrap.Modal(document.getElementById('previewModal')).show();
  });
});


 document.getElementById('searchInput').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    document.querySelectorAll('#artikelTable tr').forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(searchValue) ? '' : 'none';
    });
  });


$(document).ready(function () {
    const table = $('#tabelArtikel').DataTable({
    dom: '<"top"l>rt<"bottom"ip><"clear">',
    lengthMenu: [10, 25,50,100],
    initComplete: function () {
        $('#dataTableLengthContainer').html($('#tabelArtikel_length'));
        $('#customColVisContainer').html($('.dt-buttons')); // colVis button
    },
        buttons: [
            {
                extend: 'colvis',
                text: 'Show Colums',
                className: 'btn btn-outline-secondary btn-sm'
            }
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Show _MENU_ rows",
            zeroRecords: "Data tidak ditemukan",
            info: "Shown _START_ to _END_ from _TOTAL_ data",
            infoEmpty: "Show 0 to 0 from 0 data",
            paginate: {
                previous: "Previous",
                next: "Next"
            }
        },
        initComplete: function () {
            // Pindah elemen default ke container custom
            $('#dataTableLengthContainer').html($('#tabelArtikel_length'));
            this.api().buttons().container().appendTo('#customColVisContainer');
        }
    });
});



</script>
@endpush
@endsection
