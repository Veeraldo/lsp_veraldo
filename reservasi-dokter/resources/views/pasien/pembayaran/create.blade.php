@extends('layouts.pasien')
@section('title', 'Pembayaran Reservasi')

@section('content')
<div class="mb-4">
    <a href="{{ route('pasien.reservasi.index') }}" class="text-success text-decoration-none fw-medium small d-flex align-items-center">
        <svg class="me-1" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Riwayat
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
            <div class="bg-success text-white p-4">
                <h4 class="fw-bold mb-1">Pembayaran Reservasi</h4>
                <p class="text-white-50 small mb-0">Selesaikan pembayaran untuk mengkonfirmasi kedatangan Anda.</p>
            </div>
            
            <div class="bg-light p-4 border-bottom">
                <h6 class="text-muted text-uppercase fw-bold small mb-3">Detail Reservasi</h6>
                <div class="row g-3">
                    <div class="col-6">
                        <p class="text-muted small mb-1">Tanggal</p>
                        <p class="fw-bold text-dark mb-0">{{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d F Y') }}</p>
                    </div>
                    <div class="col-6">
                        <p class="text-muted small mb-1">Dokter</p>
                        <p class="fw-bold text-dark mb-0">{{ $reservasi->jadwalDokter->dokter->nama ?? '-' }}</p>
                    </div>
                    <div class="col-12">
                        <p class="text-muted small mb-1">Hari/Waktu</p>
                        <p class="fw-bold text-dark mb-0">{{ \Carbon\Carbon::parse($reservasi->tanggal)->locale('id')->translatedFormat('l') }}, {{ isset($reservasi->jadwalDokter->jam_mulai) ? substr($reservasi->jadwalDokter->jam_mulai, 0, 5) : '' }} WIB</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="alert alert-info border-info border rounded-3 mb-4">
                    <h6 class="fw-bold text-info-emphasis mb-2">Informasi Transfer</h6>
                    <p class="small text-info-emphasis mb-1">Bank BCA: <strong>1234567890</strong> a.n Klinik Gigi Veraldo</p>
                    <p class="small text-info-emphasis mb-0">Bank Mandiri: <strong>0987654321</strong> a.n Klinik Gigi Veraldo</p>
                </div>

                <form action="{{ route('pasien.pembayaran.store', $reservasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nominal" class="form-label fw-bold text-dark mb-2">Total Tagihan (Rp)</label>
                        <div class="input-group input-group-lg mb-2">
                            <span class="input-group-text bg-light fw-bold text-muted border-secondary">Rp</span>
                            <input type="text" class="form-control border-secondary bg-light text-dark fw-bold fs-5" value="{{ number_format($reservasi->harga, 0, ',', '.') }}" readonly>
                        </div>
                        <input type="hidden" name="nominal" value="{{ $reservasi->harga }}">
                        <div class="form-text text-success fw-medium small"><i class="bi bi-info-circle me-1"></i>Nominal telah ditetapkan oleh Klinik. Silakan transfer sejumlah tagihan di atas.</div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="bukti_bayar" class="form-label fw-bold text-dark mb-2">Upload Bukti Pembayaran</label>
                        <input type="file" id="bukti_bayar" name="bukti_bayar" class="form-control form-control-lg border-secondary rounded-3" accept="image/jpeg,image/png,image/jpg" required>
                        <div class="form-text small text-muted">PNG, JPG up to 2MB</div>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-lg w-100 fw-bold rounded-3 shadow-sm">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
