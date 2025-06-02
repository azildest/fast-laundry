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
        <h7 class="text-secondary small">/ Services Lists</h7>
    </div>
    
    {{-- <div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
        <a href="{{ route('services-records') }}" class="text-primary small text-decoration-none">Sales</a>
    </div> --}}
    {{-- End Breadcrumb --}}

    <div class="container mt-5">
    </div>

    {{-- Add Lists Button, Filters, and Reset Button --}}
    {{-- <div class="row mb-4">
        <div class="col-md">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <!-- Left: Add Lists -->
                <button type="button" class="btn btn-sm" style="background: #26a37e; color: white; padding: 5px 10px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#addRecordsModal">
                    <i class="fas fa-plus"></i> Add Lists
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
    </div> --}}

        {{-- Table --}}
        <div class="table-responsive">
            <table id="servicesTable" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Harga Per-kg</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        {{-- Edit Lists Modal --}}
        <div class="modal fade" id="editServicesModal" tabindex="-1" aria-labelledby="editSalesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-black text-white">
                        <h6 class="modal-title" id="editSalesModalLabel"><i class="fas fa-edit me-2"></i> Edit Service</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="edit_nama_layanan" class="col-sm-4 col-form-label fw-bold">Nama Layanan:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="edit_nama_layanan" name="nama_layanan" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="edit_harga_per_kg" class="col-sm-4 col-form-label fw-bold">Harga Per-kg (Rp):</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="edit_harga_per_kg" name="harga_per_kg" required>
                                    <input type="hidden" id="edit_harga_per_kg_raw" name="harga_per_kg_raw">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="edit_deskripsi" class="col-sm-4 col-form-label fw-bold">Deskripsi:</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Service</button>
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
        function formatNumberForDisplay(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        $(document).ready(function () {
            var layananTable = $('#servicesTable').DataTable({
                // processing: true,
                // serverSide: true,
                ajax: '{{ route('services.data_layanan') }}',
                scrollX: true,
                scrollY: 300,
                autoWidth:true,
                // dom: 'Bfrtip',
                dom: 'Blfrtip',
                columns: [
                    // { data: 'id_penjualan', render: function(data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }, name: 'id_penjualan' },
                    { data: 'id_layanan', name: 'id_layanan' },
                    { data: 'nama_layanan', name: 'nama_layanan' },
                    // { data: 'harga_per_kg', name: 'harga_per_kg' },
                    {
                        data: 'harga_per_kg',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    let number = Number(data);
                                    if (isNaN(number)) return data ?? '-';
                                    return number.toLocaleString('id-ID', { minimumFractionDigits: 0 });
                                }
                                return data;
                            },
                        name: 'harga_per_kg'
                    },
                    { data: 'deskripsi',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                let limitedText = data.length > 100 ? data.substring(0, 100) + '...' : data;
                                return '<div class="wrapped-description" title="' + data + '">' + limitedText + '</div>';
                            }
                            return data;
                        },
                        name: 'deskripsi'
                    },
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
                layananTable.search(this.value).draw();
            });

            $('#servicesTable').on('click', '.edit-btn', function () {
                // console.log('Edit button clicked');
                event.preventDefault();
                var id = $(this).data('id');
                var url = '/admin/services/' + id + '/edit';

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        $('#editForm').attr('action', '/admin/services/' + id);

                        // $('#edit_harga_per_kg').val(data.harga_per_kg);
                        $('#edit_harga_per_kg').val(new Intl.NumberFormat('id-ID').format(data.harga_per_kg));
                        $('#edit_harga_per_kg_raw').val(data.harga_per_kg);
                        $('#edit_nama_layanan').val(data.nama_layanan);
                        $('#edit_deskripsi').val(data.deskripsi);

                        $('#editServicesModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching data for edit:", error);
                        alert("Failed to load data for editing.");
                    }
                });

                $('#editForm').off('submit').on('submit', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('action');
                    
                    var hargaPerKgValue = $('#edit_harga_per_kg_raw').val(); 
                    
                    var formDataArray = $(this).serializeArray();
                    var formData = new FormData();

                    $.each(formDataArray, function(index, field){
                        if (field.name === 'harga_per_kg') {
                            return true; 
                        }
                        if (field.name === 'harga_per_kg_raw') {
                            formData.append('harga_per_kg', hargaPerKgValue);
                        } else {
                            formData.append(field.name, field.value);
                        }
                    });

                    formData.append('_method', 'PUT');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('#editServicesModal').modal('hide');
                            alert(response.success);
                            $('#servicesTable').DataTable().ajax.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error("Error updating record:", error);
                            alert("Failed to update record.");
                        }
                    });
                });
            });

            // Handle delete button click
            // $('#servicesTable').on('click', '.delete-btn', function () {
            //     console.log('Edit button clicked');
            //     var id = $(this).data('id');
            //     var url = '/admin/services/delete/' + id;

            //     if (confirm('Are you sure you want to delete this record?')) {
            //         $.ajax({
            //             url: url,
            //             type: 'POST',
            //             data: {
            //                 '_token': '{{ csrf_token() }}',
            //                 '_method': 'DELETE',
            //             },
            //             success: function (response) {
            //                 layananTable.ajax.reload();
            //                 toastr.success(response.success, 'Success');
            //             },
            //             error: function (xhr, status, error) {
            //                 console.error("Error deleting record:", error);
            //                 toastr.error('Failed to delete record.', 'Error');
            //             }
            //         });
            //     }
            // });

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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const layananSelect = document.getElementById('layanan');
            const beratInput = document.getElementById('berat');
            const totalHargaInput = document.getElementById('harga_per_kg');

            function calculateTotal() {
                const selectedOption = layananSelect.options[layananSelect.selectedIndex];
                const hargaPerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const berat = parseFloat(beratInput.value) || 0;

                const total = hargaPerKg * berat;
                totalHargaInput.value = total.toFixed(0);
            }
            
            layananSelect.addEventListener('change', calculateTotal);
            beratInput.addEventListener('input', calculateTotal);

            // Edit Lists Modal
            function calculateEditTotal() {
                const selectedOption = editLayananSelect.options[editLayananSelect.selectedIndex];
                const hargaPerKg = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const berat = parseFloat(editBeratInput.value) || 0;

                const total = hargaPerKg * berat;
                editTotalHargaInput.value = total.toFixed(0);
            }

            const editLayananSelect = document.getElementById('edit_layanan');
            const editBeratInput = document.getElementById('edit_berat');
            const editTotalHargaInput = document.getElementById('edit_harga_per_kg');

            if (editLayananSelect && editBeratInput && editTotalHargaInput) {
                editLayananSelect.addEventListener('change', calculateEditTotal);
                editBeratInput.addEventListener('input', calculateEditTotal);
            }
        });
    </script> --}}
@endpush