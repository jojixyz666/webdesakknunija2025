@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section / Banner -->
<section class="relative h-[600px] overflow-hidden">
    <!-- 
        PANDUAN PENEMPATAN BANNER:
        - Banner dapat diubah melalui CMS Admin di menu "Pengaturan"
        - Gambar banner disimpan di: storage/app/public/pengaturan/banner_depan.jpg
        - Ukuran rekomendasi: 1920x600px (ratio 16:5)
        - Format: JPG, PNG, atau WebP
    -->
    @if(isset($pengaturan['banner_depan']) && $pengaturan['banner_depan'])
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $pengaturan['banner_depan']) }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-black/30"></div>
    </div>
    @else
    <!-- Default gradient banner jika belum ada gambar -->
    <div class="absolute inset-0 bg-gradient-to-br from-green-600 via-green-700 to-green-900"></div>
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-xl animate-blob"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-xl animate-blob animation-delay-4000"></div>
    </div>
    @endif
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
        <div class="max-w-3xl" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" 
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 transform translate-y-8"
                 x-transition:enter-end="opacity-100 transform translate-y-0">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    Selamat Datang di<br>
                    <span class="text-yellow-300">{{ $pengaturan['nama_desa'] ?? 'Desa Kami' }}</span>
                </h1>
                <p class="text-xl text-green-100 mb-8 leading-relaxed">
                    {{ $pengaturan['tagline'] ?? 'Portal informasi dan layanan masyarakat yang modern, transparan, dan mudah diakses.' }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('berita.index') }}" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Lihat Berita
                    </a>
                    <a href="{{ route('pengaduan.index') }}" class="btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Sampaikan Aspirasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

<!-- Quick Stats -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
                        <div class="stat-card" 
                                 x-data="{ 
                                        target: {{ $jumlahPenduduk }},
                                        animated: 0,
                                        duration: 1500,
                                        started: false,
                                        start(){
                                            if(this.started) return; this.started = true;
                                            const startTime = performance.now();
                                            const animate = (now)=>{
                                                const progress = Math.min((now - startTime) / this.duration, 1);
                                                const ease = 1 - Math.pow(1 - progress, 3);
                                                this.animated = Math.floor(this.target * ease);
                                                if(progress < 1){ requestAnimationFrame(animate); } else { this.animated = this.target; }
                                            };
                                            requestAnimationFrame(animate);
                                        }
                                 }" x-init="start()">
                <div class="stat-icon bg-green-100 text-green-600 flex items-center p-6 rounded-lg">
                    <svg class="w-10 h-10 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <div class="ml-4">
                        <div class="text-3xl font-bold text-green-700 leading-none">
                            <span x-text="Number(animated).toLocaleString('id-ID')">{{ number_format($jumlahPenduduk) }}</span>
                        </div>
                        <div class="text-sm font-medium text-green-600 mt-1">Penduduk</div>
                    </div>
                </div>
            </div>

                        <div class="stat-card" 
                                 x-data="{ 
                                        target: {{ $jumlahKK }},
                                        animated: 0,
                                        duration: 1500,
                                        started: false,
                                        start(){
                                            if(this.started) return; this.started = true;
                                            const startTime = performance.now();
                                            const animate = (now)=>{
                                                const progress = Math.min((now - startTime) / this.duration, 1);
                                                const ease = 1 - Math.pow(1 - progress, 3);
                                                this.animated = Math.floor(this.target * ease);
                                                if(progress < 1){ requestAnimationFrame(animate); } else { this.animated = this.target; }
                                            };
                                            requestAnimationFrame(animate);
                                        }
                                 }" x-init="start()">
                <div class="stat-icon bg-green-100 text-green-600 flex items-center p-6 rounded-lg">
                    <svg class="w-10 h-10 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <div class="ml-4">
                        <div class="text-3xl font-bold text-green-700 leading-none">
                            <span x-text="Number(animated).toLocaleString('id-ID')">{{ number_format($jumlahKK) }}</span>
                        </div>
                        <div class="text-sm font-medium text-green-600 mt-1">Kepala Keluarga</div>
                    </div>
                </div>
            </div>

                        <div class="stat-card" 
                                 x-data="{ 
                                        target: {{ $jumlahRT }},
                                        animated: 0,
                                        duration: 1500,
                                        started: false,
                                        start(){
                                            if(this.started) return; this.started = true;
                                            const startTime = performance.now();
                                            const animate = (now)=>{
                                                const progress = Math.min((now - startTime) / this.duration, 1);
                                                const ease = 1 - Math.pow(1 - progress, 3);
                                                this.animated = Math.floor(this.target * ease);
                                                if(progress < 1){ requestAnimationFrame(animate); } else { this.animated = this.target; }
                                            };
                                            requestAnimationFrame(animate);
                                        }
                                 }" x-init="start()">
                <div class="stat-icon bg-teal-100 text-teal-600 flex items-center p-6 rounded-lg">
                    <svg class="w-10 h-10 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <div class="ml-4">
                        <div class="text-3xl font-bold text-teal-700 leading-none">
                            <span x-text="Number(animated).toLocaleString('id-ID')">{{ number_format($jumlahRT) }}</span>
                        </div>
                        <div class="text-sm font-medium text-teal-600 mt-1">RT</div>
                    </div>
                </div>
            </div>

                        <div class="stat-card" 
                                 x-data="{ 
                                        target: {{ $jumlahRW }},
                                        animated: 0,
                                        duration: 1500,
                                        started: false,
                                        start(){
                                            if(this.started) return; this.started = true;
                                            const startTime = performance.now();
                                            const animate = (now)=>{
                                                const progress = Math.min((now - startTime) / this.duration, 1);
                                                const ease = 1 - Math.pow(1 - progress, 3);
                                                this.animated = Math.floor(this.target * ease);
                                                if(progress < 1){ requestAnimationFrame(animate); } else { this.animated = this.target; }
                                            };
                                            requestAnimationFrame(animate);
                                        }
                                 }" x-init="start()">
                <div class="stat-icon bg-cyan-100 text-cyan-600 flex items-center p-6 rounded-lg">
                    <svg class="w-10 h-10 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <div class="ml-4">
                        <div class="text-3xl font-bold text-cyan-700 leading-none">
                            <span x-text="Number(animated).toLocaleString('id-ID')">{{ number_format($jumlahRW) }}</span>
                        </div>
                        <div class="text-sm font-medium text-cyan-600 mt-1">RW</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pengumuman Terkini -->
