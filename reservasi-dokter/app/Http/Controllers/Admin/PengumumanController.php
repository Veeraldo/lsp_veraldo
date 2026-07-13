<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,mp4|max:10240',
            'tanggal_publikasi' => 'required|date',
        ]);

        $data = $request->all();
        $data['admin_id'] = Auth::id();

        if ($request->hasFile('media')) {
            $data['media'] = $request->file('media')->store('pengumumans', 'public');
        }

        Pengumuman::create($data);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,mp4|max:10240',
            'tanggal_publikasi' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('media')) {
            if ($pengumuman->media) {
                Storage::disk('public')->delete($pengumuman->media);
            }
            $data['media'] = $request->file('media')->store('pengumumans', 'public');
        }

        $pengumuman->update($data);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->media) {
            Storage::disk('public')->delete($pengumuman->media);
        }
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman dihapus.');
    }
}
