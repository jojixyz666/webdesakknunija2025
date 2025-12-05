<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan';

    protected $fillable = [
        'kunci',
        'nilai',
        'tipe',
        'grup',
    ];

    /**
     * Helper untuk mengambil nilai pengaturan
     * Contoh: Pengaturan::ambil('nama_desa')
     */
    public static function ambil($kunci, $default = null)
    {
        return Cache::remember("pengaturan_{$kunci}", 3600, function () use ($kunci, $default) {
            $pengaturan = self::where('kunci', $kunci)->first();
            return $pengaturan ? $pengaturan->nilai : $default;
        });
    }

    /**
     * Helper untuk mengatur nilai pengaturan
     * Contoh: Pengaturan::atur('nama_desa', 'Desa Maju Jaya')
     */
    public static function atur($kunci, $nilai, $tipe = 'text', $grup = 'umum')
    {
        $pengaturan = self::updateOrCreate(
            ['kunci' => $kunci],
            [
                'nilai' => $nilai,
                'tipe' => $tipe,
                'grup' => $grup,
            ]
        );

        Cache::forget("pengaturan_{$kunci}");

        return $pengaturan;
    }

    /**
     * Ambil URL gambar untuk pengaturan tipe image
     */
    public function getUrlAttribute()
    {
        if ($this->tipe === 'image' && $this->nilai) {
            return asset('storage/' . $this->nilai);
        }
        return $this->nilai;
    }
}
