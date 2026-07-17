@extends('admin.layouts.app')
@section('title', 'Galeri')
@section('header', 'Data Galeri')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center space-x-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari galeri..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none w-48">
        <select name="kategori" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $k)
            <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
        <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200"><i class="fas fa-search mr-1"></i>Cari</button>
    </form>
    <a href="{{ route('admin.galeri.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-1"></i>Tambah
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @forelse($galeri as $g)
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden group">
        <div class="aspect-square bg-gray-100 relative">
            @if($g->gambar)
            <img src="{{ asset('storage/' . $g->gambar) }}" class="w-full h-full object-cover">
            @elseif($g->video)
            <video class="w-full h-full object-cover" muted preload="metadata"><source src="{{ asset('storage/' . $g->video) }}"></video>
            @else
            <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="fas fa-image text-3xl"></i></div>
            @endif
            @if($g->video)
            <div class="absolute top-2 right-2 w-6 h-6 rounded-full bg-dark-900/80 flex items-center justify-center">
                <i class="fas fa-play text-gold-400 text-[10px]"></i>
            </div>
            @endif
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center space-x-2">
                <a href="{{ route('admin.galeri.edit', $g) }}" class="w-9 h-9 rounded-full bg-white/90 flex items-center justify-center text-blue-600 hover:bg-white"><i class="fas fa-edit text-sm"></i></a>
                <form action="{{ route('admin.galeri.destroy', $g) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button class="w-9 h-9 rounded-full bg-white/90 flex items-center justify-center text-red-600 hover:bg-white"><i class="fas fa-trash text-sm"></i></button>
                </form>
            </div>
        </div>
        <div class="p-3">
            <p class="text-sm font-medium text-gray-900 truncate">{{ $g->judul }}</p>
            <p class="text-xs text-gray-500">{{ $g->kategori ?? '-' }}</p>
        </div>
    </div>
    @empty
    <div class="col-span-6 text-center py-12 text-gray-400">Belum ada data</div>
    @endforelse
</div>
<div class="mt-4">{{ $galeri->links() }}</div>
@endsection
