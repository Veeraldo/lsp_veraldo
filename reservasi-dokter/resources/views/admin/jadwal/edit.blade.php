@extends('layouts.admin')
@section('title', 'Edit Jadwal Dokter')

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold">Formulir Edit Jadwal Praktik</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="dokter_id" class="form-label fw-medium">Pilih Dokter</label>
                        <select id="dokter_id" name="dokter_id" required class="form-select">
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}" {{ $jadwal->dokter_id == $dokter->id ? 'selected' : '' }}>{{ $dokter->nama }} ({{ $dokter->spesialisasi }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-medium">Tanggal Praktik</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ $jadwal->tanggal }}" required class="form-control">
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="jam_mulai" class="form-label fw-medium">Jam Mulai</label>
                            <input type="time" id="jam_mulai" name="jam_mulai" value="{{ substr($jadwal->jam_mulai, 0, 5) }}" required class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="jam_selesai" class="form-label fw-medium">Jam Selesai</label>
                            <input type="time" id="jam_selesai" name="jam_selesai" value="{{ substr($jadwal->jam_selesai, 0, 5) }}" required class="form-control">
                        </div>
                    </div>
                    

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
