@extends('admin.layouts.app')
@section('title', 'Sub Berita - ' . $berita->judul)
@section('header', 'Sub Berita: ' . $berita->judul)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.berita.index') }}" class="text-sm text-gray-500 hover:text-gold-600"><i class="fas fa-arrow-left mr-1"></i>Kembali ke Daftar Berita</a>
</div>

<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Kelola sub berita di dalam berita ini</p>
    </div>
    <a href="{{ route('admin.berita.sub-berita.create', $berita) }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-1"></i>Tambah Sub Berita
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Gambar</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Judul</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Urutan</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($subBerita as $i => $sb)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $subBerita->firstItem() + $i }}</td>
                <td class="px-5 py-4">
                    @if($sb->gambar)
                    <img src="{{ asset('storage/' . $sb->gambar) }}" class="w-12 h-12 rounded-lg object-cover">
                    @else
                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $sb->judul_sub }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $sb->urutan }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.berita.sub-berita.edit', [$berita, $sb]) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <form action="{{ route('admin.berita.sub-berita.destroy', [$berita, $sb]) }}" method="POST" onsubmit="return confirm('Yakin hapus sub berita ini?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100"><i class="fas fa-trash mr-1"></i>Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Belum ada sub berita</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $subBerita->links() }}</div>
@endsection
