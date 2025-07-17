<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'kunjungan_wisata';

    protected $fillable = [
        'wisata_id',
        'pengunjung_id',
        'waktu_kunjungan',
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }

    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class);
    }
}
