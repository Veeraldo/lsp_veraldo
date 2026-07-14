<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $fillable = [
        'user_id', 'dokter_id', 'jadwal_dokter_id', 'tanggal', 'status', 'harga'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function jadwalDokter()
    {
        return $this->belongsTo(JadwalDokter::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
