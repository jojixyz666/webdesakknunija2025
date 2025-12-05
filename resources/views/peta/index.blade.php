@extends('layouts.app')

@section('title', 'Peta Desa')

@push('head-scripts')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { height: 600px; z-index: 1; }
    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        padding: 0;
    }
    .leaflet-popup-content {
        margin: 0;
        width: 250px !important;
    }
</style>
@endpush

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Peta Desa</h1>
        <p class="text-blue-100 text-lg">Lokasi fasilitas umum dan tempat penting di desa</p>
    </div>
</section>

<!-- Map Section -->
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6" x-data="{ selectedCategory: 'semua' }">
            <div class="flex flex-wrap items-center gap-3">
                <span class="font-medium text-gray-700">Filter:</span>
                <button @click="selectedCategory = 'semua'; filterMarkers('semua')"
                        :class="selectedCategory === 'semua' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Semua
                </button>
                <button @click="selectedCategory = 'fasilitas_umum'; filterMarkers('fasilitas_umum')"
                        :class="selectedCategory === 'fasilitas_umum' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Fasilitas Umum
                </button>
                <button @click="selectedCategory = 'wisata'; filterMarkers('wisata')"
                        :class="selectedCategory === 'wisata' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Wisata
                </button>
                <button @click="selectedCategory = 'pemerintahan'; filterMarkers('pemerintahan')"
                        :class="selectedCategory === 'pemerintahan' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Pemerintahan
                </button>
                <button @click="selectedCategory = 'lainnya'; filterMarkers('lainnya')"
                        :class="selectedCategory === 'lainnya' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Lainnya
                </button>
            </div>
        </div>

        <!-- Map Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div id="map"></div>
        </div>

        <!-- Lokasi List -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="lokasi-list">
            @foreach($lokasi as $item)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300 lokasi-card" 
                 data-kategori="{{ $item->kategori }}"
                 data-lat="{{ $item->latitude }}"
                 data-lng="{{ $item->longitude }}">
                @if($item->gambar)
                <img src="{{ $item->gambar_url }}" 
                     alt="{{ $item->nama_lokasi }}"
                     class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                @endif
                <div class="p-6">
                    <div class="mb-3">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                            {{ $item->kategori_label }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->nama_lokasi }}</h3>
                    @if($item->deskripsi)
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($item->deskripsi, 100) }}</p>
                    @endif
                    <button onclick="focusMarker({{ $item->latitude }}, {{ $item->longitude }})" 
                            class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Lihat di Peta
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let map;
    let markers = [];
    let markerGroup;

    // Koordinat default (ganti dengan koordinat desa Anda)
    const defaultLat = {{ $lokasi->first()->latitude ?? '-6.2088' }};
    const defaultLng = {{ $lokasi->first()->longitude ?? '106.8456' }};

    // Initialize map
    document.addEventListener('DOMContentLoaded', function() {
        map = L.map('map').setView([defaultLat, defaultLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        markerGroup = L.layerGroup().addTo(map);

        // Load markers from API
        loadMarkers();
    });

    async function loadMarkers() {
        try {
            const response = await fetch('{{ route('api.peta.lokasi') }}');
            const lokasi = await response.json();

            lokasi.forEach(item => {
                const marker = createMarker(item);
                markers.push({
                    marker: marker,
                    kategori: item.kategori,
                    lat: item.latitude,
                    lng: item.longitude
                });
            });

            // Fit bounds to show all markers
            if (markers.length > 0) {
                const bounds = markers.map(m => m.marker.getLatLng());
                map.fitBounds(bounds, { padding: [50, 50] });
            }
        } catch (error) {
            console.error('Error loading markers:', error);
        }
    }

    function createMarker(item) {
        // Custom icon berdasarkan kategori
        const icons = {
            'fasilitas_umum': '🏥',
            'wisata': '🎯',
            'pemerintahan': '🏛️',
            'lainnya': '📍'
        };

        const icon = L.divIcon({
            html: `<div class="text-2xl">${icons[item.kategori] || '📍'}</div>`,
            className: 'custom-marker',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        });

        const marker = L.marker([item.latitude, item.longitude], { icon: icon })
            .addTo(markerGroup);

        // Popup content
        let popupContent = `
            <div class="p-4">
                ${item.gambar_url ? `<img src="${item.gambar_url}" class="w-full h-32 object-cover rounded-lg mb-3">` : ''}
                <h3 class="font-bold text-gray-900 mb-2">${item.nama_lokasi}</h3>
                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded mb-2">
                    ${item.kategori_label}
                </span>
                ${item.deskripsi ? `<p class="text-sm text-gray-600 mt-2">${item.deskripsi}</p>` : ''}
                <a href="https://www.google.com/maps?q=${item.latitude},${item.longitude}" 
                   target="_blank"
                   class="inline-flex items-center mt-3 text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    Buka di Google Maps
                </a>
            </div>
        `;

        marker.bindPopup(popupContent, {
            maxWidth: 250,
            className: 'custom-popup'
        });

        return marker;
    }

    function filterMarkers(kategori) {
        markerGroup.clearLayers();
        const cards = document.querySelectorAll('.lokasi-card');

        if (kategori === 'semua') {
            markers.forEach(m => m.marker.addTo(markerGroup));
            cards.forEach(card => card.style.display = 'block');
        } else {
            markers.forEach(m => {
                if (m.kategori === kategori) {
                    m.marker.addTo(markerGroup);
                }
            });
            cards.forEach(card => {
                card.style.display = card.dataset.kategori === kategori ? 'block' : 'none';
            });
        }

        // Fit bounds to visible markers
        const visibleMarkers = [];
        markerGroup.eachLayer(layer => visibleMarkers.push(layer.getLatLng()));
        if (visibleMarkers.length > 0) {
            map.fitBounds(visibleMarkers, { padding: [50, 50] });
        }
    }

    function focusMarker(lat, lng) {
        map.setView([lat, lng], 16);
        
        // Find and open popup
        markerGroup.eachLayer(marker => {
            const markerLatLng = marker.getLatLng();
            if (markerLatLng.lat === lat && markerLatLng.lng === lng) {
                marker.openPopup();
            }
        });

        // Smooth scroll to map
        document.getElementById('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Custom marker style
    const style = document.createElement('style');
    style.textContent = `
        .custom-marker {
            background: white;
            border: 3px solid #2563eb;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .custom-popup .leaflet-popup-content-wrapper {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
@endsection
