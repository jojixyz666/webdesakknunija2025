@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri Desa</h1>
        <p class="text-blue-100 text-lg">Dokumentasi kegiatan dan keindahan desa</p>
    </div>
</section>

<!-- Gallery -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(($galeri->count() > 0) || (isset($beritaGambar) && $beritaGambar->count() > 0))
        <!-- Galeri Mandiri -->
        @if($galeri->count() > 0)
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Foto Galeri</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ openModal: false, selectedImage: null, selectedTitle: '', selectedDesc: '' }">
                @foreach($galeri as $item)
                <div class="group relative aspect-square overflow-hidden rounded-xl cursor-pointer bg-gray-200" 
                     @click="openModal = true; selectedImage = '{{ $item->gambar_url }}'; selectedTitle = '{{ $item->judul }}'; selectedDesc = '{{ $item->deskripsi }}'">
                    <img src="{{ $item->gambar_url }}" 
                         alt="{{ $item->judul }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-white font-bold text-xl mb-2">{{ $item->judul }}</h3>
                            @if($item->deskripsi)
                            <p class="text-white/90 text-sm line-clamp-2">{{ $item->deskripsi }}</p>
                            @endif
                            <p class="text-white/80 text-xs mt-2">Diunggah {{ $item->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Foto dari Berita -->
        @if(isset($beritaGambar) && $beritaGambar->count() > 0)
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Foto dari Berita</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($beritaGambar as $b)
                <a href="{{ route('berita.show', $b->slug) }}" class="group block">
                    <div class="relative aspect-square overflow-hidden rounded-xl bg-gray-200">
                        <img src="{{ asset('storage/' . $b->gambar) }}" 
                             alt="{{ $b->judul }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white font-bold text-xl mb-2">{{ $b->judul }}</h3>
                                <p class="text-white/80 text-xs">{{ $b->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
            <!-- Modal Lightbox (for Galeri items) -->
            <div x-show="openModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="openModal = false"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90"
                 style="display: none;">
                <div class="relative max-w-5xl w-full" @click.stop>
                    <!-- Close button -->
                    <button @click="openModal = false" 
                            class="absolute -top-12 right-0 text-white hover:text-gray-300 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <!-- Image -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-2xl">
                        <img :src="selectedImage" 
                             :alt="selectedTitle"
                             class="w-full max-h-[70vh] object-contain">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2" x-text="selectedTitle"></h3>
                            <p class="text-gray-600" x-text="selectedDesc"></p>
                            <p class="text-gray-500 text-sm mt-2">Diunggah terbaru ditampilkan di depan</p>
                        </div>
                    </div>
                </div>
            </div>
        
        @else
        <div class="text-center py-16">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Foto</h3>
            <p class="text-gray-500">Galeri foto akan ditampilkan di sini</p>
        </div>
        @endif
    </div>
</section>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
