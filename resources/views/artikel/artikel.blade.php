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

</style>

    @endpush


@section('content')
<!-- Breadcrumb -->
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
  <h7 class="text-secondary small"> Dashboard / <a href="#" class="text-primary">Artikel</a></h7>
</div>

<!-- Toolbar Atas -->
<div class="row align-items-center mb-2">
  <div class="col">
    <button type="button" id="addArtikelBtn" class="btn btn-primary btn-sm">
      <i class="fas fa-plus me-1"></i> Tambah Artikel
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
<table id="tabelArtikel" class="display nowrap" style="width:100%">
  <thead class="table-light text-center">
    <tr>
      <th style="width: 5%;">No</th>
      <th style="width: 35%;">Judul</th>
      <th style="width: 15%;">Kategori</th>
      <th style="width: 20%;">Tanggal Terbit</th>
      <th style="width: 10%;">Status</th>
      <th style="width: 15%;">Aksi</th>
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
        <button class="btn btn-sm btn-outline-primary editBtn"
                data-id="{{ $artikel->id_artikel }}"
                data-judul="{{ $artikel->judul }}"
                data-kategori="{{ $artikel->kategori }}"
                data-isi="{{ htmlspecialchars($artikel->isi) }}"
                data-gambar="{{ $artikel->gambar }}">
          <i class="fas fa-edit"></i>
        </button>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="6" class="text-center text-muted">Belum ada artikel</td>
    </tr>
    @endforelse
  </tbody>
</table>


<!-- Modal Tambah/Edit Artikel -->
<div class="modal fade" id="artikelModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="artikelForm" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" id="formMethod" value="POST">
      <input type="hidden" name="id" id="artikelId">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Tambah Artikel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                  <input type="file" name="gambar" id="gambar" class="form-control mt-2" accept=".png,.jpg,.jpeg,.pdf,.docx">
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    {{-- Buttons for DataTables --}}
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

<!-- Script Modal & Search -->
<script>
  const modal = new bootstrap.Modal(document.getElementById('artikelModal'));
  const form = document.getElementById('artikelForm');
  const title = document.getElementById('modalTitle');
  const method = document.getElementById('formMethod');
  const idField = document.getElementById('artikelId');

  const previewGambarContainer = document.getElementById('previewGambarContainer');
  const previewGambar = document.getElementById('previewGambar');

  document.getElementById('addArtikelBtn').addEventListener('click', () => {
    form.action = "{{ route('artikel.store') }}";
    method.value = 'POST';
    title.innerText = 'Tambah Artikel';
    idField.value = '';
    form.reset();
    previewGambarContainer.style.display = 'none';
    modal.show();
  });

  document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.dataset.id;
      const judul = button.dataset.judul;
      const kategori = button.dataset.kategori;
      const isi = button.dataset.isi;
      const gambar = button.dataset.gambar;

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

      } else {
        previewGambarContainer.style.display = 'none';
       previewGambar.src = gambar ? `/storage/${gambar}` : '';

      }

      modal.show();
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



</script>
@endpush
@endsection
