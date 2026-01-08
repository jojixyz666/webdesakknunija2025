<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apbd extends Model
{
    protected $table = 'apbd';

    protected $fillable = [
        'tahun',
        'judul',
        'deskripsi',
        'file_path',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];
}
