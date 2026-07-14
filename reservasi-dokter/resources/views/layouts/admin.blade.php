<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Area</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-teal: #20c997;
            --light-teal: rgba(32, 201, 151, 0.1);
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
        }
        .sidebar {
            min-height: 100vh;
            width: 260px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.03);
            z-index: 1000;
        }
        .sidebar-brand {
            color: var(--primary-teal);
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .main-content {
            flex-grow: 1;
            width: calc(100% - 260px);
        }
        .nav-link-custom {
            color: #64748b;
            padding: 0.8rem 1.5rem;
            border-radius: 0.5rem;
            margin: 0.2rem 1rem;
            transition: all 0.2s;
            font-weight: 500;
        }
        .nav-link-custom:hover {
            color: var(--primary-teal);
            background-color: var(--light-teal);
        }
        .nav-link-custom.active {
            color: var(--primary-teal);
            background-color: var(--light-teal);
            font-weight: 600;
        }
        .nav-link-custom i {
            width: 24px;
            font-size: 1.1rem;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.04);
            border-radius: 1rem;
        }
        .btn-teal {
            background-color: var(--primary-teal);
            color: white;
            border: none;
        }
        .btn-teal:hover {
            background-color: #1ba87e;
            color: white;
        }
        .text-teal {
            color: var(--primary-teal) !important;
        }
        .bg-light-teal {
            background-color: var(--light-teal) !important;
        }
        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .table > :not(caption) > * > * {
            padding: 1rem 0.5rem;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar bg-white d-none d-md-flex flex-column py-4">
            <h4 class="text-center mb-4 sidebar-brand fs-3">DentalCare</h4>
            <div class="d-flex flex-column gap-1">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid me-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.pasien.index') }}" class="text-decoration-none nav-link-custom {{ request()->routeIs('admin.pasien.*') ? 'active' : '' }}">
                    <i class="bi bi-person-check me-2"></i> Verifikasi Pasien
                </a>
                <a href="{{ route('admin.dokter.index') }}" class="text-decoration-none nav-link-custom {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
                    <i class="bi bi-heart-pulse me-2"></i> Data Dokter
                </a>
                <a href="{{ route('admin.jadwal.index') }}" class="text-decoration-none nav-link-custom {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-week me-2"></i> Jadwal Dokter
                </a>
                <a href="{{ route('admin.reservasi.index') }}" class="text-decoration-none nav-link-custom {{ request()->routeIs('admin.reservasi.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-bookmark me-2"></i> Reservasi
                </a>
                <a href="{{ route('admin.pembayaran.index') }}" class="text-decoration-none nav-link-custom {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin me-2"></i> Pembayaran
                </a>
                <a href="{{ route('admin.pengumuman.index') }}" class="text-decoration-none nav-link-custom {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                    <i class="bi bi-megaphone me-2"></i> Pengumuman
                </a>
            </div>
            
            <div class="mt-auto px-4">
                <div class="bg-light p-3 rounded-4 text-center">
                    <div class="bg-white rounded-circle d-inline-flex p-2 shadow-sm mb-2">
                        <i class="bi bi-person-circle fs-4 text-secondary"></i>
                    </div>
                    <p class="mb-0 fw-bold small text-dark">{{ auth()->user()->name }}</p>
                    <p class="mb-2 text-muted" style="font-size: 0.75rem;">Administrator</p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill fw-medium">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content min-vh-100">
            <!-- Navbar Mobile (Optional if needed, hiding for now or simple) -->
            <nav class="navbar navbar-light bg-white border-bottom px-4 py-3 d-md-none">
                <span class="navbar-brand sidebar-brand fw-bold">DentalCare</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">Logout</button>
                </form>
            </nav>

            <!-- Header Content Area -->
            <div class="px-4 px-lg-5 pt-4 pb-2">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-dark mb-0">@yield('title')</h2>
                    <div class="d-none d-md-flex text-muted small fw-medium">
                        {{ \Carbon\Carbon::now()->format('l, d F Y') }}
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="px-4 px-lg-5 pb-5">
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
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
