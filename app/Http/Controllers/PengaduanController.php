<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email',
            'telepon' => 'nullable|max:20',
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload gambar ke storage/app/public/pengaduan/
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('pengaduan', 'public');
        }

        Pengaduan::create($validated);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim. Kami akan segera menindaklanjuti.');
    }

    public function track(Request $request)
    {
        $pengaduan = null;

        if ($request->has('email')) {
            $pengaduan = Pengaduan::where('email', $request->email)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pengaduan.track', compact('pengaduan'));
    }

    // Admin Methods
    public function adminIndex()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,proses,selesai',
            'tanggapan' => 'nullable|string',
        ]);

        if ($request->filled('tanggapan')) {
            $validated['tanggal_tanggapan'] = now();
        }

        $pengaduan->update($validated);

        return redirect()->route('admin.pengaduan.show', $pengaduan)
            ->with('success', 'Status pengaduan berhasil diperbarui');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->gambar) {
            Storage::disk('public')->delete($pengaduan->gambar);
        }

        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }
}
