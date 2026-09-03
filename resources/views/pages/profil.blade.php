@extends('layouts.app')
@section('title', 'Profil Kampung - Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Profil</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Kampung Brontokusuman</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Mengenal lebih dekat kampung yang kaya akan tradisi dan budaya</p>
        </div>
    </section>

    <section class="py-20 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center mb-24">
                <div>
                    <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Tentang Kampung</span>
                    <h2 class="font-display text-4xl font-bold text-main_txt mt-3 mb-6">
                        {{ $profil['tentang_judul'] ?? 'Brontokusuman' }}</h2>
                    <div class="line-gold w-16 mb-8"></div>
                    <div class="space-y-4 text-tertiary leading-relaxed">
                        @foreach (explode("\n\n", $profil['tentang_isi'] ?? '') as $paragraf)
                            @if (trim($paragraf))
                                <p>{!! nl2br(e($paragraf)) !!}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-white backdrop-blur rounded-2xl border border-main_txt-500/10 p-8">
                        <div class="grid grid-cols-2 gap-6">
                            @php
                                $info = [
                                    [
                                        'icon' => 'fa-map-marker-alt',
                                        'label' => 'Lokasi',
                                        'value' => $profil['lokasi'] ?? 'Kec. Mergangsan, Yogyakarta',
                                    ],
                                    [
                                        'icon' => 'fa-users',
                                        'label' => 'Penduduk',
                                        'value' => $profil['penduduk'] ?? '± 3.000 Jiwa',
                                    ],
                                    [
                                        'icon' => 'fa-landmark',
                                        'label' => 'Kecamatan',
                                        'value' => $profil['kecamatan'] ?? 'Mergangsan',
                                    ],
                                    [
                                        'icon' => 'fa-city',
                                        'label' => 'Kota',
                                        'value' => $profil['kota'] ?? 'Yogyakarta',
                                    ],
                                ];
                            @endphp
                            @foreach ($info as $i)
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-main_txt-500/10 flex items-center justify-center flex-shrink-0">
                                        <i class="fas {{ $i['icon'] }} text-main_txt-400"></i>
                                    </div>
                                    <div><span class="text-main_txt-500 text-xs block">{{ $i['label'] }}</span><span
                                            class="text-tertiary font-semibold text-sm">{{ $i['value'] }}</span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @if (($profil['visi'] ?? '') || ($profil['misi'] ?? ''))
                <div class="grid lg:grid-cols-2 gap-8 mb-24">
                    @if ($profil['visi'] ?? null)
                        <div class="bg-white backdrop-blur rounded-2xl border border-main_txt-800/10 p-8">
                            <div class="w-14 h-14 bg-main_txt-500/10 rounded-xl flex items-center justify-center mb-6">
                                <i class="fas fa-eye text-main_txt text-xl"></i>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-main_txt mb-4">Visi</h3>
                            <p class="text-tertiary leading-relaxed">{!! nl2br(e($profil['visi'])) !!}</p>
                        </div>
                    @endif
                    @if ($profil['misi'] ?? null)
                        <div class="bg-white backdrop-blur rounded-2xl border border-main_txt-800/10 p-8">
                            <div class="w-14 h-14 bg-main_txt-500/10 rounded-xl flex items-center justify-center mb-6">
                                <i class="fas fa-bullseye text-main_txt text-xl"></i>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-main_txt mb-4">Misi</h3>
                            <div class="text-tertiary leading-relaxed">{!! nl2br(e($profil['misi'])) !!}</div>
                        </div>
                    @endif
                </div>
            @endif

            @if ($pengurus->count())
                <div class="text-center mb-16">
                    <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Struktur</span>
                    <h2 class="font-display text-4xl font-bold text-main_txt mt-3">Pengurus Kampung Brontokusuman</h2>
                    <div class="line-gold w-24 mx-auto mt-4"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($pengurus as $p)
                        <div class="card-hover group">
                            <div
                                class="bg-white backdrop-blur rounded-2xl overflow-hidden border border-black-500/10 hover:border-gold-500/30 text-center">
                                <div
                                    class="h-48 bg-gradient-to-br from-gold-600/20 to-dark-700 flex items-center justify-center">
                                    @if ($p->foto)
                                        <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-user-tie text-5xl text-gold-500/30"></i>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="font-display text-lg font-bold text-main_txt group-hover:text-gold-300 transition-colors">
                                        {{ $p->nama }}</h3>
                                    <p class="text-tertiary text-sm font-medium mt-1">{{ $p->jabatan }}</p>
                                    @if ($p->email)
                                        <p class="text-gray-500 text-xs mt-3"><i
                                                class="fas fa-envelope mr-1"></i>{{ $p->email }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
