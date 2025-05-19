@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<div class="p-2 rounded mb-3 bg-light">
  <small class="text-secondary">Dashboard / <span class="text-primary">Artikel</span></small>
</div>

<!-- Toolbar -->
<div class="d-flex justify-content-between align-items-center mb-3">
  <button type="button" id="addArtikelBtn" class="btn btn-primary btn-sm">
    <i class="fas fa-plus me-1"></i> Tambah Artikel
  </button>
  <input type="text" id="searchInput" placeholder="Cari artikel..." class="form-control form-control-sm w-auto">
</div>

<!-- Table Artikel -->
<table class="table table-bordered table-hover table-sm align-middle">
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
                data-kategori="{{ $artikel->kategori }}">
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
            <textarea class="form-control" id="isi" name="isi" rows="4" placeholder="Masukkan isi artikel"></textarea>
          </div>

          <div class="mb-3">
            <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
            <textarea class="form-control" id="thumbnail" name="thumbnail" rows="2" placeholder="Masukkan URL thumbnail atau catatan"></textarea>
          </div>

          <div class="mb-3">
            <label for="gambar" class="form-label fw-bold">Upload Gambar</label>
            <div class="border p-3 text-center rounded bg-light" style="border: 2px dashed #ccc;">
              <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-secondary"></i>
              <p class="text-muted">Pilih file atau drag & drop<br><small>Format: png, jpg, pdf, docx</small></p>
              <input type="file" name="gambar" id="gambar" class="form-control mt-2" accept=".png,.jpg,.jpeg,.pdf,.docx">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script Modal & Search -->
<script>
  const modal = new bootstrap.Modal(document.getElementById('artikelModal'));
  const form = document.getElementById('artikelForm');
  const title = document.getElementById('modalTitle');
  const method = document.getElementById('formMethod');
  const idField = document.getElementById('artikelId');

  document.getElementById('addArtikelBtn').addEventListener('click', () => {
    form.action = "{{ route('artikel.store') }}";
    method.value = 'POST';
    title.innerText = 'Tambah Artikel';
    idField.value = '';
    form.reset();
    modal.show();
  });



  document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.dataset.id;
      const judul = button.dataset.judul;
      const kategori = button.dataset.kategori;

      form.action = `/admin/artikel/${id}`;
      method.value = 'PUT';
      title.innerText = 'Edit Artikel';
      idField.value = id;
      document.getElementById('judul').value = judul;
      document.getElementById('kategori').value = kategori;
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
</script>
@endsection
