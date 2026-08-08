@extends('layouts.app')
@section('title', 'Kontak - Brontokusuman')

@section('content')
<section class="pt-32 pb-16 bg-dark-950 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Hubungi Kami</span>
        <h1 class="font-display text-5xl sm:text-6xl font-bold text-white mt-3 mb-4">Kontak</h1>
        <div class="line-gold w-24 mx-auto mb-6"></div>
        <p class="text-gray-400 max-w-xl mx-auto">Silakan hubungi kami untuk informasi lebih lanjut tentang kebudayaan Kampung Brontokusuman</p>
    </div>
</section>

<section class="py-20 bg-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            <div class="space-y-8">
                <div class="bg-dark-800/80 backdrop-blur rounded-2xl border border-gold-500/10 p-8">
                    <div class="w-14 h-14 gradient-gold rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-map-marker-alt text-dark-950 text-xl"></i>
                    </div>
                    <h3 class="font-display text-xl font-bold text-white mb-3">Alamat</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Jl. Prawirotaman 2, Brontokusuman, Kec. Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55153</p>
                </div>

                <div class="bg-dark-800/80 backdrop-blur rounded-2xl border border-gold-500/10 p-8">
                    <div class="w-14 h-14 gradient-gold rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-phone text-dark-950 text-xl"></i>
                    </div>
                    <h3 class="font-display text-xl font-bold text-white mb-3">Telepon</h3>
                    <p class="text-gray-400 text-sm">+62 274 XXX XXX</p>
                    <p class="text-gray-400 text-sm">+62 812 XXX XXX</p>
                </div>

                <div class="bg-dark-800/80 backdrop-blur rounded-2xl border border-gold-500/10 p-8">
                    <div class="w-14 h-14 gradient-gold rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-envelope text-dark-950 text-xl"></i>
                    </div>
                    <h3 class="font-display text-xl font-bold text-white mb-3">Email</h3>
                    <p class="text-gray-400 text-sm">info@brontokusuman.id</p>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-dark-800/80 backdrop-blur rounded-2xl border border-gold-500/10 p-8 sm:p-10">
                    <h2 class="font-display text-2xl font-bold text-white mb-8">Kirim Pesan</h2>
                    <form class="space-y-6">
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Nama Lengkap</label>
                                <input type="text" class="w-full bg-dark-900/50 border border-gold-500/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-gold-500/50 transition-colors" placeholder="Masukkan nama">
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Email</label>
                                <input type="email" class="w-full bg-dark-900/50 border border-gold-500/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-gold-500/50 transition-colors" placeholder="Masukkan email">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Subjek</label>
                            <input type="text" class="w-full bg-dark-900/50 border border-gold-500/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-gold-500/50 transition-colors" placeholder="Subjek pesan">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Pesan</label>
                            <textarea rows="6" class="w-full bg-dark-900/50 border border-gold-500/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-gold-500/50 transition-colors resize-none" placeholder="Tulis pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="gradient-gold text-dark-950 font-semibold px-8 py-4 rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-gold-500/20">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">Lokasi</span>
            <h2 class="font-display text-3xl font-bold text-white mt-3">Kampung Brontokusuman</h2>
            <div class="line-gold w-24 mx-auto mt-4"></div>
        </div>
        <div class="rounded-2xl overflow-hidden border border-gold-500/20 shadow-xl">
            <iframe
                src="https://maps.google.com/maps?q=-7.822656077037122,110.36961693442929&t=&z=16&ie=UTF8&iwloc=&output=embed"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <div class="mt-6 text-center">
            <a href="https://maps.app.goo.gl/JFJRnLabUfGwEKV87" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gradient-gold text-dark-950 font-semibold px-6 py-3 rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-gold-500/20">
                <i class="fas fa-map-marker-alt mr-2"></i>Buka di Google Maps
            </a>
        </div>
    </div>
</section>
@endsection
