@extends('layouts.app')
@section('title', 'FAQ - Brontokusuman')

@section('content')
    <section class="header-section relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-tertiary text-sm font-semibold tracking-widest uppercase">Informasi</span>
            <h1 class="font-display text-5xl sm:text-6xl font-bold text-main_txt mt-3 mb-4">FAQ</h1>
            <div class="line-gold w-24 mx-auto mb-6"></div>
            <p class="text-main_txt-400 max-w-xl mx-auto">Pertanyaan yang Sering Diajukan Seputar Kampung Brontokusuman</p>
        </div>
    </section>

    <section class="py-20 bg-pattern">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($faqs->count())
                <div class="space-y-6">
                    @foreach ($faqs as $faq)
                        <div x-data="{ open: false }"
                            class="bg-white shadow-md rounded-lg overflow-hidden border border-gold-500/10">
                            <button @click="open = !open"
                                class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                                <span class="font-semibold text-main_txt text-lg">{{ $faq->question }}</span>
                                <span :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                    class="transform transition-transform duration-300 text-main_txt-400">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-4"
                                class="px-6 pb-4 text-tertiary border-t border-gold-500/10">
                                <p>{!! nl2br(e($faq->answer)) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada FAQ yang tersedia saat ini.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
