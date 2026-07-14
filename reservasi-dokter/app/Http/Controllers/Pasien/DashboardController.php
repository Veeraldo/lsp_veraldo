<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        $upcomingReservasis = Reservasi::with('jadwalDokter.dokter')
            ->where('user_id', Auth::id())
            ->where('tanggal', '>=', now()->toDateString())
            ->whereIn('status', ['pending', 'approved'])
            ->orderBy('tanggal', 'asc')
            ->take(3)
            ->get();
            
        return view('pasien.dashboard', compact('pengumumans', 'upcomingReservasis'));
    }
}
