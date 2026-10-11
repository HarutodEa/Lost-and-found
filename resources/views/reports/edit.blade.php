<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 flex items-center justify-center min-h-screen">
    
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-lg p-8">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold">Edit Laporan</h1>
            <a href="{{ route('reports.index') }}" class="text-gray-500 hover:bg-gray-100 p-2 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </a>
        </div>

        <form action="{{ route('reports.update', $report->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Wajib ditambahkan untuk proses Update -->

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status Barang</label>
                <select name="type" class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    <option value="lost" {{ $report->type == 'lost' ? 'selected' : '' }}>Saya Kehilangan</option>
                    <option value="found" {{ $report->type == 'found' ? 'selected' : '' }}>Saya Menemukan</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang</label>
                <input type="text" name="title" value="{{ $report->title }}" class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Ciri-ciri / Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 resize-none" required>{{ $report->description }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="location" value="{{ $report->location }}" class="w-full border border-gray-300 rounded-lg p-3 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('reports.index') }}" class="px-6 py-2 rounded-full font-bold text-gray-600 bg-gray-200 hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-full font-bold text-white bg-blue-500 hover:bg-blue-600 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>