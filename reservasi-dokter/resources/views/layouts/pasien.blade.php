<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - DentalCare Pro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: #F8FAFC; /* Slightly lighter gray */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex-grow: 1;
        }
        .navbar {
            padding: 1rem 0;
        }
        .nav-link.active {
            color: var(--primary-teal) !important;
            border-bottom: 2px solid var(--primary-teal);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('pasien.dashboard') }}">DentalCare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0 gap-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}" href="{{ route('pasien.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pasien.reservasi.create') ? 'active' : '' }}" href="{{ route('pasien.reservasi.create') }}">Reservasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pasien.reservasi.index') || request()->routeIs('pasien.pembayaran.*') ? 'active' : '' }}" href="{{ route('pasien.reservasi.index') }}">Pembayaran</a>
                    </li>
                </ul>
            </div>
            
            <div class="d-none d-lg-flex align-items-center gap-3">
                <a href="#" class="text-dark fs-5"><i class="bi bi-bell"></i></a>
                <div class="dropdown">
                    <a href="#" class="text-dark fs-5 text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2">
                        <li><h6 class="dropdown-header">{{ auth()->user()->name }}</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-fluid px-4 px-lg-5 py-5">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto py-4 text-center">
        <div class="container text-muted small">
            <div class="d-flex justify-content-center gap-4 mb-2">
                <a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
                <a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                <a href="#" class="text-muted text-decoration-none">Help Center</a>
                <a href="#" class="text-muted text-decoration-none">Contact Support</a>
            </div>
            &copy; {{ date('Y') }} DentalCare Pro Professional Clinic Systems.
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
