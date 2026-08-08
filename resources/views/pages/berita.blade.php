@extends('layouts.app')
@section('title', 'Berita - Brontokusuman')

@section('content')
<section class="pt-32 pb-16 bg-dark-950 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Informasi</span>
        <h1 class="font-display text-5xl sm:text-6xl font-bold text-white mt-3 mb-4">Berita Terbaru</h1>
        <div class="line-gold w-24 mx-auto mb-6"></div>
        <p class="text-gray-400 max-w-xl mx-auto">Kabar dan informasi terkini seputar kebudayaan Kampung Brontokusuman</p>
    </div>
</section>

<section class="py-16 bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($berita->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($berita as $br)
            <a href="{{ route('berita.detail', $br->id) }}" class="card-hover group">
                <div class="bg-dark-800/80 backdrop-blur rounded-2xl overflow-hidden border border-gold-500/10 hover:border-gold-500/30 h-full">
                    <div class="relative h-52 bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                        @if($br->gambar)
                            <img src="{{ asset('storage/' . $br->gambar) }}" alt="{{ $br->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center"><i class="fas fa-newspaper text-5xl text-gold-500/20"></i></div>
                        @endif
                        @if($br->featured)
                        <div class="absolute top-4 left-4">
                            <span class="gradient-gold text-dark-950 text-xs font-bold px-3 py-1 rounded-full"><i class="fas fa-fire mr-1"></i>Utama</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-gray-500 text-xs mb-3">
                            <i class="far fa-clock mr-1"></i>{{ $br->created_at->translatedFormat('d M Y') }}
                            @if($br->penulis)
                            <span class="mx-2">•</span><i class="far fa-user mr-1"></i>{{ $br->penulis }}
                            @endif
                        </div>
                        <h3 class="font-display text-xl font-bold text-white group-hover:text-gold-300 transition-colors mb-3">{{ $br->judul }}</h3>
                        <p class="text-gray-400 text-sm line-clamp-2">{{ Str::limit($br->ringkasan ?? $br->isi, 120) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-12">{{ $berita->links('vendor.pagination.tailwind') }}</div>
        @else
        <div class="text-center py-20">
            <i class="fas fa-newspaper text-6xl text-gold-500/20 mb-6"></i>
            <p class="text-gray-400 text-lg">Belum ada berita.</p>
        </div>
        @endif
    </div>
</section>
@endsection
