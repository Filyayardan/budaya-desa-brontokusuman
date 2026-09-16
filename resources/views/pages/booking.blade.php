@extends('layouts.app')
@section('title', 'Booking Budaya - Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Layanan</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">Booking Budaya</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Pesan kebudayaan Kampung Brontokusuman untuk hiburan di acara Anda</p>
        </div>
    </section>

    <section class="py-16 bg-pattern">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            <div class="grid lg:grid-cols-5 gap-8 lg:items-start">
                <div class="lg:col-span-2">
                    <div class="bg-white backdrop-blur rounded-2xl border border-gold-500/10 p-6 sm:p-8">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="font-display text-xl font-bold text-main_txt">Kalender Booking</h2>
                            <div class="flex items-center space-x-2">
                                <button type="button" id="calPrev"
                                    class="w-9 h-9 rounded-lg bg-main_txt-500/10 text-main_txt-400 hover:bg-main_txt-500/20 transition-colors"><i
                                        class="fas fa-chevron-left text-sm"></i></button>
                                <button type="button" id="calNext"
                                    class="w-9 h-9 rounded-lg bg-main_txt-500/10 text-main_txt-400 hover:bg-main_txt-500/20 transition-colors"><i
                                        class="fas fa-chevron-right text-sm"></i></button>
                            </div>
                        </div>
                        <div id="calTitle" class="text-main_txt font-semibold text-lg text-center mb-4"></div>
                        <div class="mb-3">
                            <select id="calFilter"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 bg-white focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                                <option value="">Semua Budaya</option>
                                @foreach ($budaya as $b)
                                    <option value="{{ $b->id }}">{{ $b->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="calGrid" class="grid grid-cols-7 gap-1"></div>
                        <div class="flex items-center space-x-2 mt-5 pt-5 border-t border-main_txt-500/10">
                            <span class="inline-block w-3 h-3 rounded-full" style="background:#d4a017;"></span>
                            <span class="text-tertiary text-xs">Klik tanggal berwarna untuk melihat jadwal booking</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="bg-white backdrop-blur rounded-2xl border border-gold-500/10 p-8 sm:p-10">
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                                    @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon <span class="text-red-500">*</span></label>
                                    <input type="text" name="telepon" value="{{ old('telepon') }}" required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                                    @error('telepon')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Budaya <span class="text-red-500">*</span></label>
                                <select name="budaya_id" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                                    <option value="">Pilih Budaya</option>
                                    @foreach ($budaya as $b)
                                        <option value="{{ $b->id }}" {{ old('budaya_id') == $b->id ? 'selected' : '' }}>{{ $b->judul }}</option>
                                    @endforeach
                                </select>
                                @error('budaya_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Acara <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_acara" value="{{ old('tanggal_acara') }}" required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                                    @error('tanggal_acara')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Acara <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_acara" value="{{ old('nama_acara') }}" required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                                    @error('nama_acara')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Acara</label>
                                <input type="text" name="lokasi_acara" value="{{ old('lokasi_acara') }}"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                                @error('lokasi_acara')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi / Catatan</label>
                                <textarea name="deskripsi" rows="4"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit"
                                class="w-full px-6 py-3 rounded-xl text-white font-semibold text-sm transition-all hover:shadow-lg"
                                style="background: linear-gradient(135deg, #d4a017, #b8860b);">
                                <i class="fas fa-paper-plane mr-2"></i>Kirim Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<div id="bookModal"
    class="hidden fixed inset-0 z-[1000] flex items-center justify-center bg-black/50 p-4"
    style="backdrop-filter: blur(2px);">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 relative">
        <button id="bookModalClose" type="button"
            class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-gray-200 flex items-center justify-center">
            <i class="fas fa-times"></i>
        </button>
        <h3 id="bookModalTitle" class="font-display text-lg font-bold text-main_txt mb-4"></h3>
        <div id="bookModalList" class="space-y-3"></div>
    </div>
</div>

@push('scripts')
    <script>
        const bookings = @json($approvedBookings);

        let calFilter = '';

        function currentBookings() {
            if (calFilter === '') return bookings;
            return bookings.filter(b => b.budaya_id == calFilter);
        }

        const DAY_NAMES = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        const MONTH_NAMES = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        let calYear = new Date().getFullYear();
        let calMonth = new Date().getMonth();

        function renderCalendar() {
            const title = document.getElementById('calTitle');
            const grid = document.getElementById('calGrid');
            title.textContent = MONTH_NAMES[calMonth] + ' ' + calYear;

            let html = '';
            DAY_NAMES.forEach(d => {
                html += '<div class="text-center text-xs font-semibold text-main_txt-400 py-2">' + d + '</div>';
            });

            const firstDay = new Date(calYear, calMonth, 1).getDay();
            const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();
            const today = new Date();
            const todayKey = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');

            for (let i = 0; i < firstDay; i++) {
                html += '<div></div>';
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const key = calYear + '-' + String(calMonth + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');
                const dayBookings = currentBookings().filter(b => b.tanggal === key);
                const isPast = key < todayKey;
                const colors = [...new Set(dayBookings.map(b => b.warna))];
                const booked = colors.length > 0;

                let bar = '';
                if (booked) {
                    bar = colors.map(c =>
                        '<span class="block flex-1 h-1.5 rounded-full" style="background:' + c + ';"></span>'
                    ).join('');
                    bar = '<div class="absolute inset-x-1 bottom-1 flex space-x-0.5">' + bar + '</div>';
                }

                html += `
                    <div class="relative aspect-square flex items-center justify-center rounded-lg text-sm cursor-pointer transition-colors ${isPast ? 'text-gray-300' : 'text-gray-700'} ${booked ? 'hover:bg-gold-500/10' : 'cursor-default'}"
                        ${booked ? 'onclick="showBookingInfo(\'' + key + '\')"' : ''}>
                        ${day}
                        ${bar}
                    </div>`;
            }

            grid.innerHTML = html;
        }

        function showBookingInfo(key) {
            const items = currentBookings().filter(b => b.tanggal === key);
            if (items.length === 0) return;

            const tanggal = new Date(key + 'T00:00:00');
            const formatted = tanggal.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            const list = items.map(b =>
                '<div class="flex items-start space-x-3"><span class="mt-1.5 w-3 h-3 rounded-full flex-shrink-0" style="background:' + b.warna + ';"></span>' +
                '<span class="text-sm text-gray-700">' + b.budaya + ' sudah dibooking untuk acara <strong>' + b.acara + '</strong></span></div>'
            ).join('');

            document.getElementById('bookModalTitle').textContent = formatted;
            document.getElementById('bookModalList').innerHTML = list;
            document.getElementById('bookModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeBookingModal() {
            document.getElementById('bookModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.getElementById('calPrev').addEventListener('click', () => {
            calMonth--;
            if (calMonth < 0) { calMonth = 11; calYear--; }
            renderCalendar();
        });

        document.getElementById('calNext').addEventListener('click', () => {
            calMonth++;
            if (calMonth > 11) { calMonth = 0; calYear++; }
            renderCalendar();
        });

        document.getElementById('calFilter').addEventListener('change', (e) => {
            calFilter = e.target.value;
            renderCalendar();
        });

        document.getElementById('bookModalClose')?.addEventListener('click', closeBookingModal);
        document.getElementById('bookModal')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closeBookingModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeBookingModal();
        });

        renderCalendar();
    </script>
@endpush
