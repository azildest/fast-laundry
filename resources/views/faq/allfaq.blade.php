@extends('layouts.admin')


@section('content')

<!-- Breadcrumb -->
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
  <h7 class="text-secondary small">
    <a href="{{ route('dashboard') }}" class="text-primary text-decoration-none">Dashboard</a> /
    <span class="text-dark">Frequently Asked Questions</span>
  </h7>
</div>

<!-- Toolbar -->
<div class="d-flex justify-content-between align-items-center mb-3">
  <button type="button" id="addFaqBtn" class="btn btn-sm"  style="background: #26a37e; color: white; padding: 5px 10px; font-size: 14px;">
    <i class="fas fa-plus me-1" ></i> Add FAQ
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
      <th scope="col">Action</th>
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
    <td>
  <div class="d-flex gap-2">
    <!-- Tombol Edit -->
   <button type="button"
        class="btn btn-warning btn-sm d-flex align-items-center justify-content-center"
        data-id="{{ $faq->id_pertanyaan }}"
        data-pertanyaan="{{ $faq->pertanyaan }}"
        data-jawaban="{{ $faq->jawaban }}"
        title="Edit FAQ"
        style="width: 34px; height: 34px; padding: 0;"
        onclick="editFaq(this)">
      <i class="fas fa-pencil-alt text-dark"></i>
    </button>

    <!-- Tombol Hapus -->
    <button type="button"
            class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
            title="Hapus FAQ"
            style="width: 34px; height: 34px; padding: 0;"
            data-bs-toggle="modal"
            data-bs-target="#deleteConfirmationModal"
          data-url="{{ route('faq.destroy', $faq->id_pertanyaan) }}"
>
      <i class="fas fa-trash-alt text-white"></i>
    </button>
  </div>
</td>
    </tr>
    @endforeach
  </tbody>
</table>

<!-- Modal FAQ -->
<div class="modal fade" id="faqModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header bg-dark text-white">
  <h5 class="modal-title" id="modalTitle" >Tambah FAQ</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

<script>

  document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteConfirmationModal');
    if (deleteModal) {
      deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        const form = deleteModal.querySelector('#deleteForm');
        if (form) {
          form.setAttribute('action', url);
        }
      });
    }

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

    document.getElementById('searchInput').addEventListener('input', function () {
      const searchValue = this.value.toLowerCase();
      document.querySelectorAll('#faqTable tr').forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
      });
    });

    window.editFaq = function (button) {
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
    }
  });
  
</script>

{{-- Pop-up Delete Confirmation --}}
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
                <p class="lead">Are you sure you want to delete this record?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center border-top-0 pt-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
              <form id="deleteForm" method="POST" action="{{ route('faq.destroy', ['faq' => 1]) }}">
                  @csrf
                  @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
              </form>


            </div>
        </div>
    </div>
</div>
@endpush
@endsection