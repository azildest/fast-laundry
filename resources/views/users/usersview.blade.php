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
        <h7 class="text-secondary small">/ Users Management</h7>
    </div>

    <div class="container mt-5">
    </div>

    {{-- Add Users Button, Filters, and Reset Button --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center flex-nowrap gap-2">
                <!-- Left: Add User Button -->
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-sm" style="background: #26a37e; color: white; padding: 5px 10px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#addUsersModal">
                        <i class="fas fa-user-plus"></i> Add User
                    </button>
                </div>

                <!-- Right: Filter + Reset -->
                <div class="d-flex gap-2 flex-shrink-1" style="flex-wrap: nowrap;">
                    <select class="form-select form-select-sm" id="filter_roles" style="max-width: 100px; font-size: 14px; color: #495057; border: 1px solid #ccc;">
                        <option value="">All Roles</option>
                        @foreach($usersData->unique('level') as $users)
                            <option value="{{ $users->level }}">
                                @if($users->level == 2)
                                    Owner
                                @elseif($users->level == 1)
                                    Operator
                                @endif
                            </option>
                        @endforeach
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
        <table id="usersTable" class="table table-bordered table-striped nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. Telp</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    {{-- Modal for ADD RECORDS --}}
    <div class="modal fade" id="addUsersModal" tabindex="-1" aria-labelledby="addUsersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-black text-white">
                    <h6 class="modal-title" id="addUsersModalLabel"><i class="fas fa-user-plus me-2"></i> Add New User</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('users.add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-4 col-form-label fw-bold">Username:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="username" value="{{ old('username') }}" required>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-4 col-form-label fw-bold">Email:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="ex. emailuser@gmail.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror                            
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="no_telp" class="col-sm-4 col-form-label fw-bold">No. Telp:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="ex. 08xxxxxxxxxx">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="level" class="col-sm-4 col-form-label fw-bold">Role:</label>
                            <div class="col-sm-8">
                                <select class="form-select" id="level" name="level" required>
                                    <option selected disabled class="text-secondary">-- Pilih Role --</option>
                                    <option value="2">Owner</option>
                                    <option value="1">Operator</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label fw-bold">Password:</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password_confirmation" class="col-sm-4 col-form-label fw-bold">Konfirmasi Password:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
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
                    <p class="lead">Are you sure you want to delete this user?</p>
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
        $(document).ready(function () {
            let penggunaTable = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.data_users') }}',
                scrollX: true,
                scrollY: 300,
                autoWidth:true,
                dom: 'Blfrtip',
                 ajax: {
                    url: '{{ route('users.data_users') }}',
                    data: function(d) {
                        d.filter_roles = $('#filter_roles').val();
                    }
                },
                columns: [
                    { data: 'id_akun', render: function(data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }, name: 'id_akun' },
                    { data: 'username',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                let limitedText = data.length > 100 ? data.substring(0, 100) + '...' : data;
                                return '<div class="wrapped-description" title="' + data + '">' + limitedText + '</div>';
                            }
                            return data;
                        },
                        name: 'username'
                    },
                    { data: 'email', name: 'email' },
                    { data: 'no_telp', name: 'no_telp', orderable: false},
                    { data: 'level', name: 'level', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                "language": {
                    "emptyTable": "No users on this table.",
                    "info": "Shown _START_ to _END_ from _TOTAL_ data",
                    "infoEmpty": "Show 0 to 0 from 0 data",
                    "lengthMenu": "Show _MENU_ rows",
                    "search": "Search:",
                    "zeroRecords": "No matching user found.",
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
                penggunaTable.search(this.value).draw();
            });

            // Filter
            $('#filter_roles').change(function(){
                penggunaTable.ajax.reload();
            });

            // Reset filters
            $('#resetButton').on('click', function () {
                $('#searchInput').val('');
                $('#filter_roles').val('').trigger('change');
                penggunaTable.search('').columns().search('').draw();
            });

            $('#addUsersModal form').on('submit', function (e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                console.log('Attempting to submit Add User form via AJAX...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json', 
                    success: function (response) {
                        console.log('AJAX Success:', response); 
                        $('#addUsersModal').modal('hide'); 

                        if (response.success) {
                            toastr.success(response.success, 'Berhasil');
                        } else {
                            toastr.info('User added successfully!', 'Info'); // Fallback message
                        }

                        penggunaTable.ajax.reload(); 
                        form[0].reset(); 
                        form.find('.is-invalid').removeClass('is-invalid'); 
                        form.find('.invalid-feedback').remove(); 
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', xhr.responseText);
                        var errors = xhr.responseJSON.errors;

                        form.find('.is-invalid').removeClass('is-invalid');
                        form.find('.invalid-feedback').remove();

                        if (errors) {
                            $.each(errors, function (key, value) {
                                var input = form.find('[name="' + key + '"]');
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                            });
                            toastr.error('Please fix the errors in the form.', 'Validation Error');
                        } else {
                            toastr.error('Failed to add user. Please try again.', 'Error');
                        }
                    }
                });
            });

            let userToDeleteId = null;

            // Handle delete button click - SHOW THE MODAL
            $('#usersTable').on('click', '.delete-btn', function (event) {
                event.preventDefault();
                userToDeleteId = $(this).data('id');
                $('#deleteConfirmationModal').modal('show');
            });

            // Handle confirmation button click inside the modal - PERFORM DELETION
            $('#confirmDeleteButton').on('click', function () {
                if (userToDeleteId) {
                    var url = '/admin/users/delete/' + userToDeleteId;

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
                            penggunaTable.ajax.reload();
                            userToDeleteId = null;
                        },
                        error: function (xhr, status, error) {
                            $('#deleteConfirmationModal').modal('hide'); // Hide the modal
                            console.error("Error deleting user:", error);
                            toastr.error('Failed to delete user.', 'Error'); // Show error toast
                            userToDeleteId = null; // Reset the ID
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
@endpush