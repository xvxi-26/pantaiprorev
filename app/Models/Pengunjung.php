<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'pengunjung';

    protected $fillable = [
        'wisata_id',
        'nama',
        'alamat',
        'notelp',
        'waktu_kunjungan',
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}