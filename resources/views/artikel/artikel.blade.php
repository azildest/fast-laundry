@extends('layouts.admin')

@push('styles')
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/admintable.css') }}"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Optional: DataTables Bootstrap Integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    {{-- Buttons for DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
    color: rgb(255, 255, 255) !important; 
}

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
    <span class="text-dark">Artikel</span>
  </h7>
</div>



<!-- Toolbar Atas -->
<div class="row align-items-center mb-2">
  <div class="col">
    <button type="button" id="addArtikelBtn" class="btn "  style="background: #26a37e; color: white; padding: 5px 10px; font-size: 14px;">
      <i class="fas fa-plus me-1"></i> Add Artikel
    </button>
  </div>
</div>

<!-- Toolbar Bawah: Length, Colvis, Search -->
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

<!-- Table Artikel -->
<div style="overflow-x: auto; width: 100%;">
<table id="tabelArtikel" class="display nowrap" style="width:100%">
  <thead class="table-light text-center">
    <tr>
      <th style="width: 5%;">No</th>
      <th style="width: 35%;">Judul</th>
      <th style="width: 15%;">Kategori</th>
      <th style="width: 20%;">Tanggal Terbit</th>
      <th style="width: 10%;">Status</th>
      <th style="width: 15%;">Action</th>
    </tr>
  </thead>
  <tbody id="artikelTable">
    @forelse($artikels as $index => $artikel)
    <tr>
      <td class="text-center">{{ $index + 1 }}</td>
      <td>{{ $artikel->judul }}</td>
      <td class="text-center">{{ $artikel->kategori }}</td>
      <td class="text-center">{{ \Carbon\Carbon::parse($artikel->tanggal_terbit)->format('d M Y') }}</td>
      <td class="text-center">
        @if($artikel->status === 'publish')
          <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Publish</span>
        @elseif($artikel->status === 'draft')
          <span class="badge bg-warning text-dark"><i class="fas fa-pencil-alt me-1"></i>Draft</span>
        @else
          <span class="badge bg-danger"><i class="fas fa-ban me-1"></i>Diblokir</span>
        @endif
      </td>
      <td class="text-center">
        <div class="d-flex justify-content-center gap-2">

    <!-- Tombol Edit -->
    <button type="button"
        class="btn btn-warning btn-sm d-flex align-items-center justify-content-center editBtn"
        data-id="{{ $artikel->id_artikel }}"
        data-judul="{{ $artikel->judul }}"
        data-kategori="{{ $artikel->kategori }}"
        data-isi="{{ htmlspecialchars($artikel->isi) }}"
        data-gambar="{{ $artikel->gambar }}"
         data-is_highlight="{{ $artikel->is_highlight }}"
        title="Edit Artikel"
        style="width: 34px; height: 34px; padding: 0;">
  <i class="fas fa-pencil-alt text-dark"></i>
</button>

    <!-- Tombol Hapus -->
    <button type="button"
            class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
            title="Hapus Artikel"
            style="width: 34px; height: 34px; padding: 0;"
            data-bs-toggle="modal"
            data-bs-target="#deleteConfirmationModal"
            data-url="{{ route('artikel.destroy', $artikel->id_artikel) }}">
      <i class="fas fa-trash-alt text-white"></i>
    </button>
  </div>
</td>
    </tr>
    @empty
    <tr>
      <td colspan="6" class="text-center text-muted">Belum ada artikel</td>
    </tr>
    @endforelse
  </tbody>
  </table>
  </div>
  {{-- Pop-up Delete Confirmation for Artikel --}}
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header bg-danger text-white border-bottom-0 rounded-top-3">
                <h5 class="modal-title d-flex align-items-center" id="deleteConfirmationModalLabel">
                    <i class="fas fa-trash-alt me-2 fa-lg"></i> Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <i class="fas fa-exclamation-circle text-danger mb-3" style="font-size: 3rem;"></i>
                <p class="lead">Are you sure you want to delete this article?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center border-top-0 pt-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal Tambah/Edit Artikel -->
