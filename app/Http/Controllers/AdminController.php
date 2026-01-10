<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengaduan;
use App\Models\Peta;
use App\Models\Galeri;
use App\Models\Warga;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $statistik = [
            'total_berita' => Berita::count(),
            'total_pengaduan' => Pengaduan::count(),
            'pengaduan_pending' => Pengaduan::where('status', 'pending')->count(),
            'total_lokasi' => Peta::count(),
            'total_galeri' => Galeri::count(),
            'total_penduduk' => Warga::count(),
            'total_kk' => Warga::kepalaKeluarga()->count(),
            'total_laki' => Warga::lakiLaki()->count(),
            'total_perempuan' => Warga::perempuan()->count(),
        ];

        $pengaduanTerbaru = Pengaduan::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $beritaTerbaru = Berita::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('statistik', 'pengaduanTerbaru', 'beritaTerbaru'));
    }
}
