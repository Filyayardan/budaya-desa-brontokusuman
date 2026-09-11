@extends('layouts.app')
@section('title', $subBerita->judul_sub . ' - Berita Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center text-sm text-gray-500 mb-8">
                <a href="{{ route('home') }}" class="hover:text-main_txt-300 transition-colors">Beranda</a>
                <i class="fas fa-chevron-right text-xs mx-3 text-main_txt-500/40"></i>
                <a href="{{ route('berita') }}" class="hover:text-main_txt-300 transition-colors">Berita</a>
                <i class="fas fa-chevron-right text-xs mx-3 text-main_txt-500/40"></i>
                <a href="{{ route('berita.detail', $berita->id) }}" class="hover:text-main_txt-300 transition-colors">{{ Str::limit($berita->judul, 25) }}</a>
                <i class="fas fa-chevron-right text-xs mx-3 text-main_txt-500/40"></i>
                <span class="text-main_txt-300">{{ Str::limit($subBerita->judul_sub, 25) }}</span>
            </nav>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-main_txt mb-4">{{ $subBerita->judul_sub }}</h1>
            <div class="flex items-center text-tertiary text-sm gap-4">
                <span><i class="far fa-clock mr-1"></i>{{ $subBerita->created_at->translatedFormat('d F Y') }}</span>
                @if ($berita->penulis)
                    <span><i class="far fa-user mr-1"></i>{{ $berita->penulis }}</span>
                @endif
            </div>
        </div>
    </section>

    <section class="py-16 bg-pattern">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($subBerita->gambar)
                <div class="rounded-2xl overflow-hidden border border-gold-500/10 mb-8">
                    <img src="{{ asset('storage/' . $subBerita->gambar) }}" alt="{{ $subBerita->judul_sub }}" class="w-full h-auto">
                </div>
            @endif

            <div class="bg-second_bg backdrop-blur rounded-2xl border border-gold-500/10 p-8 sm:p-10">
                <div class="prose prose-invert max-w-none text-tertiary leading-relaxed prose-headings:text-white prose-a:text-gold-400 prose-strong:text-white">
                    {!! $subBerita->renderIsi() !!}
                </div>
            </div>

            </div>
    </section>
@endsection
