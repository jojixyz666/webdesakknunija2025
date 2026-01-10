@extends('admin.layouts.app')

@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">{{ isset($berita) ? 'Edit Berita' : 'Tambah Berita' }}</h1>
    <p class="text-gray-600">{{ isset($berita) ? 'Update informasi berita' : 'Buat berita atau pengumuman baru' }}</p>
</div>

<form action="{{ isset($berita) ? route('admin.berita.update', ['berita' => $berita->id]) : route('admin.berita.store') }}" 
      method="POST" 
      enctype="multipart/form-data"
      x-data="{ preview: '{{ isset($berita) && $berita->gambar ? $berita->gambar_url : '' }}' }">
    @csrf
    @if(isset($berita))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="judul" 
                           id="judul" 
                           required
                           value="{{ old('judul', $berita->judul ?? '') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten -->
                <div class="mb-6">
                    <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">
                        Konten <span class="text-red-500">*</span>
                    </label>
                    <textarea name="konten" 
                              id="konten" 
                              rows="15" 
                              required
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">{{ old('konten', $berita->konten ?? '') }}</textarea>
                    @error('konten')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Utama
                        <!-- PANDUAN: Gambar akan disimpan di storage/app/public/berita/ -->
                    </label>
                    <div class="mt-2">
                        <label class="flex flex-col items-center px-4 py-6 bg-white text-gray-500 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer hover:bg-gray-50 transition">
                            <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <span class="text-sm font-medium">Klik untuk upload gambar</span>
                            <span class="text-xs text-gray-400 mt-1">PNG, JPG, WebP (Max. 2MB, Rekomendasi: 1200x600px)</span>
                            <input type="file" 
                                   name="gambar" 
                                   id="gambar" 
                                   accept="image/*"
                                   class="hidden"
                                   @change="preview = URL.createObjectURL($event.target.files[0])">
                        </label>

                        <!-- Preview -->
                        <div x-show="preview" class="mt-4">
                            <img :src="preview" class="max-h-64 rounded-lg shadow-lg">
                        </div>
                    </div>
                    @error('gambar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Publish -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Publikasi</h3>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori" 
                            id="kategori" 
                            required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        <option value="berita" {{ old('kategori', $berita->kategori ?? 'berita') === 'berita' ? 'selected' : '' }}>Berita</option>
                        <option value="pengumuman" {{ old('kategori', $berita->kategori ?? '') === 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    </select>
                    @error('kategori')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Publikasi -->
                <div class="mb-4">
                    <label for="tanggal_publikasi" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Publikasi
                    </label>
                    <input type="datetime-local" 
                           name="tanggal_publikasi" 
                           id="tanggal_publikasi"
                           value="{{ old('tanggal_publikasi', isset($berita) ? $berita->tanggal_publikasi->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    @error('tanggal_publikasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tampilkan -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           name="tampilkan" 
                           id="tampilkan"
                           value="1"
                           {{ old('tampilkan', $berita->tampilkan ?? true) ? 'checked' : '' }}
                           class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                    <label for="tampilkan" class="ml-2 text-sm font-medium text-gray-700">
                        Tampilkan di website
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <button type="submit" 
                        class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium mb-3">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ isset($berita) ? 'Update Berita' : 'Simpan Berita' }}
                </button>
                <a href="{{ route('admin.berita.index') }}" 
                   class="block w-full text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    Batal
                </a>
            </div>
        </div>
    </div>
</form>
@endsection
