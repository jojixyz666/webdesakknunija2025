<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::where('tampilkan', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil gambar dari berita yang ditampilkan
        $beritaDenganGambar = \App\Models\Berita::whereNotNull('gambar')
            ->where('tampilkan', true)
            ->orderBy('tanggal_publikasi', 'desc')
            ->get(['judul', 'slug', 'gambar', 'created_at']);

        return view('galeri.index', [
            'galeri' => $galeri,
            'beritaGambar' => $beritaDenganGambar,
        ]);
    }

    // Admin Methods
    public function adminIndex()
    {
        $galeri = Galeri::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tampilkan' => 'boolean',
        ]);

        $validated['tampilkan'] = $request->has('tampilkan');

        // Upload gambar dengan keamanan tambahan
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            
            // Validasi MIME type secara manual
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors(['gambar' => 'Format file tidak valid.'])->withInput();
            }
            
            // Generate nama file unik dengan hash untuk keamanan
            $fileName = time() . '_' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $validated['gambar'] = $file->storeAs('galeri', $fileName, 'public');
        }

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tampilkan' => 'boolean',
        ]);

        $validated['tampilkan'] = $request->has('tampilkan');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            
            // Validasi MIME type
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors(['gambar' => 'Format file tidak valid.'])->withInput();
            }
            
            // Hapus gambar lama
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            
            // Generate nama file unik
            $fileName = time() . '_' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $validated['gambar'] = $file->storeAs('galeri', $fileName, 'public');
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil dihapus');
    }
}
