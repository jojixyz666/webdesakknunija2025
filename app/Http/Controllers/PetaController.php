<?php

namespace App\Http\Controllers;

use App\Models\Peta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaController extends Controller
{
    public function index()
    {
        $lokasi = Peta::where('tampilkan', true)->get();

        return view('peta.index', compact('lokasi'));
    }

    public function apiLokasi()
    {
        $lokasi = Peta::where('tampilkan', true)
            ->select('id', 'nama_lokasi', 'deskripsi', 'latitude', 'longitude', 'kategori', 'icon', 'gambar')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_lokasi' => $item->nama_lokasi,
                    'deskripsi' => $item->deskripsi,
                    'latitude' => (float) $item->latitude,
                    'longitude' => (float) $item->longitude,
                    'kategori' => $item->kategori,
                    'kategori_label' => $item->kategori_label,
                    'icon' => $item->icon,
                    'gambar_url' => $item->gambar_url,
                ];
            });

        return response()->json($lokasi);
    }

    // Admin Methods
    public function adminIndex()
    {
        $peta = Peta::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.peta.index', compact('peta'));
    }

    public function create()
    {
        return view('admin.peta.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'kategori' => 'required|in:fasilitas_umum,wisata,pemerintahan,lainnya',
            'icon' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tampilkan' => 'boolean',
        ]);

        $validated['tampilkan'] = $request->has('tampilkan');

        // Upload gambar dengan keamanan tambahan
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            
            // Validasi MIME type
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors(['gambar' => 'Format file tidak valid.'])->withInput();
            }
            
            // Generate nama file unik
            $fileName = time() . '_' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $validated['gambar'] = $file->storeAs('peta', $fileName, 'public');
        }

        Peta::create($validated);

        return redirect()->route('admin.peta.index')
            ->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function edit(Peta $peta)
    {
        return view('admin.peta.edit', compact('peta'));
    }

    public function update(Request $request, Peta $peta)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|max:255',
            'deskripsi' => 'nullable',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'kategori' => 'required|in:fasilitas_umum,wisata,pemerintahan,lainnya',
            'icon' => 'nullable|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tampilkan' => 'boolean',
        ]);

        $validated['tampilkan'] = $request->has('tampilkan');

        if ($request->hasFile('gambar')) {
            if ($peta->gambar) {
                Storage::disk('public')->delete($peta->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('peta', 'public');
        }

        $peta->update($validated);

        return redirect()->route('admin.peta.index')
            ->with('success', 'Lokasi berhasil diperbarui');
    }

    public function destroy(Peta $peta)
    {
        if ($peta->gambar) {
            Storage::disk('public')->delete($peta->gambar);
        }

        $peta->delete();

        return redirect()->route('admin.peta.index')
            ->with('success', 'Lokasi berhasil dihapus');
    }
}
