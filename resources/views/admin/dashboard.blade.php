@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600 mt-2">Selamat datang di panel admin CMS</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Penduduk</p>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($statistik['total_penduduk']) }}</p>
            </div>
            <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Kepala Keluarga</p>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($statistik['total_kk']) }}</p>
            </div>
            <div class="w-14 h-14 bg-emerald-100 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Laki-laki</p>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($statistik['total_laki']) }}</p>
            </div>
            <div class="w-14 h-14 bg-teal-100 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Perempuan</p>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($statistik['total_perempuan']) }}</p>
            </div>
            <div class="w-14 h-14 bg-pink-100 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Berita</p>
                <p class="text-3xl font-bold text-gray-900">{{ $statistik['total_berita'] }}</p>
            </div>
            <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Pengaduan</p>
                <p class="text-3xl font-bold text-gray-900">{{ $statistik['total_pengaduan'] }}</p>
            </div>
            <div class="w-14 h-14 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
            </div>
        </div>
        @if($statistik['pengaduan_pending'] > 0)
        <div class="mt-3 text-sm text-yellow-600 font-medium">
            {{ $statistik['pengaduan_pending'] }} menunggu ditanggapi
        </div>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Lokasi</p>
                <p class="text-3xl font-bold text-gray-900">{{ $statistik['total_lokasi'] }}</p>
            </div>
            <div class="w-14 h-14 bg-cyan-100 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Data Warga</p>
                <p class="text-3xl font-bold text-gray-900">{{ $statistik['total_penduduk'] }}</p>
            </div>
            <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Pengaduan Terbaru -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">Pengaduan Terbaru</h2>
        </div>
        <div class="p-6">
            @if($pengaduanTerbaru->count() > 0)
            <div class="space-y-4">
                @foreach($pengaduanTerbaru as $pengaduan)
                <div class="flex items-start space-x-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                    <div class="flex-shrink-0">
                        {!! $pengaduan->status_badge !!}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $pengaduan->judul }}</p>
                        <p class="text-sm text-gray-500">{{ $pengaduan->nama }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $pengaduan->created_at->diffForHumans() }}</p>
                    </div>
                    <a href="{{ route('admin.pengaduan.show', $pengaduan) }}" 
                       class="flex-shrink-0 text-green-600 hover:text-green-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
            <a href="{{ route('admin.pengaduan.index') }}" 
               class="block mt-4 text-center text-green-600 hover:text-green-800 font-medium text-sm">
                Lihat Semua →
            </a>
            @else
            <p class="text-center text-gray-500 py-8">Belum ada pengaduan</p>
            @endif
        </div>
    </div>

    <!-- Berita Terbaru -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">Berita Terbaru</h2>
        </div>
        <div class="p-6">
            @if($beritaTerbaru->count() > 0)
            <div class="space-y-4">
                @foreach($beritaTerbaru as $berita)
                <div class="flex items-start space-x-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                    @if($berita->gambar)
                    <img src="{{ $berita->gambar_url }}" 
                         alt="{{ $berita->judul }}"
                         class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                    @else
                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0"></div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $berita->judul }}</p>
                        <p class="text-sm text-gray-500">{{ $berita->user->name }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $berita->created_at->diffForHumans() }}</p>
                    </div>
                    <a href="{{ route('admin.berita.edit', $berita) }}" 
                       class="flex-shrink-0 text-green-600 hover:text-green-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
            <a href="{{ route('admin.berita.index') }}" 
               class="block mt-4 text-center text-green-600 hover:text-green-800 font-medium text-sm">
                Lihat Semua →
            </a>
            @else
            <p class="text-center text-gray-500 py-8">Belum ada berita</p>
            @endif
        </div>
    </div>
</div>
@endsection
