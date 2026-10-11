<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="max-w-7xl mx-auto flex min-h-screen">
        
        <!-- KOLOM KIRI (Sidebar) -->
        <div class="w-1/4 p-4 border-r border-gray-200 hidden md:block">
            <h1 class="text-2xl font-bold text-blue-500 mb-8 px-2">🔍 Lost & Found</h1>
            <nav class="space-y-2">
                <a href="/" class="flex items-center text-xl font-bold text-gray-900 bg-gray-200 p-3 rounded-full w-max pr-6"><span class="mr-4">🏠</span> Beranda</a>
                
                @auth
                    <a href="{{ route('profile.edit') }}" class="flex items-center text-xl font-semibold text-gray-700 hover:bg-gray-200 p-3 rounded-full w-max pr-6 transition"><span class="mr-4">👤</span> Profil</a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center text-xl font-semibold text-red-600 hover:bg-red-50 p-3 rounded-full w-max pr-6 transition"><span class="mr-4">🚪</span> Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center text-xl font-semibold text-gray-700 hover:bg-gray-200 p-3 rounded-full w-max pr-6 transition"><span class="mr-4">🔑</span> Masuk</a>
                    <a href="{{ route('register') }}" class="mt-4 block text-center bg-blue-500 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-600 transition shadow">Daftar Akun</a>
                @endauth
            </nav>
        </div>

        <!-- KOLOM TENGAH (Feed Utama) -->
        <div class="w-full md:w-2/4 border-r border-gray-200 bg-white min-h-screen">
            <div class="sticky top-0 bg-white/80 backdrop-blur-md border-b border-gray-200 p-4 z-10">
                <h2 class="text-xl font-bold">Laporan Terbaru</h2>
            </div>

            <!-- Notifikasi Sukses -->
            @if(session('success'))
            <div class="bg-blue-50 text-blue-600 p-3 font-semibold text-sm border-b border-gray-200">
                ✔️ {{ session('success') }}
            </div>
            @endif

            <!-- Form Posting Laporan (Hanya jika Login) -->
            @auth
            <div class="p-4 border-b border-gray-200 flex space-x-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex-shrink-0 flex items-center justify-center text-blue-600 font-bold text-xl">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="w-full pt-2">
                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf
                        <input type="text" name="title" placeholder="Apa nama barangnya?" class="w-full border-none focus:ring-0 text-xl font-semibold mb-2 p-0 outline-none" required>
                        <textarea name="description" rows="2" placeholder="Tuliskan ciri-ciri detail barang tersebut..." class="w-full border-none focus:ring-0 text-gray-700 p-0 resize-none outline-none" required></textarea>
                        
                        <div class="flex items-center space-x-2 mt-2">
                            <input type="text" name="location" placeholder="Lokasi kejadian" class="w-1/2 border border-gray-300 rounded-lg p-2 text-sm outline-none focus:border-blue-500" required>
                            <select name="type" class="w-1/2 border border-gray-300 rounded-lg p-2 text-sm bg-white outline-none focus:border-blue-500" required>
                                <option value="lost">Saya Kehilangan</option>
                                <option value="found">Saya Menemukan</option>
                            </select>
                        </div>
                        
                        <div class="flex justify-end mt-4 border-t border-gray-100 pt-3">
                            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-5 rounded-full hover:bg-blue-600 transition">Posting</button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <!-- Pengingat jika belum login -->
            <div class="p-6 border-b border-gray-200 flex flex-col items-center justify-center bg-gray-50">
                <p class="text-gray-600 font-medium mb-3">Login untuk membuat laporan kehilangan atau penemuan barang.</p>
                <a href="{{ route('login') }}" class="bg-blue-500 text-white font-bold py-2 px-6 rounded-full hover:bg-blue-600">Masuk Sekarang</a>
            </div>
            @endauth

            <!-- Looping Feed Laporan -->
            @foreach($reports as $report)
            <div class="p-4 border-b border-gray-200 hover:bg-gray-50 transition flex space-x-4">
                <div class="w-12 h-12 bg-gray-200 rounded-full flex-shrink-0 flex items-center justify-center text-gray-700 font-bold text-xl">
                    {{ strtoupper(substr($report->user->name, 0, 1)) }}
                </div>
                
                <div class="w-full">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <span class="font-bold text-gray-900 hover:underline cursor-pointer">{{ $report->user->name }}</span>
                            @if($report->user->is_admin)
                                <span class="bg-blue-100 text-blue-800 text-[10px] px-2 py-0.5 rounded-full ml-2 font-bold uppercase tracking-wider">Admin</span>
                            @endif
                            <span class="text-gray-500 text-sm ml-2">&middot; {{ $report->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <!-- Menu Aksi (Edit & Hapus) -->
                        @auth
                        <div class="flex space-x-3">
                            <!-- Tombol Edit (Hanya Pemilik) -->
                            @if(Auth::id() === $report->user_id)
                            <a href="{{ route('reports.edit', $report->id) }}" class="text-gray-400 hover:text-blue-500 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            @endif

                            <!-- Tombol Hapus (Admin ATAU Pemilik) -->
                            @if(Auth::user()->is_admin || Auth::id() === $report->user_id)
                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                        @endauth
                    </div>

                    <!-- Isi Feed -->
                    <div class="mt-1">
                        @if($report->type === 'lost')
                            <span class="inline-block bg-red-100 text-red-600 text-[11px] px-2 py-0.5 rounded font-bold mr-1 uppercase">Hilang</span>
                        @else
                            <span class="inline-block bg-green-100 text-green-600 text-[11px] px-2 py-0.5 rounded font-bold mr-1 uppercase">Ditemukan</span>
                        @endif
                        <span class="text-lg font-bold text-gray-900 inline">{{ $report->title }}</span>
                    </div>
                    
                    <p class="text-gray-800 mt-2 leading-normal">{{ $report->description }}</p>
                    
                    <div class="mt-3 flex items-center text-sm text-gray-500 bg-gray-100 inline-flex px-3 py-1 rounded-full">
                        <span class="mr-1">📍</span> {{ $report->location }}
                    </div>
                </div>
            </div>
            @endforeach
            
            @if($reports->isEmpty())
                <div class="p-10 text-center text-gray-500">
                    <span class="text-5xl block mb-4">📭</span>
                    <p class="font-medium text-lg">Belum ada laporan.</p>
                </div>
            @endif
        </div>

        <!-- KOLOM KANAN (Informasi) -->
        <div class="w-1/4 p-4 hidden lg:block">
            <div class="bg-gray-100 rounded-2xl p-5 mb-4 border border-gray-200">
                <h3 class="font-bold text-xl mb-2 text-gray-900">Panduan</h3>
                <p class="text-sm text-gray-600 leading-relaxed mb-3">
                    Mari saling membantu. Postingan Anda sangat berharga bagi mereka yang kehilangan barang.
                </p>
                <div class="flex items-center space-x-2 text-sm text-red-600 font-semibold mb-2">
                    <span>🔴</span> <span>Status Hilang</span>
                </div>
                <div class="flex items-center space-x-2 text-sm text-green-600 font-semibold">
                    <span>🟢</span> <span>Status Ditemukan</span>
                </div>
            </div>
        </div>

    </div>
</body>
</html>