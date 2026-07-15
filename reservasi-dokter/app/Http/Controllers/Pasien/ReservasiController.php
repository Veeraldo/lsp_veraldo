<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\JadwalDokter;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::where('user_id', Auth::id())
            ->with('jadwalDokter.dokter', 'pembayaran')
            ->latest()
            ->get();
        return view('pasien.reservasi.index', compact('reservasis'));
    }

    public function create()
    {
        $dokters = \App\Models\Dokter::with('jadwalDokters')->whereHas('jadwalDokters')->get();
        
        $availableSlots = [];

        foreach ($dokters as $dokter) {
            foreach ($dokter->jadwalDokters as $jadwal) {
                $availableSlots[] = [
                    'dokter_id' => $dokter->id,
                    'jadwal_id' => $jadwal->id,
                    'tanggal_display' => \Carbon\Carbon::parse($jadwal->tanggal)->format('l, d M Y'),
                    'jam' => substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5),
                    'sisa_kuota' => 'Tersedia'
                ];
            }
        }

        return view('pasien.reservasi.create', compact('dokters', 'availableSlots'));
    }

    public function store(Request $request)
    {
        if (\Illuminate\Support\Facades\Auth::user()->status_akun !== 'approved') {
            return back()->with('error', 'Akun Anda belum disetujui. Anda tidak dapat membuat reservasi saat ini.');
        }

        $request->validate([
            'jadwal_dokter_id' => 'required|exists:jadwal_dokters,id',
        ]);
        
        $jadwalId = $request->jadwal_dokter_id;
        $jadwal = \App\Models\JadwalDokter::findOrFail($jadwalId);
        
        Reservasi::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'dokter_id' => $jadwal->dokter_id,
            'jadwal_dokter_id' => $jadwal->id,
            'tanggal' => $jadwal->tanggal,
            'status' => 'pending'
        ]);

        return redirect()->route('pasien.reservasi.index')->with('success', 'Reservasi berhasil diajukan, menunggu konfirmasi Admin.');
    }

    public function edit($id)
    {
        $reservasi = Reservasi::where('user_id', Auth::id())->where('status', 'pending')->findOrFail($id);
        $dokters = \App\Models\Dokter::with('jadwalDokters')->whereHas('jadwalDokters')->get();
        
        $availableSlots = [];
        foreach ($dokters as $dokter) {
            foreach ($dokter->jadwalDokters as $jadwal) {
                $availableSlots[] = [
                    'dokter_id' => $dokter->id,
                    'jadwal_id' => $jadwal->id,
                    'tanggal_display' => \Carbon\Carbon::parse($jadwal->tanggal)->format('l, d M Y'),
                    'jam' => substr($jadwal->jam_mulai, 0, 5) . ' - ' . substr($jadwal->jam_selesai, 0, 5),
                    'sisa_kuota' => 'Tersedia'
                ];
            }
        }
        return view('pasien.reservasi.edit', compact('reservasi', 'dokters', 'availableSlots'));
    }

    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::where('user_id', Auth::id())->where('status', 'pending')->findOrFail($id);
        
        if (\Illuminate\Support\Facades\Auth::user()->status_akun !== 'approved') {
            return back()->with('error', 'Akun Anda belum disetujui.');
        }

        $request->validate([
            'jadwal_dokter_id' => 'required|exists:jadwal_dokters,id',
        ]);
        
        $jadwal = \App\Models\JadwalDokter::findOrFail($request->jadwal_dokter_id);
        
        $reservasi->update([
            'dokter_id' => $jadwal->dokter_id,
            'jadwal_dokter_id' => $jadwal->id,
            'tanggal' => $jadwal->tanggal,
        ]);

        return redirect()->route('pasien.reservasi.index')->with('success', 'Reservasi berhasil dijadwalkan ulang.');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::where('user_id', Auth::id())->where('status', 'pending')->findOrFail($id);
        $reservasi->delete();
        
        return redirect()->route('pasien.reservasi.index')->with('success', 'Request reservasi berhasil dibatalkan.');
    }
}
