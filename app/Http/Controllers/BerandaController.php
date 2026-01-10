<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengaturan;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil berita terbaru
        $beritaTerbaru = Berita::where('tampilkan', true)
            ->where('kategori', 'berita')
            ->orderBy('tanggal_publikasi', 'desc')
            ->limit(6)
            ->get();

        // Ambil pengumuman terbaru
        $pengumumanTerbaru = Berita::where('tampilkan', true)
            ->where('kategori', 'pengumuman')
            ->orderBy('tanggal_publikasi', 'desc')
            ->limit(3)
            ->get();

        // Statistik Penduduk dari tabel Warga (sinkronisasi dengan Data Grafis)
        $jumlahPenduduk = Warga::count();
        $jumlahKK = Warga::kepalaKeluarga()->count();
        
        // Hitung jumlah RT dan RW berdasarkan data unik di tabel Warga
        $jumlahRT = Warga::distinct()->whereNotNull('rt')->count('rt');
        $jumlahRW = Warga::distinct()->whereNotNull('rw')->count('rw');

        return view('beranda', compact(
            'beritaTerbaru', 
            'pengumumanTerbaru',
            'jumlahPenduduk',
            'jumlahKK',
            'jumlahRT',
            'jumlahRW'
        ));
    }
}
