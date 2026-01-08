<?php

namespace App\Http\Controllers;

use App\Models\ProfileDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileDesaController extends Controller
{
    // Public method untuk menampilkan profile desa
    public function index()
    {
        $profile = ProfileDesa::first();
        
        // Jika belum ada profile, buat instance kosong
        if (!$profile) {
            $profile = new ProfileDesa();
        }
        
        return view('profile.index', compact('profile'));
    }

    // Admin method untuk edit profile
    public function edit()
    {
        $profile = ProfileDesa::first();
        
        // Jika belum ada profile, buat baru
        if (!$profile) {
            $profile = ProfileDesa::create([
                'visi' => '',
                'misi' => '',
                'sejarah_desa' => '',
                'bagan_organisasi' => '',
            ]);
        }
        
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'sejarah_desa' => 'nullable|string',
            'bagan_organisasi' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
        ]);

        $profile = ProfileDesa::first();
        
        if (!$profile) {
            $profile = new ProfileDesa();
        }

        $data = [
            'visi' => $request->visi,
            'misi' => $request->misi,
            'sejarah_desa' => $request->sejarah_desa,
        ];

        // Handle bagan organisasi upload
        if ($request->hasFile('bagan_organisasi')) {
            // Hapus file lama jika ada
            if ($profile->bagan_organisasi && Storage::disk('public')->exists($profile->bagan_organisasi)) {
                Storage::disk('public')->delete($profile->bagan_organisasi);
            }

            // Upload file baru
            $file = $request->file('bagan_organisasi');
            $fileName = time() . '_bagan_organisasi.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('profile', $fileName, 'public');
            $data['bagan_organisasi'] = $filePath;
        }

        if ($profile->exists) {
            $profile->update($data);
        } else {
            ProfileDesa::create($data);
        }

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profile desa berhasil diperbarui.');
    }
}
