@extends('admin.layouts.app')
@section('title', 'Background Website')
@section('header', 'Kelola Background Website')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-500 text-sm">Background yang dipakai di seluruh halaman website. Hanya satu yang aktif.</p>
        <a href="{{ route('admin.background.create') }}" class="px-4 py-2.5 rounded-lg text-white text-sm font-medium"
            style="background: linear-gradient(135deg, #d4a017, #b8860b);">
            <i class="fas fa-plus mr-2"></i>Tambah Background
        </a>
    </div>

    @if ($backgrounds->count())
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach ($backgrounds as $b)
                <div class="bg-white rounded-xl border {{ $b->aktif ? 'border-gold-500/60 ring-2 ring-gold-500/30' : 'border-gray-200' }} overflow-hidden">
                    <div class="relative h-48 bg-gradient-to-br from-gold-600/20 to-dark-700">
                        @if ($b->gambar)
                            <img src="{{ asset('storage/' . $b->gambar) }}" class="w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gold-500/20"></i>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            @if ($b->aktif)
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">Aktif</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Nonaktif</span>
                            @endif
                        </div>
                        @if ($b->pola)
                            <div class="absolute bottom-3 right-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-dark-900/70 text-gold-300">
                                    <i class="fas fa-th mr-1"></i>+ Pola
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <h3 class="font-semibold text-gray-900 text-lg">{{ $b->nama }}</h3>
                            @if ($b->pola)
                                <img src="{{ asset('storage/' . $b->pola) }}" class="w-10 h-10 rounded object-cover border border-gray-200" title="Pola">
                            @endif
                        </div>
                        <div class="flex items-center justify-end space-x-2">
                            @if (!$b->aktif)
                                <form action="{{ route('admin.background.activate', $b) }}" method="POST" class="inline">
                                    @csrf @method('PUT')
                                    <button
                                        class="px-3 py-1.5 rounded-lg text-xs font-medium bg-green-50 text-green-700 hover:bg-green-100">
                                        <i class="fas fa-check-circle mr-1"></i>Aktifkan
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('admin.background.edit', $b) }}"
                                class="px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('admin.background.destroy', $b) }}" method="POST"
                                onsubmit="return confirm('Hapus background ini?')">
                                @csrf @method('DELETE')
                                <button
                                    class="px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100">
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
            <i class="fas fa-palette text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 mb-4">Belum ada background. Background akan ditampilkan di seluruh halaman website.</p>
            <a href="{{ route('admin.background.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium"
                style="background: linear-gradient(135deg, #d4a017, #b8860b);">
                <i class="fas fa-plus mr-2"></i>Tambah Background Pertama
            </a>
        </div>
    @endif
@endsection