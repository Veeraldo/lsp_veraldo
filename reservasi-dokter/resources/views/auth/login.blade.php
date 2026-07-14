<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DentalCare Pro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }
        .login-header {
            background-color: var(--primary-teal);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .login-body {
            padding: 40px;
        }
        .input-group-text, .form-control {
            border-color: #E5E7EB;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #E5E7EB;
            background-color: #fff !important;
        }
        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: var(--primary-teal);
            background-color: #fff !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <h2 class="fw-bolder" style="color: var(--primary-teal);">
                            <i class="bi bi-hospital me-2"></i>DentalCare
                        </h2>
                    </a>
                </div>

                <div class="login-card">
                    <div class="login-header">
                        <h3 class="fw-bold mb-1">Welcome!</h3>
                        <p class="mb-0 text-white-50">Please log in to your account</p>
                    </div>
                    
                    <div class="login-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <ul class="mb-0 ps-3 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label text-muted fw-semibold small mb-1">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control bg-light border-start-0 py-2 ps-0" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="john@example.com">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label text-muted fw-semibold small mb-1">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control bg-light border-start-0 py-2 ps-0" id="password" name="password" required placeholder="••••••••">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small text-muted" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="text-decoration-none small fw-semibold" style="color: var(--primary-teal);">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn btn-teal w-100 py-3 fw-bold text-uppercase tracking-wider">Log In</button>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted small">Don't have an account? <a href="{{ url('/#register') }}" class="fw-bold text-decoration-none" style="color: var(--primary-teal);">Register here</a></p>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
