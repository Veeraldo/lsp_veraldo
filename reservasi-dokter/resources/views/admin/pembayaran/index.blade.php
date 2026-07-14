@extends('layouts.admin')
@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Pasien</th>
                        <th>Tanggal Reservasi</th>
                        <th>Nominal</th>
                        <th>Bukti Bayar</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $pembayaran)
                    <tr>
                        <td class="ps-4 fw-medium">{{ $pembayaran->reservasi->user->name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($pembayaran->reservasi->tanggal ?? now())->format('d M Y') }}</td>
                        <td class="fw-medium text-primary">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" target="_blank" class="text-decoration-none">Lihat Bukti</a>
                        </td>
                        <td>
                            @if($pembayaran->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($pembayaran->status == 'approved')
                                <span class="badge bg-success">Lunas</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if($pembayaran->status == 'pending')
                            <form action="{{ route('admin.pembayaran.verify', $pembayaran->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" name="status" value="approved" class="btn btn-sm btn-success me-1">Valid</button>
                                <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger" onclick="return confirm('Tolak pembayaran ini?')">Tidak Valid</button>
                            </form>
                            @else
                            <span class="text-muted fst-italic small">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Tidak ada data pembayaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
