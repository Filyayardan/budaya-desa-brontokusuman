<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Brontokusuman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative">
    <div class="absolute inset-0 z-0" style="background: linear-gradient(135deg, #1a1820, #2d2b33);">
        @if($fotoLogin)
            <img src="{{ asset('storage/' . $fotoLogin) }}" alt="Kampung Brontokusuman" class="w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <div class="relative z-10 w-full max-w-md mx-4">
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg, #d4a017, #f5de8c);">
                    <i class="fas fa-landmark text-dark-950 text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Admin Panel</h1>
                <p class="text-gray-500 text-sm mt-1">Brontokusuman</p>
            </div>

            @if($errors->any())
            <div class="mb-6 p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Masukkan Email/Username</label>
                    <div class="relative">
                        <input type="text" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none transition">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none transition">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                <button type="submit" class="w-full py-3 rounded-lg text-white font-semibold transition" style="background: linear-gradient(135deg, #d4a017, #b8860b);">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                </button>
            </form>
        </div>
        <p class="text-center text-white/70 text-sm mt-6">&copy; {{ date('Y') }} Kampung Brontokusuman</p>
    </div>
</body>
</html>
