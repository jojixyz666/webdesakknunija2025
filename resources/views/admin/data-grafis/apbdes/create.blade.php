@extends('admin.layouts.app')

@section('title', 'Tambah Data APBDes')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Tambah Data APBDes</h1>
    <p class="text-gray-600">Tambah data anggaran pendapatan dan belanja desa</p>
</div>

<form action="{{ route('admin.data-grafis.apbdes.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <!-- Tahun -->
                <div class="mb-6">
                    <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                        Tahun <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="tahun" 
                           id="tahun" 
                           value="{{ old('tahun', date('Y')) }}"
                           min="2000" 
                           max="2100"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                    @error('tahun')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-6">
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori" 
                            id="kategori" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Pendapatan" {{ old('kategori') == 'Pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                        <option value="Belanja" {{ old('kategori') == 'Belanja' ? 'selected' : '' }}>Belanja</option>
                        <option value="Pembiayaan Penerimaan" {{ old('kategori') == 'Pembiayaan Penerimaan' ? 'selected' : '' }}>Pembiayaan Penerimaan</option>
                        <option value="Pembiayaan Pengeluaran" {{ old('kategori') == 'Pembiayaan Pengeluaran' ? 'selected' : '' }}>Pembiayaan Pengeluaran</option>
                    </select>
                    @error('kategori')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis -->
                <div class="mb-6">
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis/Uraian <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="jenis" 
                           id="jenis" 
                           value="{{ old('jenis') }}"
                           placeholder="Contoh: Pendapatan Asli Desa, Belanja Pegawai, dll"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                    @error('jenis')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah -->
                <div class="mb-6">
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">
                        Jumlah (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="jumlah" 
                           id="jumlah" 
                           value="{{ old('jumlah') }}"
                           min="0"
                           step="0.01"
                           placeholder="0"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                    @error('jumlah')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Urutan -->
                <div>
                    <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                        Urutan Tampilan
                    </label>
                    <input type="number" 
                           name="urutan" 
                           id="urutan" 
                           value="{{ old('urutan', 0) }}"
                           min="0"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    @error('urutan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Digunakan untuk mengurutkan tampilan data (semakin kecil semakin atas)</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                
                <button type="submit" 
                        class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium mb-3">
                    Simpan Data
                </button>
                
                <a href="{{ route('admin.data-grafis.apbdes.index') }}" 
                   class="w-full px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium inline-block text-center">
                    Batal
                </a>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="font-semibold text-gray-900 mb-3 text-sm">Informasi</h4>
                    <div class="space-y-2 text-xs text-gray-600">
                        <div class="flex items-start">
                            <svg class="w-4 h-4 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p>Data akan ditampilkan di halaman Data Grafis</p>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-4 h-4 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p>Pastikan kategori dan jenis sesuai dengan struktur APBDes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
