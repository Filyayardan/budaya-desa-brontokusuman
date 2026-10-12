@extends('admin.layouts.app')
@section('title', 'Detail Booking')
@section('header', 'Detail Booking')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Pengunjung</label>
                <p class="text-gray-900 font-medium">{{ $booking->nama }}</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Telepon</label>
                <p class="text-gray-900">{{ $booking->telepon }}</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Email</label>
                <p class="text-gray-900">{{ $booking->email ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Status</label>
                @if ($booking->status == 'pending')
                    <span class="px-2.5 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-medium">Menunggu</span>
                @elseif ($booking->status == 'approved')
                    <span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-medium">Disetujui</span>
                @else
                    <span class="px-2.5 py-1 bg-red-50 text-red-700 rounded-full text-xs font-medium">Ditolak</span>
                @endif
            </div>
        </div>

        <hr class="border-gray-200 mb-6">

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Budaya</label>
                <p class="text-gray-900 font-medium">{{ $booking->budaya->judul ?? '-' }}</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Tanggal Acara</label>
                <p class="text-gray-900">{{ $booking->tanggal_acara->translatedFormat('d F Y') }}</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Acara</label>
                <p class="text-gray-900">{{ $booking->nama_acara }}</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Lokasi Acara</label>
                <p class="text-gray-900">{{ $booking->lokasi_acara ?? '-' }}</p>
            </div>
        </div>

        @if ($booking->deskripsi)
        <div class="mb-6">
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Deskripsi / Catatan</label>
            <p class="text-gray-700 text-sm leading-relaxed bg-gray-50 rounded-lg p-4">{{ $booking->deskripsi }}</p>
        </div>
        @endif

        @if ($booking->status == 'rejected' && $booking->rejection_reason)
        <div class="mb-6">
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Alasan Penolakan</label>
            <p class="text-red-600 text-sm leading-relaxed bg-red-50 border border-red-200 rounded-lg p-4">{{ $booking->rejection_reason }}</p>
        </div>
        @endif

        <div class="flex items-center space-x-3">
            @if ($booking->status == 'pending')
            <form action="{{ route('admin.booking.update-status', $booking) }}" method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="approved">
                <button type="submit" class="px-5 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700">
                    <i class="fas fa-check mr-1"></i>Setujui
                </button>
            </form>
            <button type="button" onclick="document.getElementById('rejectModal').classList.remove('hidden')"
                class="px-5 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700">
                <i class="fas fa-times mr-1"></i>Tolak
            </button>
            @endif
            <a href="{{ route('admin.booking.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Kembali</a>
        </div>
    </div>
</div>

<div id="rejectModal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-xl border border-gray-200 p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold text-gray-900 mb-1"><i class="fas fa-times-circle text-red-600 mr-2"></i>Tolak Booking</h3>
        <p class="text-sm text-gray-500 mb-4">Tuliskan alasan penolakan. Alasan ini akan dikirim ke email pemohon ({{ $booking->email ?? '-' }}).</p>
        <form action="{{ route('admin.booking.update-status', $booking) }}" method="POST">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="rejected">
            <textarea name="rejection_reason" rows="4" required
                placeholder="Contoh: Jadwal sudah penuh pada tanggal tersebut. Silakan pilih tanggal lain."
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"></textarea>
            <div class="flex items-center justify-end space-x-3 mt-4">
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')"
                    class="px-4 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</button>
                <button type="submit" class="px-4 py-2.5 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700">
                    <i class="fas fa-times mr-1"></i>Tolak & Kirim Email
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
