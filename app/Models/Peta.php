<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peta extends Model
{
    use HasFactory;

    protected $table = 'peta';

    protected $fillable = [
        'nama_lokasi',
        'deskripsi',
        'latitude',
        'longitude',
        'kategori',
        'icon',
        'gambar',
        'tampilkan',
    ];

    protected $casts = [
        'tampilkan' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function getKategoriLabelAttribute()
    {
        $labels = [
            'fasilitas_umum' => 'Fasilitas Umum',
            'wisata' => 'Wisata',
            'pemerintahan' => 'Pemerintahan',
            'lainnya' => 'Lainnya',
        ];

        return $labels[$this->kategori] ?? 'Lainnya';
    }
}
