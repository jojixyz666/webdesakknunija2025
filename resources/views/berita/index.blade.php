@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Berita & Pengumuman</h1>
        <p class="text-blue-100 text-lg">Informasi terkini dari desa</p>
    </div>
</section>

<!-- Content -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($berita->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($berita as $item)
            <article class="card group border border-gray-200 hover:border-gray-300 rounded-xl shadow-sm hover:shadow-xl transition-all" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <a href="{{ route('berita.show', $item->slug) }}">
                    <div class="relative h-56 overflow-hidden rounded-t-xl">
                        <img src="{{ $item->gambar_url }}" 
                             alt="{{ $item->judul }}"
                             class="w-full h-full object-cover transition-transform duration-500"
                             :class="hover ? 'scale-110' : 'scale-100'">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full" 
                                  :class="'{{ $item->kategori }}' === 'pengumuman' ? 'bg-yellow-500 text-white' : 'bg-blue-600 text-white'">
                                {{ ucfirst($item->kategori) }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $item->tanggal_publikasi->format('d M Y') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $item->user->name }}
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $item->kutipan }}</p>
                        <div class="flex items-center text-blue-600 font-medium">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $berita->links() }}
        </div>
        @else
        <div class="text-center py-16">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Berita</h3>
            <p class="text-gray-500">Berita akan ditampilkan di sini</p>
        </div>
        @endif
    </div>
</section>

<style>
    .card {
        @apply bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
