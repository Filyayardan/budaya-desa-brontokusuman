@extends('admin.layouts.app')
@section('title', 'Pengurus')
@section('header', 'Data Pengurus')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">Total: {{ $pengurus->total() }} pengurus</p>
    <a href="{{ route('admin.pengurus.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-1"></i>Tambah
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Foto</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jabatan</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Telepon</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pengurus as $i => $p)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $pengurus->firstItem() + $i }}</td>
                <td class="px-5 py-4">
                    @if($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400"><i class="fas fa-user"></i></div>
                    @endif
                </td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $p->nama }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $p->jabatan }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $p->telepon ?? '-' }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $p->email ?? '-' }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.pengurus.edit', $p) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <form action="{{ route('admin.pengurus.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
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
<div class="mt-4">{{ $pengurus->links() }}</div>
@endsection
