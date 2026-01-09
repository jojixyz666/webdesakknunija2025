<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataApbdes extends Model
{
    protected $table = 'data_apbdes';

    protected $fillable = [
        'tahun',
        'kategori',
        'jenis',
        'jumlah',
        'urutan',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'jumlah' => 'decimal:2',
        'urutan' => 'integer',
    ];
}
