@extends('admin.layouts.app')
@section('title', 'Kelola Galeri')
@section('content')
<div class="mb-6 flex items-center justify-between">
    <div><h1 class="text-3xl font-bold text-gray-900">Kelola Galeri</h1><p class="text-gray-600">Manage foto galeri desa</p></div>
    <a href="{{ route('admin.galeri.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium inline-flex items-center"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Tambah Foto</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
@forelse($galeri as $item)
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden"><img src="{{ $item->gambar_url }}" class="w-full h-48 object-cover"><div class="p-4"><h3 class="font-bold text-gray-900 mb-1">{{ $item->judul }}</h3><p class="text-sm text-gray-600 mb-3">{{ Str::limit($item->deskripsi, 60) }}</p><div class="flex items-center justify-between"><a href="{{ route('admin.galeri.edit', $item) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</a><form action="{{ route('admin.galeri.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin?')" class="inline">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button></form></div></div></div>
@empty
<div class="col-span-full text-center py-12 text-gray-500">Belum ada foto</div>
@endforelse
</div>
@if($galeri->hasPages())<div class="mt-6">{{ $galeri->links() }}</div>@endif
@endsection
