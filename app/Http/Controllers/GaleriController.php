<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Support\ImageCompressor;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::where('tampilkan', true)
            ->orderBy('urutan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('galeri.index', compact('galeri'));
    }

    // Admin Methods
    public function adminIndex()
    {
        $galeri = Galeri::orderBy('urutan')
            ->orderBy('created_at', 'desc')
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
            // Allow larger uploads (e.g., up to 8MB); we'll compress to ~2MB on store
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:8192',
            'tampilkan' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);

        $validated['tampilkan'] = $request->has('tampilkan');

        // Upload + compress gambar ke storage/app/public/galeri/
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = ImageCompressor::compressAndStore($request->file('gambar'), 'galeri', 2 * 1024 * 1024);
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
            // Allow larger uploads (e.g., up to 8MB); we'll compress to ~2MB on store
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:8192',
            'tampilkan' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);

        $validated['tampilkan'] = $request->has('tampilkan');

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $validated['gambar'] = ImageCompressor::compressAndStore($request->file('gambar'), 'galeri', 2 * 1024 * 1024);
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
