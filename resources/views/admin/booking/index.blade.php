@extends('admin.layouts.app')
@section('title', 'Booking')
@section('header', 'Data Booking')

@section('content')
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center space-x-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / acara..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none w-64">
        <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
        </select>
        <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200"><i class="fas fa-search mr-1"></i>Cari</button>
    </form>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Budaya</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Acara</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($bookings as $i => $bk)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 text-gray-500">{{ $bookings->firstItem() + $i }}</td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $bk->nama }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $bk->budaya->judul ?? '-' }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $bk->nama_acara }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $bk->tanggal_acara->format('d M Y') }}</td>
                <td class="px-5 py-4">
                    @if ($bk->status == 'pending')
                        <span class="px-2.5 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-medium">Menunggu</span>
                    @elseif ($bk->status == 'approved')
                        <span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-medium">Disetujui</span>
                    @else
                        <span class="px-2.5 py-1 bg-red-50 text-red-700 rounded-full text-xs font-medium">Ditolak</span>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.booking.show', $bk) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100"><i class="fas fa-eye mr-1"></i>Detail</a>
                        <form action="{{ route('admin.booking.destroy', $bk) }}" method="POST" onsubmit="return confirm('Yakin hapus booking ini?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100"><i class="fas fa-trash mr-1"></i>Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-5 py-8 text-center text-gray-400">Belum ada data booking</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $bookings->links() }}</div>
@endsection
