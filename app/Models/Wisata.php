<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';

    protected $fillable = [
        'nama',
        'tarif',
        'deskripsi',
        'fasilitas',
        'admin_id',
        'jam_buka',
        'jam_tutup',
    ];

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }
    public function pengunjung()
    {
        return $this->belongsToMany(Pengunjung::class , 'kunjungan_wisata', 'wisata_id', 'pengunjung_id');
    }
}
