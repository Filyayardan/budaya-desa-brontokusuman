@extends('admin.layouts.app')
@section('title', 'Banner')
@section('header', 'Kelola Banner')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">Banner adalah bagian utama (hero) di halaman beranda.</p>
    <a href="{{ route('admin.banner.create') }}" class="px-4 py-2.5 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-2"></i>Tambah Banner
    </a>
</div>

@if($banners->count())
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    @foreach($banners as $b)
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="relative h-48 bg-gradient-to-br from-gold-600/20 to-dark-700">
            @if($b->gambar)
                <img src="{{ asset('storage/' . $b->gambar) }}" class="w-full h-full object-cover">
            @else
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-image text-4xl text-gold-500/20"></i>
                </div>
            @endif
            <div class="absolute top-3 right-3">
                @if($b->aktif)
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">Aktif</span>
                @else
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Nonaktif</span>
                @endif
            </div>
        </div>
        <div class="p-5">
            @if($b->badge)
                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-gold-50 text-gold-700 mb-2">{{ $b->badge }}</span>
            @endif
            <h3 class="font-semibold text-gray-900 text-lg mb-1">{{ $b->judul_atas ?? '' }} {{ $b->judul_tengah ?? '' }} {{ $b->judul_bawah ?? '' }}</h3>
            @if($b->deskripsi)
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $b->deskripsi }}</p>
            @endif
            <div class="flex items-center justify-end space-x-2">
                <a href="{{ route('admin.banner.edit', $b) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100">
                    <i class="fas fa-edit mr-1"></i>Edit
                </a>
                <form action="{{ route('admin.banner.destroy', $b) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
    <i class="fas fa-images text-4xl text-gray-300 mb-4"></i>
    <p class="text-gray-500 mb-4">Belum ada banner. Banner akan ditampilkan sebagai hero di halaman beranda.</p>
    <a href="{{ route('admin.banner.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-2"></i>Tambah Banner Pertama
    </a>
</div>
@endif
@endsection
