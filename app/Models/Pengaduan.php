<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'judul',
        'deskripsi',
        'gambar',
        'status',
        'tanggapan',
        'tanggal_tanggapan',
    ];

    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
            'proses' => '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Proses</span>',
            'selesai' => '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>',
        ];

        return $badges[$this->status] ?? '';
    }
}
