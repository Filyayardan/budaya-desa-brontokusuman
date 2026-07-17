@extends('admin.layouts.app')
@section('title', 'Acara')
@section('header', 'Data Acara')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center space-x-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari acara..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none w-48">
        <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            <option value="">Semua Status</option>
            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Mendatang</option>
            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
        </select>
        <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200"><i class="fas fa-search mr-1"></i>Cari</button>
    </form>
    <a href="{{ route('admin.acara.create') }}" class="px-4 py-2 rounded-lg text-white text-sm font-medium" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
        <i class="fas fa-plus mr-1"></i>Tambah
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Acara</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Lokasi</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($acara as $i => $a)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $acara->firstItem() + $i }}</td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $a->nama_acara }}</td>
                <td class="px-5 py-4 text-gray-600 text-xs">{{ \Carbon\Carbon::parse($a->tanggal_mulai)->format('d M Y') }}{{ $a->tanggal_selesai ? ' - ' . \Carbon\Carbon::parse($a->tanggal_selesai)->format('d M Y') : '' }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $a->lokasi ?? '-' }}</td>
                <td class="px-5 py-4">
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $a->status === 'upcoming' ? 'bg-blue-50 text-blue-600' : ($a->status === 'ongoing' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500') }}">
                        {{ $a->status === 'upcoming' ? 'Mendatang' : ($a->status === 'ongoing' ? 'Berlangsung' : 'Selesai') }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.acara.edit', $a) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <form action="{{ route('admin.acara.destroy', $a) }}" method="POST" onsubmit="return confirm('Yakin hapus acara ini?')">
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
<div class="mt-4">{{ $acara->links() }}</div>
@endsection
