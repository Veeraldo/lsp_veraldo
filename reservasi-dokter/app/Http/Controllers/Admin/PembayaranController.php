<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('reservasi.user')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function verify(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = $request->status;
        $pembayaran->save();
        return redirect()->back()->with('success', 'Status pembayaran diperbarui.');
    }
}
