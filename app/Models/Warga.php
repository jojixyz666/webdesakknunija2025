<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';

    protected $fillable = [
        'nik',
        'nama',
        'nomor_kk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_perkawinan',
        'status_dalam_keluarga',
        'dusun',
        'rt',
        'rw',
        'alamat',
        'wajib_pilih',
        'kewarganegaraan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'wajib_pilih' => 'boolean',
    ];

    /**
     * Get umur dari tanggal lahir
     */
    public function getUmurAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    /**
     * Get kelompok umur
     */
    public function getKelompokUmurAttribute()
    {
        $umur = $this->umur;
        
        if ($umur < 5) return '0-4 tahun';
        if ($umur < 10) return '5-9 tahun';
        if ($umur < 15) return '10-14 tahun';
        if ($umur < 20) return '15-19 tahun';
        if ($umur < 25) return '20-24 tahun';
        if ($umur < 30) return '25-29 tahun';
        if ($umur < 35) return '30-34 tahun';
        if ($umur < 40) return '35-39 tahun';
        if ($umur < 45) return '40-44 tahun';
        if ($umur < 50) return '45-49 tahun';
        if ($umur < 55) return '50-54 tahun';
        if ($umur < 60) return '55-59 tahun';
        if ($umur < 65) return '60-64 tahun';
        
        return '65+ tahun';
    }

    /**
     * Scope untuk kepala keluarga
     */
    public function scopeKepalaKeluarga($query)
    {
        return $query->where('status_dalam_keluarga', 'Kepala Keluarga');
    }

    /**
     * Scope untuk laki-laki
     */
    public function scopeLakiLaki($query)
    {
        return $query->where('jenis_kelamin', 'L');
    }

    /**
     * Scope untuk perempuan
     */
    public function scopePerempuan($query)
    {
        return $query->where('jenis_kelamin', 'P');
    }

    /**
     * Scope untuk wajib pilih
     */
    public function scopeWajibPilih($query)
    {
        return $query->where('wajib_pilih', true);
    }
}
