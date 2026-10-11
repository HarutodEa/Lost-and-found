<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Lost & Found</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <!-- Sisi Kiri (Visual/Branding) -->
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-blue-600 to-blue-900 items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="z-10 p-12 text-white max-w-lg text-center">
                <div class="text-6xl mb-6">🔍</div>
                <h1 class="text-4xl font-extrabold mb-4 tracking-tight">CariBarang Platform</h1>
                <p class="text-lg text-blue-100 leading-relaxed">Bergabunglah dengan komunitas kami. Laporkan barang yang hilang atau bantu orang lain menemukan barang berharga mereka yang tercecer.</p>
            </div>
        </div>

        <!-- Sisi Kanan (Form Login) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h2>
                    <p class="text-gray-500">Silakan masuk ke akun Anda.</p>
                </div>

                <!-- Session Status & Errors -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-xl text-sm font-medium">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border border-gray-300 rounded-xl p-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                        <input id="password" type="password" name="password" required class="w-full border border-gray-300 rounded-xl p-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600 font-medium">Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition shadow-lg mt-4">
                        Masuk Sekarang
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-600 font-medium">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-bold transition">Daftar di sini</a>
                </p>
                <div class="mt-4 text-center">
                    <a href="{{ route('reports.index') }}" class="text-sm text-gray-400 hover:text-gray-600 font-medium transition">&larr; Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>