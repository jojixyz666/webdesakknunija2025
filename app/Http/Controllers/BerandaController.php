<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengaturan;

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

        // Ambil galeri
        $galeri = Galeri::where('tampilkan', true)
            ->orderBy('urutan')
            ->limit(6)
            ->get();

        return view('beranda', compact('beritaTerbaru', 'pengumumanTerbaru', 'galeri'));
    }
}
