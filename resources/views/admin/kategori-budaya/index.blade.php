@extends('admin.layouts.app')
@section('title', 'Kategori Budaya')
@section('header', 'Kategori Budaya')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">Total: {{ $kategori->total() }} kategori</p>
    <a href="{{ route('admin.kategori-budaya.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-1"></i>Tambah
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Ikon</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jumlah Budaya</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($kategori as $i => $k)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $kategori->firstItem() + $i }}</td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $k->nama_kategori }}</td>
                <td class="px-5 py-4 text-gray-600"><i class="fas {{ $k->ikon ?? 'fa-landmark' }}"></i> {{ $k->ikon ?? '-' }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $k->budaya_count }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.kategori-budaya.edit', $k) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <form action="{{ route('admin.kategori-budaya.destroy', $k) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
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
<div class="mt-4">{{ $kategori->links() }}</div>
@endsection
