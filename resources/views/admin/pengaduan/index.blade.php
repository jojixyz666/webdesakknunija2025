@extends('admin.layouts.app')

@section('title', 'Kelola Pengaduan')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Kelola Pengaduan</h1>
    <p class="text-gray-600">Tanggapi pengaduan dari masyarakat</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengaduan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pengaduan as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">{{ Str::limit($item->judul, 50) }}</p>
                        <p class="text-xs text-gray-500">{{ Str::limit($item->deskripsi, 80) }}</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <p class="text-sm text-gray-900">{{ $item->nama }}</p>
                        <p class="text-xs text-gray-500">{{ $item->email }}</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {!! $item->status_badge !!}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.pengaduan.show', $item) }}" class="text-blue-600 hover:text-blue-900">
                            Lihat Detail →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p>Belum ada pengaduan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengaduan->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $pengaduan->links() }}
    </div>
    @endif
</div>
@endsection
