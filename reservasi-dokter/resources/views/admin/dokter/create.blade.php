@extends('layouts.admin')
@section('title', 'Tambah Dokter Baru')

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 fw-bold">Formulir Data Dokter</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.dokter.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-medium">Nama Dokter</label>
                        <input type="text" id="nama" name="nama" required class="form-control" placeholder="Contoh: drg. Budi Santoso">
                    </div>
                    
                    <div class="mb-3">
                        <label for="spesialisasi" class="form-label fw-medium">Spesialisasi</label>
                        <input type="text" id="spesialisasi" name="spesialisasi" required class="form-control" placeholder="Contoh: Spesialis Ortodonti">
                    </div>
                    
                    <div class="mb-4">
                        <label for="foto" class="form-label fw-medium">Foto Dokter </label>
                        <input type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg" required class="form-control">
                        <div class="form-text">Format: JPG, PNG. Maksimal 2MB.</div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.dokter.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
