<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kebudayaan Desa Brontokusuman')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: { 50:'#fdf8e8', 100:'#faefc5', 200:'#f5de8c', 300:'#efc94b', 400:'#e8b923', 500:'#d4a017', 600:'#b8860b', 700:'#8b6508', 800:'#6b4e0a', 900:'#5a420d' },
                        dark: { 50:'#f6f6f7', 100:'#e2e1e5', 200:'#c4c3ca', 300:'#9f9da7', 400:'#7b7986', 500:'#615f6c', 600:'#4d4b56', 700:'#3f3d47', 800:'#2d2b33', 900:'#1a1820', 950:'#0f0e14' },
                    },
                    fontFamily: {
                        display: ['Playfair Display', 'serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .gradient-gold { background: linear-gradient(135deg, #d4a017 0%, #f5de8c 50%, #d4a017 100%); }
        .text-gradient-gold { background: linear-gradient(135deg, #d4a017, #f5de8c, #b8860b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .bg-pattern { background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4a017' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        .hero-pattern { background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23d4a017' fill-opacity='0.04' fill-rule='evenodd'/%3E%3C/svg%3E"); }
        .card-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-8px); box-shadow: 0 20px 60px -15px rgba(212, 160, 23, 0.2); }
        .line-gold { height: 2px; background: linear-gradient(90deg, transparent, #d4a017, transparent); }
        .nav-scrolled { background: rgba(15, 14, 20, 0.98) !important; backdrop-filter: blur(20px); }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #1a1820; }
        ::-webkit-scrollbar-thumb { background: #d4a017; border-radius: 4px; }
    </style>
    @stack('styles')
</head>
<body class="bg-dark-950 text-white antialiased">
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-500 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 gradient-gold rounded-lg flex items-center justify-center">
                        <i class="fas fa-landmark text-dark-950 text-lg"></i>
                    </div>
                    <div>
                        <span class="font-display text-xl font-bold text-gold-300">Brontokusuman</span>
                        <span class="block text-xs text-gold-500/70 tracking-widest uppercase">Kebudayaan Desa</span>
                    </div>
                </a>

                <div class="hidden lg:flex items-center space-x-1">
                    @php $links = ['Beranda'=>'home','Kebudayaan'=>'budaya','Acara'=>'acara','Galeri'=>'galeri','Berita'=>'berita','Sejarah'=>'sejarah','Profil'=>'profil','Kontak'=>'kontak']; @endphp
                    @foreach($links as $label => $route)
                        <a href="{{ route($route) }}" class="px-4 py-2 text-sm font-medium {{ request()->routeIs($route) ? 'text-gold-300' : 'text-gray-300 hover:text-gold-300' }} transition-colors duration-300 relative group">
                            {{ $label }}
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 gradient-gold group-hover:w-3/4 transition-all duration-300"></span>
                        </a>
                    @endforeach
                </div>

                <button id="mobileToggle" class="lg:hidden text-gold-300 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="hidden lg:hidden bg-dark-900/98 backdrop-blur-xl border-t border-gold-500/10">
            <div class="px-4 py-4 space-y-1">
                @foreach($links as $label => $route)
                    <a href="{{ route($route) }}" class="block px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs($route) ? 'bg-gold-500/10 text-gold-300' : 'text-gray-300 hover:bg-gold-500/5 hover:text-gold-300' }} transition-all">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-dark-900 border-t border-gold-500/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 gradient-gold rounded-lg flex items-center justify-center">
                            <i class="fas fa-landmark text-dark-950 text-lg"></i>
                        </div>
                        <div>
                            <span class="font-display text-lg font-bold text-gold-300">Brontokusuman</span>
                            <span class="block text-xs text-gold-500/70 tracking-widest uppercase">Kebudayaan Desa</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Melestarikan dan mempromosikan kebudayaan warisan leluhur Desa Brontokusuman agar tetap hidup dan dikenal luas.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="w-10 h-10 rounded-full bg-gold-500/10 flex items-center justify-center text-gold-400 hover:bg-gold-500/20 transition-colors"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gold-500/10 flex items-center justify-center text-gold-400 hover:bg-gold-500/20 transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gold-500/10 flex items-center justify-center text-gold-400 hover:bg-gold-500/20 transition-colors"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gold-500/10 flex items-center justify-center text-gold-400 hover:bg-gold-500/20 transition-colors"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="font-display text-lg font-semibold text-gold-300 mb-6">Navigasi</h4>
                    <ul class="space-y-3">
                        @foreach(['Beranda'=>'home','Kebudayaan'=>'budaya','Acara'=>'acara','Galeri'=>'galeri','Berita'=>'berita'] as $label => $route)
                            <li><a href="{{ route($route) }}" class="text-gray-400 hover:text-gold-300 transition-colors text-sm"><i class="fas fa-chevron-right text-gold-500/50 text-xs mr-2"></i>{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="font-display text-lg font-semibold text-gold-300 mb-6">Informasi</h4>
                    <ul class="space-y-3">
                        @foreach(['Sejarah'=>'sejarah','Profil Desa'=>'profil','Kontak'=>'kontak'] as $label => $route)
                            <li><a href="{{ route($route) }}" class="text-gray-400 hover:text-gold-300 transition-colors text-sm"><i class="fas fa-chevron-right text-gold-500/50 text-xs mr-2"></i>{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="font-display text-lg font-semibold text-gold-300 mb-6">Kontak</h4>
                    <ul class="space-y-4">
                        @php $fp = App\Models\ProfilDesa::all()->pluck('value','key'); @endphp
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-gold-400 mt-1"></i>
                            <span class="text-gray-400 text-sm">{{ $fp['alamat'] ?? 'Desa Brontokusuman, Kecamatan Mergangsan, Kota Yogyakarta, DI Yogyakarta' }}</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-gold-400"></i>
                            <span class="text-gray-400 text-sm">{{ $fp['telepon'] ?? '+62 274 XXX XXX' }}</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-gold-400"></i>
                            <span class="text-gray-400 text-sm">{{ $fp['email'] ?? 'info@brontokusuman.id' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gold-500/10 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Desa Brontokusuman. Hak Cipta Dilindungi.</p>
                <p class="text-gray-600 text-xs mt-2 md:mt-0">Dibuat dengan <i class="fas fa-heart text-gold-500"></i> untuk kebudayaan</p>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) { nav.classList.add('nav-scrolled'); } else { nav.classList.remove('nav-scrolled'); }
        });

        document.getElementById('mobileToggle')?.addEventListener('click', () => {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
