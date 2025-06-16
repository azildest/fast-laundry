<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        @stack('styles')

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminnavbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admintable.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    
<body>
    @include('layouts.components.adminnavbar')
    <div class="d-flex">
        @include('layouts.components.sidebar')
        <div class="flex-grow-1 p-4 bg-light content-wrapper">
            @yield('content')
        </div>
    </div>

    <style>
        .content-wrapper {
            max-width: 100vw;
            overflow-x: hidden;
        }

        /* .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
        }

        .password-toggle:hover {
            color: #333; */
        /* } */
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-expanded');

            // document.body.classList.toggle('sidebar-collapsed-body');
        });
    </script>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Edit User Profile Modal --}}
    <div class="modal fade" id="editUserProfileModal" tabindex="-1" aria-labelledby="editUserProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editForm" method="POST" action="{{ route('profile.update', auth()->user()->id_akun) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        {{-- Icon statis --}}
                        <div class="text-center mb-2">
                            <i class="fas fa-user-circle fa-5x text-secondary"></i>
                        </div>

                        <br>

                        <div class="mb-2 row">
                            <label for="edit_username" class="col-sm-4 col-form-label fw-bold">Username:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="edit_username" name="username" placeholder="Username" 
                                    value="{{ auth()->user()->username }}" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="edit_email" class="col-sm-4 col-form-label fw-bold">Email:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="edit_email" name="email" placeholder="ex. user@example.com" 
                                    value="{{ auth()->user()->email }}" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="edit_no_telp" class="col-sm-4 col-form-label fw-bold">No. Telp:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="edit_no_telp" name="no_telp" placeholder="ex. 08xxxxxxxxxx"
                                value="{{ auth()->user()->no_telp }}">
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label for="edit_level" class="col-sm-4 col-form-label fw-bold">Role:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="edit_level" name="role" value="{{ auth()->user()->level == 1 ? 'Operator' : 'Owner' }}" readonly>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveUpdateProfile">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Please correct the following errors:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    {{-- Change Password Modal --}}
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="changePasswordForm" method="POST" action="{{ route('profile.changePassword', auth()->user()->id_akun) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        {{-- Password Saat ini/lama --}}
                        <div class="mb-2 row">
                            <label for="current_password" class="col-sm-4 col-form-label fw-bold">Password Lama:</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                    {{-- <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('current_password', this.querySelector('i'))">
                                        <i class="fas fa-eye"></i>
                                    </button> --}}
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        {{-- Password baru --}}
                        <div class="mb-2 row">
                            <label for="password" class="col-sm-4 col-form-label fw-bold">Password Baru:</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    {{-- <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('password', this.querySelector('i'))">
                                        <i class="fas fa-eye"></i>
                                    </button> --}}
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        {{-- Konfirmasi password baru --}}
                        <div class="mb-2 row">
                            <label for="password_confirmation" class="col-sm-4 col-form-label fw-bold">Konfirmasi Password Baru:</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                                    {{-- <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('password_confirmation', this.querySelector('i'))">
                                        <i class="fas fa-eye"></i>
                                    </button> --}}
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    {{-- </div> --}}

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="saveChangePassword">Change</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Logout --}}
    <div class="modal fade" id="logoutConfirmationModal" tabindex="-1" aria-labelledby="logoutConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="d-flex justify-content-end p-2 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 pb-2 text-center">
                    <i class="fas fa-question-circle text-warning mb-2" style="font-size: 3rem;"></i>
                    <p class="mb-1 fw-bold">Are you sure you want to log out?</p>
                    <small class="text-muted">You will need to log in again to access your account.</small>
                </div>
                <br>
                <div class="modal-footer d-flex justify-content-center border-top-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning px-4" id="confirmLogoutButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div class="modal fade">
        <div id="passwordChangeSuccessAlert" class="alert alert-success d-none" role="alert">
            </div>
        <div id="passwordChangeErrorAlert" class="alert alert-danger d-none" role="alert">
            </div>

        <form id="changePasswordForm" method="POST" action="{{ route('profile.changePassword', auth()->user()->id_akun) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                    <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword" onclick="togglePasswordVisibility('current_password', 'toggleCurrentPassword')">
                        <i class="fa fa-eye" id="toggleCurrentPassword"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword" onclick="togglePasswordVisibility('password', 'toggleNewPassword')">
                        <i class="fa fa-eye" id="toggleNewPassword"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="8">
                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword" onclick="togglePasswordVisibility('password_confirmation', 'toggleConfirmPassword')">
                        <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                    </button>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveChangePassword">Change</button>
            </div>
        </form>
    </div>

    <script>
        $('#confirmLogoutButton').on('click', function () {
            $('#logoutConfirmationModal').modal('hide');
            document.getElementById('logout-form').submit();
        });

        $('#saveUpdateProfile').click(function () {
            $.get('/user/edit/{{ auth()->user()->id }}', function (data) {
                $('#edit_username').val(data.username);
                $('#edit_email').val(data.email);
                $('#edit_no_telp').val(data.no_telp);
                $('#editUserProfileModal').modal('show');
            });
        });

        function togglePasswordVisibility(inputId, iconElement) { // iconElement is the <i> tag
            const input = document.getElementById(inputId);

            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            }
        }

        $(document).ready(function() {
            function clearErrors() {
                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid'); 
                $('#passwordChangeSuccessAlert').addClass('d-none').text(''); 
                $('#passwordChangeErrorAlert').addClass('d-none').text(''); 
            }

            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                clearErrors();

                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                let formData = form.serialize();

                // Show a loading indicator if you have one
                // $('#saveChangePassword').prop('disabled', true).text('Changing...');

                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    success: function(response) {
                        $('#passwordChangeSuccessAlert').removeClass('d-none').text(response.message || 'Password has been updated successfully!');
                        form[0].reset();
                        setTimeout(function() {
                            $('#changePasswordModal').modal('hide');
                        }, 2000);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                let input = form.find('[name="' + key + '"]');
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                            });
                        } else if (xhr.responseJSON.message) {
                            $('#passwordChangeErrorAlert').removeClass('d-none').text(xhr.responseJSON.message);
                        } else {
                            $('#passwordChangeErrorAlert').removeClass('d-none').text('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        // Hide loading indicator
                        // $('#saveChangePassword').prop('disabled', false).text('Change');
                    }
                });
            });

            $('#changePasswordModal').on('hidden.bs.modal', function () {
                clearErrors();
            });
        });
    </script>

    @stack('scripts')
    
</body>
</html>