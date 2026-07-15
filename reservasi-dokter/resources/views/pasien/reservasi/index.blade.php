@extends('layouts.pasien')
@section('title', 'My Activity')

@section('content')

@php
    $activeCount = $reservasis->where('status', 'approved')->where('pembayaran.status', 'approved')->count();
    $pendingPaymentReservasis = $reservasis->where('status', 'approved')->filter(function($r) {
        return !$r->pembayaran || $r->pembayaran->status !== 'approved';
    });
    $pendingCount = $pendingPaymentReservasis->count();
    $totalDues = $pendingPaymentReservasis->sum('harga');
@endphp

<div class="mb-5">
    <h1 class="display-6 fw-bold text-dark mb-2">My Activity</h1>
    <p class="text-muted fs-5">Manage your appointments and track your payment history.</p>
</div>

<div class="row g-5">
    <!-- Left Column: Activity List -->
    <div class="col-lg-8">
        
        <div class="d-flex flex-column gap-4">
            @forelse($reservasis as $reservasi)
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                @if($reservasi->status == 'approved' && optional($reservasi->pembayaran)->status == 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.7rem;">CONFIRMED</span>
                                @elseif($reservasi->status == 'approved' && (!optional($reservasi->pembayaran) || optional($reservasi->pembayaran)->status != 'approved'))
                                    <span class="badge bg-warning bg-opacity-10 text-warning fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.7rem;">PENDING PAYMENT VERIFICATION</span>
                                @elseif($reservasi->status == 'pending')
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.7rem;">WAITING</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger fw-bold text-uppercase tracking-wider mb-2" style="font-size: 0.7rem;">REJECTED</span>
                                @endif
                                
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle overflow-hidden me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                                        @if(isset($reservasi->jadwalDokter->dokter->foto))
                                            <img src="{{ asset('storage/' . $reservasi->jadwalDokter->dokter->foto) }}" class="w-100 h-100 object-fit-cover" alt="Doctor">
                                        @else
                                            <i class="bi bi-person text-secondary fs-4"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">{{ $reservasi->jadwalDokter->dokter->spesialisasi ?? 'Dental Consultation' }}</h5>
                                        <p class="text-muted small mb-0">{{ $reservasi->jadwalDokter->dokter->nama ?? 'Unknown Doctor' }} - DentalCare</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <h5 class="fw-bold text-dark mb-1">
                                    @if($reservasi->harga)
                                        Rp {{ number_format($reservasi->harga, 0, ',', '.') }}
                                    @else
                                        <span class="fs-6 text-muted fw-normal fst-italic">Awaiting Price</span>
                                    @endif
                                </h5>
                                <p class="text-muted small mb-0"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('M d, Y') }} &bull; {{ isset($reservasi->jadwalDokter) ? substr($reservasi->jadwalDokter->jam_mulai, 0, 5) : '' }}</p>
                            </div>
                        </div>

                        <!-- Payment Upload Section if needed -->
                        @if($reservasi->status == 'approved' && (!$reservasi->pembayaran || $reservasi->pembayaran->status == 'rejected'))
                            <div class="bg-light p-4 rounded-4 mt-3 border border-dashed text-center">
                                <p class="small text-muted fw-semibold mb-3">Please upload your transfer receipt to secure your slot.</p>
                                <a href="{{ route('pasien.pembayaran.create', $reservasi->id) }}" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">Submit Payment</a>
                            </div>
                        @elseif($reservasi->status == 'approved' && $reservasi->pembayaran && $reservasi->pembayaran->status == 'pending')
                            <div class="bg-light p-3 rounded-4 mt-3 text-center border">
                                <p class="small text-warning fw-semibold mb-0"><i class="bi bi-hourglass-split me-1"></i> Admin is verifying your payment.</p>
                            </div>
                        @endif
                        
                        <!-- Action Buttons -->
                        @if($reservasi->status == 'pending')
                            <div class="d-flex gap-2 mt-4">
                                <a href="{{ route('pasien.reservasi.edit', $reservasi->id) }}" class="btn btn-outline-secondary rounded-pill flex-grow-1 fw-bold">Reschedule</a>
                                <form action="{{ route('pasien.reservasi.destroy', $reservasi->id) }}" method="POST" class="flex-grow-1 d-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger rounded-pill w-100 fw-bold" onclick="return confirm('Apakah Anda yakin ingin membatalkan request reservasi ini?')">Cancel Request</button>
                                </form>
                            </div>
                        @elseif($reservasi->status == 'rejected')
                            <div class="mt-3">
                                <p class="small text-danger mb-0"><i class="bi bi-info-circle me-1"></i> Specialist unavailable for the selected date. Please choose another slot.</p>
                            </div>
                        @endif

                    </div>
                </div>
            @empty
                <div class="card border-0 rounded-4 shadow-sm">
                    <div class="card-body p-5 text-center text-muted">
                        <i class="bi bi-journal-x fs-1 mb-3 text-secondary opacity-50"></i>
                        <h5>No Activity Found</h5>
                        <p class="mb-0">You don't have any appointments or payments yet.</p>
                    </div>
                </div>
            @endforelse
        </div>
        
    </div>

    <!-- Right Column: Sidebar -->
    <div class="col-lg-4">
        
        <!-- Activity Summary -->
        <div class="card border-0 rounded-4 shadow-sm mb-4 bg-teal text-white">
            <div class="card-body p-4">
                <h6 class="text-uppercase fw-bold text-white-50 small tracking-wider mb-4">ACTIVITY SUMMARY</h6>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-white-50">Reservation Completed</span>
                    <h5 class="fw-bold mb-0">0{{ $activeCount }}</h5>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-white-50">Awaiting Payment</span>
                    <h5 class="fw-bold mb-0">0{{ $pendingCount }}</h5>
                </div>
                
                <hr class="border-white opacity-25 my-4">
                
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-white-50">Total Bill</span>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($totalDues, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <!-- Payment Instructions -->
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Payment Instructions</h6>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="bg-light text-teal rounded-circle p-2 me-3">
                        <i class="bi bi-bank"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 small">BCA Bank Transfer</h6>
                        <p class="text-muted small mb-0">DentalCare<br>Rek: 1234567890</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start">
                    <div class="bg-light text-teal rounded-circle p-2 me-3">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 small">Mandiri Bank Transfer</h6>
                        <p class="text-muted small mb-0">DentalCare<br>Rek: 0987654321</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-teal { background-color: var(--primary-teal); }
    .text-teal { color: var(--primary-teal); }
    .border-dashed { border-style: dashed !important; border-width: 2px !important; border-color: #dee2e6 !important; }
    .border-teal { border-color: var(--primary-teal); color: var(--primary-teal); }
    .border-teal:hover { background-color: var(--primary-teal); color: white; }
</style>

@endsection
