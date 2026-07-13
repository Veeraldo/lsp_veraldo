<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = ['nama', 'spesialisasi', 'foto'];

    public function jadwalDokters()
    {
        return $this->hasMany(JadwalDokter::class);
    }

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}
