@extends('layouts.admin')
@section('title', 'Verifikasi Reservasi')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Pasien</th>
                        <th>Dokter</th>
                        <th>Jadwal</th>
                        <th>Status Reservasi</th>
                        <th>Tagihan</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasis as $reservasi)
                    <tr>
                        <td class="ps-4 fw-medium">{{ $reservasi->user->name }}</td>
                        <td>{{ $reservasi->jadwalDokter->dokter->nama ?? '-' }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d M Y') }}<br>
                            <small class="text-muted">{{ $reservasi->jadwalDokter->hari ?? '' }}, {{ substr($reservasi->jadwalDokter->jam_mulai ?? '', 0, 5) }} WIB</small>
                        </td>
                        <td>
                            @if($reservasi->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                            @elseif($reservasi->status == 'approved')
                                <span class="badge bg-primary">Disetujui</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if($reservasi->status == 'pending')
                                <div class="input-group input-group-sm" style="width: 130px;">
                                    <span class="input-group-text bg-light border-0">Rp</span>
                                    <input type="text" form="form-verify-{{ $reservasi->id }}" class="form-control format-rupiah text-end border-start-0" placeholder="0" required>
                                    <input type="hidden" form="form-verify-{{ $reservasi->id }}" name="harga" class="harga-real">
                                </div>
                            @elseif($reservasi->status == 'approved')
                                <span class="fw-bold">Rp {{ number_format($reservasi->harga, 0, ',', '.') }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if($reservasi->status == 'pending')
                            <form id="form-verify-{{ $reservasi->id }}" action="{{ route('admin.reservasi.verify', $reservasi->id) }}" method="POST" class="d-inline-flex align-items-center">
                                @csrf
                                <button type="submit" name="status" value="approved" class="btn btn-sm btn-success me-1">Setujui</button>
                                <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger">Tolak</button>
                            </form>
                            @else
                            <span class="text-muted fst-italic small">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Tidak ada pengajuan reservasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.format-rupiah');
    inputs.forEach(input => {
        input.addEventListener('keyup', function(e) {
            let val = this.value.replace(/[^0-9]/g, '');
            let realInput = this.closest('.input-group').querySelector('.harga-real');
            
            if(val) {
                realInput.value = val;
                this.value = parseInt(val, 10).toLocaleString('id-ID');
            } else {
                realInput.value = '';
                this.value = '';
            }
        });
    });
});
</script>
@endsection
