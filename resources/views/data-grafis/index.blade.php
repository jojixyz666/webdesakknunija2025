@extends('layouts.app')

@section('title', 'Data Grafis')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-indigo-600 to-indigo-800 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Data Grafis Desa
            </h1>
            <p class="text-xl text-indigo-100 max-w-3xl mx-auto">
                Visualisasi data dan informasi {{ $pengaturan['nama_desa'] ?? 'desa' }}
            </p>
        </div>
    </div>
</section>

<!-- Tabs Navigation -->
<section class="bg-white border-b sticky top-16 z-40" x-data="{ activeTab: '{{ request()->get('tab', 'penduduk') }}' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex space-x-8 overflow-x-auto">
            <button @click="activeTab = 'penduduk'" 
                    :class="activeTab === 'penduduk' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Data Penduduk</span>
                </div>
            </button>
            <button @click="activeTab = 'apbdes'" 
                    :class="activeTab === 'apbdes' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>APBDes</span>
                </div>
            </button>
        </nav>
    </div>

    <!-- Tab Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Data Penduduk Tab -->
        <div x-show="activeTab === 'penduduk'" x-transition>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Data Kependudukan</h2>
            
            @if($totalPenduduk == 0)
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-gray-500">Data penduduk belum tersedia</p>
            </div>
            @else
            <!-- Statistik Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Total Penduduk</p>
                            <p class="text-3xl font-bold">{{ number_format($totalPenduduk) }}</p>
                        </div>
                        <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm mb-1">Kepala Keluarga</p>
                            <p class="text-3xl font-bold">{{ number_format($totalKepalaKeluarga) }}</p>
                        </div>
                        <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm mb-1">Laki-laki</p>
                            <p class="text-3xl font-bold">{{ number_format($totalLakiLaki) }}</p>
                        </div>
                        <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-100 text-sm mb-1">Perempuan</p>
                            <p class="text-3xl font-bold">{{ number_format($totalPerempuan) }}</p>
                        </div>
                        <svg class="w-12 h-12 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm mb-1">Wajib Pilih</p>
                            <p class="text-3xl font-bold">{{ number_format($totalWajibPilih) }}</p>
                        </div>
                        <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Charts -->
            <div class="space-y-8">
                <!-- Chart Kelompok Umur -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-6 text-white">
                        <h3 class="text-xl font-bold mb-2">Distribusi Penduduk Berdasarkan Kelompok Umur</h3>
                        <p class="text-indigo-100 text-sm">Grafik menampilkan jumlah penduduk dalam setiap kelompok rentang usia. Data ini berguna untuk analisis demografi dan perencanaan program berbasis usia.</p>
                    </div>
                    <div class="p-6">
                        <canvas id="chartKelompokUmur" height="80"></canvas>
                    </div>
                </div>
                
                <!-- Chart Dusun (Pie) -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                        <h3 class="text-xl font-bold mb-2">Sebaran Penduduk Per Dusun</h3>
                        <p class="text-blue-100 text-sm">Diagram lingkaran menunjukkan proporsi jumlah penduduk di setiap dusun. Memudahkan identifikasi dusun dengan populasi terbesar dan terkecil.</p>
                    </div>
                    <div class="p-6">
                        <div class="max-w-md mx-auto">
                            <canvas id="chartDusun"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Chart Pendidikan -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white">
                        <h3 class="text-xl font-bold mb-2">Tingkat Pendidikan Penduduk</h3>
                        <p class="text-green-100 text-sm">Grafik horizontal menampilkan distribusi tingkat pendidikan masyarakat. Data ini penting untuk perencanaan program pendidikan dan pengembangan SDM desa.</p>
                    </div>
                    <div class="p-6">
                        <canvas id="chartPendidikan" height="100"></canvas>
                    </div>
                </div>
                
                <!-- Chart Wajib Pilih -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 text-white">
                        <h3 class="text-xl font-bold mb-2">Proyeksi Pemilih Dalam Pemilu/Pilkada Per Tahun</h3>
                        <p class="text-purple-100 text-sm">Grafik batang menampilkan proyeksi jumlah penduduk yang memenuhi syarat wajib pilih (17 tahun ke atas) untuk setiap tahun. Data ini berguna untuk perencanaan Pemilu dan Pilkada di tahun-tahun mendatang.</p>
                        <div class="mt-4 pt-4 border-t border-purple-400/30">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-purple-200 text-xs">Wajib Pilih {{ date('Y') }}</p>
                                    <p class="text-2xl font-bold">{{ number_format($totalWajibPilih) }}</p>
                                    <p class="text-purple-200 text-xs">orang (≥ 17 tahun)</p>
                                </div>
                                <div>
                                    <p class="text-purple-200 text-xs">Belum Wajib Pilih</p>
                                    <p class="text-2xl font-bold">{{ number_format($totalPenduduk - $totalWajibPilih) }}</p>
                                    <p class="text-purple-200 text-xs">orang (< 17 tahun)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <canvas id="chartWajibPilih" height="100"></canvas>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- APBDes Tab -->
        <div x-show="activeTab === 'apbdes'" x-transition>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Data APBDes</h2>
                @if($tahunApbdes->count() > 0)
                <form method="GET" action="{{ route('data-grafis.index') }}">
                    <input type="hidden" name="tab" value="apbdes">
                    <select name="tahun_apbdes" 
                            onchange="this.form.submit()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @foreach($tahunApbdes as $tahun)
                        <option value="{{ $tahun }}" {{ $tahunApbdesAktif == $tahun ? 'selected' : '' }}>
                            Tahun {{ $tahun }}
                        </option>
                        @endforeach
                    </select>
                </form>
                @endif
            </div>
            
            @if($dataApbdes->isEmpty())
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500">Data APBDes belum tersedia</p>
            </div>
            @else
            <!-- Ringkasan APBDes -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm mb-1">Pendapatan</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($totalPendapatan / 1000000, 1) }}M</p>
                            <p class="text-xs text-green-100 mt-1">{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                        <svg class="w-10 h-10 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100 text-sm mb-1">Belanja</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($totalBelanja / 1000000, 1) }}M</p>
                            <p class="text-xs text-red-100 mt-1">{{ number_format($totalBelanja, 0, ',', '.') }}</p>
                        </div>
                        <svg class="w-10 h-10 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Pembiayaan Penerimaan</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($totalPembiayaanPenerimaan / 1000000, 1) }}M</p>
                            <p class="text-xs text-blue-100 mt-1">{{ number_format($totalPembiayaanPenerimaan, 0, ',', '.') }}</p>
                        </div>
                        <svg class="w-10 h-10 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                        </svg>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm mb-1">Pembiayaan Pengeluaran</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($totalPembiayaanPengeluaran / 1000000, 1) }}M</p>
                            <p class="text-xs text-orange-100 mt-1">{{ number_format($totalPembiayaanPengeluaran, 0, ',', '.') }}</p>
                        </div>
                        <svg class="w-10 h-10 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                        </svg>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-{{ $surplusDefisit >= 0 ? 'emerald' : 'rose' }}-500 to-{{ $surplusDefisit >= 0 ? 'emerald' : 'rose' }}-600 rounded-lg shadow-md p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-{{ $surplusDefisit >= 0 ? 'emerald' : 'rose' }}-100 text-sm mb-1">{{ $surplusDefisit >= 0 ? 'Surplus' : 'Defisit' }}</p>
                            <p class="text-2xl font-bold">Rp {{ number_format(abs($surplusDefisit) / 1000000, 1) }}M</p>
                            <p class="text-xs text-{{ $surplusDefisit >= 0 ? 'emerald' : 'rose' }}-100 mt-1">{{ number_format(abs($surplusDefisit), 0, ',', '.') }}</p>
                        </div>
                        <svg class="w-10 h-10 text-{{ $surplusDefisit >= 0 ? 'emerald' : 'rose' }}-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($surplusDefisit >= 0)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            @endif
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Detail APBDes -->
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($dataApbdes as $kategori => $items)
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $kategori }}</h3>
                    <div class="space-y-4">
                        @php $total = $items->sum('jumlah'); @endphp
                        @foreach($items as $item)
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-gray-700 text-sm">{{ $item->jenis }}</span>
                                <span class="font-semibold text-indigo-600">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $total > 0 ? ($item->jumlah / $total) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                        <div class="pt-3 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">Total {{ $kategori }}</span>
                                <span class="font-bold text-lg text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>


    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Kelompok Umur
    @if($totalPenduduk > 0)
    const ctxKelompokUmur = document.getElementById('chartKelompokUmur');
    if (ctxKelompokUmur) {
        new Chart(ctxKelompokUmur, {
            type: 'bar',
            data: {
                labels: {!! json_encode($dataKelompokUmur->keys()) !!},
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: {!! json_encode($dataKelompokUmur->values()) !!},
                    backgroundColor: 'rgba(79, 70, 229, 0.8)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
    
    // Chart Dusun (Pie)
    const ctxDusun = document.getElementById('chartDusun');
    if (ctxDusun) {
        new Chart(ctxDusun, {
            type: 'pie',
            data: {
                labels: {!! json_encode($dataDusun->pluck('dusun')) !!},
                datasets: [{
                    data: {!! json_encode($dataDusun->pluck('jumlah')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(99, 255, 132, 0.8)',
                        'rgba(235, 54, 162, 0.8)',
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    }
    
    // Chart Pendidikan
    const ctxPendidikan = document.getElementById('chartPendidikan');
    if (ctxPendidikan) {
        new Chart(ctxPendidikan, {
            type: 'bar',
            data: {
                labels: {!! json_encode($dataPendidikan->pluck('pendidikan')) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($dataPendidikan->pluck('jumlah')) !!},
                    backgroundColor: 'rgba(34, 197, 94, 0.8)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
    
    // Chart Wajib Pilih (Bar - Per Tahun)
    const ctxWajibPilih = document.getElementById('chartWajibPilih');
    if (ctxWajibPilih) {
        new Chart(ctxWajibPilih, {
            type: 'bar',
            data: {
                labels: {!! json_encode($tahunRange) !!},
                datasets: [
                    {
                        label: 'Wajib Pilih (≥ 17 tahun)',
                        data: {!! json_encode($dataWajibPilihPerTahun) !!},
                        backgroundColor: 'rgba(168, 85, 247, 0.8)',
                        borderColor: 'rgba(168, 85, 247, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Belum Wajib Pilih (< 17 tahun)',
                        data: {!! json_encode($dataTidakWajibPilihPerTahun) !!},
                        backgroundColor: 'rgba(209, 213, 219, 0.8)',
                        borderColor: 'rgba(209, 213, 219, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tahun'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Penduduk'
                        },
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });
    }
    @endif
});
</script>
@endpush
@endsection
