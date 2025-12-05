<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::orderBy('grup')->orderBy('kunci')->get()->groupBy('grup');

        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $kunci => $nilai) {
            $pengaturan = Pengaturan::where('kunci', $kunci)->first();

            if ($pengaturan) {
                // Jika tipe image dan ada file upload
                if ($pengaturan->tipe === 'image' && $request->hasFile($kunci)) {
                    // Hapus gambar lama
                    if ($pengaturan->nilai) {
                        Storage::disk('public')->delete($pengaturan->nilai);
                    }

                    // Upload gambar baru ke storage/app/public/pengaturan/
                    $nilai = $request->file($kunci)->store('pengaturan', 'public');
                } elseif ($pengaturan->tipe === 'image' && empty($nilai)) {
                    // Jika tipe image tapi tidak ada upload, skip (jangan update)
                    continue;
                }

                // Jika nilai kosong untuk field text/textarea, set ke string kosong
                if (empty($nilai) && in_array($pengaturan->tipe, ['text', 'textarea', 'number'])) {
                    $nilai = '';
                }

                // Update nilai
                Pengaturan::atur($kunci, $nilai, $pengaturan->tipe, $pengaturan->grup);
            }
        }

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan berhasil diperbarui');
    }
}
