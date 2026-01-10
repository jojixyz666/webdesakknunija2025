@extends('admin.layouts.app')

@section('title', 'Pengaturan Website')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Pengaturan Website</h1>
    <p class="text-gray-600">Konfigurasi informasi dan tampilan website</p>
</div>

<form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @foreach($pengaturan as $grup => $items)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6 capitalize">{{ str_replace('_', ' ', $grup) }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($items as $item)
            <div class="{{ $item->tipe === 'textarea' || $item->tipe === 'image' ? 'md:col-span-2' : '' }}">
                <label for="{{ $item->kunci }}" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ ucwords(str_replace('_', ' ', $item->kunci)) }}
                    
                    @if($item->tipe === 'image')
                    <!-- PANDUAN GAMBAR:
                         - Gambar disimpan di: storage/app/public/pengaturan/
                         - Untuk banner_depan: Rekomendasi 1920x600px
                         - Untuk logo_desa: Rekomendasi 200x200px
                         - Format: JPG, PNG, WebP (Max 2MB)
                    -->
                    @endif
                </label>

                @if($item->tipe === 'text')
                    <input type="text" 
                           name="{{ $item->kunci }}" 
                           id="{{ $item->kunci }}"
                           value="{{ old($item->kunci, $item->nilai) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                
                @elseif($item->tipe === 'textarea')
                    <textarea name="{{ $item->kunci }}" 
                              id="{{ $item->kunci }}"
                              rows="4"
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">{{ old($item->kunci, $item->nilai) }}</textarea>
                
                @elseif($item->tipe === 'image')
                    <div x-data="{ preview: '{{ $item->nilai ? asset('storage/' . $item->nilai) : '' }}' }">
                        @if($item->nilai)
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $item->nilai) }}" 
                                 alt="{{ $item->kunci }}"
                                 class="max-h-48 rounded-lg shadow-sm">
                        </div>
                        @endif

                        <label class="flex flex-col items-center px-4 py-6 bg-white text-gray-500 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer hover:bg-gray-50 transition">
                            <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <span class="text-sm font-medium" x-text="preview ? 'Klik untuk ganti gambar' : 'Klik untuk upload gambar'"></span>
                            <span class="text-xs text-gray-400 mt-1">
                                @if(str_contains($item->kunci, 'banner'))
                                    Rekomendasi: 1920x600px, PNG/JPG (Max. 2MB)
                                @elseif(str_contains($item->kunci, 'logo'))
                                    Rekomendasi: 200x200px, PNG (Max. 1MB)
                                @else
                                    PNG, JPG, WebP (Max. 2MB)
                                @endif
                            </span>
                            <input type="file" 
                                   name="{{ $item->kunci }}" 
                                   id="{{ $item->kunci }}"
                                   accept="image/*"
                                   class="hidden"
                                   @change="preview = URL.createObjectURL($event.target.files[0])">
                        </label>

                        <div x-show="preview && preview !== '{{ $item->nilai ? asset('storage/' . $item->nilai) : '' }}'" class="mt-4">
                            <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
                            <img :src="preview" class="max-h-48 rounded-lg shadow-lg">
                        </div>
                    </div>
                @endif

                @error($item->kunci)
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                @if($item->kunci === 'banner_depan')
                <p class="mt-2 text-xs text-gray-500">
                    💡 Tip: Banner ini akan ditampilkan di halaman depan website. Gunakan gambar dengan kualitas tinggi untuk hasil terbaik.
                </p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Simpan Perubahan</h3>
                <p class="text-sm text-gray-600">Pastikan semua informasi sudah benar sebelum menyimpan</p>
            </div>
            <button type="submit" 
                    class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Pengaturan
            </button>
        </div>
    </div>
</form>
@endsection
