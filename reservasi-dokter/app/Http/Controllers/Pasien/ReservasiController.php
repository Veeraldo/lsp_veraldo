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
        $jadwals = JadwalDokter::with('dokter')->where('status', 'tersedia')->get();
        return view('pasien.reservasi.create', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_dokter_id' => 'required|exists:jadwal_dokters,id',
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        $jadwal = JadwalDokter::findOrFail($request->jadwal_dokter_id);

        Reservasi::create([
            'user_id' => Auth::id(),
            'dokter_id' => $jadwal->dokter_id,
            'jadwal_dokter_id' => $jadwal->id,
            'tanggal' => $request->tanggal,
            'status' => 'pending'
        ]);

        return redirect()->route('pasien.reservasi.index')->with('success', 'Reservasi berhasil diajukan, menunggu konfirmasi Admin.');
    }
}
