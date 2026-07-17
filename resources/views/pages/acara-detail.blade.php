@extends('layouts.app')
@section('title', $acara->nama_acara . ' - Acara Brontokusuman')

@section('content')
<section class="pt-32 pb-16 bg-dark-950 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-gold-300 transition-colors">Beranda</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-gold-500/40"></i>
            <a href="{{ route('acara') }}" class="hover:text-gold-300 transition-colors">Acara</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-gold-500/40"></i>
            <span class="text-gold-300">{{ $acara->nama_acara }}</span>
        </nav>
        <span class="text-xs font-semibold px-3 py-1 rounded-full mb-4 inline-block
            {{ $acara->status === 'upcoming' ? 'bg-blue-500/20 text-blue-300' : ($acara->status === 'ongoing' ? 'bg-green-500/20 text-green-300' : 'bg-gray-500/20 text-gray-300') }}">
            {{ $acara->status === 'upcoming' ? 'Mendatang' : ($acara->status === 'ongoing' ? 'Berlangsung' : 'Selesai') }}
        </span>
        <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-4">{{ $acara->nama_acara }}</h1>
    </div>
</section>

<section class="py-16 bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                @if($acara->gambar)
                <div class="rounded-2xl overflow-hidden border border-gold-500/10 mb-8">
                    <img src="{{ asset('storage/' . $acara->gambar) }}" alt="{{ $acara->nama_acara }}" class="w-full h-auto">
                </div>
                @endif
                <div class="bg-dark-800/80 backdrop-blur rounded-2xl border border-gold-500/10 p-8">
                    <h2 class="font-display text-2xl font-bold text-white mb-6">Deskripsi Acara</h2>
                    <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                        {!! nl2br(e($acara->deskripsi)) !!}
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-dark-800/80 backdrop-blur rounded-2xl border border-gold-500/10 p-6 sticky top-28">
                    <h3 class="font-display text-lg font-bold text-gold-300 mb-4">Detail Acara</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-gold-500/10 flex items-center justify-center"><i class="fas fa-calendar text-gold-400 text-sm"></i></div>
                            <div><span class="text-gray-500 text-xs block">Tanggal Mulai</span><span class="text-white text-sm font-medium">{{ \Carbon\Carbon::parse($acara->tanggal_mulai)->translatedFormat('d F Y') }}</span></div>
                        </div>
                        @if($acara->tanggal_selesai)
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-gold-500/10 flex items-center justify-center"><i class="fas fa-calendar-check text-gold-400 text-sm"></i></div>
                            <div><span class="text-gray-500 text-xs block">Tanggal Selesai</span><span class="text-white text-sm font-medium">{{ \Carbon\Carbon::parse($acara->tanggal_selesai)->translatedFormat('d F Y') }}</span></div>
                        </div>
                        @endif
                        @if($acara->lokasi)
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-gold-500/10 flex items-center justify-center"><i class="fas fa-map-marker-alt text-gold-400 text-sm"></i></div>
                            <div><span class="text-gray-500 text-xs block">Lokasi</span><span class="text-white text-sm font-medium">{{ $acara->lokasi }}</span></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
