<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Lost & Found</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="max-w-7xl mx-auto flex min-h-screen">
        
        <!-- KOLOM KIRI (Sidebar Navigasi) -->
        <div class="w-1/4 p-4 border-r border-gray-200 hidden md:block">
            <h1 class="text-2xl font-bold text-blue-500 mb-8 px-2">🔍 CariBarang</h1>
            <nav class="space-y-2">
                <a href="{{ route('reports.index') }}" class="flex items-center text-xl font-semibold text-gray-700 hover:bg-gray-200 p-3 rounded-full w-max pr-6 transition"><span class="mr-4">🏠</span> Beranda</a>
                
                <a href="{{ route('profile.edit') }}" class="flex items-center text-xl font-bold text-gray-900 bg-gray-200 p-3 rounded-full w-max pr-6 transition"><span class="mr-4">👤</span> Profil</a>
                
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center text-xl font-semibold text-red-600 hover:bg-red-50 p-3 rounded-full w-max pr-6 transition"><span class="mr-4">🚪</span> Keluar</button>
                </form>
            </nav>
        </div>

        <!-- KOLOM TENGAH (Pengaturan Profil) -->
        <div class="w-full md:w-2/4 border-r border-gray-200 bg-white min-h-screen pb-10">
            <!-- Header Sticky -->
            <div class="sticky top-0 bg-white/90 backdrop-blur-md border-b border-gray-200 p-4 z-10 flex items-center">
                <a href="{{ route('reports.index') }}" class="mr-4 text-gray-600 hover:bg-gray-100 p-2 rounded-full transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="text-xl font-bold">Pengaturan Akun</h2>
            </div>

            <!-- Banner Profil -->
            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-32 w-full"></div>
            <div class="px-6 relative mb-8">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold text-4xl border-4 border-white shadow-md -mt-12 mb-4">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                <p class="text-gray-500">{{ Auth::user()->email }}</p>
                @if(Auth::user()->is_admin)
                    <span class="inline-block mt-2 bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider">Administrator</span>
                @endif
            </div>

            <!-- Formulir Bawaan Breeze yang dipercantik dengan border -->
            <div class="px-6 space-y-8">
                <!-- Update Profil -->
                <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Hapus Akun -->
                <div class="p-6 bg-red-50 border border-red-100 rounded-2xl shadow-sm">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (Informasi Tambahan) -->
        <div class="w-1/4 p-4 hidden lg:block">
            <div class="bg-gray-100 rounded-2xl p-5 mb-4 border border-gray-200">
                <h3 class="font-bold text-xl mb-2 text-gray-900">Privasi Akun</h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Pastikan email Anda aktif untuk mempermudah komunikasi jika ada yang menemukan barang Anda. Gunakan password yang kuat untuk menjaga keamanan akun.
                </p>
            </div>
        </div>

    </div>
</body>
</html>