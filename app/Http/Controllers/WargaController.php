<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Warga::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('nomor_kk', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan dusun
        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        // Filter berdasarkan jenis kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        $warga = $query->orderBy('nama')->paginate(20);
        $dusunList = Warga::select('dusun')->distinct()->pluck('dusun');

        return view('admin.warga.index', compact('warga', 'dusunList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:warga,nik|regex:/^[0-9]+$/',
            'nama' => 'required|string|max:255',
            'nomor_kk' => 'required|string|size:16|regex:/^[0-9]+$/',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'agama' => 'required|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'status_dalam_keluarga' => 'required|in:Kepala Keluarga,Istri,Anak,Menantu,Cucu,Orang Tua,Mertua,Famili Lain,Pembantu,Lainnya',
            'dusun' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'alamat' => 'required|string',
            'wajib_pilih' => 'boolean',
            'kewarganegaraan' => 'required|string|max:255',
        ], [
            'nik.regex' => 'NIK harus berupa angka.',
            'nomor_kk.regex' => 'Nomor KK harus berupa angka.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
        ]);

        $validated['wajib_pilih'] = $request->has('wajib_pilih');

        Warga::create($validated);

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warga $warga)
    {
        return view('admin.warga.show', compact('warga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warga $warga)
    {
        return view('admin.warga.edit', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:warga,nik,' . $warga->id . '|regex:/^[0-9]+$/',
            'nama' => 'required|string|max:255',
            'nomor_kk' => 'required|string|size:16|regex:/^[0-9]+$/',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'agama' => 'required|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'status_dalam_keluarga' => 'required|in:Kepala Keluarga,Istri,Anak,Menantu,Cucu,Orang Tua,Mertua,Famili Lain,Pembantu,Lainnya',
            'dusun' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'alamat' => 'required|string',
            'wajib_pilih' => 'boolean',
            'kewarganegaraan' => 'required|string|max:255',
        ]);

        $validated['wajib_pilih'] = $request->has('wajib_pilih');

        $warga->update($validated);

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
