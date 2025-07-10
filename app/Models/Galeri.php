<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'wisata_id',
        'nama',
        'url_gambar',
        'url_video',
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}
