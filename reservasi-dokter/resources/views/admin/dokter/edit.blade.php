@extends('layouts.admin')
@section('title', 'Edit Data Dokter')

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold">Formulir Edit Data Dokter</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-medium">Nama Dokter</label>
                        <input type="text" id="nama" name="nama" value="{{ $dokter->nama }}" required class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="spesialisasi" class="form-label fw-medium">Spesialisasi</label>
                        <input type="text" id="spesialisasi" name="spesialisasi" value="{{ $dokter->spesialisasi }}" required class="form-control">
                    </div>
                    
                    @if($dokter->foto)
                    <div class="mb-3">
                        <label class="form-label fw-medium d-block">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $dokter->foto) }}" alt="Foto {{ $dokter->nama }}" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    @endif
                    
                    <div class="mb-4">
                        <label for="foto" class="form-label fw-medium">Upload Foto Baru (Opsional)</label>
                        <input type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg" class="form-control">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG. Maks 2MB.</div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.dokter.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
