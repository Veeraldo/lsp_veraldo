@extends('layouts.admin')
@section('title', 'Data Dokter')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">
        + Tambah Dokter Baru
    </a>
</div>

<div class="row g-4">
    @forelse($dokters as $dokter)
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            @if($dokter->foto)
                <img src="{{ asset('storage/' . $dokter->foto) }}" class="card-img-top object-fit-cover" alt="{{ $dokter->nama }}" style="height: 200px;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                    <span>Tanpa Foto</span>
                </div>
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold">{{ $dokter->nama }}</h5>
                <h6 class="card-subtitle mb-3 text-primary">{{ $dokter->spesialisasi }}</h6>
                
                <div class="mt-auto d-flex gap-2">
                    <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-light flex-grow-1 border">Edit</a>
                    <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" class="flex-grow-1 d-flex" onsubmit="return confirm('Hapus dokter ini beserta jadwalnya?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="p-5 text-center bg-white border border-dashed rounded-3">
            <p class="text-muted mb-0">Belum ada data dokter.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
