<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengaduan;
use App\Models\Peta;
use App\Models\Galeri;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

    public function editPassword()
    {
        return view('admin.pengaturan.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.password.edit')
            ->with('success', 'Password berhasil diubah.');
    }
}
