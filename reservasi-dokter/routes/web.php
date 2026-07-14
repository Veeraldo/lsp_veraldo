<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PasienController as AdminPasien;
use App\Http\Controllers\Admin\DokterController as AdminDokter;
use App\Http\Controllers\Admin\JadwalDokterController as AdminJadwal;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasi;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaran;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumuman;

// Pasien Controllers
use App\Http\Controllers\Pasien\DashboardController as PasienDashboard;
use App\Http\Controllers\Pasien\ReservasiController as PasienReservasi;
use App\Http\Controllers\Pasien\PembayaranController as PasienPembayaran;

Route::get('/', function () {
    return view('LandingPage');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Verifikasi Pasien Baru
    Route::get('/pasien', [AdminPasien::class, 'index'])->name('pasien.index');
    Route::post('/pasien/{id}/verify', [AdminPasien::class, 'verify'])->name('pasien.verify');

    // CRUD Dokter
    Route::resource('dokter', AdminDokter::class);
    
    // CRUD Jadwal Dokter
    Route::resource('jadwal', AdminJadwal::class);
    
    // Verifikasi Reservasi
    Route::get('/reservasi', [AdminReservasi::class, 'index'])->name('reservasi.index');
    Route::post('/reservasi/{id}/verify', [AdminReservasi::class, 'verify'])->name('reservasi.verify');
    
    // Verifikasi Pembayaran
    Route::get('/pembayaran', [AdminPembayaran::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{id}/verify', [AdminPembayaran::class, 'verify'])->name('pembayaran.verify');
    
    // CRUD Pengumuman
    Route::resource('pengumuman', AdminPengumuman::class);
});

// Routes Pasien
Route::middleware(['auth', 'pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', [PasienDashboard::class, 'index'])->name('dashboard');
    
    // Reservasi
    Route::get('/reservasi', [PasienReservasi::class, 'index'])->name('reservasi.index');
    Route::get('/reservasi/create', [PasienReservasi::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi', [PasienReservasi::class, 'store'])->name('reservasi.store');
    
    // Pembayaran
    Route::get('/pembayaran/{reservasi}/create', [PasienPembayaran::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran/{reservasi}', [PasienPembayaran::class, 'store'])->name('pembayaran.store');
});
