@extends('layouts.app')

@section('title', 'Beranda - Kebudayaan Kampung Brontokusuman')

@section('content')
    <section class=" relative min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0  from-dark-950 via-dark-900 to-dark-950"></div>
        @if ($banner && $banner->gambar)
            <img src="{{ asset('storage/' . $banner->gambar) }}" alt=""
                class="absolute inset-0 w-full h-full object-cover opacity-30">
        @endif
        <div class="absolute inset-0 hero-pattern opacity-30"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-main_txt-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-main_txt-600/5 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <!-- Left: Artifact Frame -->
                    <div class="col-span-7 relative z-10 pr-gutter">
                        <div
                            class="p-4 bg-surface-container-lowest border border-outline-variant shadow-[0_30px_60px_-15px_rgba(111,36,16,0.05)] relative rounded-sm">
                            <!-- Inner Gold Frame -->
                            <div class="absolute inset-4 border border-secondary-fixed-dim/40 pointer-events-none z-20">
                            </div>
                            <div class="relative overflow-hidden w-full aspect-[4/3]">
                                <img class="w-full h-full object-cover filter sepia-[.08] contrast-105 relative z-10 transition-transform duration-[2000ms] hover:scale-105"
                                    data-alt="A highly detailed, high-resolution museum-quality photograph of an intricately carved Indonesian Wayang Kulit shadow puppet. The puppet is made of dark buffalo hide with precise, delicate perforations, depicting a mythological figure. It is presented against a pure, bright off-white minimalist gallery background, bathed in soft, warm directional light that casts a subtle, elegant shadow to emphasize its flat, two-dimensional nature. The overall aesthetic is curatorial, timeless, and perfectly aligned with a light-mode Modern Heritage design system."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkePIH-M8Z3uW0ljksQM42G2IQF06jAq1HiHT1HLbOH7uivJkhrzNQgdiJhHvIzStAvc3fIBP5iMFki-8tN5lvWh28MqnkVnJ3PHh3OyAXmwuWIGLIpmxSBKASXSs-seFFXXHIKo0hEKpECXOq4vCMgBjyn-2w49RMIPpMWcjapVLysByiUdjo9XZMwPfeFe6jDePAvOhkCgdyMffw_rNIuTc44EAZCW1oRpAo4CPzBwjc7W3Ye5VVew" />
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    @if ($banner && $banner->badge)
                        <div
                            class="inline-flex items-center space-x-2 bg-main_txt-500/10 border border-main_txt-500/20 rounded-full px-5 py-2 mb-8">
                            <span class="w-2 h-2 bg-main_txt-400 rounded-full animate-pulse"></span>
                            <span class="text-main_txt-300 text-sm font-medium tracking-wide">{{ $banner->badge }}</span>
                        </div>
                    @endif

                    <h1
                        class="font-display text-3xl sm:text-4xl lg:text-6xl font-bold leading-tight mb-8 text-center lg:text-start">
                        <span
                            class="text-xl font-body text-tertiary">{{ $banner->judul_atas ?? 'Jelajahi Kebudayaan' }}</span><br>
                        <span class="text-main_txt">{{ $banner->judul_bawah ?? 'Brontokusuman' }}</span>
                    </h1>

                    <p class="text-tertiary text-lg leading-relaxed mb-10 max-w-xl text-center lg:text-start">
                        {{ $banner->deskripsi ?? 'Mengenal lebih dekat keindahan tradisi, seni, dan warisan budaya Kampung Brontokusuman yang telah mengakar sejak berabad-abad lamanya.' }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 ">
                        @if ($banner && $banner->btn1_teks)
                            <a href="{{ route($banner->btn1_link ?? 'home') }}"
                                class="gradient-darkred text-dark-950 font-semibold px-8 py-4 rounded-xl hover:opacity-90 transition-opacity text-center shadow-lg shadow-main_txt-500/20">
                                <i class="fas fa-compass mr-2"></i>{{ $banner->btn1_teks }}
                            </a>
                        @endif
                        @if ($banner && $banner->btn2_teks)
                            <a href="{{ route($banner->btn2_link ?? 'home') }}"
                                class="border border-main_txt-500/30 text-main_txt-300 font-semibold px-8 py-4 rounded-xl hover:bg-main_txt-500/10 transition-colors text-center">
                                <i class="fas fa-book-open mr-2"></i>{{ $banner->btn2_teks }}
                            </a>
                        @endif
                    </div>
                    <div class="flex gap-4 justify-center lg:justify-start">
                        <a href="{{ route('galeri') }}"
                            class="bg-main_txt text-white rounded-lg font-label-lg text-label-lg px-8 py-4 hover:text-on-tertiary transition-colors shadow-sm inline-block text-center">
                            Lihat Koleksi
                        </a>
                        <a href="{{ route('sejarah') }}"
                            class="border border-tertiary text-tertiary rounded-lg font-label-lg text-label-lg px-8 py-4 hover:bg-tertiary hover:text-on-tertiary transition-colors inline-block text-center">
                            Baca Sejarah
                        </a>
                    </div>
                </div>

                {{-- <div class="relative hidden lg:block">
                <div class="relative w-full h-[500px] rounded-2xl overflow-hidden border border-main_txt-500/20 shadow-2xl shadow-main_txt-500/10">
                    <div class="absolute inset-0 bg-gradient-to-br from-main_txt-600/20 to-dark-900/80"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-masks-theater text-8xl text-main_txt-400/40 mb-4"></i>
                            <p class="text-main_txt-300/60 font-display text-xl">Seni & Tradisi</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 gradient-darkred rounded-2xl flex items-center justify-center shadow-xl">
                    <div class="text-center">
                        <span class="block text-3xl font-bold text-dark-950 font-display">{{ $kategori->count() }}</span>
                        <span class="text-dark-800 text-xs font-medium">Kategori</span>
                    </div>
                </div>
                <div class="absolute -top-6 -right-6 w-40 bg-dark-800/90 backdrop-blur-xl rounded-2xl p-5 border border-main_txt-500/10">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-main_txt-500/10 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-main_txt-400 text-xl"></i>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold text-white font-display">{{ $acaraTerbaru->count() }}</span>
                            <span class="text-gray-400 text-xs">Acara Aktif</span>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-32 "></div>
    </section>

    <section class="py-8 bg-surface-container-highest">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php $stats = [['icon'=>'fa-landmark','count'=>$kategori->count(),'label'=>'Kategori Budaya'],['icon'=>'fa-scroll','count'=>App\Models\Budaya::count(),'label'=>'Item Budaya'],['icon'=>'fa-calendar-check','count'=>App\Models\Acara::count(),'label'=>'Acara Budaya'],['icon'=>'fa-images','count'=>App\Models\Galeri::count(),'label'=>'Foto Galeri']]; @endphp
                @foreach ($stats as $s)
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-main_txt-500/10 flex items-center justify-center group-hover:bg-main_txt-500/20 transition-colors">
                            <i class="fas {{ $s['icon'] }} text-main_txt-400 text-2xl"></i>
                        </div>
                        <span class="block text-3xl font-bold font-body  text-white mb-1">{{ $s['count'] }}</span>
                        <span class="text-tertiary text-sm">{{ $s['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- @if ($kategori->count())
        <section class="py-24 bg-pattern">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-tertiary-400 text-sm font-semibold tracking-widest uppercase">Kategori</span>
                    <h2 class="font-display text-4xl sm:text-5xl font-bold text-main_txt mt-3 mb-4">Jenis Kebudayaan</h2>
                    <div class="line-main_txt w-24 mx-auto mb-6"></div>
                    <p class="text-tertiary max-w-2xl mx-auto">Beragam warisan budaya yang dilestarikan di Kampung
                        Brontokusuman</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    @foreach ($kategori as $k)
                        <a href="{{ route('budaya.kategori', $k->id) }}" class="card-hover group">
                            <div
                                class="bg-white backdrop-blur border border-main_txt-500/10 rounded-2xl p-6 text-center h-full hover:border-main_txt-500/30">
                                <div
                                    class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-main_txt-500/10 flex items-center justify-center group-hover:bg-main_txt-500/20 transition-colors">
                                    <i class="fas {{ $k->ikon ?? 'fa-landmark' }} text-main_txt-400 text-2xl"></i>
                                </div>
                                <h3 class="font-semibold text-white text-sm mb-1">{{ $k->nama_kategori }}</h3>
                                <p class="text-gray-500 text-xs">{{ $k->budaya_count }} item</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif --}}

    {{-- @if ($budayaUnggulan->count())
        <section class="py-15 ">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
                    <div>
                        <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Unggulan</span>
                        <h2 class="font-display text-4xl sm:text-5xl font-bold text-main_txt mt-3">Kebudayaan Pilihan</h2>
                        <div class="line-main_txt w-24 mt-4"></div>
                    </div>
                    <a href="{{ route('budaya') }}"
                        class="mt-6 md:mt-0 text-main_txt-400 hover:text-main_txt-300 font-medium text-sm transition-colors">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($budayaUnggulan as $b)
                        <a href="{{ route('budaya.detail', $b->id) }}" class="card-hover group">
                            <div
                                class="bg-white backdrop-blur rounded-md overflow-hidden border border-outline-variant/50 hover:border-main_txt-500/30 h-full">

                                <div class="relative overflow-hidden aspect-[3/2]">
                                    @if ($b->gambar)
                                        <img src="{{ asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="fas fa-image text-5xl text-main_txt-500/20"></i>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-main_txt text-white text-xs font-bold px-3 py-2 rounded-full">
                                            {{ $b->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="font-display text-[32px] font-bold text-main_txt group-hover:text-main_txt-300 transition-colors mb-3">
                                        {{ $b->judul }}</h3>
                                    <p class="text-tertiary text-[16px] line-clamp-2 mb-4">
                                        {{ Str::limit($b->deskripsi, 120) }}
                                    </p>
                                    @if ($b->lokasi)
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i
                                                class="fas fa-map-marker-alt text-main_txt-500/60 mr-2"></i>{{ $b->lokasi }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif --}}

    <section class="py-16 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Bagi menjadi 2 kolom di dalam container yang sudah sejajar -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Kolom Kiri: Acara Budaya -->
                @if ($acaraTerbaru->count())
                    <div>
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
                            <div>
                                <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Agenda</span>
                                <h2 class="font-display text-4xl sm:text-5xl font-bold text-main_txt mt-3">Acara Budaya</h2>
                                <div class="line-main_txt w-24 mt-4"></div>
                            </div>
                            <a href="{{ route('acara') }}"
                                class="mt-6 md:mt-0 text-main_txt-400 hover:text-main_txt-300 font-medium text-sm transition-colors">
                                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>

                        <div class="">
                            @foreach ($acaraTerbaru as $a)
                                <a href="{{ route('acara.detail', $a->id) }}" class="card-hover group">
                                    <div
                                        class="bg-white backdrop-blur rounded-md overflow-hidden border border-outline-variant/50 hover:border-main_txt-500/30 h-full">
                                        <div class="relative  aspect-[3/2] overflow-hidden">
                                            @if ($a->gambar)
                                                <img src="{{ asset('storage/' . $a->gambar) }}" alt="{{ $a->nama_acara }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            @else
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <i class="fas fa-calendar-day text-5xl text-main_txt-500/20"></i>
                                                </div>
                                            @endif
                                            <div class="absolute top-4 right-4">
                                                <span
                                                    class="bg-main_txt backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full border border-main_txt-500/20">
                                                    {{ \Carbon\Carbon::parse($a->tanggal_mulai)->translatedFormat('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <div
                                                class="font-label-sm text-label-sm  text-tertiary mb-3 flex items-center gap-2">
                                                <span class="material-symbols-outlined text-[18px]"><i
                                                        class="fa-regular fa-calendar-days"></i></span>
                                                {{ \Carbon\Carbon::parse($a->tanggal_mulai)->translatedFormat('d M Y') }}
                                            </div>
                                            <h3
                                                class="font-display text-xl font-bold text-main_txt group-hover:text-main_txt-300 transition-colors mb-3">
                                                {{ Str::limit($a->nama_acara, 80) }}</h3>
                                            <p class="text-tertiary text-sm line-clamp-2 mb-4">
                                                {{ Str::limit($a->deskripsi, 120) }}</p>
                                            <div class="flex items-center justify-between">
                                                @if ($a->lokasi)
                                                    <div class="flex items-center text-gray-500 text-sm">
                                                        <i
                                                            class="fas fa-map-marker-alt text-main_txt-500/60 mr-2"></i>{{ Str::limit($a->lokasi, 30) }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="text-xs font-semibold px-3 py-1 rounded-full
                                {{ $a->status === 'upcoming' ? 'bg-blue-500/10 text-blue-400' : ($a->status === 'ongoing' ? 'bg-green-500/10 text-green-400' : 'bg-gray-500/10 text-gray-400') }}">
                                                    {{ $a->status === 'upcoming' ? 'Mendatang' : ($a->status === 'ongoing' ? 'Berlangsung' : 'Selesai') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Kolom Kanan: Berita Terbaru -->
                <div>
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
                        <div>
                            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Informasi</span>
                            <h2 class="font-display text-4xl sm:text-5xl font-bold text-main_txt mt-3">Berita Terbaru</h2>
                            <div class="line-main_txt w-24 mt-4"></div>
                        </div>
                        <a href="{{ route('berita') }}"
                            class="mt-6 md:mt-0 text-main_txt-400 hover:text-main_txt-300 font-medium text-sm transition-colors">
                            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <div class="">
                        @foreach ($beritaTerbaru as $br)
                            <a href="{{ route('berita.detail', $br->id) }}" class="card-hover group">
                                <div
                                    class="bg-white backdrop-blur rounded-md overflow-hidden border border-main_txt-500/10 hover:border-main_txt-500/30 h-full">
                                    <div class="relative  aspect-[3/2] overflow-hidden">
                                        @if ($br->gambar)
                                            <img src="{{ asset('storage/' . $br->gambar) }}" alt="{{ $br->judul }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <i class="fas fa-newspaper text-5xl text-main_txt-500/20"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center text-tertiary text-xs mb-3">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $br->created_at->translatedFormat('d M Y') }}
                                            @if ($br->penulis)
                                                <span class="mx-2">•</span>
                                                <i class="far fa-user mr-1"></i>{{ $br->penulis }}
                                            @endif
                                        </div>
                                        <h3
                                            class="font-display text-xl font-bold text-main_txt group-hover:text-main_txt-300 transition-colors mb-3">
                                            {{ Str::limit($br->judul, 50) }}</h3>
                                        <p class="text-gray-400 text-sm line-clamp-2">
                                            {{ Str::limit($br->ringkasan ?? $br->isi, 120) }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- <div class="flex">
        @if ($acaraTerbaru->count())
            <section class="py-16 bg-pattern  bg-amber-400 w-1/2  ">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-amber-800 ">


                    
                </div>
            </section>
        @endif

        @if ($beritaTerbaru->count())
            <section class="py-16 bg-pattern  w-1/2 ">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                </div>
            </section>
        @endif
    </div> --}}

    {{-- @if ($galeriTerbaru->count())
        <section class="py-16 ">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10">
                    <div>
                        <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Dokumentasi</span>
                        <h2 class="font-display text-4xl sm:text-5xl font-bold text-main_txt mt-3">Galeri Foto</h2>
                        <div class="line-main_txt w-24 mt-4"></div>
                    </div>
                    <a href="{{ route('galeri') }}"
                        class="mt-6 md:mt-0 text-main_txt-400 hover:text-main_txt-300 font-medium text-sm transition-colors">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($galeriTerbaru as $g)
                        <div class="group relative rounded-xl overflow-hidden aspect-square card-hover cursor-pointer">
                            <div class="absolute inset-0 bg-gradient-to-br from-main_txt-600/20 to-dark-800">
                                @if ($g->gambar)
                                    <img src="{{ asset('storage/' . $g->gambar) }}" alt="{{ $g->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="fas fa-image text-4xl text-main_txt-500/20"></i>
                                    </div>
                                @endif
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-dark-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <p class="text-white font-semibold text-sm">{{ $g->judul }}</p>
                                @if ($g->kategori)
                                    <p class="text-main_txt-300 text-xs mt-1">{{ $g->kategori }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif --}}

    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Jelajahi</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Peta Kampung</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Temukan lokasi UMKM, kebudayaan, dan acara di Kampung
                Brontokusuman</p>
        </div>
    </section>

    <section class="py-16 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center mb-8">
                <button data-filter="all"
                    class="filter-btn active px-5 py-2.5 rounded-full text-sm font-medium transition-all">Semua</button>
                <button data-filter="umkm"
                    class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all"><i
                        class="fas fa-store mr-2"></i>UMKM</button>
                <button data-filter="budaya"
                    class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all"><i
                        class="fas fa-landmark mr-2"></i>Budaya</button>
                <button data-filter="acara"
                    class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all"><i
                        class="fas fa-calendar-alt mr-2"></i>Acara</button>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden border border-gold-500/10 shadow-lg relative z-10  ">
                <div id="map" style="height: 600px; width: 100%;"></div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-6 mt-8 text-sm">
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full" style="background:#2e7d32;"></span>
                    <span class="text-gray-700 font-medium">UMKM</span>
                    <span class="text-gray-400">({{ count($umkm) }})</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full" style="background:#b8860b;"></span>
                    <span class="text-gray-700 font-medium">Budaya</span>
                    <span class="text-gray-400">({{ count($budaya) }})</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full" style="background:#1565c0;"></span>
                    <span class="text-gray-700 font-medium">Acara</span>
                    <span class="text-gray-400">({{ $acara->where('status', '!=', 'ongoing')->count() }})</span>
                </div>
                @if ($acara->contains('status', 'ongoing'))
                    <div class="flex items-center gap-2">
                        <span class="w-4 h-4 rounded-full animate-pulse" style="background:#22c55e;"></span>
                        <span class="text-gray-700 font-medium">Acara Berlangsung</span>
                        <span class="text-gray-400">({{ $acara->where('status', 'ongoing')->count() }})</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- visitor section end --}}
      <section class=" relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            {{-- <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Jelajahi</span> --}}
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Traffic Pengunjung</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            {{-- <p class="text-main_txt-400 max-w-xl mx-auto">Temukan lokasi UMKM, kebudayaan, dan acara di Kampung
                Brontokusuman</p> --}}
        </div>
    </section>
    <section class="pb-16 pt-5 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-8">
                <div class=" ">
                    <section class="grid grid-cols-1 sm:grid-cols-2  content-center h-full gap-6">
                        <!-- Total  -->
                        <div
                            class="bg-white rounded-xl shadow-card p-5 border border-brand-border flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-brand-blue">
                                <i class="fa-solid fa-users text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-brand-gray mb-1">Total Pengunjung</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $totalVisitors }}</p>
                            </div>
                        </div>
                        <!-- Total Hari Ini -->
                        <div
                            class="bg-white rounded-xl shadow-card p-5 border border-brand-border flex items-center space-x-4">
                            <div
                                class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center text-brand-green">
                                <i class="fa-solid fa-user-clock text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-brand-gray mb-1">Pengunjung Hari ini</p>
                                <p class="text-2xl font-bold text-brand-green">{{ $todayVisitors }}</p>
                            </div>
                        </div>


                    </section>
                </div>
                <div>
                    <section class=" ">
                        <!-- Chart Card -->
                        {{-- Chart Harian --}}
                        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                            <div
                                class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-5 py-3.5">
                                <span class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                                    <i class="bi bi-graph-up text-blue-600"></i>
                                    Pengunjung Harian
                                </span>

                                <span
                                    class="rounded-full border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs text-slate-500">
                                    {{-- {{ \Carbon\Carbon::createFromDate(request('bulan'), request('bulan'), 1)->isoFormat('MMMM Y') }} --}}
                                </span>
                            </div>

                            <div class="p-5">
                                <div class="relative h-72 w-full">
                                    <canvas id="chartHarian"></canvas>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
      {{-- visitor section end --}}
    <section class="py-24  relative overflow-hidden">
        <div class="absolute inset-0 bg-main_txt from-main_txt-600/5 via-transparent to-main_txt-600/5"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <i class="fas fa-quote-left text-second_bg text-5xl mb-8"></i>
            <blockquote class="font-display text-3xl sm:text-4xl font-bold text-white leading-relaxed mb-8">
                "Budaya adalah identitas kita. Melestarikan budaya berarti menjaga jati diri bangsa."
            </blockquote>
            <div class="line-main_txt w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-200 font-semibold">Kampung Brontokusuman</p>
            <p class="text-second_bg text-sm">Kecamatan Mergangsan, Kota Yogyakarta</p>
        </div>
    </section>



    @push('styles')
        <style>
            .filter-btn {
                background: #2d2b33;
                color: #9f9da7;
                border: 1px solid rgba(212, 160, 23, 0.1);
            }

            .filter-btn:hover {
                background: rgba(212, 160, 23, 0.1);
                color: #b8860b;
            }

            .filter-btn.active {
                background: linear-gradient(135deg, #d4a017 0%, #f5de8c 50%, #d4a017 100%);
                color: #1a1820;
                border-color: transparent;
                font-weight: 700;
            }

            .peta-divicon {
                background: transparent;
                border: none;
            }

            .peta-pin {
                width: 36px;
                height: 36px;
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
                border: 2px solid rgba(255, 255, 255, 0.9);
            }

            .peta-pin i {
                transform: rotate(45deg);
                color: #fff;
                font-size: 14px;
            }

            .peta-popup a:hover {
                text-decoration: underline;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            const petaData = {
                umkm: @json($umkm),
                budaya: @json($budaya),
                acara: @json($acara),
            };

            const markerConf = {
                umkm: {
                    color: '#2e7d32',
                    icon: 'fa-store',
                    label: 'UMKM'
                },
                budaya: {
                    color: '#b8860b',
                    icon: 'fa-landmark',
                    label: 'Budaya'
                },
                acara: {
                    color: '#1565c0',
                    icon: 'fa-calendar-alt',
                    label: 'Acara'
                },
            };

            function esc(s) {
                return String(s == null ? '' : s).replace(/[&<>"']/g, c => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [c]));
            }

            function colorFor(type, item) {
                if (type === 'acara' && item.status === 'ongoing') {
                    return '#22c55e';
                }
                return markerConf[type].color;
            }

            function iconFor(type, item) {
                const c = markerConf[type];
                return L.divIcon({
                    className: 'peta-divicon',
                    html: `<div class="peta-pin" style="background:${colorFor(type, item)};"><i class="fas ${c.icon}"></i></div>`,
                    iconSize: [36, 42],
                    iconAnchor: [18, 42],
                    popupAnchor: [0, -40],
                });
            }

            function popupContent(item, type) {
                const c = markerConf[type];
                const color = colorFor(type, item);
                return `
                    <div class="peta-popup" style="font-family:Inter,sans-serif;min-width:200px;">
                        <span class="text-xs font-semibold uppercase tracking-wider" style="color:${color};">${c.label} · ${esc(item.kategori)}</span>
                        <h4 class="font-bold text-base mt-1 mb-1" style="color:#331006;">${esc(item.nama)}</h4>
                        ${item.lokasi ? `<p class="text-xs mb-1" style="color:#615f6c;"><i class="fas fa-map-marker-alt mr-1"></i>${esc(item.lokasi)}</p>` : ''}
                        ${item.deskripsi ? `<p class="text-xs leading-relaxed" style="color:#4d4b56;">${esc(item.deskripsi)}</p>` : ''}
                        ${item.url ? `<a href="${esc(item.url)}" class="inline-block mt-2 text-xs font-bold" style="color:#8f2a1c;">Lihat Detail &rarr;</a>` : ''}
                    </div>`;
            }

            const map = L.map('map').setView([-7.8170, 110.3703], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const groups = {};
            const allBounds = [];

            Object.keys(petaData).forEach(type => {
                groups[type] = L.layerGroup();
                petaData[type].forEach(item => {
                    const lat = parseFloat(item.lat);
                    const lng = parseFloat(item.lng);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        L.marker([lat, lng], {
                                icon: iconFor(type, item)
                            })
                            .bindPopup(popupContent(item, type))
                            .addTo(groups[type]);
                        allBounds.push([lat, lng]);
                    }
                });
                groups[type].addTo(map);
            });

            if (allBounds.length) {
                map.fitBounds(L.latLngBounds(allBounds).pad(0.25));
            }

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const f = btn.dataset.filter;
                    Object.keys(groups).forEach(type => {
                        if (f === 'all' || f === type) {
                            map.addLayer(groups[type]);
                        } else {
                            map.removeLayer(groups[type]);
                        }
                    });
                });
            });
        </script>
    @endpush

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        new Chart(document.getElementById('chartHarian'), {
            type: 'line',
            data: {
                labels: @json($visitorLabels),
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: @json($visitorData),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.08)',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#2563eb',
                    fill: true,
                    tension: 0.35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: context =>
                                context.parsed.y.toLocaleString('id-ID') + ' pengunjung'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            // color: '#64748b'
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#64748b',
                            callback: value =>
                                Number(value).toLocaleString('id-ID')
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Pengunjung'
                        }
                    }
                }
            }
        });
    </script>
@endsection