<div class="modal fade" id="artikelModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="artikelForm" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" id="formMethod" value="POST">
      <input type="hidden" name="id" id="artikelId">
      <div class="modal-content">
        <div class="modal-header bg-black text-white">
        <h6 class="modal-title" id="modalTitle">
          <i class="fas fa-newspaper me-2">Tambah</i> Tambah Artikel
        </h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        
        <div class="modal-body">
          <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="judul" class="form-label fw-bold">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
              </div>

              <div class="mb-3">
                <label for="kategori" class="form-label fw-bold">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                  <option selected disabled>Pilih kategori</option>
                  <option value="Bisnis">Bisnis</option>
                  <option value="Teknologi">Teknologi</option>
                  <option value="Gaya Hidup">Gaya Hidup</option>
                </select>
              </div>  
             
              <!-- checkbox  -->
              <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="is_highlight" id="is_highlight"
                 data-artikel_id=""> 
                 {{-- {{ $highlightExists ? 'disabled' : '' }} --}}
                <label class="form-check-label" for="is_highlight">
                  Jadikan sebagai artikel highlight
                </label>
                <small class="text-danger d-block" id="highlightNotice" style="display: {{ $highlightExists ? 'block' : 'none' }}">
                  Hanya satu artikel yang dapat dijadikan highlight. Hapus artikel highlight yang sudah ada untuk mengaktifkan opsi ini.
                </small>
              </div>

              <div class="mb-3">
                <label for="isi" class="form-label fw-bold">Isi Artikel</label>
                <textarea class="form-control" id="isi" name="isi"  rows="12" style="min-height: 300px;"placeholder="Masukkan isi artikel"></textarea>
              </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="gambar" class="form-label fw-bold">Upload Gambar</label>
                <div class="border p-3 text-center rounded bg-light" style="border: 2px dashed #ccc;">
                  <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-secondary"></i>
                  <p class="text-muted">Pilih file atau drag & drop<br><small>Format: png, jpg, pdf, docx</small></p>
                  <input type="file" name="gambar" id="gambar" class="form-control mt-2" accept=".png,.jpg,.jpeg,.pdf,.docx" required>
                </div>
              </div>

              <div class="mb-3" id="previewGambarContainer" style="display: none;">
                <label class="form-label fw-bold">Gambar Saat Ini</label>
                <div>
                  <img id="previewGambar" src="" class="img-fluid rounded" alt="Gambar artikel">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    {{-- Buttons for DataTables --}}
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
 
   
  @if(session('success'))
    toastr.success(" {{ session('success') }}");
  @endif
  @if(session('danger'))
    toastr.danger(" {{ session('danger') }}");
  @endif
  @if(session('error'))
    toastr.error(" {{ session('error') }}");
  @endif

</script>

<!-- Script Modal & Search -->
<script>
 document.addEventListener('DOMContentLoaded', function () {
    const artikelModal = new bootstrap.Modal(document.getElementById('artikelModal'));
    const form = document.getElementById('artikelForm');
    const title = document.getElementById('modalTitle');
    const method = document.getElementById('formMethod');
    const idField = document.getElementById('artikelId');

  const previewGambarContainer = document.getElementById('previewGambarContainer');
  const previewGambar = document.getElementById('previewGambar');
  const deleteModal = document.getElementById('deleteConfirmationModal');
  const deleteForm = document.getElementById('deleteForm');
  const isHighlightCheckbox = document.getElementById('is_highlight');
  const highlightNotice = document.getElementById('highlightNotice');
  const highlightExists = {{ $highlightExists ? 'true' : 'false' }};

    deleteModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const url = button.getAttribute('data-url');
      deleteForm.setAttribute('action', url);
    });


  document.getElementById('addArtikelBtn').addEventListener('click', () => {
    form.action = "{{ route('artikel.store') }}";
    method.value = 'POST';
    title.innerText = 'Tambah Artikel';
    idField.value = '';
      document.getElementById('judul').value = '';
      document.getElementById('kategori').value = '';
      document.getElementById('isi').value = '';
      //document.getElementById('is_highlight').checked = false;
      document.getElementById('gambar').value = '';
      document.getElementById('previewGambarContainer').style.display = 'none';
       document.getElementById('gambar').setAttribute('required', 'required'); 
  
   isHighlightCheckbox.checked = false;
  isHighlightCheckbox.disabled = highlightExists;
  isHighlightCheckbox.setAttribute('data-artikel_id', ''); // reset id juga
  highlightNotice.style.display = highlightExists ? 'block' : 'none';

  artikelModal.show();

  });

  document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.dataset.id;
      const judul = button.dataset.judul;
      const kategori = button.dataset.kategori;
      const isi = button.dataset.isi;
      const gambar = button.dataset.gambar;
      const isHighlight = button.dataset.is_highlight === '1';

      form.action = `/admin/artikel/${id}`;
      method.value = 'PUT';
      title.innerText = 'Edit Artikel';
      idField.value = id;
      document.getElementById('judul').value = judul;
      document.getElementById('kategori').value = kategori;
      document.getElementById('isi').value = isi;

      if (gambar) {
        previewGambarContainer.style.display = 'block';
       previewGambar.src = gambar ? `/storage/${gambar}` : '';
         document.getElementById('gambar').removeAttribute('required'); // TIDAK WAJIB saat edit
      } else {
        previewGambarContainer.style.display = 'none';
       previewGambar.src = gambar ? `/storage/${gambar}` : '';
         document.getElementById('gambar').setAttribute('required', 'required'); // WAJIB kalau kosong
      }

    // Set data id agar bisa dipakai kalau diperlukan
isHighlightCheckbox.setAttribute('data-artikel_id', id);

// Logika penanganan checkbox highlight saat edit
if (isHighlight) {
    // Jika artikel ini memang sedang jadi highlight
    isHighlightCheckbox.checked = true;
    isHighlightCheckbox.disabled = false;
    highlightNotice.style.display = 'none';
} else if (highlightExists) {
    // Jika artikel ini bukan highlight, tapi highlight sudah ada
    isHighlightCheckbox.checked = false;
    isHighlightCheckbox.disabled = true;
    highlightNotice.style.display = 'block';
} else {
    // Tidak ada highlight sama sekali, checkbox bebas dicentang
    isHighlightCheckbox.checked = false;
    isHighlightCheckbox.disabled = false;
    highlightNotice.style.display = 'none';
}

      artikelModal.show();

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
       responsive: true,
    dom: '<"top"l>rt<"bottom"ip><"clear">',
    lengthMenu: [10, 25, 50,100],
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
});


</script>
@endpush
@endsection
