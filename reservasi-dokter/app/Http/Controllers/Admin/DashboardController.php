<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingPasienCount = User::where('role', 'pasien')->where('status_akun', 'pending')->count();
        $pendingReservasiCount = Reservasi::where('status', 'pending')->count();
        $pendingPembayaranCount = Pembayaran::where('status', 'pending')->count();

        return view('admin.dashboard', compact('pendingPasienCount', 'pendingReservasiCount', 'pendingPembayaranCount'));
    }
}
