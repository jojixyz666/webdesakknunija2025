<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $pengaturan['deskripsi_desa'] ?? 'Website Resmi Desa' }}">
    <title>@yield('title', 'Beranda') - {{ $pengaturan['nama_desa'] ?? 'Desa' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Intersect plugin for x-intersect -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Leaflet for maps -->
    @stack('head-scripts')
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navbar -->
        <nav x-data="{ open: false, scrolled: false }" 
            @scroll.window="scrolled = window.scrollY > 20"
            :class="scrolled ? 'bg-white shadow-lg' : 'bg-white/95 backdrop-blur-sm'"
            class="fixed w-full z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center">
                    <a href="{{ route('beranda') }}" class="flex items-center space-x-3">
                        @if(isset($pengaturan['logo_desa']) && !empty($pengaturan['logo_desa']))
                        <img src="{{ asset('storage/' . $pengaturan['logo_desa']) }}" alt="Logo" class="h-10 w-10 object-cover rounded-lg ring-1 ring-gray-200">
                        @else
                        <div class="h-10 w-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg flex items-center justify-center ring-1 ring-blue-300/40">
                            <span class="text-white font-bold text-lg">{{ substr($pengaturan['nama_desa'] ?? 'D', 0, 1) }}</span>
                        </div>
                        @endif
                        <div>
                            <h1 class="text-lg md:text-xl font-semibold text-gray-900 tracking-tight">{{ $pengaturan['nama_desa'] ?? 'Desa' }}</h1>
                            @if(isset($pengaturan['kecamatan']) && !empty($pengaturan['kecamatan']))
                            <p class="text-[11px] text-gray-600">{{ $pengaturan['kecamatan'] }}</p>
                            @endif
                        </div>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Beranda</span>
                        <span class="indicator"></span>
                    </a>
                    <a href="{{ route('berita.index') }}" class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span>Berita</span>
                        <span class="indicator"></span>
                    </a>
                    <a href="{{ route('profile.index') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>Profile</span>
                        <span class="indicator"></span>
                    </a>
                    <a href="{{ route('peta.index') }}" class="nav-link {{ request()->routeIs('peta.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <span>Peta Desa</span>
                        <span class="indicator"></span>
                    </a>
                    <a href="{{ route('apbd.index') }}" class="nav-link {{ request()->routeIs('apbd.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Transparansi</span>
                        <span class="indicator"></span>
                    </a>
                    <a href="{{ route('data-grafis.index') }}" class="nav-link {{ request()->routeIs('data-grafis.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Data Grafis</span>
                        <span class="indicator"></span>
                    </a>
                    <a href="{{ route('pengaduan.index') }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg font-medium">
                        Pengaduan
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
           <div x-show="open" 
             @click.away="open = false"
               x-transition:enter="transition ease-out duration-400"
               x-transition:enter-start="opacity-0 -translate-y-1"
               x-transition:enter-end="opacity-100 translate-y-0"
               x-transition:leave="transition ease-in duration-300"
               x-transition:leave-start="opacity-100 translate-y-0"
               x-transition:leave-end="opacity-0 -translate-y-1"
               class="md:hidden bg-white border-t border-gray-200 shadow-lg">
            <div class="px-4 pt-3 pb-4 space-y-2">
                <a href="{{ route('beranda') }}" 
                   @click="open = false"
                   class="mobile-nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('berita.index') }}" 
                   @click="open = false"
                   class="mobile-nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <span>Berita</span>
                </a>
                <a href="{{ route('profile.index') }}" 
                   @click="open = false"
                   class="mobile-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>Profile</span>
                </a>
                <a href="{{ route('peta.index') }}" 
                   @click="open = false"
                   class="mobile-nav-link {{ request()->routeIs('peta.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span>Peta Desa</span>
                </a>
                <a href="{{ route('apbd.index') }}" 
                   @click="open = false"
                   class="mobile-nav-link {{ request()->routeIs('apbd.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Transparansi</span>
                </a>
                <a href="{{ route('data-grafis.index') }}" 
                   @click="open = false"
                   class="mobile-nav-link {{ request()->routeIs('data-grafis.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Data Grafis</span>
                </a>
                <a href="{{ route('pengaduan.index') }}" 
                   @click="open = false"
                   class="flex items-center space-x-2 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-medium shadow-md">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    <span>Pengaduan</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @if(session('success'))
        <div x-data="{ show: true }" 
             x-show="show"
             x-transition
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-24 right-4 z-50 max-w-sm">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">{{ $pengaturan['nama_desa'] ?? 'Desa' }}</h3>
                    <p class="text-sm mb-4">{{ $pengaturan['deskripsi_singkat'] ?? 'Website resmi desa untuk informasi dan layanan masyarakat.' }}</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Menu</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('beranda') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-white transition">Berita</a></li>
                        <li><a href="{{ route('profile.index') }}" class="hover:text-white transition">Profile Desa</a></li>
                        <li><a href="{{ route('peta.index') }}" class="hover:text-white transition">Peta Desa</a></li>
                        <li><a href="{{ route('apbd.index') }}" class="hover:text-white transition">Transparansi</a></li>
                        <li><a href="{{ route('pengaduan.index') }}" class="hover:text-white transition">Pengaduan</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $pengaturan['alamat'] ?? 'Alamat Kantor Desa' }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $pengaturan['telepon'] ?? '-' }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $pengaturan['email'] ?? '-' }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} {{ $pengaturan['nama_desa'] ?? 'Desa' }}. Powered by Laravel & Tailwind CSS.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <style>
        .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            color: #374151; /* gray-700 */
            transition: color 350ms cubic-bezier(0.22, 1, 0.36, 1), background-color 350ms cubic-bezier(0.22, 1, 0.36, 1);
            position: relative;
            will-change: background-color, color;
            transform-origin: center;
            outline: none;
        }
        .nav-link:hover { 
            color: #1d4ed8; /* blue-700 */
            background-color: #eff6ff; /* blue-50 */
        }
        .nav-link .indicator {
            position: absolute;
            bottom: -6px;
            left: 10px;
            height: 2px;
            width: 0;
            background: linear-gradient(90deg, #2563eb, #1e40af);
            border-radius: 9999px;
            transition: width 250ms ease;
        }
        .nav-link:hover .indicator { width: calc(100% - 20px); }
        .nav-link.active {
            color: #1d4ed8;
            background-color: #dbeafe; /* blue-100 */
        }
        .nav-link.active .indicator { width: calc(100% - 20px); }
        /* Reduce motion for users who prefer it */
        @media (prefers-reduced-motion: reduce) {
            .nav-link, .nav-link .indicator { transition: none; }
        }
        .mobile-nav-link {
            @apply flex items-center space-x-2 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-300 font-medium;
        }
        .mobile-nav-link.active {
            @apply bg-blue-100 text-blue-700;
        }
    </style>
    
    @stack('scripts')
</body>
</html>
