<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $fillable = ['dokter_id', 'hari', 'jam_mulai', 'jam_selesai', 'status'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}
