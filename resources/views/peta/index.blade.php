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
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Peta Desa</h1>
        <p class="text-green-100 text-lg">Lokasi fasilitas umum dan tempat penting di desa</p>
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
                        :class="selectedCategory === 'semua' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Semua
                </button>
                <button @click="selectedCategory = 'fasilitas_umum'; filterMarkers('fasilitas_umum')"
                        :class="selectedCategory === 'fasilitas_umum' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Fasilitas Umum
                </button>
                <button @click="selectedCategory = 'wisata'; filterMarkers('wisata')"
                        :class="selectedCategory === 'wisata' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Wisata
                </button>
                <button @click="selectedCategory = 'pemerintahan'; filterMarkers('pemerintahan')"
                        :class="selectedCategory === 'pemerintahan' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-lg font-medium transition">
                    Pemerintahan
                </button>
                <button @click="selectedCategory = 'lainnya'; filterMarkers('lainnya')"
                        :class="selectedCategory === 'lainnya' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
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
                <div class="w-full h-48 bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                @endif
                <div class="p-6">
                    <div class="mb-3">
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                            {{ $item->kategori_label }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->nama_lokasi }}</h3>
                    @if($item->deskripsi)
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($item->deskripsi, 100) }}</p>
                    @endif
                    <button onclick="focusMarker({{ $item->latitude }}, {{ $item->longitude }})" 
                            class="text-green-600 hover:text-green-800 font-medium text-sm inline-flex items-center">
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

    // Koordinat default Desa Ambunten Tengah
    const defaultLat = {{ $lokasi->first()->latitude ?? '-6.9003364' }};
    const defaultLng = {{ $lokasi->first()->longitude ?? '113.7216313' }};

    // Initialize map
    document.addEventListener('DOMContentLoaded', function() {
        // Koordinat pusat Desa Ambunten Tengah dari Google Maps
        map = L.map('map').setView([-6.9003364, 113.7216313], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add village boundary polygon - Desa Ambunten Tengah
        // Koordinat batas wilayah RESMI Desa Ambunten Tengah, Kec. Ambunten, Kab. Sumenep
        // Data GPS Tracking - 145 titik koordinat akurat
        // Pusat: -6.9003364, 113.7216313
        // Batas Wilayah:
        // - Utara: Laut Jawa
        // - Timur: Desa Ambunten Timur
        // - Selatan: Desa Tambaagung Barat
        // - Barat: Desa Ambunten Barat
        const villageBoundary = [
            [-6.886272042094689, 113.71383629144876],
            [-6.886403261533136, 113.71515802081407],
            [-6.886403261533136, 113.7162814907746],
            [-6.886731309970477, 113.71786756601298],
            [-6.886272042094689, 113.7190571224418],
            [-6.886862529281894, 113.72070928414843],
            [-6.886862529281894, 113.72421186696656],
            [-6.886731309970477, 113.72559968280012],
            [-6.886472333971852, 113.73641872609745],
            [-6.887283797339778, 113.73719521880837],
            [-6.88788862697357, 113.73801366366122],
            [-6.889911895354077, 113.73756077891727],
            [-6.8901888589862414, 113.73792127201592],
            [-6.8902306731959335, 113.73960600777437],
            [-6.890504053606366, 113.7397531021739],
            [-6.891162019671165, 113.73971034388893],
            [-6.890965912819846, 113.73854847242025],
            [-6.891107545553857, 113.73838386090497],
            [-6.891151124848121, 113.73832899039988],
            [-6.891434390163185, 113.73842775730905],
            [-6.893331688323336, 113.74036141924458],
            [-6.894224927950442, 113.73955164929824],
            [-6.894569462765444, 113.73948738184353],
            [-6.895386136881764, 113.7398986935537],
            [-6.895947599520176, 113.74045139366423],
            [-6.896496301001158, 113.7404385401733],
            [-6.896598384972875, 113.74011720291],
            [-6.896725989849867, 113.74000152149154],
            [-6.897006720458251, 113.73995010752773],
            [-6.897172606648635, 113.73995010752773],
            [-6.897541684495608, 113.73885332955068],
            [-6.898153636904805, 113.73798442780821],
            [-6.899975269830581, 113.73716890824116],
            [-6.903026878566779, 113.73741983733422],
            [-6.903792262132778, 113.73728265679966],
            [-6.905227131675114, 113.73741530467473],
            [-6.90536066963728, 113.73755602283093],
            [-6.9052897749267546, 113.7366060255068],
            [-6.9052805356426745, 113.73600573735935],
            [-6.905234339219579, 113.73533564826452],
            [-6.905110401460889, 113.73473532232579],
            [-6.904706133164836, 113.73254325570785],
            [-6.907582889566791, 113.72757901726605],
            [-6.907951015019107, 113.72749072745908],
            [-6.908231491361863, 113.72766730707302],
            [-6.9083541997095175, 113.72747306949769],
            [-6.910734652957258, 113.7263729686643],
            [-6.9114528143430185, 113.72620602606149],
            [-6.912520847150591, 113.72559390344202],
            [-6.912999619694647, 113.72507452667398],
            [-6.913239005784779, 113.72487048580082],
            [-6.913404734545378, 113.72436965820305],
            [-6.913533634652311, 113.7238688306053],
            [-6.9135520489504305, 113.72336800300755],
            [-6.913570463247837, 113.72338655217783],
            [-6.913533634652311, 113.72205101191716],
            [-6.9137361918921805, 113.72104935672164],
            [-6.915467132113147, 113.72045578319262],
            [-6.915945901671691, 113.72052997987379],
            [-6.916461499140531, 113.72038158652332],
            [-6.917419035756546, 113.72082676661022],
            [-6.918137186944494, 113.72108645499422],
            [-6.9186896101920325, 113.72108645499422],
            [-6.919518243917635, 113.72090096320629],
            [-6.922814350115341, 113.71811858761737],
            [-6.923256284386156, 113.71804439093623],
            [-6.923790287744502, 113.71811858761737],
            [-6.923624562630727, 113.71439020424916],
            [-6.9230537312246225, 113.71409341740029],
            [-6.92279593617295, 113.71372243399455],
            [-6.922777522235289, 113.71309176220477],
            [-6.922888005850424, 113.71251673792588],
            [-6.922777522235289, 113.70936337897702],
            [-6.922832764046094, 113.70904804308215],
            [-6.92270386647751, 113.70873270718727],
            [-6.922722280411519, 113.70637696231381],
            [-6.922574968867198, 113.70604307724862],
            [-6.921488544807727, 113.70459624196621],
            [-6.921285990892926, 113.70452204528507],
            [-6.921138678900285, 113.7043365535822],
            [-6.920475774364493, 113.70415106187932],
            [-6.919720798620438, 113.70411396353875],
            [-6.919205204735563, 113.70422525856048],
            [-6.918542297441734, 113.7035760375383],
            [-6.917437449955725, 113.70379862758175],
            [-6.917308550913984, 113.70442929937151],
            [-6.916921853577663, 113.7048744794584],
            [-6.917032338563211, 113.70511561867215],
            [-6.9171244093647575, 113.7057648396322],
            [-6.916700883529052, 113.70604307718651],
            [-6.916203700486483, 113.70583903628898],
            [-6.916019558506495, 113.70587613462953],
            [-6.915651274331181, 113.7063769622273],
            [-6.9148042196383335, 113.70702618318735],
            [-6.914693734131647, 113.70780524833943],
            [-6.914178134758814, 113.70838027261831],
            [-6.914178134758814, 113.70847301846976],
            [-6.914178134758814, 113.70906659191897],
            [-6.913754606281646, 113.70951177200585],
            [-6.913478391799748, 113.71060617320582],
            [-6.913018034059684, 113.71075456656813],
            [-6.912797062185156, 113.71131104167675],
            [-6.912704990540279, 113.71144088586875],
            [-6.91248401851938, 113.71168202508248],
            [-6.910863553811189, 113.71205300850967],
            [-6.908911623115378, 113.71181186929593],
            [-6.907954069199511, 113.71188606598152],
            [-6.907512120613186, 113.71168202510836],
            [-6.907033342511975, 113.71051342738025],
            [-6.906793953279621, 113.71032793567737],
            [-6.906333589030719, 113.71068036991284],
            [-6.906131028619264, 113.71066182074256],
            [-6.9059652973090175, 113.71053197655054],
            [-6.905560176083958, 113.70947467384416],
            [-6.905560176083958, 113.70943757550359],
            [-6.9039634527367175, 113.70908470118592],
            [-6.902392935110082, 113.70910309637105],
            [-6.901352007696999, 113.70845926485798],
            [-6.899425620843593, 113.70934853196476],
            [-6.899104796622664, 113.70958551910705],
            [-6.897922800243809, 113.71057629259062],
            [-6.897827764410173, 113.71153357994856],
            [-6.897946559199245, 113.71241907075465],
            [-6.897827764410173, 113.71270625696204],
            [-6.897376343939926, 113.71289771443361],
            [-6.8966635739004465, 113.71284985006571],
            [-6.896687332919035, 113.71287378224966],
            [-6.89633094751497, 113.71332849374468],
            [-6.895499380529518, 113.71474049259764],
            [-6.894311425161323, 113.71478835696553],
            [-6.893764964691854, 113.71524306846055],
            [-6.893052189127001, 113.7152430685206],
            [-6.892481967977294, 113.71533879725641],
            [-6.891650394237642, 113.71481228920953],
            [-6.890985134195622, 113.71481228920953],
            [-6.890771300412422, 113.71445330645031],
            [-6.8901773171753105, 113.71423791679479],
            [-6.888656716610757, 113.71402252716308],
            [-6.888038971274003, 113.71368747658781],
            [-6.8867288499412735, 113.71366354440384],
            [-6.886272042094689, 113.71383629144876]
        ];

        // Draw boundary dengan styling
        const boundaryPolygon = L.polygon(villageBoundary, {
            color: '#16a34a',           // Warna garis hijau
            weight: 4,                  // Ketebalan garis
            opacity: 0.9,               // Transparansi garis
            fillColor: '#22c55e',       // Warna isi hijau
            fillOpacity: 0.15,          // Transparansi isi
            dashArray: '12, 8'          // Garis putus-putus
        }).addTo(map);

        // Popup info untuk boundary
        boundaryPolygon.bindPopup(`
            <div class="p-4">
                <h3 class="font-bold text-gray-900 mb-2 text-lg">Wilayah Desa Ambunten Tengah</h3>
                <p class="text-sm text-gray-600 mb-3">Kecamatan Ambunten, Kabupaten Sumenep</p>
                <div class="border-t pt-3 space-y-2">
                    <div class="flex items-start">
                        <span class="font-semibold text-xs text-green-700 w-20">Utara:</span>
                        <span class="text-xs text-gray-600">Laut Jawa</span>
                    </div>
                    <div class="flex items-start">
                        <span class="font-semibold text-xs text-green-700 w-20">Timur:</span>
                        <span class="text-xs text-gray-600">Desa Ambunten Timur</span>
                    </div>
                    <div class="flex items-start">
                        <span class="font-semibold text-xs text-green-700 w-20">Selatan:</span>
                        <span class="text-xs text-gray-600">Desa Tambaagung Barat</span>
                    </div>
                    <div class="flex items-start">
                        <span class="font-semibold text-xs text-green-700 w-20">Barat:</span>
                        <span class="text-xs text-gray-600">Desa Ambunten Barat</span>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t">
                    <p class="text-xs text-gray-500">Terdiri dari 8 Dusun</p>
                </div>
            </div>
        `, {
            className: 'custom-popup',
            maxWidth: 300
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
                <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded mb-2">
                    ${item.kategori_label}
                </span>
                ${item.deskripsi ? `<p class="text-sm text-gray-600 mt-2">${item.deskripsi}</p>` : ''}
                <a href="https://www.google.com/maps?q=${item.latitude},${item.longitude}" 
                   target="_blank"
                   class="inline-flex items-center mt-3 text-green-600 hover:text-green-800 text-sm font-medium">
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
