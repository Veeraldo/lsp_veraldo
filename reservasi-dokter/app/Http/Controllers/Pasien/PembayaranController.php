<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function create($reservasi_id)
    {
        $reservasi = Reservasi::where('user_id', Auth::id())->findOrFail($reservasi_id);
        
        if ($reservasi->status !== 'approved') {
            return redirect()->back()->with('error', 'Reservasi belum disetujui, tidak bisa melakukan pembayaran.');
        }

        if ($reservasi->pembayaran) {
            return redirect()->route('pasien.reservasi.index')->with('error', 'Pembayaran untuk reservasi ini sudah dilakukan.');
        }

        return view('pasien.pembayaran.create', compact('reservasi'));
    }

    public function store(Request $request, $reservasi_id)
    {
        $reservasi = Reservasi::where('user_id', Auth::id())->findOrFail($reservasi_id);

        $request->validate([
            'no_hp' => 'required|string|max:20',
            'nominal' => 'required|numeric|min:1',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $user->update(['no_hp' => $request->no_hp]);

        $path = $request->file('bukti_bayar')->store('pembayarans', 'public');

        Pembayaran::create([
            'reservasi_id' => $reservasi->id,
            'nominal' => $request->nominal,
            'bukti_bayar' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('pasien.reservasi.index')->with('success', 'Bukti pembayaran berhasil diunggah, menunggu verifikasi.');
    }
}
