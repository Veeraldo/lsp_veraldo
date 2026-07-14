@extends('layouts.admin')
@section('title', 'Kelola Pengumuman')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
        + Buat Pengumuman Baru
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Judul</th>
                        <th>Isi Ringkas</th>
                        <th>Tanggal Publikasi</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengumumans as $pengumuman)
                    <tr>
                        <td class="ps-4 fw-medium">{{ $pengumuman->judul }}</td>
                        <td>{{ Str::limit($pengumuman->isi, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($pengumuman->tanggal_publikasi)->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}" class="btn btn-sm btn-light border me-1">Edit</a>
                            <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus pengumuman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Belum ada pengumuman yang dibuat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
