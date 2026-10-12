@extends('layouts.app')
@section('title', 'Galeri - Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Dokumentasi</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Galeri</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Koleksi foto dan video kegiatan kebudayaan Kampung Brontokusuman
            </p>
        </div>
    </section>

    <section class="py-16 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($kategori->count())
                <div class="flex flex-wrap gap-3 justify-center mb-12">
                    <button
                        class="px-5 py-2.5 rounded-full text-sm font-medium gradient-gold text-dark-950 transition-all filter-btn active"
                        data-filter="all">Semua</button>
                    @foreach ($kategori as $k)
                        <button
                            class="px-5 py-2.5 rounded-full text-sm font-medium bg-dark-800 text-gray-300 hover:bg-gold-500/10 hover:text-gold-300 border border-gold-500/10 transition-all filter-btn"
                            data-filter="{{ $k }}">{{ $k }}</button>
                    @endforeach
                </div>
            @endif

            @if ($galeri->count())
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery">
                    @foreach ($galeri as $g)
                        <div class="group relative rounded-xl overflow-hidden aspect-square card-hover cursor-pointer gallery-item"
                            data-kategori="{{ $g->kategori }}"
                            data-video="{{ $g->video ? asset('storage/' . $g->video) : '' }}"
                            data-judul="{{ $g->judul }}">
                            <div class="absolute inset-0 bg-gradient-to-br from-gold-600/20 to-dark-800">
                                @if ($g->gambar)
                                    <img src="{{ asset('storage/' . $g->gambar) }}" alt="{{ $g->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @elseif($g->video)
                                    <video class="w-full h-full object-cover" muted preload="metadata">
                                        <source src="{{ asset('storage/' . $g->video) }}">
                                    </video>
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center"><i
                                            class="fas fa-image text-4xl text-gold-500/20"></i></div>
                                @endif
                            </div>
                            @if ($g->video)
                                <div
                                    class="absolute top-3 right-3 w-8 h-8 rounded-full bg-dark-900/80 flex items-center justify-center">
                                    <i class="fas fa-play text-gold-400 text-xs"></i>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-dark-950/90 via-dark-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 p-5 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                <h3 class="text-white font-bold">{{ $g->judul }}</h3>
                                @if ($g->kategori)
                                    <p class="text-gold-300 text-sm mt-1">{{ $g->kategori }}</p>
                                @endif
                                @if ($g->deskripsi)
                                    <p class="text-gray-400 text-xs mt-2 line-clamp-2">{!! nl2br(e(Str::limit($g->deskripsi, 80))) !!}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-12">{{ $galeri->links('vendor.pagination.tailwind') }}</div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-images text-6xl text-gold-500/20 mb-6"></i>
                    <p class="text-gray-400 text-lg">Belum ada foto di galeri.</p>
                </div>
            @endif
        </div>
    </section>

    <div id="lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/95 backdrop-blur-sm">
        <button id="lightbox-close"
            class="absolute top-5 right-5 z-10 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all">
            <i class="fas fa-times"></i>
        </button>
        <button id="lightbox-prev"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="lightbox-next"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="max-w-5xl w-full max-h-[85vh] flex items-center justify-center px-4">
            <img id="lightbox-img" src="" alt=""
                class="max-w-full max-h-[80vh] object-contain rounded-lg hidden">
            <video id="lightbox-video" src="" controls
                class="max-w-full max-h-[80vh] object-contain rounded-lg hidden"></video>
        </div>
        <div id="lightbox-caption"
            class="absolute bottom-6 left-0 right-0 text-center text-white text-lg font-semibold px-4"></div>
    </div>

    @push('scripts')
        <script>
            const items = Array.from(document.querySelectorAll('.gallery-item'));
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxVideo = document.getElementById('lightbox-video');
            const lightboxCaption = document.getElementById('lightbox-caption');
            let currentIndex = -1;

            function openLightbox(index) {
                const item = items[index];
                if (!item) return;
                currentIndex = index;

                const img = item.querySelector('img');
                const videoSrc = item.dataset.video;

                lightboxVideo.pause();
                if (img) {
                    lightboxImg.src = img.src;
                    lightboxImg.classList.remove('hidden');
                    lightboxVideo.classList.add('hidden');
                } else if (videoSrc) {
                    lightboxVideo.src = videoSrc;
                    lightboxVideo.classList.remove('hidden');
                    lightboxImg.classList.add('hidden');
                }

                lightboxCaption.textContent = item.dataset.judul || '';
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function closeLightbox() {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
                lightboxVideo.pause();
                lightboxVideo.removeAttribute('src');
                document.body.style.overflow = '';
            }

            items.forEach((item, i) => {
                item.addEventListener('click', () => openLightbox(i));
            });

            document.getElementById('lightbox-close').addEventListener('click', closeLightbox);
            document.getElementById('lightbox-prev').addEventListener('click', () => {
                if (currentIndex !== -1) openLightbox((currentIndex - 1 + items.length) % items.length);
            });
            document.getElementById('lightbox-next').addEventListener('click', () => {
                if (currentIndex !== -1) openLightbox((currentIndex + 1) % items.length);
            });
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) closeLightbox();
            });
            document.addEventListener('keydown', (e) => {
                if (currentIndex === -1) return;
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') openLightbox((currentIndex - 1 + items.length) % items.length);
                if (e.key === 'ArrowRight') openLightbox((currentIndex + 1) % items.length);
            });

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.filter-btn').forEach(b => {
                        b.classList.remove('gradient-gold', 'text-dark-950', 'active');
                        b.classList.add('bg-dark-800', 'text-gray-300');
                    });
                    btn.classList.add('gradient-gold', 'text-dark-950', 'active');
                    btn.classList.remove('bg-dark-800', 'text-gray-300');
                    const filter = btn.dataset.filter;
                    document.querySelectorAll('.gallery-item').forEach(item => {
                        item.style.display = (filter === 'all' || item.dataset.kategori === filter) ?
                            '' : 'none';
                    });
                });
            });
        </script>
    @endpush
@endsection
