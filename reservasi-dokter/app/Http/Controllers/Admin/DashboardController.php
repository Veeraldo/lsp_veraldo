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
        $pendingPasien = User::where('role', 'pasien')->where('status_akun', 'pending')->count();
        $pendingReservasi = Reservasi::where('status', 'pending')->count();
        $pendingPembayaran = Pembayaran::where('status', 'pending')->count();

        return view('admin.dashboard', compact('pendingPasien', 'pendingReservasi', 'pendingPembayaran'));
    }
}
