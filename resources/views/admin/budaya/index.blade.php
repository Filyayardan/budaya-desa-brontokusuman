@extends('admin.layouts.app')
@section('title', 'Budaya')
@section('header', 'Data Budaya')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center space-x-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari budaya..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none w-64">
        <select name="kategori_id" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $k)
            <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
            @endforeach
        </select>
        <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200"><i class="fas fa-search mr-1"></i>Cari</button>
    </form>
    <a href="{{ route('admin.budaya.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-1"></i>Tambah
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Gambar</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Judul</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Lokasi</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Unggulan</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($budaya as $i => $b)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $budaya->firstItem() + $i }}</td>
                <td class="px-5 py-4">
                    @if($b->gambar)
                    <img src="{{ asset('storage/' . $b->gambar) }}" class="w-12 h-12 rounded-lg object-cover">
                    @else
                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $b->judul }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $b->kategori->nama_kategori ?? '-' }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $b->lokasi ?? '-' }}</td>
                <td class="px-5 py-4">
                    @if($b->unggulan)
                    <span class="px-2 py-1 bg-gold-50 text-gold-700 rounded-full text-xs font-medium">Ya</span>
                    @else
                    <span class="px-2 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-medium">Tidak</span>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.budaya.edit', $b) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <form action="{{ route('admin.budaya.destroy', $b) }}" method="POST" onsubmit="return confirm('Yakin hapus budaya ini?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100"><i class="fas fa-trash mr-1"></i>Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-5 py-8 text-center text-gray-400">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $budaya->links() }}</div>
@endsection
