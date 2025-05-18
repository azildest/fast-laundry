@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
  <h7 class="text-secondary small">Dashboard / <a href="#" class="text-primary">Frequently Asked Questions</a></h7>
</div>

<!-- Toolbar -->
<div class="d-flex justify-content-between align-items-center mb-3">
  <button type="button" id="addFaqBtn" class="btn btn-primary btn-sm">
    <i class="fas fa-plus me-1"></i> FAQ
  </button>
  <input type="text" id="searchInput" placeholder="Search..." class="form-control form-control-sm w-auto">
</div>

<!-- Table FAQ -->
<table class="table table-bordered table-sm">
  <thead class="table-secondary">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Pertanyaan</th>
      <th scope="col">Jawaban</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody id="faqTable">
    @foreach($faqs as $index => $faq)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $faq->pertanyaan }}</td>
      <td>{{ $faq->jawaban }}</td>
      <td>{{ \Carbon\Carbon::parse($faq->created_at)->format('d M') }}</td>
      <td>
        @if($faq->status === 'approved')
          <span class="badge bg-success">Approved</span>
        @elseif($faq->status === 'in_progress')
          <span class="badge bg-warning text-dark">In Progress</span>
        @else
          <span class="badge bg-danger">Blocked</span>
        @endif
      </td>
      <td class="d-flex gap-2">
        <button class="btn btn-sm btn-outline-primary editBtn" 
                data-id="{{ $faq->id_pertanyaan }}"
                data-pertanyaan="{{ $faq->pertanyaan }}"
                data-jawaban="{{ $faq->jawaban }}">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <form action="{{ route('faq.destroy', $faq->id_pertanyaan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<!-- Modal FAQ -->
<div class="modal fade" id="faqModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Tambah FAQ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="faqForm">
        @csrf
        <input type="hidden" name="_method" id="formMethod" value="POST">
        <input type="hidden" name="id" id="faqId">
        <div class="modal-body">
          <div class="mb-3">
            <label for="pertanyaan" class="form-label">Pertanyaan</label>
            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" required>
          </div>
          <div class="mb-3">
            <label for="jawaban" class="form-label">Jawaban</label>
            <textarea class="form-control" id="jawaban" name="jawaban" rows="3" required></textarea>
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

<!-- Script FAQ -->
<script>
  const modal = new bootstrap.Modal(document.getElementById('faqModal'));
  const form = document.getElementById('faqForm');
  const title = document.getElementById('modalTitle');
  const method = document.getElementById('formMethod');
  const idField = document.getElementById('faqId');

  document.getElementById('addFaqBtn').addEventListener('click', () => {
    form.action = "{{ route('faq.store') }}";
    method.value = 'POST';
    title.innerText = 'Tambah FAQ';
    idField.value = '';
    document.getElementById('pertanyaan').value = '';
    document.getElementById('jawaban').value = '';
    modal.show();
  });

  document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', () => {
      const id = button.dataset.id;
      const pertanyaan = button.dataset.pertanyaan;
      const jawaban = button.dataset.jawaban;
      form.action = `/faq/${id}`;
      method.value = 'PUT';
      title.innerText = 'Edit FAQ';
      idField.value = id;
      document.getElementById('pertanyaan').value = pertanyaan;
      document.getElementById('jawaban').value = jawaban;
      modal.show();
    });
  });

  document.getElementById('searchInput').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    document.querySelectorAll('#faqTable tr').forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(searchValue) ? '' : 'none';
    });
  });
</script>
@endsection