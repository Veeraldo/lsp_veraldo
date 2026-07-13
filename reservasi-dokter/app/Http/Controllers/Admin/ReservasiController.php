<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::with(['user', 'jadwalDokter.dokter'])->latest()->get();
        return view('admin.reservasi.index', compact('reservasis'));
    }

    public function verify(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = $request->status;
        $reservasi->save();
        return redirect()->back()->with('success', 'Status reservasi diperbarui.');
    }
}
