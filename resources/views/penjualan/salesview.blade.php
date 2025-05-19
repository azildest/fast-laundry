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
@endpush

@section('content')
    {{-- Breadcrumb --}}
    <div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
        <a href="{{ route('dashboard') }}" class="text-primary small text-decoration-none">Dashboard</a>
        <h7 class="text-secondary small">/ Sales Records</h7>
    </div>
    
    {{-- <div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
        <a href="{{ route('sales-records') }}" class="text-primary small text-decoration-none">Sales</a>
    </div> --}}
    {{-- End Breadcrumb --}}

    <div class="container mt-5">
    </div>

    {{-- Add Records Button, Filters, and Reset Button --}}
    <div class="row mb-4">
        <div class="col-md">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <!-- Left: Add Records -->
                <button type="button" class="btn btn-sm" style="background: #26a37e; color: white; padding: 5px 10px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#addRecordsModal">
                    <i class="fas fa-plus"></i> Add Records
                </button>
            
                <!-- Right: Filters and Reset -->
                <div class="d-flex flex-wrap gap-2">
                    <select class="form-select form-select-sm" id="filterLayanan" style="max-width: 150px; font-size: 14px; color: #495057; border: 1px solid #ccc;">
                        <option value="">Semua Layanan</option>
                        <option value="Cuci Kering">Cuci Kering</option>
                        <option value="Cuci Lipat">Cuci Kering dan Lipat</option>
                        <option value="Setrika">Setrika Saja</option>
                        <option value="Setrika">Cuci Kering dan Setrika</option>
                    </select>
                    <select class="form-select form-select-sm" id="filterSelesai" style="max-width: 120px; font-size: 14px; color: #495057; border: 1px solid #ccc;">
                        <option value="">All Status</option>
                        <option value="belum selesai">Belum Selesai</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <button class="btn btn-outline-secondary btn-sm" id="resetButton" style="padding: 5px 10px; font-size: 14px; border: 1px solid #ccc;">
                    <i class="fas fa-sync-alt me-2"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table id="salesTable" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pesanan Dibuat</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Total Harga</th>
                        <th>Nama Customer</th>
                        <th>WhatsApp</th>
                        <th>Status</th>                        
                        <th>Pesanan Selesai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        {{-- Modal for ADD RECORDS --}}
        <div class="modal fade" id="addRecordsModal" tabindex="-1" aria-labelledby="addSalesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-black text-white">
                        <h6 class="modal-title" id="addSalesModalLabel"><i class="fas fa-plus me-2"></i> Add New Record</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('sales.add') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="created_at" class="col-sm-4 col-form-label fw-bold">Tanggal Pesanan:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="created_at" name="created_at" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="layanan" class="col-sm-4 col-form-label fw-bold">Layanan:</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="layanan" name="id_layanan" required>
                                        <option selected disabled class="text-secondary">-- Pilih Layanan --</option>
                                        @foreach($layananData as $layanan)
                                            <option value="{{ $layanan->id_layanan }}" data-price="{{ $layanan->harga_per_kg }}">
                                                {{ $layanan->nama_layanan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="berat" class="col-sm-4 col-form-label fw-bold">Berat (Kg):</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="berat" name="berat" step="0.1" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="total_harga" class="col-sm-4 col-form-label fw-bold">Total Harga (Rp):</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama_customer" class="col-sm-4 col-form-label fw-bold">Nama Pemesan:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="whatsapp" class="col-sm-4 col-form-label fw-bold">WhatsApp:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="ex. 08xxxxxxxxxx">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="pesanan_selesai" class="col-sm-4 col-form-label fw-bold">Status:</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="status" name="status">
                                        <option value="belum selesai" selected>Belum Selesai</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Records Modal --}}
        <div class="modal fade" id="editRecordsModal" tabindex="-1" aria-labelledby="editSalesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-black text-white">
                        <h6 class="modal-title" id="editSalesModalLabel"><i class="fas fa-edit me-2"></i> Edit Record</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="edit_created_at" class="col-sm-4 col-form-label fw-bold">Tanggal Pesanan:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="edit_pesanan_dibuat" name="created_at" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="edit_layanan" class="col-sm-4 col-form-label fw-bold">Layanan:</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="edit_layanan" name="id_layanan" required>
                                        <option selected disabled class="text-secondary">-- Pilih Layanan --</option>
                                        @foreach($layananData as $layanan)
                                            <option value="{{ $layanan->id_layanan }}" data-price="{{ $layanan->harga_per_kg }}">
                                                {{ $layanan->nama_layanan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="edit_berat" class="col-sm-4 col-form-label fw-bold">Berat (Kg):</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="edit_berat" name="berat" step="0.1" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="edit_total_harga" class="col-sm-4 col-form-label fw-bold">Total Harga (Rp):</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="edit_total_harga" name="total_harga" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="edit_nama_customer" class="col-sm-4 col-form-label fw-bold">Nama Pemesan:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="edit_nama_customer" name="nama_customer" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="edit_whatsapp" class="col-sm-4 col-form-label fw-bold">WhatsApp:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="edit_whatsapp" name="whatsapp" placeholder="ex. 08xxxxxxxxxx">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="edit_status" class="col-sm-4 col-form-label fw-bold">Status:</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="edit_status" name="status">
                                        <option value="belum selesai">Belum Selesai</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

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
        $(document).ready(function () {
            var penjualanTable = $('#salesTable').DataTable({
                // processing: true,
                // serverSide: true,
                ajax: '{{ route('sales.data_penjualan') }}',
                scrollX: true,
                scrollY: 300,
                autoWidth:true,
                // dom: 'Bfrtip',
                dom: 'Blfrtip',
                columns: [
                    // { data: 'id_penjualan', render: function(data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }, name: 'id_penjualan' },
                    { data: 'id_penjualan', name: 'id_penjualan' },
                    { data: 'created_at', name: 'created_at'},
                    { data: 'id_layanan', name: 'id_layanan' },
                    { data: 'berat', name: 'berat' },
                    { data: 'total_harga', name: 'total_harga' },
                    { data: 'nama_customer',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                let limitedText = data.length > 100 ? data.substring(0, 100) + '...' : data;
                                return '<div class="wrapped-description" title="' + data + '">' + limitedText + '</div>';
                            }
                            return data;
                        },
                        name: 'nama_customer'
                    },
                    { data: 'whatsapp', name: 'whatsapp' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'pesanan_selesai', name: 'pesanan_selesai' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                // drawCallback: function(settings) {
                //     setTimeout(function() {
                //         penjualanTable.columns.adjust().draw();
                //     }, 20);
                // },
                "language": {
                    "emptyTable": "No records on this table.",
                    "info": "Shown _START_ to _END_ from _TOTAL_ data",
                    "infoEmpty": "Show 0 to 0 from 0 data",
                    "lengthMenu": "Show _MENU_ rows",
                    "search": "Search:",
                    "zeroRecords": "No matching record found.",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                // "autoWidth": true,
                "buttons": [{
                    extend: 'colvis',
                    text: 'Show Column'
                },
                {
                    text: 'Show All',
                    action: function (e, dt, node, config) {
                        dt.columns().visible(true);
                    }
                }
                ],
            });

            // Custom search
            $('#searchInput').on('keyup', function () {
                penjualanTable.search(this.value).draw();
            });

            // Filter by layanan
            $('#filterLayanan').on('change', function () {
                penjualanTable.column(2).search(this.value).draw();
            });

            // Filter by status
            $('#filterStatus').on('change', function () {
                penjualanTable.column(7).search(this.value).draw();
            });

            // Reset filters
            $('#resetButton').on('click', function () {
                $('#searchInput').val('');
                $('#filterLayanan').val('');
                $('#filterStatus').val('');
                penjualanTable.search('').columns().search('').draw();
            });

            $('#salesTable').on('click', '.edit-btn', function () {
                console.log('Edit button clicked');
                event.preventDefault();
                var id = $(this).data('id');
                var url = '/admin/sales/' + id + '/edit';

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        $('#editForm').attr('action', '/admin/sales/' + id);

                        var createdAtDate = data.created_at.split(' ')[0];
                        $('#edit_created_at').val(createdAtDate);
                        $('#edit_layanan').val(data.id_layanan);
                        $('#edit_berat').val(data.berat);
                        $('#edit_total_harga').val(data.total_harga);
                        $('#edit_nama_customer').val(data.nama_customer);
                        $('#edit_whatsapp').val(data.whatsapp);
                        $('#edit_status').val(data.status);

                        $('#editRecordsModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching data for edit:", error);
                        alert("Failed to load data for editing.");
                    }
                });

                $('#editForm').on('submit', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('action');
                    var formData = $(this).serialize();

                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: formData,
                        success: function (response) {
                            $('#editRecordsModal').modal('hide');
                            alert(response.success); 
                            $('#salesTable').DataTable().ajax.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error("Error updating record:", error);
                            alert("Failed to update record.");
                        }
                    });
                });
            });

            // Handle delete button click
            $('#salesTable').on('click', '.delete-btn', function () {
                console.log('Edit button clicked');
                var id = $(this).data('id');
                var url = '/admin/sales/delete/' + id;

                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'DELETE',
                        },
                        success: function (response) {
                            penjualanTable.ajax.reload();
                            toastr.success(response.success, 'Success');
                        },
                        error: function (xhr, status, error) {
                            console.error("Error deleting record:", error);
                            toastr.error('Failed to delete record.', 'Error');
                        }
                    });
                }
            });

            // Toastr Notification
            @if (session('pesan'))
                @switch(session('level-alert'))
                    @case('alert-success')
                        toastr.success("{{ Session::get('pesan') }}", 'Berhasil');
                        @break
                    @case('alert-warning')
                        toastr.warning("{{ Session::get('pesan') }}", 'Peringatan');
                        @break
                    @case('alert-error')
                        toastr.error("{{ Session::get('pesan') }}", 'Error');
                        @break
                    @default
                        toastr.info("{{ Session::get('pesan') }}", 'Info');
                @endswitch
            @endif
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const layananSelect = document.getElementById('layanan');
            const beratInput = document.getElementById('berat');
            const totalHargaInput = document.getElementById('total_harga');

            function calculateTotal() {
                const selectedOption = layananSelect.options[layananSelect.selectedIndex];
                const hargaPerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const berat = parseFloat(beratInput.value) || 0;

                const total = hargaPerKg * berat;
                totalHargaInput.value = total.toFixed(0);
            }
            
            layananSelect.addEventListener('change', calculateTotal);
            beratInput.addEventListener('input', calculateTotal);

            // Edit Records Modal
            function calculateEditTotal() {
                const selectedOption = editLayananSelect.options[editLayananSelect.selectedIndex];
                const hargaPerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const berat = parseFloat(editBeratInput.value) || 0;

                const total = hargaPerKg * berat;
                editTotalHargaInput.value = total.toFixed(0);
            }

            const editLayananSelect = document.getElementById('edit_layanan');
            const editBeratInput = document.getElementById('edit_berat');
            const editTotalHargaInput = document.getElementById('edit_total_harga');

            if (editLayananSelect && editBeratInput && editTotalHargaInput) {
                editLayananSelect.addEventListener('change', calculateEditTotal);
                editBeratInput.addEventListener('input', calculateEditTotal);
            }
        });
    </script>
@endpush