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
            'nama' => 'required|string|max:255|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|min:10|max:2000',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'telepon.regex' => 'Format telepon tidak valid.',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 2000 karakter.',
        ]);

        // Upload gambar dengan keamanan tambahan
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            
            // Validasi MIME type secara manual
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return back()->withErrors(['gambar' => 'Format file tidak valid.'])->withInput();
            }
            
            // Generate nama file unik dengan hash
            $fileName = time() . '_' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $validated['gambar'] = $file->storeAs('pengaduan', $fileName, 'public');
        }
        
        // Sanitasi deskripsi untuk mencegah XSS
        $validated['deskripsi'] = strip_tags($validated['deskripsi'], '<p><br><strong><em><ul><li><ol>');
        $validated['nama'] = htmlspecialchars($validated['nama'], ENT_QUOTES, 'UTF-8');
        $validated['judul'] = htmlspecialchars($validated['judul'], ENT_QUOTES, 'UTF-8');

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
            'tanggapan' => 'nullable|string|max:1000',
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
