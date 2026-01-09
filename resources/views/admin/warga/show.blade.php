@extends('admin.layouts.app')

@section('title', 'Detail Data Warga')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Detail Data Warga</h1>
        <p class="text-gray-600 mt-1">Informasi lengkap penduduk</p>
    </div>
    <div class="flex space-x-2">
        <a href="{{ route('admin.warga.edit', $warga) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit
        </a>
        <a href="{{ route('admin.warga.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Sidebar Info -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center mb-6">
                <div class="w-32 h-32 mx-auto bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center mb-4">
                    <span class="text-5xl font-bold text-white">{{ strtoupper(substr($warga->nama, 0, 1)) }}</span>
                </div>
                <h2 class="text-xl font-bold text-gray-900">{{ $warga->nama }}</h2>
                <p class="text-gray-600">{{ $warga->nik }}</p>
            </div>
            
            <div class="border-t border-gray-200 pt-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Umur</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $warga->umur }} tahun</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kelompok Umur</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $warga->kelompok_umur }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                        {{ $warga->status_dalam_keluarga }}
                    </span>
                </div>
                @if($warga->wajib_pilih)
                <div>
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Wajib Pilih
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Data Pribadi -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Data Pribadi</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">NIK</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->nik }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Nomor KK</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->nomor_kk }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jenis Kelamin</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tempat, Tanggal Lahir</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->tempat_lahir }}, {{ $warga->tanggal_lahir->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Agama</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->agama }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kewarganegaraan</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->kewarganegaraan }}</p>
                </div>
            </div>
        </div>
        
        <!-- Data Keluarga & Sosial -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Data Keluarga & Sosial</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Status Perkawinan</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->status_perkawinan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Dalam Keluarga</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->status_dalam_keluarga }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pendidikan</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->pendidikan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pekerjaan</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->pekerjaan ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Data Alamat -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Data Alamat</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Dusun</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->dusun }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">RT</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->rt }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">RW</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->rw }}</p>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Alamat Lengkap</p>
                <p class="text-base font-medium text-gray-900">{{ $warga->alamat }}</p>
            </div>
        </div>
        
        <!-- Data Timestamps -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Informasi Sistem</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Ditambahkan Pada</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                    <p class="text-base font-medium text-gray-900">{{ $warga->updated_at->format('d F Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
