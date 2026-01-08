@extends('layouts.app')

@section('title', 'Profile Desa')

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Profile Desa
            </h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Mengenal lebih dekat {{ $pengaturan['nama_desa'] ?? 'Desa Kami' }}
            </p>
        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Visi -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-600 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Visi</h2>
                </div>
                @if($profile->visi)
                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">{{ $profile->visi }}</p>
                @else
                    <p class="text-gray-500 italic">Visi desa belum tersedia.</p>
                @endif
            </div>

            <!-- Misi -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="bg-green-600 p-3 rounded-lg mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Misi</h2>
                </div>
                @if($profile->misi)
                    <div class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">{{ $profile->misi }}</div>
                @else
                    <p class="text-gray-500 italic">Misi desa belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Struktur Organisasi Section -->
@if($profile->bagan_organisasi)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Struktur Organisasi</h2>
            <p class="text-gray-600 text-lg">Bagan susunan perangkat desa</p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $profile->bagan_organisasi) }}" 
                     alt="Bagan Struktur Organisasi Desa" 
                     class="max-w-full h-auto rounded-lg shadow-lg">
            </div>
        </div>
    </div>
</section>
@endif

<!-- Sejarah Desa Section -->
@if($profile->sejarah_desa)
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Sejarah Desa</h2>
            <p class="text-gray-600 text-lg">Jejak perjalanan dan perkembangan desa</p>
        </div>
        
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-8 md:p-12 shadow-lg">
            <div class="prose prose-lg max-w-none">
                <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $profile->sejarah_desa }}</div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Info Section -->
@if(!$profile->visi && !$profile->misi && !$profile->sejarah_desa && !$profile->bagan_organisasi)
<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Profile Desa Belum Tersedia</h3>
        <p class="text-gray-600">Informasi profile desa sedang dalam proses penyusunan.</p>
    </div>
</section>
@endif
@endsection
