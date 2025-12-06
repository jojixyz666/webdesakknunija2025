<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Support\ImageCompressor;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('user')
            ->where('tampilkan', true)
            ->orderBy('tanggal_publikasi', 'desc')
            ->paginate(9);

        return view('berita.index', compact('berita'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('tampilkan', true)
            ->firstOrFail();

        $beritaTerkait = Berita::where('kategori', $berita->kategori)
            ->where('id', '!=', $berita->id)
            ->where('tampilkan', true)
            ->limit(3)
            ->get();

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }

    // Admin Methods
    public function adminIndex()
    {
        $berita = Berita::with('user')
            ->orderBy('tanggal_publikasi', 'desc')
            ->paginate(15);

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'kategori' => 'required|in:berita,pengumuman',
            // Allow larger uploads (e.g., up to 8MB); we'll compress to ~2MB on store
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:8192',
            'tampilkan' => 'boolean',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['tampilkan'] = $request->has('tampilkan');

        // Upload + compress gambar ke storage/app/public/berita/
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = ImageCompressor::compressAndStore($request->file('gambar'), 'berita', 2 * 1024 * 1024);
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'kategori' => 'required|in:berita,pengumuman',
            // Allow larger uploads (e.g., up to 8MB); we'll compress to ~2MB on store
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:8192',
            'tampilkan' => 'boolean',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        $validated['tampilkan'] = $request->has('tampilkan');

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = ImageCompressor::compressAndStore($request->file('gambar'), 'berita', 2 * 1024 * 1024);
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        // Hapus gambar
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}
