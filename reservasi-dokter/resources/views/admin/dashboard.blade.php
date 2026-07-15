@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card h-100 p-3 hover-shadow" style="cursor: default;">
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <span class="badge bg-light text-muted border px-2 py-1">Accounts</span>
                </div>
                <h2 class="fw-bold mb-1 display-5">{{ $pendingPasien ?? 0 }}</h2>
                <p class="text-muted fw-medium mb-0">Pasien Menunggu Verifikasi</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 p-3 hover-shadow" style="cursor: default;">
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4">
                        <i class="bi bi-calendar-event fs-3"></i>
                    </div>
                    <span class="badge bg-light text-muted border px-2 py-1">Appointments</span>
                </div>
                <h2 class="fw-bold mb-1 display-5">{{ $pendingReservasi ?? 0 }}</h2>
                <p class="text-muted fw-medium mb-0">Reservasi Pending</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 p-3 hover-shadow" style="cursor: default;">
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>
                    <span class="badge bg-light text-muted border px-2 py-1">Transactions</span>
                </div>
                <h2 class="fw-bold mb-1 display-5">{{ $pendingPembayaran ?? 0 }}</h2>
                <p class="text-muted fw-medium mb-0">Pembayaran Pending</p>
            </div>
        </div>
    </div>
</div>

<div class="card bg-teal text-black overflow-hidden position-relative">
    <div class="card-body p-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-white bg-opacity-25 text-black mb-3 tracking-wider text-uppercase" style="letter-spacing: 1px;">Admin DentalCare</span>
                <h3 class="fw-bold mb-3 display-6">Selamat Datang, {{ explode(' ', auth()->user()->name)[0] }}!</h3>
                <p class="text-black-50 fs-5 mb-0 w-75">Pantau kinerja klinik Anda hari ini. Segera tindak lanjuti pasien baru, konfirmasi jadwal reservasi, dan pastikan seluruh pembayaran diverifikasi.</p>
            </div>
        </div>
    </div>
</div>
@endsection
