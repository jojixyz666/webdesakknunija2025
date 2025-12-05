@extends('admin.layouts.app')
@section('title', 'Kelola Peta')
@section('content')
<div class="mb-6 flex items-center justify-between">
    <div><h1 class="text-3xl font-bold text-gray-900">Kelola Peta Lokasi</h1><p class="text-gray-600">Manage lokasi di peta desa</p></div>
    <a href="{{ route('admin.peta.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium inline-flex items-center"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Tambah Lokasi</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Koordinat</th><th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th></tr></thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($peta as $item)
        <tr class="hover:bg-gray-50"><td class="px-6 py-4"><p class="text-sm font-medium text-gray-900">{{ $item->nama_lokasi }}</p><p class="text-xs text-gray-500">{{ Str::limit($item->deskripsi, 60) }}</p></td><td class="px-6 py-4"><span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">{{ $item->kategori_label }}</span></td><td class="px-6 py-4 text-sm text-gray-600">{{ $item->latitude }}, {{ $item->longitude }}</td><td class="px-6 py-4 text-right"><div class="flex items-center justify-end space-x-2"><a href="{{ route('admin.peta.edit', $item) }}" class="text-blue-600 hover:text-blue-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a><form action="{{ route('admin.peta.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin?')" class="inline">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button></form></div></td></tr>
        @empty
        <tr><td colspan="4" class="px-6 py-12 text-center text-gray-500">Belum ada lokasi</td></tr>
        @endforelse
        </tbody>
    </table>
    @if($peta->hasPages())<div class="px-6 py-4 border-t">{{ $peta->links() }}</div>@endif
</div>
@endsection
