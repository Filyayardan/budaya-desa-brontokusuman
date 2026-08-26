@extends('admin.layouts.app')
@section('title', 'Pengunjung')
@section('header', 'Pengunjung')
@section('content')

    @php

        $cards = [
            [
                'label' => 'Total Pengunjung',
                'count' => $totalVisitors,
                'icon' => 'fa-users',
                'route' => 'admin.pengurus.index',
                'color' => 'teal',
            ],
            [
                'label' => 'Pengunjung Hari Ini',
                'count' => $todayVisitors,
                'icon' => 'fa-eye',
                'route' => 'admin.pengunjung.index',
                'color' => 'orange',
            ],
        ];
    @endphp
    <main class="space-y-6 max-w-6xl">
        <!-- BEGIN: FilterSection -->

        {{-- Rentang Hari --}}
        <section class="bg-white rounded-xl shadow-card p-5 border border-brand-border">
            <form method="GET" action="{{ route('admin.pengunjung.index') }}">
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <i class="fa-regular fa-calendar text-gray-500"></i>
                        <span>Lihat Dalam Rentang Waktu</span>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 sm:items-center items-center">


                        {{-- Date range --}}
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
                            <div class="w-full sm:flex-1">
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    <i class="bi bi-calendar3 mr-1"></i>
                                    Dari Tanggal
                                </label>
                                <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                                <input type="date" name="mulai" value="{{ request('mulai') }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700
                   shadow-sm outline-none transition
                   focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>

                            <div class="hidden pb-2 text-gray-400 sm:block">
                                <i class="bi bi-arrow-right"></i>
                            </div>

                            <div class="w-full sm:flex-1">
                                <label class="mb-2 block text-sm font-medium text-gray-700">
                                    <i class="bi bi-calendar3 mr-1"></i>
                                    Sampai Tanggal
                                </label>

                                <input type="date" name="selesai" value="{{ request('selesai') }}"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-700
                   shadow-sm outline-none transition
                   focus:border-blue-500 focus:ring-2 focus:ring-blue-200">



                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 w-full sm:w-auto">
                            <button
                                class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center space-x-2 hover:bg-blue-700 transition">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span>Tampilkan</span>
                            </button>

                        </div>
                    </div>
                    {{-- <!-- Total Rentang Waktu -->
                <div class="bg-white rounded-xl shadow-card p-5 border border-brand-border flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-lg bg-orange-50 flex items-center justify-center text-brand-orange">
                        <i class="fa-solid fa-qrcode text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brand-gray mb-1">Pengunjunga </p>
                        <p class="text-2xl font-bold text-gray-800">Rp 0</p>
                    </div>
                </div> --}}
                </div>
            </form>
            @if (request()->filled(['mulai', 'selesai']))
                <div
                    class="mt-4 flex items-center space-x-4 rounded-xl border border-brand-border bg-white p-5 shadow-card">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-orange-50 text-orange-600">
                        <i class="fa-solid fa-eye text-xl"></i>
                    </div>

                    <div>
                        <p class="mb-1 text-sm font-medium text-brand-gray">
                            Pengunjung
                            {{ \Carbon\Carbon::parse(request('mulai'))->translatedFormat('d F Y') }}
                            -
                            {{ \Carbon\Carbon::parse(request('selesai'))->translatedFormat('d F Y') }}
                        </p>

                        <p class="text-2xl font-bold text-gray-800">
                            {{ $rangeVisitors }}
                        </p>
                    </div>
                </div>
            @endif
        </section>

        {{-- //month --}}
        <section class="bg-white rounded-xl shadow-card p-5 border border-brand-border">
            <form method="GET" action="{{ route('admin.pengunjung.index') }}">
                <div class="flex flex-col space-y-4">

                    <div class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                        <i class="fa-regular fa-calendar text-gray-500"></i>
                        <span>Pilih Bulan</span>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                        <!-- Month Input -->
                        <div class="relative w-full sm:w-64">

                            <input type="hidden" name="mulai" value="{{ request('mulai') }}">
                            <input type="hidden" name="selesai" value="{{ request('selesai') }}">

                            <input id="month" name="bulan" type="month"
                                value="{{ request('bulan', now()->format('Y-m')) }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 text-sm
               focus:border-blue-500 focus:ring-brand-blue">

                        </div>
                        <!-- Action Buttons -->
                        <div class="flex gap-3 w-full sm:w-auto">
                            <button
                                class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center space-x-2 hover:bg-blue-700 transition">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span>Tampilkan</span>
                            </button>
                            {{-- <button type="submit"
                                class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium flex items-center space-x-2 hover:bg-gray-50 transition">
                                <i class="fa-solid fa-rotate-right"></i>
                                <span>Hari Ini</span>
                            </button> --}}
                        </div>
                    </div>


            </form>

            @if (request()->filled('bulan'))
                <div class="flex items-center space-x-4 rounded-xl border border-brand-border bg-white p-5 shadow-card">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100 text-gray-600">
                        <i class="fa-solid fa-eye text-xl"></i>
                    </div>

                    <div>
                        <p class="mb-1 text-sm font-medium text-brand-gray">
                            Pengunjung Bulan {{ \Carbon\Carbon::parse(request('bulan') . '-01')->translatedFormat('F Y') }}
                        </p>
                        <p class="text-2xl font-bold text-gray-800">
                            {{ $monthVisitors }}
                        </p>
                    </div>
                </div>
            @endif

            </div>
        </section>
        <!-- END: FilterSection -->


        <!-- BEGIN: SummaryCards -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total  -->
            <div class="bg-white rounded-xl shadow-card p-5 border border-brand-border flex items-center space-x-4">
                <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-brand-blue">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-brand-gray mb-1">Total Pengunjung</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalVisitors }}</p>
                </div>
            </div>
            <!-- Total Hari Ini -->
            <div class="bg-white rounded-xl shadow-card p-5 border border-brand-border flex items-center space-x-4">
                <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center text-brand-green">
                    <i class="fa-solid fa-user-clock text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-brand-gray mb-1">Pengunjung Hari ini</p>
                    <p class="text-2xl font-bold text-brand-green">{{ $todayVisitors }}</p>
                </div>
            </div>


        </section>
        <!-- END: SummaryCards -->


        <!-- BEGIN: DetailedReports -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
            <!-- Chart Card -->
            {{-- Chart Harian --}}
            <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-5 py-3.5">
                    <span class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                        <i class="bi bi-graph-up text-blue-600"></i>
                        Pengunjung Harian
                    </span>

                    <span class="rounded-full border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs text-slate-500">
                        {{-- {{ \Carbon\Carbon::createFromDate(request('bulan'), request('bulan'), 1)->isoFormat('MMMM Y') }} --}}
                    </span>
                </div>

                <div class="p-5">
                    <div class="relative h-72 w-full">
                        <canvas id="chartHarian"></canvas>
                    </div>
                </div>
            </div>
            {{-- <!-- Table Card -->
            <div class="bg-white rounded-xl shadow-card border border-brand-border overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex items-center space-x-2">
                    <i class="fa-solid fa-pills text-brand-blue"></i>
                    <h2 class="text-base font-semibold text-gray-800">Obat Terjual</h2>
                </div>
                <!-- Table Header -->
                <div
                    class="grid grid-cols-12 gap-4 p-4 border-b border-gray-100 bg-gray-50 text-xs font-semibold text-brand-gray uppercase tracking-wider">
                    <div class="col-span-8">Nama Obat</div>
                    <div class="col-span-2 text-right">Qty</div>
                    <div class="col-span-2 text-right">Total</div>
                </div>
                <!-- Table Empty State -->
                <div class="p-10 flex flex-col items-center justify-center text-center space-y-3">
                    <div class="text-gray-300 text-4xl">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">Tidak ada transaksi</p>
                </div>
            </div> --}}
        </section>
        <!-- END: DetailedReports -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        new Chart(document.getElementById('chartHarian'), {
            type: 'line',
            data: {
                labels: @json($visitorLabels),
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: @json($visitorData),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.08)',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#2563eb',
                    fill: true,
                    tension: 0.35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: context =>
                                context.parsed.y.toLocaleString('id-ID') + ' pengunjung'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#64748b',
                            callback: value =>
                                Number(value).toLocaleString('id-ID')
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Pengunjung'
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const mulaiInput = document.querySelector('input[name="mulai"]');
        const selesaiInput = document.querySelector('input[name="selesai"]');

        function aturBatasTanggal() {
            if (!mulaiInput.value) {
                selesaiInput.removeAttribute('min');
                selesaiInput.removeAttribute('max');
                return;
            }

            const mulai = new Date(mulaiInput.value);
            const maksimal = new Date(mulai);
            maksimal.setDate(maksimal.getDate() + 90);

            const formatTanggal = tanggal =>
                tanggal.toISOString().split('T')[0];

            selesaiInput.min = mulaiInput.value;
            selesaiInput.max = formatTanggal(maksimal);

            if (
                selesaiInput.value &&
                (
                    selesaiInput.value < selesaiInput.min ||
                    selesaiInput.value > selesaiInput.max
                )
            ) {
                selesaiInput.value = '';
            }
        }

        mulaiInput.addEventListener('change', aturBatasTanggal);
        aturBatasTanggal();
    </script>
@endsection
