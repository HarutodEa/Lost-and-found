<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Lost & Found</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <div class="min-h-screen flex flex-row-reverse">
        
        <!-- Sisi Kanan (Visual/Branding) -->
        <div class="hidden lg:flex w-1/2 bg-gradient-to-bl from-blue-800 to-blue-500 items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0 bg-white opacity-10"></div>
            <div class="z-10 p-12 text-white max-w-lg text-center">
                <div class="text-6xl mb-6">🤝</div>
                <h1 class="text-4xl font-extrabold mb-4 tracking-tight">Mulai Membantu</h1>
                <p class="text-lg text-blue-100 leading-relaxed">Buat akun Anda dalam hitungan detik dan jadilah pahlawan bagi seseorang yang kehilangan barang berharganya hari ini.</p>
            </div>
        </div>

        <!-- Sisi Kiri (Form Register) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h2>
                    <p class="text-gray-500">Lengkapi data di bawah ini untuk mendaftar.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-xl text-sm font-medium">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full border border-gray-300 rounded-xl p-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-xl p-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                        <input id="password" type="password" name="password" required class="w-full border border-gray-300 rounded-xl p-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full border border-gray-300 rounded-xl p-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition shadow-lg mt-2">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-600 font-medium">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-bold transition">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>