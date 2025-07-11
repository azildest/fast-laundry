<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/adminlogin.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<body>
    <div class="main-container"> 
        <div class="logo-section"> 
            <img src="{{ asset('Logonobackground.png') }}" alt="company-logo">
            {{-- <h2>Fast Laundry</h2>
            <p>Welcome to our platform!</p> --}}
        </div>
        <div class="login-container"> <h2>Welcome Back!</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="input-group">
                    <input type="text" name="login" class="input-field" placeholder="Email / Username" required>
                    @error('login')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility()">
                        <i id="togglePassword" class="fas fa-eye"></i>
                    </span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="login-options">
                    <div class="remember-me">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                    {{-- <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                    </div> --}}
                </div>

                <button type="submit" class="login-button">Log In</button>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>