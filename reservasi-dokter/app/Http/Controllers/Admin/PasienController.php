<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->latest()->get();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'status_akun' => 'required|in:approved,rejected'
        ]);

        $pasien = User::where('role', 'pasien')->findOrFail($id);
        $pasien->status_akun = $request->status_akun;
        $pasien->save();

        return redirect()->back()->with('success', 'Status akun pasien berhasil diperbarui.');
    }
}
