<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentalCare Pro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-4 bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="/">DentalCare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" style="border-bottom: 2px solid var(--primary-teal);" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#footer">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-teal px-4" href="/login">Get Started</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container py-5 my-5">
        <div class="row align-items-center">
            <!-- Left Text -->
            <div class="col-lg-6 mb-5 mb-lg-0 pe-lg-5">
                <div class="d-inline-block badge-teal mb-4">
                    <i class="bi bi-shield-check me-1"></i> Trusted by 5,000+ local patients
                </div>
                <h1 class="display-4 fw-bolder lh-sm mb-4">
                    Precision Dentistry for a <span style="color: var(--primary-teal);">Brighter Future.</span>
                </h1>
                <p class="text-muted fs-5 mb-5 lh-base">
                    Experience clinical excellence paired with compassionate care. At DentalCare Pro, we leverage advanced technology to deliver painless, precise, and professional dental solutions.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#register" class="btn btn-teal">Register for an Account <i class="bi bi-arrow-right ms-2"></i></a>
                    <a href="#" class="btn btn-light-gray">Explore Our Clinic</a>
                </div>
            </div>
            
            <!-- Right Video -->
            <div class="col-lg-6 ps-lg-5">
                <div class="position-relative">
                    <div class="ratio ratio-16x9 shadow-lg rounded-5 overflow-hidden position-relative" style="z-index: 2; border: 8px solid white;">
                        <iframe src="https://www.youtube.com/embed/qgDvIye_qBM?si=-V9kf975qiXWhLZG&autoplay=1&mute=1"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values & Features Section -->
    <section id="services" class="container py-5 my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Modern Care, Traditional Values</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">We combine the latest dental innovations with a patient-first approach to ensure your comfort and health are always prioritized.</p>
        </div>

        <div class="row g-4">
            <!-- Top Left: Advanced Diagnostics -->
            <div class="col-lg-7">
                <div class="feature-card d-flex flex-column justify-content-between">
                    <div>
                        <div class="icon-box">
                            <i class="bi bi-display"></i>
                        </div>
                        <h4 class="mb-3">Advanced Diagnostics</h4>
                        <p class="text-muted mb-4" style="max-width: 80%;">Our facility is equipped with AI-powered 3D imaging and laser diagnostics to detect issues long before they become problems.</p>
                    </div>
                    <!-- Placeholder for the small screen image in the card -->
                    <div class="mt-auto text-end" style="margin-right: -30px; margin-bottom: -30px;">
                        <img src="https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&w=400&q=80" alt="Diagnostics Screen" style="width: 250px; border-top-left-radius: 20px;">
                    </div>
                </div>
            </div>

            <!-- Top Right: Certified Experts -->
            <div class="col-lg-5">
                <div class="feature-card feature-card-teal">
                    <div class="icon-box icon-box-white">
                        <i class="bi bi-award text-teal"></i>
                    </div>
                    <h4 class="mb-3">Certified Experts</h4>
                    <p class="text-white-50">Board-certified specialists with over 15 years of experience in restorative and cosmetic surgery.</p>
                    <div class="avatar-group mt-4">
                        <img src="https://i.pravatar.cc/100?img=1" alt="Doctor 1">
                        <img src="https://i.pravatar.cc/100?img=2" alt="Doctor 2">
                        <img src="https://i.pravatar.cc/100?img=3" alt="Doctor 3">
                    </div>
                </div>
            </div>

            <!-- Bottom Left: Patient Comfort -->
            <div class="col-lg-5">
                <div class="feature-card feature-card-gray text-center d-flex flex-column align-items-center justify-content-center py-5">
                    <div class="icon-box bg-transparent text-teal" style="font-size: 40px; color: var(--primary-teal);">
                        <i class="bi bi-emoji-smile"></i>
                    </div>
                    <h4 class="mb-3">Patient Comfort</h4>
                    <p class="text-muted px-4">Sedation options and luxury amenities to ensure a completely stress-free experience.</p>
                </div>
            </div>

            <!-- Bottom Right: Hygiene Protocol -->
            <div class="col-lg-7">
                <div class="feature-card d-flex align-items-center">
                    <div class="pe-4">
                        <h4 class="mb-3">Hygiene Protocol</h4>
                        <p class="text-muted">Our 'Sterile-Safe' program exceeds industry standards with hospital-grade filtration and sterilization in every room.</p>
                    </div>
                    <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&w=300&q=80" alt="Hygiene Tools" class="rounded-4" style="width: 200px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section id="register" class="container py-5 my-5">
        <div class="split-card">
            <!-- Form Side -->
            <div class="split-card-left">
                <h2 class="fw-bold mb-2">Join the Clinic</h2>
                <p class="text-muted mb-4">Create your account to book appointments and track your treatment history.</p>

                @if($errors->any())
                <div class="alert alert-danger mb-4 rounded-3 text-sm">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-sm text-muted fw-semibold mb-1">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-custom" placeholder="Dr. John Doe" required value="{{ old('name') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-sm text-muted fw-semibold mb-1">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-custom" placeholder="john@example.com" required value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-sm text-muted fw-semibold mb-1">Create Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="reg_password" class="form-control form-control-custom pe-5" placeholder="••••••••" required>
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;" id="togglePassword"></i>
                        </div>
                    </div>
                    
                    <input type="hidden" name="password_confirmation" id="password_confirmation">
                    <script>
                        // Toggle Password Visibility
                        const togglePassword = document.getElementById('togglePassword');
                        const password = document.getElementById('reg_password');

                        togglePassword.addEventListener('click', function () {
                            // Toggle the type attribute
                            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                            password.setAttribute('type', type);
                            // Toggle the icon
                            this.classList.toggle('bi-eye');
                            this.classList.toggle('bi-eye-slash');
                        });

                        // Auto-fill confirmation for simplicity if not in design, but required by backend
                        password.addEventListener('input', function(e) {
                            document.getElementById('password_confirmation').value = e.target.value;
                        });
                    </script>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label text-muted small" for="terms">I agree to the <a href="#" class="text-dark fw-semibold text-decoration-none">Privacy Policy</a> and <a href="#" class="text-dark fw-semibold text-decoration-none">Terms of Service</a>.</label>
                    </div>

                    <button type="submit" class="btn btn-teal w-100 py-3 mb-3 text-uppercase tracking-wider fw-bold" style="letter-spacing: 0.5px;">Register for an Account</button>
                    
                    <div class="text-center text-muted small">
                        Already have an account? <a href="{{ route('login') }}" class="text-teal fw-bold text-decoration-none" style="color: var(--primary-teal);">Log in</a>
                    </div>
                </form>
            </div>
            
            <!-- Info Side -->
            <div class="split-card-right">
                <div class="icon-box bg-white text-teal bg-opacity-25 text-white mb-4" style="background-color: rgba(255,255,255,0.2) !important;">
                    <i class="bi bi-hospital"></i>
                </div>
                <h3 class="fw-bold mb-4">Personalized Portal</h3>
                
                <ul class="list-unstyled mb-5 space-y-3">
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle me-3 fs-5"></i> Direct booking with specialists</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle me-3 fs-5"></i> Secure access to 3D scans</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle me-3 fs-5"></i> Appointment reminders via SMS</li>
                </ul>

                <div class="mt-auto bg-white bg-opacity-10 p-4 rounded-4" style="border: 1px solid rgba(255,255,255,0.1);">
                    <p class="small fst-italic mb-3">"The digital onboarding was seamless. I booked my crown replacement in under 2 minutes."</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-circle me-2" style="width: 24px; height: 24px;"></div>
                        <span class="small fw-semibold">— Sarah J., Patient</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3" style="color: var(--primary-teal);">DentalCare Pro</h5>
                    <p class="text-muted small w-75 mb-4">Setting the standard in high-end medical dental services with a commitment to clinical perfection and patient well-being.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-dark"><i class="bi bi-globe"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-envelope"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-telephone"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h6 class="footer-heading text-uppercase text-xs tracking-wider" style="font-size: 0.75rem;">RESOURCES</h6>
                    <a href="#" class="footer-link">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                    <a href="#" class="footer-link">Help Center</a>
                    <a href="#" class="footer-link">Contact Support</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-heading text-uppercase text-xs tracking-wider" style="font-size: 0.75rem;">HOURS</h6>
                    <p class="footer-link mb-1">Mon - Fri: 8am - 6pm</p>
                    <p class="footer-link mb-1">Sat: 9am - 4pm</p>
                    <p class="footer-link mb-1">Sun: Emergency Only</p>
                </div>
            </div>
            
            <hr class="my-4 border-secondary opacity-25">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-muted small">
                <p class="mb-2 mb-md-0">&copy; 2026 DentalCare Pro Professional Clinic Systems.</p>
                <div class="d-flex gap-2">
                    <span class="bg-white px-2 py-1 rounded border shadow-sm" style="font-size: 10px;">VISA</span>
                    <span class="bg-white px-2 py-1 rounded border shadow-sm" style="font-size: 10px;">MC</span>
                    <span class="bg-white px-2 py-1 rounded border shadow-sm" style="font-size: 10px;">AMEX</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
