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
        map = L.map('map').setView([-6.90368, 113.72712], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add village boundary polygon - Desa Ambunten Tengah
        // Koordinat batas wilayah Desa Ambunten Tengah, Kec. Ambunten, Kab. Sumenep
        // Pusat: -6.90368, 113.72712
        // Untuk lengkungan detail, tambahkan lebih banyak titik koordinat
        const villageBoundary = [
            [-6.8980, 113.7210],  // Titik 1 - Utara Barat
            [-6.8965, 113.7220],  // Titik 2
            [-6.8950, 113.7240],  // Titik 3 - Utara
            [-6.8955, 113.7260],  // Titik 4
            [-6.8960, 113.7280],  // Titik 5
            [-6.8970, 113.7300],  // Titik 6 - Utara Timur
            [-6.8985, 113.7315],  // Titik 7
            [-6.9000, 113.7325],  // Titik 8
            [-6.9020, 113.7330],  // Titik 9 - Timur
            [-6.9045, 113.7328],  // Titik 10
            [-6.9070, 113.7322],  // Titik 11
            [-6.9090, 113.7315],  // Titik 12
            [-6.9100, 113.7310],  // Titik 13 - Tenggara
            [-6.9115, 113.7290],  // Titik 14
            [-6.9125, 113.7270],  // Titik 15
            [-6.9130, 113.7260],  // Titik 16 - Selatan
            [-6.9125, 113.7240],  // Titik 17
            [-6.9118, 113.7225],  // Titik 18
            [-6.9110, 113.7210],  // Titik 19 - Barat Daya
            [-6.9090, 113.7195],  // Titik 20
            [-6.9070, 113.7185],  // Titik 21
            [-6.9050, 113.7180],  // Titik 22 - Barat
            [-6.9025, 113.7185],  // Titik 23
            [-6.9000, 113.7195],  // Titik 24
            [-6.8980, 113.7210]   // Kembali ke titik awal (HARUS sama dengan titik 1)
        ];

        // Draw boundary dengan styling
        const boundaryPolygon = L.polygon(villageBoundary, {
            color: '#2563eb',           // Warna garis biru
            weight: 3,                  // Ketebalan garis
            opacity: 0.8,               // Transparansi garis
            fillColor: '#3b82f6',       // Warna isi biru muda
            fillOpacity: 0.1,           // Transparansi isi (sangat tipis)
            dashArray: '10, 5'          // Garis putus-putus
        }).addTo(map);

        // Popup info untuk boundary
        boundaryPolygon.bindPopup(`
            <div class="p-3">
                <h3 class="font-bold text-gray-900 mb-1">Wilayah Desa Ambunten Tengah</h3>
                <p class="text-sm text-gray-600">Batas administratif Desa Ambunten Tengah</p>
                <p class="text-xs text-gray-500 mt-1">Kec. Ambunten, Kab. Sumenep</p>
            </div>
        `, {
            className: 'custom-popup'
        });

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
        // Custom icon berdasarkan kategori dengan berbagai style
        // Opsi 1: Emoji (sudah ada)
        const emojiIcons = {
            'fasilitas_umum': '🏥',
            'wisata': '🎯',
            'pemerintahan': '🏛️',
            'lainnya': '📍'
        };

        // Opsi 2: Font Awesome / SVG Icons dengan warna berbeda
        const coloredIcons = {
            'fasilitas_umum': { icon: '🏥', color: '#ef4444', bg: '#fee2e2' },  // Merah
            'wisata': { icon: '🎯', color: '#10b981', bg: '#d1fae5' },          // Hijau
            'pemerintahan': { icon: '🏛️', color: '#3b82f6', bg: '#dbeafe' },    // Biru
            'lainnya': { icon: '📍', color: '#f59e0b', bg: '#fed7aa' }          // Orange
        };

        const iconData = coloredIcons[item.kategori] || coloredIcons['lainnya'];

        // Style 1: Marker dengan border berwarna
        const icon = L.divIcon({
            html: `
                <div style="
                    background: ${iconData.bg};
                    border: 3px solid ${iconData.color};
                    border-radius: 50%;
                    width: 40px;
                    height: 40px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 20px;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
                ">
                    ${iconData.icon}
                </div>
            `,
            className: 'custom-marker-icon',
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });

        // ALTERNATIF: Uncomment salah satu style di bawah untuk ganti tampilan
        
        // Style 2: Marker dengan ekor (tear drop)
        /*
        const icon = L.divIcon({
            html: `
                <div style="
                    position: relative;
                    width: 35px;
                    height: 45px;
                ">
                    <svg viewBox="0 0 24 24" fill="${iconData.color}" style="width: 100%; height: 100%;">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <div style="
                        position: absolute;
                        top: 8px;
                        left: 50%;
                        transform: translateX(-50%);
                        font-size: 16px;
                    ">
                        ${iconData.icon}
                    </div>
                </div>
            `,
            className: 'custom-marker-icon',
            iconSize: [35, 45],
            iconAnchor: [17, 45],
            popupAnchor: [0, -45]
        });
        */

        // Style 3: Marker kotak dengan shadow
        /*
        const icon = L.divIcon({
            html: `
                <div style="
                    background: linear-gradient(135deg, ${iconData.color} 0%, ${iconData.bg} 100%);
                    border-radius: 10px;
                    width: 45px;
                    height: 45px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 24px;
                    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
                    transform: rotate(45deg);
                ">
                    <span style="transform: rotate(-45deg);">${iconData.icon}</span>
                </div>
            `,
            className: 'custom-marker-icon',
            iconSize: [45, 45],
            iconAnchor: [22, 45],
            popupAnchor: [0, -45]
        });
        */

        // Style 4: Menggunakan gambar custom PNG/SVG
        /*
        const icon = L.icon({
            iconUrl: '/images/markers/' + item.kategori + '.png',  // Siapkan file di public/images/markers/
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32],
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            shadowSize: [41, 41]
        });
        */

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
        .custom-marker-icon {
            background: transparent !important;
            border: none !important;
        }
        .custom-popup .leaflet-popup-content-wrapper {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
@endsection
