@extends('admin.layouts.app')
@section('title', 'UMKM')
@section('header', 'Data UMKM')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center space-x-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari UMKM..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none w-64">
        <select name="kategori" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $k)
            <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
        <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200"><i class="fas fa-search mr-1"></i>Cari</button>
    </form>
    <a href="{{ route('admin.umkm.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-1"></i>Tambah
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Usaha</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Pemilik</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Alamat</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Peta</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($umkm as $i => $u)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $umkm->firstItem() + $i }}</td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $u->nama_usaha }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $u->pemilik ?? '-' }}</td>
                <td class="px-5 py-4">
                    <span class="px-2 py-1 bg-gold-50 text-gold-700 rounded-full text-xs font-medium">{{ $u->kategori ?? '-' }}</span>
                </td>
                <td class="px-5 py-4 text-gray-600 max-w-[220px] truncate">{{ $u->alamat ?? '-' }}</td>
                <td class="px-5 py-4">
                    @if($u->latitude && $u->longitude)
                    <span class="px-2 py-1 bg-green-50 text-green-600 rounded-full text-xs font-medium"><i class="fas fa-map-marker-alt mr-1"></i>Ada</span>
                    @else
                    <span class="px-2 py-1 bg-gray-100 text-gray-400 rounded-full text-xs font-medium">-</span>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.umkm.edit', $u) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <form action="{{ route('admin.umkm.destroy', $u) }}" method="POST" onsubmit="return confirm('Yakin hapus UMKM ini?')">
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
<div class="mt-4">{{ $umkm->links() }}</div>
@endsection
