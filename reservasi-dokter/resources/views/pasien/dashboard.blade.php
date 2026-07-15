@extends('layouts.pasien')
@section('title', 'Dashboard')

@section('content')

    @if(auth()->user()->status_akun !== 'approved')
        <!-- Verification Banner -->
        <div class="alert alert-danger d-flex align-items-center rounded-4 shadow-sm mb-4 border-0 p-4" role="alert">
            <div class="bg-danger bg-opacity-25 p-3 rounded-circle me-3">
                <i class="bi bi-shield-exclamation text-danger fs-4"></i>
            </div>
            <div class="flex-grow-1">
                <h5 class="fw-bold mb-1 text-danger">Awaiting Admin Verification</h5>
                <p class="mb-0 text-danger opacity-75 small">Your account details are being reviewed. Full clinic features will
                    be unlocked once verified.</p>
            </div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Left Column -->
        <div class="col-lg-8">

            <!-- Welcome Card -->
            <div class="card border-0 rounded-4 shadow-sm mb-4 overflow-hidden" style="background-color: #fff;">
                <div class="card-body p-5 position-relative">
                    <div class="d-flex align-items-center mb-3 flex-wrap gap-2">
                        <h1 class="display-6 fw-bold text-dark mb-0">Welcome, {{ explode(' ', auth()->user()->name)[0] }}</h1>
                        @if(auth()->user()->status_akun == 'approved')
                            <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-2 ms-md-2"><i class="bi bi-check-circle-fill me-1"></i> Terverifikasi</span>
                        @elseif(auth()->user()->status_akun == 'rejected')
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3 py-2 ms-md-2"><i class="bi bi-x-circle-fill me-1"></i> Ditolak</span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3 py-2 ms-md-2"><i class="bi bi-hourglass-split me-1"></i> Menunggu Verifikasi</span>
                        @endif
                    </div>
                    <p class="text-muted fs-6 w-75 mb-0">Check Health Status, View Reservations, and Update Clinic Notifications</p>
                    <i class="bi bi-tooth position-absolute text-light"
                        style="font-size: 150px; right: -20px; bottom: -40px; opacity: 0.5;"></i>
                </div>
            </div>

            <div class="row g-4">
                <!-- Announcements -->
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <h5 class="fw-bold mb-0"><i class="bi bi-megaphone me-2 text-teal"></i> Clinic Announcements</h5>
                        <a href="#" class="text-teal text-decoration-none small fw-bold">View All</a>
                    </div>

                    <div class="row g-3">
                        @forelse($pengumumans as $pengumuman)
                            <div class="col-md-6">
                                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                    @if($pengumuman->media)
                                        @if(Str::endsWith($pengumuman->media, ['.mp4']))
                                            <video class="card-img-top w-100 object-fit-cover" style="height: 160px;" controls>
                                                <source src="{{ asset('storage/' . $pengumuman->media) }}" type="video/mp4">
                                            </video>
                                        @else
                                            <img src="{{ asset('storage/' . $pengumuman->media) }}" alt="{{ $pengumuman->judul }}"
                                                class="card-img-top w-100 object-fit-cover" style="height: 160px;">
                                        @endif
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center text-muted"
                                            style="height: 160px;">
                                            <i class="bi bi-image fs-1 opacity-25"></i>
                                        </div>
                                    @endif
                                    <div class="card-body p-4">
                                        <span
                                            class="badge bg-light text-muted mb-2 border">{{ \Carbon\Carbon::parse($pengumuman->tanggal_publikasi)->format('M d, Y') }}</span>
                                        <h6 class="fw-bold mb-2">{{ $pengumuman->judul }}</h6>
                                        <p class="text-muted small mb-0">{{ Str::limit($pengumuman->isi, 80) }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="card border-0 rounded-4 shadow-sm">
                                    <div class="card-body p-4 text-center text-muted">
                                        No new announcements.
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="col-12 mt-5">
                    <h5 class="fw-bold mb-3">Upcoming reservations</h5>
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            @forelse($upcomingReservasis as $reservasi)
                                <div class="d-flex align-items-center p-3 border rounded-3 mb-3 hover-shadow transition">
                                    <div class="bg-light-teal text-teal p-3 rounded-3 text-center me-4">
                                        <div class="small fw-bold text-uppercase">
                                            {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('M') }}</div>
                                        <h4 class="fw-bold mb-0">{{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d') }}
                                        </h4>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">
                                            {{ optional(optional($reservasi->jadwalDokter)->dokter)->spesialisasi ?? 'Konsultasi Gigi' }}
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ isset($reservasi->jadwalDokter) ? substr($reservasi->jadwalDokter->jam_mulai, 0, 5) : '' }}
                                            &nbsp;&bull;&nbsp;
                                            {{ optional(optional($reservasi->jadwalDokter)->dokter)->nama ?? 'Dokter Klinik' }}
                                        </p>
                                    </div>
                                    <div class="d-none d-sm-block">
                                        @if($reservasi->status == 'approved')
                                            <span class="badge bg-success bg-opacity-10 text-success">Confirmed</span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning">Pending</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="bi bi-calendar-x fs-1 text-muted opacity-50 mb-3 d-block"></i>
                                    <p class="text-muted fw-semibold mb-0">There are no upcoming reservation schedules.</p>
                                </div>
                            @endforelse

                            @if($upcomingReservasis->isNotEmpty())
                                <div class="text-center mt-3">
                                    <a href="{{ route('pasien.reservasi.index') }}"
                                        class="btn btn-light text-muted fw-bold w-100 rounded-3 py-2">Lihat semua riwayat</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">

            <!-- CTA Book -->
            <div class="card border-0 rounded-4 shadow-sm mb-4 bg-teal text-white">
                <div class="card-body p-4 text-center position-relative overflow-hidden">
                    <i class="bi bi-calendar-plus position-absolute"
                        style="font-size: 80px; top: -10px; left: -10px; opacity: 0.1;"></i>
                    <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-calendar-check fs-2 text-white"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Ready for a Checkup?</h5>
                    <p class="small text-white-50 mb-4">Book your next appointment in less than 2 minutes.</p>
                    <a href="{{ route('pasien.reservasi.create') }}"
                        class="btn btn-light text-teal fw-bold rounded-pill px-4 py-2 w-100 shadow-sm">Book Now</a>
                </div>
            </div>


        </div>
    </div>

    <style>
        .bg-teal {
            background-color: var(--primary-teal);
        }

        .text-teal {
            color: var(--primary-teal);
        }

        .bg-light-teal {
            background-color: var(--light-teal);
        }

        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05) !important;
            transition: all 0.2s;
        }
    </style>
@endsection