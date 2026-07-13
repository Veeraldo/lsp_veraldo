<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = ['admin_id', 'judul', 'isi', 'media', 'tanggal_publikasi'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
