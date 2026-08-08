@extends('layouts.app')
@section('title', 'Sejarah - Brontokusuman')

@section('content')
<section class="pt-32 pb-16 bg-dark-950 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Masa Lalu</span>
        <h1 class="font-display text-5xl sm:text-6xl font-bold text-white mt-3 mb-4">Sejarah Kampung</h1>
        <div class="line-gold w-24 mx-auto mb-6"></div>
        <p class="text-gray-400 max-w-xl mx-auto">Perjalanan panjang Kampung Brontokusuman dari masa ke masa</p>
    </div>
</section>

<section class="py-20 bg-pattern">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($sejarah->count())
        <div class="relative">
            <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-gold-500/50 via-gold-500/20 to-transparent"></div>

            @foreach($sejarah as $i => $s)
            <div class="relative flex flex-col md:flex-row items-start mb-16 {{ $i % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }}">
                <div class="absolute left-8 md:left-1/2 w-4 h-4 rounded-full gradient-gold border-4 border-dark-950 -translate-x-1/2 z-10 mt-2"></div>

                <div class="md:w-1/2 {{ $i % 2 == 0 ? 'md:pr-16 md:text-right' : 'md:pl-16' }} pl-20 md:pl-0">
                    @if($s->gambar)
                    <div class="rounded-xl overflow-hidden border border-gold-500/10 mb-4 {{ $i % 2 == 0 ? 'md:ml-auto' : '' }}">
                        <img src="{{ asset('storage/' . $s->gambar) }}" alt="{{ $s->judul }}" class="w-full h-48 object-cover">
                    </div>
                    @endif
                    <h3 class="font-display text-2xl font-bold text-white mb-3">{{ $s->judul }}</h3>
                    <p class="text-gray-400 leading-relaxed">{{ Str::limit($s->isi, 300) }}</p>
                </div>

                <div class="hidden md:block md:w-1/2"></div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <i class="fas fa-landmark-dome text-6xl text-gold-500/20 mb-6"></i>
            <p class="text-gray-400 text-lg">Data sejarah belum tersedia.</p>
        </div>
        @endif
    </div>
</section>
@endsection
