@extends('layouts.app')
@section('title', 'Sejarah - Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Masa Lalu</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Sejarah Kampung</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Perjalanan panjang Kampung Brontokusuman dari masa ke masa</p>
        </div>
    </section>

    <section class="py-20 bg-pattern">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($sejarah->count())
                <div class="relative">
                    <div
                        class="absolute left-8 md:left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-gold-500/50 via-gold-500/20 to-transparent">
                    </div>

                    @foreach ($sejarah as $i => $s)
                        <div
                            class="relative flex flex-col md:flex-row items-start mb-16 {{ $i % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }}">
                            <div
                                class="absolute left-8 md:left-1/2 w-4 h-4 rounded-full gradient-gold border-4 border-dark-950 -translate-x-1/2 z-10 mt-2">
                            </div>

                            <div class="md:w-1/2 {{ $i % 2 == 0 ? 'md:pr-16 md:text-right' : 'md:pl-16' }} pl-20 md:pl-0">
                                <h3 class="font-display text-2xl font-bold text-main_txt mb-3">{{ $s->judul }}</h3>
                                <p class="text-tertiary leading-relaxed">{!! nl2br(e(Str::limit($s->isi, 300))) !!}</p>
                            </div>

                            <div class="pl-20 md:pl-0 md:w-1/2 {{ $i % 2 == 0 ? 'md:pl-16' : 'md:pr-16' }}">
                                @if ($s->gambar)
                                    <div class="rounded-xl overflow-hidden border border-gold-500/10">
                                        <img src="{{ asset('storage/' . $s->gambar) }}" alt="{{ $s->judul }}" class="w-full h-auto object-contain">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-landmark-dome text-6xl text-gold-500/20 mb-6"></i>
                    <p class="text-tertiary-400 text-lg">Data sejarah belum tersedia.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 bg-second_bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Koleksi Arsip</span>
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-main_txt mt-3 mb-4">Sejarah Lainnya</h2>
                <div class="line-gold w-24 mx-auto"></div>
            </div>

            @if ($sejarahLainnya->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($sejarahLainnya as $sl)
                        <div class="card-hover group">
                            <div
                                class="bg-white backdrop-blur rounded-md overflow-hidden border border-gold-500/10 hover:border-gold-500/30 h-full">
                                <div class="relative h-52 bg-gradient-to-br from-gold-600/20 to-dark-700 overflow-hidden">
                                    @if ($sl->gambar)
                                        <img src="{{ asset('storage/' . $sl->gambar) }}" alt="{{ $sl->judul }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center"><i
                                                class="fas fa-landmark-dome text-5xl text-gold-500/20"></i></div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center text-tertiary text-xs mb-3">
                                        <i class="far fa-clock mr-1"></i>{{ $sl->created_at->translatedFormat('d M Y') }}
                                    </div>
                                    <h3
                                        class="font-display text-xl font-bold text-main_txt group-hover:text-gold-300 transition-colors mb-3">
                                        {{ $sl->judul }}</h3>
                                    <p class="text-tertiary text-sm line-clamp-2">{!! nl2br(e(Str::limit($sl->ringkasan ?? $sl->isi, 120))) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <i class="fas fa-landmark-dome text-6xl text-gold-500/20 mb-6"></i>
                    <p class="text-tertiary-400 text-lg">Belum ada sejarah lainnya.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
