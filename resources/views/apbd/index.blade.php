@extends('layouts.app')

@section('title', 'Transparansi Dana Desa')

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Transparansi Dana Desa
            </h1>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Akses dokumen APBD (Anggaran Pendapatan dan Belanja Desa) untuk transparansi penggunaan dana desa
            </p>
        </div>
    </div>
</section>

<!-- APBD List Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($apbdList->isEmpty())
        <div class="text-center py-16">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">Belum Ada Dokumen</h3>
            <p class="text-gray-500">Dokumen APBD akan ditampilkan di sini</p>
        </div>
        @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($apbdList as $apbd)
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium mb-1">Tahun Anggaran</p>
                            <h2 class="text-4xl font-bold text-white">{{ $apbd->tahun }}</h2>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">
                        {{ $apbd->judul }}
                    </h3>
                    
                    @if($apbd->deskripsi)
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ $apbd->deskripsi }}
                    </p>
                    @endif
                    
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Dipublikasikan: {{ $apbd->created_at->format('d M Y') }}
                    </div>
                    
                    <a href="{{ route('apbd.download', $apbd) }}" 
                       class="btn-primary w-full justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Unduh PDF
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Info Section -->
<section class="bg-green-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tentang Transparansi Dana Desa</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Transparansi Dana Desa merupakan komitmen kami untuk memberikan akses publik terhadap informasi pengelolaan keuangan desa. 
                        Dokumen APBD yang tersedia di halaman ini dapat diunduh secara gratis untuk keperluan informasi dan pengawasan masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
