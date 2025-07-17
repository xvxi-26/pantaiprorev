<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budaya extends Model
{
    protected $table = 'budaya';

    protected $fillable = [
        'nama',
        'deskripsi',
        'url_gambar',
        'url_video',
        'admin_id'
    ];
}
