@extends('layouts.app')

@section('title', 'Cek Status Pengaduan')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Cek Status Pengaduan</h1>
        <p class="text-blue-100 text-lg">Lacak pengaduan Anda dengan email</p>
    </div>
</section>

<!-- Content -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8">
            <form action="{{ route('pengaduan.track') }}" method="GET" class="flex gap-4">
                <div class="flex-1">
                    <input type="email" 
                           name="email" 
                           placeholder="Masukkan email yang didaftarkan"
                           value="{{ request('email') }}"
                           required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
            </form>
        </div>

        <!-- Results -->
        @if(request('email'))
            @if($pengaduan && $pengaduan->count() > 0)
            <div class="space-y-6">
                @foreach($pengaduan as $item)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->judul }}</h3>
                                <p class="text-sm text-gray-500">
                                    Dikirim: {{ $item->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                            <div>
                                {!! $item->status_badge !!}
                            </div>
                        </div>

                        <div class="prose text-gray-700 mb-4">
                            {{ Str::limit($item->deskripsi, 200) }}
                        </div>

                        @if($item->gambar)
                        <div class="mb-4">
                            <img src="{{ $item->gambar_url }}" 
                                 alt="Bukti"
                                 class="max-h-48 rounded-lg">
                        </div>
                        @endif

                        @if($item->tanggapan)
                        <div class="mt-6 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                            <h4 class="font-bold text-green-900 mb-2">Tanggapan:</h4>
                            <p class="text-green-800 text-sm">{{ $item->tanggapan }}</p>
                            <p class="text-xs text-green-600 mt-2">
                                {{ $item->tanggal_tanggapan->format('d M Y H:i') }}
                            </p>
                        </div>
                        @endif

                        <!-- Timeline -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-bold text-gray-900 mb-4">Riwayat Status</h4>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="w-2 h-2 rounded-full mt-2 mr-3" 
                                         :class="'{{ $item->status }}' === 'selesai' ? 'bg-green-500' : 'bg-gray-300'"></div>
                                    <div>
                                        <p class="font-medium text-gray-900">Selesai</p>
                                        @if($item->status === 'selesai' && $item->tanggal_tanggapan)
                                        <p class="text-sm text-gray-500">{{ $item->tanggal_tanggapan->format('d M Y H:i') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-2 h-2 rounded-full mt-2 mr-3" 
                                         :class="['proses', 'selesai'].includes('{{ $item->status }}') ? 'bg-blue-500' : 'bg-gray-300'"></div>
                                    <div>
                                        <p class="font-medium text-gray-900">Diproses</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-2 h-2 rounded-full bg-yellow-500 mt-2 mr-3"></div>
                                    <div>
                                        <p class="font-medium text-gray-900">Diterima</p>
                                        <p class="text-sm text-gray-500">{{ $item->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Pengaduan</h3>
                <p class="text-gray-500">Tidak ditemukan pengaduan dengan email tersebut</p>
                <a href="{{ route('pengaduan.index') }}" class="inline-block mt-6 text-blue-600 hover:text-blue-800 font-medium">
                    Buat Pengaduan Baru →
                </a>
            </div>
            @endif
        @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Cari Pengaduan Anda</h3>
            <p class="text-gray-500">Masukkan email yang didaftarkan pada form di atas</p>
        </div>
        @endif
    </div>
</section>
@endsection
