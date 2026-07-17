@extends('admin.layouts.app')
@section('title', 'Berita')
@section('header', 'Data Berita')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center space-x-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none w-64">
        <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200"><i class="fas fa-search mr-1"></i>Cari</button>
    </form>
    <a href="{{ route('admin.berita.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
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
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Penulis</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($berita as $i => $br)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $berita->firstItem() + $i }}</td>
                <td class="px-5 py-4">
                    @if($br->gambar)
                    <img src="{{ asset('storage/' . $br->gambar) }}" class="w-12 h-12 rounded-lg object-cover">
                    @else
                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $br->judul }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $br->penulis ?? '-' }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $br->created_at->format('d M Y') }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.berita.edit', $br) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <form action="{{ route('admin.berita.destroy', $br) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100"><i class="fas fa-trash mr-1"></i>Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $berita->links() }}</div>
@endsection
