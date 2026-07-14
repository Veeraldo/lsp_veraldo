@extends('layouts.admin')
@section('title', 'Buat Pengumuman')

@section('content')
<div class="row">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-medium">Judul Pengumuman</label>
                        <input type="text" id="judul" name="judul" required class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="isi" class="form-label fw-medium">Isi Pengumuman</label>
                        <textarea id="isi" name="isi" rows="5" required class="form-control"></textarea>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="tanggal_publikasi" class="form-label fw-medium">Tanggal Publikasi</label>
                            <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" required class="form-control">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="media" class="form-label fw-medium">Media (Gambar/Video Opsional)</label>
                            <input type="file" id="media" name="media" accept="image/*,video/mp4" class="form-control">
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary">Terbitkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
