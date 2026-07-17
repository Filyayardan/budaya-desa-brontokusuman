@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    @php
        $cards = [
            ['label' => 'Kategori Budaya', 'count' => $stats['kategori'], 'icon' => 'fa-tags', 'route' => 'admin.kategori-budaya.index', 'color' => 'blue'],
            ['label' => 'Budaya', 'count' => $stats['budaya'], 'icon' => 'fa-landmark', 'route' => 'admin.budaya.index', 'color' => 'gold'],
            ['label' => 'Berita', 'count' => $stats['berita'], 'icon' => 'fa-newspaper', 'route' => 'admin.berita.index', 'color' => 'green'],
            ['label' => 'Acara', 'count' => $stats['acara'], 'icon' => 'fa-calendar-alt', 'route' => 'admin.acara.index', 'color' => 'purple'],
            ['label' => 'Galeri', 'count' => $stats['galeri'], 'icon' => 'fa-images', 'route' => 'admin.galeri.index', 'color' => 'pink'],
            ['label' => 'Sejarah', 'count' => $stats['sejarah'], 'icon' => 'fa-book', 'route' => 'admin.sejarah.index', 'color' => 'indigo'],
            ['label' => 'Pengurus', 'count' => $stats['pengurus'], 'icon' => 'fa-users', 'route' => 'admin.pengurus.index', 'color' => 'teal'],
        ];
    @endphp
    @foreach($cards as $c)
    <a href="{{ route($c['route']) }}" class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center
                {{ $c['color'] == 'gold' ? 'bg-gold-50 text-gold-600' : '' }}
                {{ $c['color'] == 'blue' ? 'bg-blue-50 text-blue-600' : '' }}
                {{ $c['color'] == 'green' ? 'bg-green-50 text-green-600' : '' }}
                {{ $c['color'] == 'purple' ? 'bg-purple-50 text-purple-600' : '' }}
                {{ $c['color'] == 'pink' ? 'bg-pink-50 text-pink-600' : '' }}
                {{ $c['color'] == 'indigo' ? 'bg-indigo-50 text-indigo-600' : '' }}
                {{ $c['color'] == 'teal' ? 'bg-teal-50 text-teal-600' : '' }}">
                <i class="fas {{ $c['icon'] }}"></i>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-900">{{ $c['count'] }}</div>
        <div class="text-sm text-gray-500">{{ $c['label'] }}</div>
    </a>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl border border-gray-200">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Budaya Terbaru</h3>
            <a href="{{ route('admin.budaya.index') }}" class="text-sm text-gold-600 hover:text-gold-700">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recentBudaya as $b)
            <div class="p-4 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-lg bg-gold-50 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-landmark text-gold-600 text-sm"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $b->judul }}</p>
                    <p class="text-xs text-gray-500">{{ $b->kategori->nama_kategori ?? '-' }}</p>
                </div>
            </div>
            @empty
            <div class="p-4 text-center text-gray-400 text-sm">Belum ada data</div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Berita Terbaru</h3>
            <a href="{{ route('admin.berita.index') }}" class="text-sm text-gold-600 hover:text-gold-700">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recentBerita as $br)
            <div class="p-4 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-newspaper text-green-600 text-sm"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $br->judul }}</p>
                    <p class="text-xs text-gray-500">{{ $br->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <div class="p-4 text-center text-gray-400 text-sm">Belum ada data</div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Acara Terbaru</h3>
            <a href="{{ route('admin.acara.index') }}" class="text-sm text-gold-600 hover:text-gold-700">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recentAcara as $a)
            <div class="p-4 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-calendar-alt text-purple-600 text-sm"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $a->nama_acara }}</p>
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($a->tanggal_mulai)->format('d M Y') }}</p>
                </div>
            </div>
            @empty
            <div class="p-4 text-center text-gray-400 text-sm">Belum ada data</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
