<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form - Point Of Sales</title>

    <!-- SEO Optimization -->
    <meta name="description" content="Login Screen - Spark Admin Premium Bootstrap 5 Admin Dashboard Template">
    <meta name="author" content="Spark Admin Team">

    @include('inc.css')
</head>

<body>
    <div class="login-wrapper">
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>

        <div class="login-card">
            <a href="index.html" class="login-brand text-decoration-none">
                <i class="bi bi-asterisk"></i>
                <span>Admin</span>
            </a>
            <p class="login-subtitle">Please sign in to access your dashboard</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan input:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('action-login') }}" method="POST" id="loginForm" class="needs-validation"
                novalidate>
                @csrf
                <div class="login-form-group">
                    <label for="email" class="login-form-label">Email Address</label>
                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input name="email" type="email" id="email"
                            class="login-input @error('email') is-invalid @enderror" placeholder="name@gmail.com"
                            required value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="login-form-group">
                    <label for="password" class="login-form-label">Password</label>
                    <div class="login-input-group">
                        <i class="bi bi-shield-lock input-icon"></i>
                        <input name="password" type="password" id="password"
                            class="login-input login-input-password @error('password') is-invalid @enderror"
                            placeholder="your password" required value="{{ old('password') }}">
                        <button type="button" class="password-toggle-btn" id="toggle-password"
                            aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="login-options">
                    <label class="custom-control-label">
                        <input type="checkbox" class="custom-checkbox-input" id="rememberMe">
                        <span>Remember Me</span>
                    </label>
                    <a href="#" class="forgot-password-link">Forgot Password?</a>
                </div>
                <button type="submit" class="btn-login" id="btn-submit">
                    <span>Sign In to Dashboard</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
    @inlcude('inc.js')
</body>

</html>
