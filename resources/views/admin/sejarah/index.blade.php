@extends('admin.layouts.app')
@section('title', 'Sejarah')
@section('header', 'Data Sejarah')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">Total: {{ $sejarah->total() }} item</p>
    <a href="{{ route('admin.sejarah.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
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
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Urutan</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($sejarah as $i => $s)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $sejarah->firstItem() + $i }}</td>
                <td class="px-5 py-4">
                    @if($s->gambar)
                    <img src="{{ asset('storage/' . $s->gambar) }}" class="w-12 h-12 rounded-lg object-cover">
                    @else
                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $s->judul }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $s->urutan }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.sejarah.edit', $s) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <form action="{{ route('admin.sejarah.destroy', $s) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100"><i class="fas fa-trash mr-1"></i>Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $sejarah->links() }}</div>
@endsection
