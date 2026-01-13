<?php

namespace App\Http\Controllers;

use App\Models\Apbd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApbdController extends Controller
{
    // Public method untuk menampilkan transparansi dana desa
    public function index()
    {
        $apbdList = Apbd::orderBy('tahun', 'desc')->get();
        return view('apbd.index', compact('apbdList'));
    }

    // Admin methods
    public function adminIndex()
    {
        $apbdList = Apbd::orderBy('tahun', 'desc')->paginate(10);
        return view('admin.apbd.index', compact('apbdList'));
    }

    public function create()
    {
        return view('admin.apbd.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:2000',
            'file' => 'required|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        $file = $request->file('file');
        
        // Validasi MIME type PDF
        if ($file->getMimeType() !== 'application/pdf') {
            return back()->withErrors(['file' => 'File harus berformat PDF.'])->withInput();
        }
        
        // Generate nama file aman
        $fileName = time() . '_' . md5($file->getClientOriginalName()) . '.pdf';
        $filePath = $file->storeAs('apbd', $fileName, 'public');

        Apbd::create([
            'tahun' => $request->tahun,
            'judul' => htmlspecialchars($request->judul, ENT_QUOTES, 'UTF-8'),
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.apbd.index')
            ->with('success', 'Data APBD berhasil ditambahkan.');
    }

    public function edit(Apbd $apbd)
    {
        return view('admin.apbd.edit', compact('apbd'));
    }

    public function update(Request $request, Apbd $apbd)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        $data = [
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama
            if (Storage::disk('public')->exists($apbd->file_path)) {
                Storage::disk('public')->delete($apbd->file_path);
            }

            // Upload file baru
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('apbd', $fileName, 'public');
            $data['file_path'] = $filePath;
        }

        $apbd->update($data);

        return redirect()->route('admin.apbd.index')
            ->with('success', 'Data APBD berhasil diperbarui.');
    }

    public function destroy(Apbd $apbd)
    {
        // Hapus file
        if (Storage::disk('public')->exists($apbd->file_path)) {
            Storage::disk('public')->delete($apbd->file_path);
        }

        $apbd->delete();

        return redirect()->route('admin.apbd.index')
            ->with('success', 'Data APBD berhasil dihapus.');
    }

    public function download(Apbd $apbd)
    {
        if (Storage::disk('public')->exists($apbd->file_path)) {
            return Storage::disk('public')->download($apbd->file_path);
        }

        abort(404);
    }
}
