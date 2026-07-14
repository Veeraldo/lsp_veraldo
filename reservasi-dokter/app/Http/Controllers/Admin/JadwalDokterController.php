<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Dokter;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $jadwals = JadwalDokter::with('dokter')->latest()->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $dokters = Dokter::all();
        return view('admin.jadwal.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalDokter::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dokter berhasil ditambahkan.');
    }

    public function edit(JadwalDokter $jadwal)
    {
        $dokters = Dokter::all();
        return view('admin.jadwal.edit', compact('jadwal', 'dokters'));
    }

    public function update(Request $request, JadwalDokter $jadwal)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dokter berhasil diperbarui.');
    }

    public function destroy(JadwalDokter $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dokter berhasil dihapus.');
    }
}
