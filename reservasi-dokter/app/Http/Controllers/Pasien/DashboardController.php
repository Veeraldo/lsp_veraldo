<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('pasien.dashboard', compact('pengumumans'));
    }
}
