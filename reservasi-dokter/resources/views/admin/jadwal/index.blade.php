@extends('layouts.admin')
@section('title', 'Jadwal Praktik Dokter')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
        + Tambah Jadwal
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Dokter</th>
                        <th>Tanggal</th>
                        <th>Jam Praktik</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $jadwal)
                    <tr>
                        <td class="ps-4 fw-medium">{{ $jadwal->dokter->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
                        <td>{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }} WIB</td>
                        <td>
                            @if($jadwal->status == 'tersedia')
                                <span class="badge bg-success">Tersedia</span>
                            @elseif($jadwal->status == 'penuh')
                                <span class="badge bg-warning text-dark">Penuh</span>
                            @else
                                <span class="badge bg-danger">Libur</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-light border me-1">Edit</a>
                            <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus jadwal ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada data jadwal dokter.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
