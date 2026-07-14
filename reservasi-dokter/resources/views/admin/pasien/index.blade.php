@extends('layouts.admin')
@section('title', 'Verifikasi Pasien')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 fw-bold">Daftar Akun Pasien Baru</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasiens as $pasien)
                    <tr>
                        <td class="ps-4 fw-medium">{{ $pasien->name }}</td>
                        <td>{{ $pasien->email }}</td>
                        <td>{{ $pasien->no_hp ?? '-' }}</td>
                        <td>
                            @if($pasien->status_akun == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($pasien->status_akun == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if($pasien->status_akun == 'pending')
                            <form action="{{ route('admin.pasien.verify', $pasien->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" name="status_akun" value="approved" class="btn btn-sm btn-success me-1">Setujui</button>
                                <button type="submit" name="status_akun" value="rejected" class="btn btn-sm btn-danger" onclick="return confirm('Tolak akun ini?')">Tolak</button>
                            </form>
                            @else
                            <span class="text-muted fst-italic small">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Tidak ada pendaftaran pasien baru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
