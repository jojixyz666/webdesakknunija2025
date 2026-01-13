<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:berita,pengumuman',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tampilkan' => 'boolean',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['tampilkan'] = $request->has('tampilkan');

        // Upload gambar dengan keamanan tambahan
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            
            // Validasi MIME type secara manual
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors(['gambar' => 'Format file tidak valid.']);
            }
            
            // Generate nama file unik dengan hash untuk keamanan
            $fileName = time() . '_' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $validated['gambar'] = $file->storeAs('berita', $fileName, 'public');
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
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:berita,pengumuman',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
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
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
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
