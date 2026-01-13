<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.user-account', compact('user'));
    }

    /**
     * Update profil user (nama dan email)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'current_password' => 'required|string',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan oleh user lain',
            'current_password.required' => 'Password saat ini harus diisi untuk keamanan',
        ]);

        // Verifikasi password saat ini untuk keamanan
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai'
            ])->withInput();
        }

        // Sanitasi input
        $name = strip_tags(trim($validated['name']));
        $email = filter_var($validated['email'], FILTER_SANITIZE_EMAIL);

        // Update profil
        $user->update([
            'name' => $name,
            'email' => $email,
        ]);

        // Log aktivitas untuk audit
        \Log::info('User profile updated', [
            'user_id' => $user->id,
            'old_email' => $user->getOriginal('email'),
            'new_email' => $email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.user.profile.edit')
            ->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi password
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed|different:current_password',
        ], [
            'current_password.required' => 'Password saat ini harus diisi',
            'new_password.required' => 'Password baru harus diisi',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
            'new_password.different' => 'Password baru harus berbeda dengan password saat ini',
        ]);

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai'
            ]);
        }

        // Validasi kekuatan password (opsional: minimal 1 huruf besar, 1 angka)
        if (!preg_match('/[A-Z]/', $request->new_password)) {
            return back()->withErrors([
                'new_password' => 'Password harus mengandung minimal 1 huruf besar'
            ])->withInput();
        }

        if (!preg_match('/[0-9]/', $request->new_password)) {
            return back()->withErrors([
                'new_password' => 'Password harus mengandung minimal 1 angka'
            ])->withInput();
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Log aktivitas
        \Log::info('User password changed', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Logout semua session lain (opsional untuk keamanan)
        // Auth::logoutOtherDevices($request->new_password);

        return redirect()->route('admin.user.profile.edit')
            ->with('success', 'Password berhasil diubah');
    }
}
