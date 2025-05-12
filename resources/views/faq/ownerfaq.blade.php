@extends('layouts.admin')

@section('content')
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
  <h7 class="text-secondary small"> Dashboard / <a href="#" class="text-primary">Publikasi FAQ</a></h7>
</div>

<div class="row mb-3">
  <div class="col-md-12 text-end">
    <input type="text" id="searchInput" placeholder="Search..." class="form-control form-control-sm w-auto d-inline-block">
  </div>
</div>

<div class="table-responsive">
  <table class="table table-bordered table-sm table-striped">
    <thead class="table-secondary">
      <tr>
        <th style="width: 40px;">No</th>
        <th>Pertanyaan</th>
        <th>Jawaban</th>
        <th style="width: 100px;">Status</th>
        <th style="width: 120px;">Aksi</th>
      </tr>
    </thead>
    <tbody id="faqTable">
      @foreach($faqs as $index => $faq)
      <tr>
        <td><strong>{{ $index + 1 }}</strong></td>
        <td>{{ $faq->pertanyaan }}</td>
        <td>{{ $faq->jawaban }}</td>
        <td>
          @if($faq->status === 'approved')
            <span class="badge bg-success">Approved</span>
          @elseif($faq->status === 'in_progress')
            <span class="badge bg-warning text-dark">In Progress</span>
          @else
            <span class="badge bg-danger">Blocked</span>
          @endif
        </td>
        <td class="text-center">
          <div class="d-flex justify-content-center gap-2">
            <form method="POST" action="{{ route('faq.status', $faq->id_pertanyaan) }}">
              @csrf
              <input type="hidden" name="status" value="approved">
              <button class="btn btn-sm btn-success" title="Setujui" onclick="return confirm('Setujui FAQ ini?')">
                <i class="bi bi-check-lg"></i>
              </button>
            </form>
            <form method="POST" action="{{ route('faq.status', $faq->id_pertanyaan) }}">
              @csrf
              <input type="hidden" name="status" value="blocked">
              <button class="btn btn-sm btn-danger" title="Tolak" onclick="return confirm('Blokir FAQ ini?')">
                <i class="bi bi-x-lg"></i>
              </button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
  document.getElementById('searchInput').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#faqTable tr');
    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(searchValue) ? '' : 'none';
    });
  });
</script>
@endsection