@if($pengumumanTerbaru->count() > 0)
<section class="py-4 bg-yellow-50 border-y border-yellow-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center" x-data="{ currentIndex: 0, total: {{ $pengumumanTerbaru->count() }} }" 
             x-init="setInterval(() => { if(total>0){ currentIndex = (currentIndex + 1) % total } }, 5000)">
            <div class="flex items-center space-x-3 mr-6">
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-yellow-500 text-white shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-white/90 mr-2 animate-pulse"></span>
                    Pengumuman
                </span>
            </div>
            <div class="flex-1 overflow-hidden">
                <div class="relative min-h-[2.5rem] md:min-h-[1.5rem]">
                    @foreach($pengumumanTerbaru as $index => $pengumuman)
                    <div x-show="currentIndex === {{ $index }}"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="absolute inset-0 flex items-center">
                        <a href="{{ route('berita.show', $pengumuman->slug) }}?from=beranda" class="text-gray-800 hover:text-green-600 text-sm md:text-base whitespace-normal md:whitespace-nowrap flex items-center md:justify-between w-full">
                            <span class="line-clamp-2 md:line-clamp-none pr-2">{{ $pengumuman->judul }}</span>
                            <span class="text-gray-500 text-xs md:text-sm md:inline md:shrink-0 md:ml-4">{{ $pengumuman->tanggal_publikasi->format('d M Y, H:i') }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Berita Terbaru -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
            <p class="text-gray-600">Informasi dan perkembangan terkini dari desa</p>
        </div>

        @if($beritaTerbaru->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($beritaTerbaru as $berita)
            <article class="card group border border-gray-200 hover:border-gray-300 rounded-xl shadow-sm hover:shadow-xl transition-all" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <a href="{{ route('berita.show', $berita->slug) }}?from=beranda">
                    <div class="relative h-48 overflow-hidden rounded-t-xl">
                        <img src="{{ $berita->gambar_url }}" 
                             alt="{{ $berita->judul }}"
                             class="w-full h-full object-cover transition-transform duration-500"
                             :class="hover ? 'scale-110' : 'scale-100'">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">
                                {{ ucfirst($berita->kategori) }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $berita->tanggal_publikasi->format('d M Y') }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors line-clamp-2">
                            {{ $berita->judul }}
                        </h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $berita->kutipan }}</p>
                        <div class="flex items-center text-green-600 font-medium">
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

        <div class="text-center mt-12">
            <a href="{{ route('berita.index') }}" class="btn-primary inline-flex">
                Lihat Semua Berita
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <p class="text-gray-600">Belum ada berita tersedia</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ada Keluhan atau Aspirasi?</h2>
        <p class="text-green-100 text-lg mb-8 max-w-2xl mx-auto">
            Sampaikan pengaduan, saran, atau aspirasi Anda. Kami siap mendengarkan dan menindaklanjuti.
        </p>
        <a href="{{ route('pengaduan.index') }}" class="btn-secondary inline-flex">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
            Sampaikan Pengaduan
        </a>
    </div>
</section>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }

    .stat-card {
        @apply bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow duration-300;
    }
    .stat-icon {
        @apply rounded-lg flex items-center p-6 w-full;
    }
    .stat-number {
        @apply text-2xl font-bold leading-none;
    }
    .stat-label {
        @apply text-sm font-medium;
    }

    .card {
        @apply bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300;
        @apply hover:border-gray-300 hover:shadow-xl;
    }

    .btn-primary {
        @apply px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-md hover:shadow-lg font-medium inline-flex items-center;
    }
    .btn-secondary {
        @apply px-6 py-3 bg-white/10 backdrop-blur-sm text-white border-2 border-white rounded-lg hover:bg-white hover:text-green-700 transition-all duration-200 font-medium inline-flex items-center;
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

@push('scripts')
<script>
    // Simple counter animation for stats
    document.addEventListener('alpine:init', () => {
        // Stats animation handled by Alpine.js x-intersect
    });
</script>
@endpush
@endsection
