<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        // Catatan: Laravel Breeze menggunakan Email untuk login, bukan Username
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com', 
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        // 2. Buat Akun User Biasa
        $user = User::create([
            'name' => 'User Biasa',
            'email' => 'user@user.com',
            'password' => Hash::make('user123'),
            'is_admin' => false,
        ]);

        // 3. Data Dummy: Barang Kehilangan (Belum Ditemukan)
        Report::create([
            'user_id' => $user->id,
            'type' => 'lost',
            'title' => 'Dompet Kulit Coklat',
            'description' => 'Hilang dompet kulit lipat warna coklat. Di dalamnya terdapat KTP, KTM, dan sedikit uang tunai. Terakhir terlihat saat makan siang.',
            'location' => 'Kantin Utama',
            'created_at' => now()->subDays(2), // Tanggal dibuat mundur 2 hari
        ]);

        Report::create([
            'user_id' => $admin->id,
            'type' => 'lost',
            'title' => 'Kunci Motor Honda',
            'description' => 'Kunci motor dengan gantungan boneka beruang kecil. Jatuh di sekitar area parkiran pagi ini.',
            'location' => 'Parkiran Gedung B',
            'created_at' => now()->subHours(5), // Tanggal dibuat mundur 5 jam
        ]);

        // 4. Data Dummy: Barang Ditemukan (Sudah Ditemukan)
        Report::create([
            'user_id' => $user->id,
            'type' => 'found',
            'title' => 'Flashdisk SanDisk 32GB',
            'description' => 'Ditemukan flashdisk warna hitam-merah tergeletak di meja pojok. Bagi yang merasa kehilangan bisa membalas pos ini.',
            'location' => 'Perpustakaan Lantai 2',
            'created_at' => now()->subDay(),
        ]);

        Report::create([
            'user_id' => $admin->id,
            'type' => 'found',
            'title' => 'Jam Tangan Hitam',
            'description' => 'Ditemukan jam tangan pria tertinggal di wastafel. Saat ini barang saya titipkan di pos satpam depan.',
            'location' => 'Toilet Lantai 1',
            'created_at' => now()->subMinutes(30),
        ]);
    }
}