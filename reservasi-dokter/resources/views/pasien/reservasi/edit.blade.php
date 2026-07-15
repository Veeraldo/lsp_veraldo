@extends('layouts.pasien')
@section('title', 'Schedule Appointment')

@section('content')

@php
    $isPending = auth()->user()->status_akun !== 'approved';
@endphp

<div class="mb-5">
    <h1 class="display-6 fw-bold text-dark mb-2">Reschedule Appointment</h1>
    <p class="text-muted fs-5">Complete the following steps to secure your dental consultation.</p>
</div>

@if($isPending)
<div class="alert alert-danger rounded-4 shadow-sm mb-4 border-0 p-4" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-lock-fill text-danger fs-4 me-3"></i>
        <div>
            <h6 class="fw-bold mb-1 text-danger">Account Pending</h6>
            <p class="mb-0 text-danger opacity-75 small">You cannot book an appointment until your account is verified by an Admin.</p>
        </div>
    </div>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger rounded-4 shadow-sm mb-4 border-0 p-4" role="alert">
    <div class="d-flex align-items-center mb-2">
        <i class="bi bi-exclamation-triangle-fill text-danger fs-5 me-2"></i>
        <h6 class="fw-bold mb-0 text-danger">Gagal membuat reservasi</h6>
    </div>
    <ul class="mb-0 text-danger opacity-75 small ms-3">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('pasien.reservasi.update', $reservasi->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row g-5">
        <!-- Left Column: Steps -->
        <div class="col-lg-8">
            
            <!-- Step Indicators -->
            <div class="d-flex mb-4 pb-2 border-bottom" id="step-headers">
                <div class="me-4 fw-bold step-header active-step" id="header-step-1" style="border-bottom: 2px solid var(--primary-teal); padding-bottom: 10px; color: var(--primary-teal);">
                    1. Select Specialist
                </div>
                <div class="me-4 text-muted fw-semibold step-header" id="header-step-2" style="padding-bottom: 10px;">
                    2. Select Doctor
                </div>
                <div class="text-muted fw-semibold step-header" id="header-step-3" style="padding-bottom: 10px;">
                    3. Date & Time
                </div>
            </div>

            <!-- STEP 1 CONTAINER (Specialization) -->
            <div id="step-1-container">
                <div class="row g-4 mb-4">
                    @php
                        $spesialisasies = $dokters->pluck('spesialisasi')->unique();
                    @endphp
                    @if($spesialisasies->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-light border rounded-4 text-center p-5 text-muted">
                                No specialists are available at the moment.
                            </div>
                        </div>
                    @else
                        @foreach($spesialisasies as $index => $spec)
                        <div class="col-md-6">
                            <input type="radio" name="spesialisasi" value="{{ $spec }}" id="spec_{{ $index }}" class="btn-check spec-radio">
                            <label class="card border border-2 rounded-4 p-4 h-100 cursor-pointer shadow-sm spec-card text-center transition hover-shadow" for="spec_{{ $index }}" style="cursor:pointer;">
                                <div class="bg-light-teal rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px;">
                                    <i class="bi bi-heart-pulse text-teal fs-2"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">{{ $spec }}</h5>
                                <p class="small text-muted mb-0">General & Specialized Care</p>
                            </label>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="d-flex justify-content-end mt-4 pt-4 border-top">
                    <button type="button" id="btn-next-1" class="btn btn-teal rounded-pill px-4 py-2 fw-bold shadow-sm" disabled>Next: Select Doctor <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </div>

            <!-- STEP 2 CONTAINER (Doctor) -->
            <div id="step-2-container" style="display: none;">
                <div class="alert bg-light border text-muted small rounded-3 mb-4">
                    <i class="bi bi-info-circle me-1"></i> Specialization: <strong id="selected-spec-text" class="text-dark">None</strong>
                </div>
                <div class="row g-4 mb-4" id="doctor-list">
                    @foreach($dokters as $dokter)
                    <div class="col-md-6 doctor-item" data-spec="{{ $dokter->spesialisasi }}">
                        <input type="radio" name="dokter_id" value="{{ $dokter->id }}" id="dokter_{{ $dokter->id }}" class="btn-check doctor-radio">
                        <label class="card border border-2 rounded-4 p-3 h-100 cursor-pointer shadow-sm doctor-card" for="dokter_{{ $dokter->id }}" style="cursor:pointer;">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle overflow-hidden me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 60px; height: 60px;">
                                    @if($dokter->foto)
                                        <img src="{{ asset('storage/' . $dokter->foto) }}" class="w-100 h-100 object-fit-cover" alt="Doctor">
                                    @else
                                        <i class="bi bi-person text-secondary fs-3"></i>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">{{ $dokter->nama }}</h6>
                                    <p class="small text-muted mb-0 text-uppercase tracking-wider" style="font-size: 0.75rem;">{{ $dokter->spesialisasi }}</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                    <button type="button" id="btn-back-1" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold"><i class="bi bi-arrow-left me-2"></i> Back</button>
                    <button type="button" id="btn-next-2" class="btn btn-teal rounded-pill px-4 py-2 fw-bold shadow-sm" disabled>Next: Date & Time <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </div>

            <!-- STEP 3 CONTAINER (Date & Time Slots) -->
            <div id="step-3-container" style="display: none;">
                <div class="alert bg-light border text-muted small rounded-3 mb-4">
                    <i class="bi bi-info-circle me-1"></i> Doctor: <strong id="selected-doc-name" class="text-dark">None</strong> 
                </div>
                
                <h6 class="fw-bold mb-3 text-teal">Available Schedule Slots</h6>
                <div class="row g-4 mb-4" id="slot-list">
                    @forelse($availableSlots as $slot)
                    <div class="col-md-6 slot-item" data-doc="{{ $slot['dokter_id'] }}">
                        <input type="radio" name="jadwal_dokter_id" value="{{ $slot['jadwal_id'] }}" id="slot_{{ $slot['jadwal_id'] }}" class="btn-check slot-radio" required {{ $isPending ? 'disabled' : '' }}>
                        <label class="card border border-2 rounded-4 p-3 h-100 cursor-pointer shadow-sm slot-card" for="slot_{{ $slot['jadwal_id'] }}" style="cursor:pointer;">
                            <div class="d-flex align-items-center">
                                <div class="bg-light-teal rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="bi bi-clock text-teal fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark slot-date-text">{{ $slot['tanggal_display'] }}</h6>
                                    <p class="small text-muted mb-0 slot-time-text">{{ $slot['jam'] }} </p>
                                </div>
                            </div>
                        </label>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-light border rounded-4 text-center p-4 text-muted">
                            No available slots for this doctor.
                        </div>
                    </div>
                    @endforelse
                </div>
                
                <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                    <button type="button" id="btn-back-2" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold"><i class="bi bi-arrow-left me-2"></i> Back</button>
                    <button type="button" id="btn-next-3" class="btn btn-teal rounded-pill px-4 py-2 fw-bold shadow-sm" disabled>Review Details <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </div>

            <!-- STEP 4 CONTAINER (Summary / Finish) -->
            <div id="step-4-container" style="display: none;">
                <div class="alert alert-success bg-opacity-10 border-success rounded-4 p-4 text-center">
                    <i class="bi bi-check-circle-fill text-success fs-1 mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark">Great! Almost done.</h5>
                    <p class="text-muted mb-0">Please review your booking summary on the right and click <strong>Confirm & Book</strong> to secure your slot.</p>
                </div>
                <div class="mt-4 pt-4 border-top">
                    <button type="button" id="btn-back-3" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold"><i class="bi bi-arrow-left me-2"></i> Back</button>
                </div>
            </div>

        </div>

        <!-- Right Column: Summary -->
        <div class="col-lg-4">
            <div class="card border-0 rounded-4 bg-light shadow-sm sticky-top" style="top: 100px;">
                <div class="card-body p-4 p-xl-5">
                    <h5 class="fw-bold mb-4">Booking Summary</h5>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-person-badge text-teal me-2"></i>
                            <span class="small text-muted fw-semibold">Specialist</span>
                        </div>
                        <p class="fw-bold text-dark mb-0 ms-4" id="summary-specialist">Not selected</p>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-calendar text-teal me-2"></i>
                            <span class="small text-muted fw-semibold">Date & Time</span>
                        </div>
                        <p class="fw-bold text-dark mb-0 ms-4" id="summary-date">Not selected</p>
                    </div>

                    <hr class="my-4 border-secondary opacity-25">

                    <button type="submit" id="btn-submit-final" class="btn btn-teal w-100 py-3 fw-bold rounded-pill shadow-sm" disabled>
                        Confirm & Book <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                    
                    <div class="text-center mt-3">
                        <p class="small text-muted mb-0" style="font-size: 0.75rem;">A confirmation will be sent immediately after booking.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .btn-check:checked + .doctor-card,
    .btn-check:checked + .spec-card,
    .btn-check:checked + .slot-card {
        border-color: var(--primary-teal) !important;
        background-color: var(--light-teal);
    }
    .text-teal { color: var(--primary-teal); }
    .bg-teal { background-color: var(--primary-teal); }
    .bg-light-teal { background-color: rgba(32,185,180,0.15); }
    .step-header { transition: all 0.3s ease; }
</style>

<script>
    const isPending = {{ $isPending ? 'true' : 'false' }};
    
    // UI Elements
    const step1Container = document.getElementById('step-1-container');
    const step2Container = document.getElementById('step-2-container');
    const step3Container = document.getElementById('step-3-container');
    const step4Container = document.getElementById('step-4-container');
    
    const headerStep1 = document.getElementById('header-step-1');
    const headerStep2 = document.getElementById('header-step-2');
    const headerStep3 = document.getElementById('header-step-3');
    
    const btnNext1 = document.getElementById('btn-next-1');
    const btnNext2 = document.getElementById('btn-next-2');
    const btnNext3 = document.getElementById('btn-next-3');
    
    const btnBack1 = document.getElementById('btn-back-1');
    const btnBack2 = document.getElementById('btn-back-2');
    const btnBack3 = document.getElementById('btn-back-3');
    const btnSubmit = document.getElementById('btn-submit-final');
    
    // Step 1: Select Specialization
    document.querySelectorAll('.spec-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const selectedSpec = this.value;
            document.getElementById('selected-spec-text').innerText = selectedSpec;
            
            // Filter doctors
            document.querySelectorAll('.doctor-item').forEach(item => {
                if (item.getAttribute('data-spec') === selectedSpec) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                    // uncheck if hidden
                    const rb = item.querySelector('.doctor-radio');
                    if(rb.checked) {
                        rb.checked = false;
                        btnNext2.disabled = true;
                    }
                }
            });
            
            // Enable next button instead of auto advance
            btnNext1.disabled = false;
        });
    });
    
    btnNext1.addEventListener('click', () => {
        step1Container.style.display = 'none';
        step2Container.style.display = 'block';
        setActiveHeader(2);
    });
    
    // Step 2: Select Doctor
    document.querySelectorAll('.doctor-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const selectedDocId = this.value;
            const label = this.nextElementSibling;
            const docName = label.querySelector('h6').innerText;
            
            // Update Summary
            document.getElementById('summary-specialist').innerText = docName;
            
            // Update Step 3 Hints
            document.getElementById('selected-doc-name').innerText = docName;
            
            // Filter Slots
            let hasSlots = false;
            document.querySelectorAll('.slot-item').forEach(item => {
                if (item.getAttribute('data-doc') === selectedDocId) {
                    item.style.display = 'block';
                    hasSlots = true;
                } else {
                    item.style.display = 'none';
                    const rb = item.querySelector('.slot-radio');
                    if(rb.checked) {
                        rb.checked = false;
                        btnNext3.disabled = true;
                        document.getElementById('summary-date').innerText = 'Not selected';
                    }
                }
            });
            
            // Enable next button
            btnNext2.disabled = false;
            
            // Auto advance to Step 3
            step2Container.style.display = 'none';
            step3Container.style.display = 'block';
            setActiveHeader(3);
        });
    });
    
    // Step 3: Select Slot
    document.querySelectorAll('.slot-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            if(!isPending) {
                const label = this.nextElementSibling;
                const dateText = label.querySelector('.slot-date-text').innerText;
                const timeText = label.querySelector('.slot-time-text').innerText;
                
                document.getElementById('summary-date').innerHTML = dateText + '<br>' + timeText;
                btnNext3.disabled = false;
            }
        });
    });

    // Navigation Logic
    function setActiveHeader(step) {
        // Reset all
        [headerStep1, headerStep2, headerStep3].forEach(el => {
            el.style.borderBottom = 'none';
            el.style.color = '';
            el.classList.remove('text-teal', 'fw-bold');
            el.classList.add('text-muted');
        });
        
        // Set active
        let activeEl = step === 1 ? headerStep1 : (step === 2 ? headerStep2 : headerStep3);
        if(step === 4) activeEl = headerStep3;
        activeEl.style.borderBottom = '2px solid var(--primary-teal)';
        activeEl.style.color = 'var(--primary-teal)';
        activeEl.classList.add('text-teal', 'fw-bold');
        activeEl.classList.remove('text-muted');
    }
    
    btnBack1.addEventListener('click', () => {
        step2Container.style.display = 'none';
        step1Container.style.display = 'block';
        setActiveHeader(1);
    });
    
    btnBack2.addEventListener('click', () => {
        step3Container.style.display = 'none';
        step2Container.style.display = 'block';
        setActiveHeader(2);
    });
    
    btnNext3.addEventListener('click', () => {
        step3Container.style.display = 'none';
        step4Container.style.display = 'block';
        if(!isPending) btnSubmit.disabled = false;
    });
    
    btnBack3.addEventListener('click', () => {
        step4Container.style.display = 'none';
        step3Container.style.display = 'block';
        btnSubmit.disabled = true;
    });
    
</script>
@endsection
