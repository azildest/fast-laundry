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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                    <select class="form-select form-select-sm" id="filter_layanan" style="max-width: 150px; font-size: 14px; color: #495057; border: 1px solid #ccc;">
                        {{-- <option selected disabled class="text-secondary">Semua Layanan</option> --}}
                        <option value="">Semua Layanan</option>
                        @foreach($layananData as $layanan)
                            <option value="{{ $layanan->id_layanan }}">
                                {{ $layanan->nama_layanan }}
                            </option>
                        @endforeach
                    </select>
                    <select class="form-select form-select-sm" id="filter_status" style="max-width: 120px; font-size: 14px; color: #495057; border: 1px solid #ccc;">
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
                                <label for="pesanan_dibuat" class="col-sm-4 col-form-label fw-bold">Tanggal Pesanan:</label>
                                <div class="col-sm-8">
                                    {{-- <input type="date" class="form-control" id="pesanan_dibuat" name="pesanan_dibuat" required> --}}
                                    <input type="datetime-local" class="form-control" id="pesanan_dibuat" name="pesanan_dibuat" required>
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
                                {{-- <label for="total_harga" class="col-sm-4 col-form-label fw-bold">Total Harga (Rp):</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
                                </div> --}}
                                <label for="total_harga_display" class="col-sm-4 col-form-label fw-bold">Total Harga (Rp):</label>
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="total_harga" name="total_harga">
                                    <span class="form-control-plaintext fw-bold" id="total_harga_display">0</span>
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
                            {{-- @php
                                $pesananDibuat = \Carbon\Carbon::parse($penjualanData->pesanan_dibuat);
                                $pesananSelesai = \Carbon\Carbon::parse($penjualanData->pesanan_selesai);
                            @endphp --}}

                            <div class="mb-3 row">
                                <label for="edit_pesanan_dibuat" class="col-sm-4 col-form-label fw-bold">Tanggal Pesanan:</label>
                                <div class="col-sm-8">
                                    <input type="datetime-local" class="form-control" id="edit_pesanan_dibuat" name="pesanan_dibuat" 
                                        {{-- value="{{ $penjualanData->pesanan_dibuat ? $pesananDibuat->format('Y-m-d\TH:i') : '' }}" --}}
                                        required>
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
                                {{-- <label for="edit_total_harga" class="col-sm-4 col-form-label fw-bold">Total Harga (Rp):</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="edit_total_harga" name="total_harga" readonly>
                                </div> --}}
                                <label for="edit_total_harga_display" class="col-sm-4 col-form-label fw-bold">Total Harga (Rp):</label>
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="edit_total_harga" name="total_harga">
                                    <span class="form-control-plaintext fw-bold" id="edit_total_harga_display">0</span>
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
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteButton">Delete</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- toastr --}}
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
    </script>

    <script>
        function formatNumberForDisplay(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        $(document).ready(function () {
            let penjualanTable = $('#salesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('sales.data_penjualan') }}',
                scrollX: true,
                scrollY: 300,
                autoWidth:true,
                dom: 'Blfrtip',
                 ajax: {
                    url: '{{ route('sales.data_penjualan') }}',
                    data: function(d) {
                        d.filter_tanggal = $('#filter_tanggal').val();
                        d.filter_layanan = $('#filter_layanan').val();
                        d.filter_status = $('#filter_status').val();
                    }
                },
                columns: [
                    { data: 'id_penjualan', render: function(data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }, name: 'id_penjualan' },
                    // { data: 'id_penjualan', name: 'id_penjualan' },
                    { data: 'pesanan_dibuat', name: 'pesanan_dibuat'},
                    { data: 'layanan', name: 'layanan.layanan', orderable: false, searchable: false},
                    { data: 'berat', name: 'berat' },
                    // { data: 'total_harga', name: 'total_harga' },
                    {
                        data: 'total_harga',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    let number = Number(data);
                                    if (isNaN(number)) return data ?? '-';
                                    return number.toLocaleString('id-ID', { minimumFractionDigits: 0 });
                                }
                                return data;
                            },
                            name: 'total_harga'
                        },
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

            // Filter
            $('#filter_layanan, #filter_status').change(function(){
                penjualanTable.ajax.reload();
            });

            // Reset filters
            $('#resetButton').on('click', function () {
                $('#searchInput').val('');
                // $('#filter_layanan').val('');
                // $('#filter_status').val('');
                $('#filter_layanan').val('').trigger('change');
                $('#filter_status').val('').trigger('change');
                penjualanTable.search('').columns().search('').draw();
            });

            $('#salesTable').on('click', '.edit-btn', function () {
                // console.log('Edit button clicked');
                event.preventDefault();
                var id = $(this).data('id');
                var url = '/admin/sales/' + id + '/edit';

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        $('#editForm').attr('action', '/admin/sales/' + id);

                        var createdAtDate = data.pesanan_dibuat.split(' ')[0];
                        let pesananDibuatDatetime = new Date(data.pesanan_dibuat);
                        let formattedPesananDibuat = pesananDibuatDatetime.getFullYear() + '-' +
                            ('0' + (pesananDibuatDatetime.getMonth() + 1)).slice(-2) + '-' +
                            ('0' + pesananDibuatDatetime.getDate()).slice(-2) + 'T' +
                            ('0' + pesananDibuatDatetime.getHours()).slice(-2) + ':' +
                            ('0' + pesananDibuatDatetime.getMinutes()).slice(-2);

                        $('#edit_pesanan_dibuat').val(formattedPesananDibuat);
                        $('#edit_layanan').val(data.id_layanan);
                        $('#edit_berat').val(data.berat);
                        $('#edit_total_harga').val(data.total_harga);
                        $('#edit_total_harga_display').text(formatNumberForDisplay(data.total_harga));
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
                            // alert(response.success); 
                            if (response.success) {
                                toastr.success(response.success);
                            }
                            $('#salesTable').DataTable().ajax.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error("Error updating record:", error);
                            let errorMessage = "Failed to update record.";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMessage = xhr.responseJSON.error;
                            }
                            toastr.error(errorMessage, 'Error'); 
                        }
                    });
                });
            });

            let recordToDeleteId = null;

            // Handle delete button click - SHOW THE MODAL
            $('#salesTable').on('click', '.delete-btn', function (event) {
                event.preventDefault();
                recordToDeleteId = $(this).data('id');
                $('#deleteConfirmationModal').modal('show');
            });

            // Handle confirmation button click inside the modal - PERFORM DELETION
            $('#confirmDeleteButton').on('click', function () {
                if (recordToDeleteId) {
                    var url = '/admin/sales/delete/' + recordToDeleteId;

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            // '_method': 'DELETE',
                        },
                        success: function (response) {
                            $('#deleteConfirmationModal').modal('hide');
                            toastr.success(response.success || 'Record deleted successfully!', 'Success'); // Use a fallback message
                            penjualanTable.ajax.reload();
                            recordToDeleteId = null;
                        },
                        error: function (xhr, status, error) {
                            $('#deleteConfirmationModal').modal('hide'); // Hide the modal
                            console.error("Error deleting record:", error);
                            toastr.error('Failed to delete record.', 'Error'); // Show error toast
                            recordToDeleteId = null; // Reset the ID
                        }
                    });
                }
            });

            // Toastr Notification
            @if(session('success'))
                toastr.success(" {{ session('success') }}");
            @endif
            @if(session('danger'))
                toastr.danger(" {{ session('danger') }}");
            @endif
            @if(session('error'))
                toastr.error(" {{ session('error') }}");
            @endif
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Add Records Modal Calculation ---
            const layananSelect = document.getElementById('layanan');
            const beratInput = document.getElementById('berat');
            const totalHargaInput = document.getElementById('total_harga');
            const totalHargaDisplay = document.getElementById('total_harga_display');

            function calculateTotal() {
                const selectedOption = layananSelect.options[layananSelect.selectedIndex];
                const hargaPerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const berat = parseFloat(beratInput.value) || 0;

                const total = hargaPerKg * berat;

                totalHargaInput.value = total.toFixed(0);
                totalHargaDisplay.textContent = formatNumberForDisplay(total);
            }
            
            layananSelect.addEventListener('change', calculateTotal);
            beratInput.addEventListener('input', calculateTotal);
            calculateTotal();

            // --- Edit Records Modal Calculation ---
            const editLayananSelect = document.getElementById('edit_layanan');
            const editBeratInput = document.getElementById('edit_berat');
            const editTotalHargaInput = document.getElementById('edit_total_harga'); // This is now the HIDDEN input
            const editTotalHargaDisplay = document.getElementById('edit_total_harga_display'); // This is the NEW DISPLAY span

            function calculateEditTotal() {
                const selectedOption = editLayananSelect.options[editLayananSelect.selectedIndex];
                const hargaPerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const berat = parseFloat(editBeratInput.value) || 0;

                const total = hargaPerKg * berat;

                editTotalHargaInput.value = total.toFixed(0);
                editTotalHargaDisplay.textContent = formatNumberForDisplay(total);
            }

            if (editLayananSelect && editBeratInput && editTotalHargaInput && editTotalHargaDisplay) {
                editLayananSelect.addEventListener('change', calculateEditTotal);
                editBeratInput.addEventListener('input', calculateEditTotal);
            }
        });
    </script>
@endpush