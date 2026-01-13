@extends('admin.layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar
    </a>
    <h1 class="text-3xl font-bold text-gray-900">Detail Pengaduan</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $pengaduan->judul }}</h2>
                    {!! $pengaduan->status_badge !!}
                </div>
                <p class="text-sm text-gray-500">Dikirim: {{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
            </div>

            <div class="prose max-w-none mb-6">
                <p class="text-gray-700 whitespace-pre-line">{{ $pengaduan->deskripsi }}</p>
            </div>

            @if($pengaduan->gambar)
            <div class="mb-6">
                <h3 class="font-bold text-gray-900 mb-3">Bukti Foto</h3>
                <img src="{{ $pengaduan->gambar_url }}" alt="Bukti" class="rounded-lg shadow-lg max-h-96">
            </div>
            @endif

            @if($pengaduan->tanggapan)
            <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded">
                <h3 class="font-bold text-green-900 mb-2">Tanggapan</h3>
                <p class="text-green-800 whitespace-pre-line">{{ $pengaduan->tanggapan }}</p>
                <p class="text-xs text-green-600 mt-2">
                    Ditanggapi: {{ $pengaduan->tanggal_tanggapan->format('d F Y, H:i') }}
                </p>
            </div>
            @endif
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-4">Informasi Pelapor</h3>
            <dl class="space-y-3 text-sm">
                <div>
                    <dt class="text-gray-600">Nama</dt>
                    <dd class="font-medium text-gray-900">{{ $pengaduan->nama }}</dd>
                </div>
                <div>
                    <dt class="text-gray-600">Email</dt>
                    <dd class="font-medium text-gray-900">{{ $pengaduan->email }}</dd>
                </div>
                @if($pengaduan->telepon)
                <div>
                    <dt class="text-gray-600">Telepon</dt>
                    <dd class="font-medium text-gray-900">{{ $pengaduan->telepon }}</dd>
                </div>
                @endif
            </dl>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-4">Update Status</h3>
            <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500">
                        <option value="pending" {{ $pengaduan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ $pengaduan->status === 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $pengaduan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tanggapan" class="block text-sm font-medium text-gray-700 mb-2">Tanggapan</label>
                    <textarea name="tanggapan" id="tanggapan" rows="5" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500">{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors font-medium">
                    Update Status
                </button>
            </form>

            <form action="{{ route('admin.pengaduan.destroy', $pengaduan) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors font-medium">
                    Hapus Pengaduan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
