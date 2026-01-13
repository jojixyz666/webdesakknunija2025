@extends('admin.layouts.app')

@section('title', 'Edit Profil Akun')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-user-edit text-blue-600"></i> Edit Profil Akun
            </h1>
            <p class="text-gray-600 mt-1">Kelola informasi akun dan keamanan Anda</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center" role="alert">
        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Edit Nama & Email -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-4">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-user-circle mr-2"></i> Informasi Akun
                </h2>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.user.profile.update') }}" method="POST" id="profileForm">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user text-blue-600"></i> Nama Lengkap
                            <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('name') border-red-500 @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $user->name) }}"
                            required
                            maxlength="255"
                            minlength="3"
                            placeholder="Masukkan nama lengkap"
                        >
                        @error('name')
                        <p class="mt-1 text-sm text-red-500"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Minimal 3 karakter, maksimal 255 karakter</p>
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-blue-600"></i> Email
                            <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}"
                            required
                            maxlength="255"
                            placeholder="contoh@email.com"
                        >
                        @error('email')
                        <p class="mt-1 text-sm text-red-500"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Email harus unik dan akan digunakan untuk login</p>
                    </div>

                    <!-- Password Konfirmasi -->
                    <div class="mb-6">
                        <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-red-600"></i> Password Saat Ini
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('current_password') border-red-500 @enderror" 
                                id="current_password" 
                                name="current_password"
                                required
                                placeholder="Masukkan password saat ini"
                            >
                            <button 
                                type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                onclick="togglePassword('current_password')"
                            >
                                <i class="fas fa-eye" id="current_password_icon"></i>
                            </button>
                        </div>
                        @error('current_password')
                        <p class="mt-1 text-sm text-red-500"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            <i class="fas fa-shield-alt"></i> Diperlukan untuk memverifikasi perubahan data
                        </p>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t">
                        <button type="reset" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-md">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Ubah Password -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white px-6 py-4">
                <h2 class="text-xl font-semibold flex items-center">
                    <i class="fas fa-key mr-2"></i> Ubah Password
                </h2>
            </div>
            <div class="p-6">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-5 rounded-r-lg">
                    <p class="text-sm font-semibold text-blue-800 mb-2">
                        <i class="fas fa-info-circle"></i> Persyaratan Password:
                    </p>
                    <ul class="text-sm text-blue-700 space-y-1 ml-4">
                        <li>• Minimal 8 karakter</li>
                        <li>• Mengandung minimal 1 huruf besar (A-Z)</li>
                        <li>• Mengandung minimal 1 angka (0-9)</li>
                        <li>• Berbeda dengan password lama</li>
                    </ul>
                </div>

                <form action="{{ route('admin.user.profile.password') }}" method="POST" id="passwordForm">
                    @csrf
                    @method('PUT')

                    <!-- Password Lama -->
                    <div class="mb-4">
                        <label for="old_password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password Saat Ini <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition @error('current_password') border-red-500 @enderror" 
                                id="old_password" 
                                name="current_password"
                                required
                            >
                            <button 
                                type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                onclick="togglePassword('old_password')"
                            >
                                <i class="fas fa-eye" id="old_password_icon"></i>
                            </button>
                        </div>
                        @error('current_password')
                        <p class="mt-1 text-sm text-red-500"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Baru -->
                    <div class="mb-4">
                        <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition @error('new_password') border-red-500 @enderror" 
                                id="new_password" 
                                name="new_password"
                                required
                                minlength="8"
                            >
                            <button 
                                type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                onclick="togglePassword('new_password')"
                            >
                                <i class="fas fa-eye" id="new_password_icon"></i>
                            </button>
                        </div>
                        @error('new_password')
                        <p class="mt-1 text-sm text-red-500"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                        <div id="passwordStrength" class="mt-2"></div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-6">
                        <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Konfirmasi Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" 
                                id="new_password_confirmation" 
                                name="new_password_confirmation"
                                required
                                minlength="8"
                            >
                            <button 
                                type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                onclick="togglePassword('new_password_confirmation')"
                            >
                                <i class="fas fa-eye" id="new_password_confirmation_icon"></i>
                            </button>
                        </div>
                        <p id="passwordMatch" class="mt-1 text-sm"></p>
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white rounded-lg hover:from-orange-600 hover:to-red-700 transition shadow-md font-semibold">
                        <i class="fas fa-key"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Keamanan -->
    <div class="mt-6 bg-white rounded-xl shadow-md border border-red-200 border-l-4 border-l-red-500 overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-bold text-red-700 mb-4 flex items-center">
                <i class="fas fa-shield-alt mr-2"></i> Informasi Keamanan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-600 mb-2"><strong>Email Terdaftar:</strong> {{ $user->email }}</p>
                    <p class="text-gray-600"><strong>Tanggal Daftar:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 mb-2"><strong>Terakhir Update:</strong> {{ $user->updated_at->format('d M Y, H:i') }}</p>
                    <p class="text-gray-600"><strong>IP Address:</strong> {{ request()->ip() }}</p>
                </div>
            </div>
            <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                <p class="text-sm text-yellow-800">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <strong>Penting:</strong> Setiap perubahan data akan dicatat dalam log sistem untuk audit keamanan.
                    Pastikan Anda mengingat password baru dan simpan di tempat yang aman.
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Password strength indicator
document.getElementById('new_password')?.addEventListener('input', function() {
    const password = this.value;
    const strengthDiv = document.getElementById('passwordStrength');
    
    let strength = 0;
    let message = '';
    let colorClass = '';
    
    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    switch(strength) {
        case 0:
        case 1:
            message = 'Lemah';
            colorClass = 'text-red-600';
            break;
        case 2:
            message = 'Sedang';
            colorClass = 'text-yellow-600';
            break;
        case 3:
            message = 'Kuat';
            colorClass = 'text-blue-600';
            break;
        case 4:
            message = 'Sangat Kuat';
            colorClass = 'text-green-600';
            break;
    }
    
    strengthDiv.innerHTML = password.length > 0 
        ? `<span class="text-sm ${colorClass}"><i class="fas fa-shield-alt"></i> Kekuatan Password: <strong>${message}</strong></span>`
        : '';
});

// Password match checker
document.getElementById('new_password_confirmation')?.addEventListener('input', function() {
    const password = document.getElementById('new_password').value;
    const confirm = this.value;
    const matchDiv = document.getElementById('passwordMatch');
    
    if (confirm.length > 0) {
        if (password === confirm) {
            matchDiv.innerHTML = '<i class="fas fa-check-circle text-green-600"></i> Password cocok';
            matchDiv.className = 'mt-1 text-sm text-green-600';
        } else {
            matchDiv.innerHTML = '<i class="fas fa-times-circle text-red-600"></i> Password tidak cocok';
            matchDiv.className = 'mt-1 text-sm text-red-600';
        }
    } else {
        matchDiv.innerHTML = '';
    }
});

// Konfirmasi sebelum submit
document.getElementById('profileForm')?.addEventListener('submit', function(e) {
    if (!confirm('Apakah Anda yakin ingin mengubah data profil?')) {
        e.preventDefault();
    }
});

document.getElementById('passwordForm')?.addEventListener('submit', function(e) {
    if (!confirm('Apakah Anda yakin ingin mengubah password? Anda akan tetap login di session ini.')) {
        e.preventDefault();
    }
});
</script>
@endpush
@endsection
