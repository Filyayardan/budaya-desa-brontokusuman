@extends('layouts.app')
@section('title', 'Galeri - Brontokusuman')

@section('content')
<section class="pt-32 pb-16 bg-dark-950 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Dokumentasi</span>
        <h1 class="font-display text-5xl sm:text-6xl font-bold text-white mt-3 mb-4">Galeri</h1>
        <div class="line-gold w-24 mx-auto mb-6"></div>
        <p class="text-gray-400 max-w-xl mx-auto">Koleksi foto dan video kegiatan kebudayaan Desa Brontokusuman</p>
    </div>
</section>

<section class="py-16 bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($kategori->count())
        <div class="flex flex-wrap gap-3 justify-center mb-12">
            <button class="px-5 py-2.5 rounded-full text-sm font-medium gradient-gold text-dark-950 transition-all filter-btn active" data-filter="all">Semua</button>
            @foreach($kategori as $k)
            <button class="px-5 py-2.5 rounded-full text-sm font-medium bg-dark-800 text-gray-300 hover:bg-gold-500/10 hover:text-gold-300 border border-gold-500/10 transition-all filter-btn" data-filter="{{ $k }}">{{ $k }}</button>
            @endforeach
        </div>
        @endif

        @if($galeri->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery">
            @foreach($galeri as $g)
            <div class="group relative rounded-xl overflow-hidden aspect-square card-hover cursor-pointer gallery-item" data-kategori="{{ $g->kategori }}" data-video="{{ $g->video ? asset('storage/' . $g->video) : '' }}" data-judul="{{ $g->judul }}">
                <div class="absolute inset-0 bg-gradient-to-br from-gold-600/20 to-dark-800">
                    @if($g->gambar)
                        <img src="{{ asset('storage/' . $g->gambar) }}" alt="{{ $g->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @elseif($g->video)
                        <video class="w-full h-full object-cover" muted preload="metadata"><source src="{{ asset('storage/' . $g->video) }}"></video>
                    @else
                        <div class="absolute inset-0 flex items-center justify-center"><i class="fas fa-image text-4xl text-gold-500/20"></i></div>
                    @endif
                </div>
                @if($g->video)
                <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-dark-900/80 flex items-center justify-center">
                    <i class="fas fa-play text-gold-400 text-xs"></i>
                </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-dark-950/90 via-dark-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute bottom-0 left-0 right-0 p-5 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                    <h3 class="text-white font-bold">{{ $g->judul }}</h3>
                    @if($g->kategori)
                    <p class="text-gold-300 text-sm mt-1">{{ $g->kategori }}</p>
                    @endif
                    @if($g->deskripsi)
                    <p class="text-gray-400 text-xs mt-2 line-clamp-2">{{ Str::limit($g->deskripsi, 80) }}</p>
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

@push('scripts')
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => { b.classList.remove('gradient-gold','text-dark-950','active'); b.classList.add('bg-dark-800','text-gray-300'); });
        btn.classList.add('gradient-gold','text-dark-950','active');
        btn.classList.remove('bg-dark-800','text-gray-300');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.style.display = (filter === 'all' || item.dataset.kategori === filter) ? '' : 'none';
        });
    });
});
</script>
@endpush
@endsection
