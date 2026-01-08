@extends('admin.layouts.app')

@section('title', 'Edit Profile Desa')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Profile Desa</h1>
    <p class="text-gray-600">Update informasi visi, misi, sejarah, dan struktur organisasi desa</p>
</div>

@if(session('success'))
<div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    {{ session('success') }}
</div>
@endif

<form action="{{ route('admin.profile.update') }}" 
      method="POST" 
      enctype="multipart/form-data"
      x-data="{ preview: '{{ $profile->bagan_organisasi ? asset('storage/' . $profile->bagan_organisasi) : '' }}' }">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Visi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <label for="visi" class="text-lg font-semibold text-gray-900">Visi Desa</label>
                </div>
                <textarea name="visi" 
                          id="visi" 
                          rows="6"
                          placeholder="Masukkan visi desa..."
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('visi', $profile->visi) }}</textarea>
                @error('visi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Misi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <label for="misi" class="text-lg font-semibold text-gray-900">Misi Desa</label>
                </div>
                <textarea name="misi" 
                          id="misi" 
                          rows="10"
                          placeholder="Masukkan misi desa (pisahkan dengan enter untuk setiap poin)..."
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">{{ old('misi', $profile->misi) }}</textarea>
                @error('misi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sejarah Desa -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-amber-100 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <label for="sejarah_desa" class="text-lg font-semibold text-gray-900">Sejarah Desa</label>
                </div>
                <textarea name="sejarah_desa" 
                          id="sejarah_desa" 
                          rows="15"
                          placeholder="Masukkan sejarah dan perkembangan desa..."
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition">{{ old('sejarah_desa', $profile->sejarah_desa) }}</textarea>
                @error('sejarah_desa')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bagan Organisasi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-purple-100 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <label for="bagan_organisasi" class="text-lg font-semibold text-gray-900">Bagan Struktur Organisasi</label>
                </div>

                <!-- Current Image Preview -->
                @if($profile->bagan_organisasi)
                <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-sm font-medium text-gray-700 mb-2">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $profile->bagan_organisasi) }}" 
                         alt="Bagan Organisasi" 
                         class="max-h-64 rounded-lg shadow-md">
                </div>
                @endif

                <label class="flex flex-col items-center px-4 py-6 bg-white text-gray-500 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer hover:bg-gray-50 transition">
                    <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <span class="text-sm font-medium">Klik untuk upload gambar bagan {{ $profile->bagan_organisasi ? 'baru' : '' }}</span>
                    <span class="text-xs text-gray-400 mt-1">PNG, JPG, WebP (Max. 5MB)</span>
                    <input type="file" 
                           name="bagan_organisasi" 
                           id="bagan_organisasi" 
                           accept="image/*"
                           class="hidden"
                           @change="preview = URL.createObjectURL($event.target.files[0])">
                </label>

                <!-- New Image Preview -->
                <div x-show="preview && preview !== '{{ $profile->bagan_organisasi ? asset('storage/' . $profile->bagan_organisasi) : '' }}'" class="mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview gambar baru:</p>
                    <img :src="preview" class="max-h-64 rounded-lg shadow-lg">
                </div>

                @error('bagan_organisasi')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi</h3>
                
                <div class="space-y-3 text-sm text-gray-600 mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>Profile desa akan ditampilkan di halaman publik</p>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p>Gambar bagan organisasi akan disimpan di storage/app/public/profile/</p>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <p>Semua field bersifat opsional</p>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('profile.index') }}" 
                       target="_blank"
                       class="w-full px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Preview
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
