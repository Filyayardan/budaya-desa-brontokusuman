@extends('layouts.app')
@section('title', $berita->judul . ' - Berita Brontokusuman')

@section('content')
<section class="pt-32 pb-16 bg-dark-950 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-20"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-gold-300 transition-colors">Beranda</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-gold-500/40"></i>
            <a href="{{ route('berita') }}" class="hover:text-gold-300 transition-colors">Berita</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-gold-500/40"></i>
            <span class="text-gold-300">{{ Str::limit($berita->judul, 40) }}</span>
        </nav>
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4">{{ $berita->judul }}</h1>
        <div class="flex items-center text-gray-400 text-sm gap-4">
            <span><i class="far fa-clock mr-1"></i>{{ $berita->created_at->translatedFormat('d F Y') }}</span>
            @if($berita->penulis)
            <span><i class="far fa-user mr-1"></i>{{ $berita->penulis }}</span>
            @endif
        </div>
    </div>
</section>

<section class="py-16 bg-pattern">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($berita->gambar)
        <div class="rounded-2xl overflow-hidden border border-gold-500/10 mb-8">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-auto">
        </div>
        @endif

        <div class="bg-dark-800/80 backdrop-blur rounded-2xl border border-gold-500/10 p-8 sm:p-10">
            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed prose-headings:text-white prose-a:text-gold-400 prose-strong:text-white">
                {!! $berita->isi !!}
            </div>
        </div>

        @if($beritaLain->count())
        <div class="mt-16">
            <h2 class="font-display text-2xl font-bold text-white mb-8">Berita Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($beritaLain as $bl)
                <a href="{{ route('berita.detail', $bl->id) }}" class="card-hover group">
                    <div class="bg-dark-800/80 backdrop-blur rounded-xl overflow-hidden border border-gold-500/10 hover:border-gold-500/30">
                        <div class="relative h-40 bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                            @if($bl->gambar)
                                <img src="{{ asset('storage/' . $bl->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center"><i class="fas fa-newspaper text-4xl text-gold-500/20"></i></div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-display text-lg font-bold text-white group-hover:text-gold-300 transition-colors mb-2">{{ $bl->judul }}</h3>
                            <span class="text-gray-500 text-xs"><i class="far fa-clock mr-1"></i>{{ $bl->created_at->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
