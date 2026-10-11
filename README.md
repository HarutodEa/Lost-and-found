# 🔍 Lost & Found Platform

CariBarang adalah sebuah platform web untuk melaporkan kehilangan dan penemuan barang. Proyek ini dibangun menggunakan **Laravel** dan **Tailwind CSS** dengan antarmuka (UI) bergaya *feed* ala media sosial (Twitter/X) yang modern, bersih, dan responsif.

## ✨ Fitur Utama
- **Akses Publik (Guest):** Pengunjung dapat melihat daftar *feed* barang hilang dan ditemukan tanpa harus login.
- **Autentikasi Pengguna:** Sistem login dan registrasi modern menggunakan Laravel Breeze.
- **Manajemen Laporan (CRUD):** 
  - Pengguna terdaftar dapat memposting laporan (Kehilangan/Menemukan).
  - Pengguna dapat mengedit dan menghapus postingan milik mereka sendiri.
- **Sistem Role (Admin & User):**
  - **Admin:** Memiliki kontrol penuh untuk memantau dan menghapus laporan milik siapa saja yang dianggap melanggar atau tidak valid.
  - **User:** Hanya dapat mengelola (edit/hapus) laporannya sendiri.
- **UI/UX Modern:** Desain antarmuka 3 kolom (Navigasi, Feed Utama, Panduan) dengan *split-screen* pada halaman autentikasi.

## 🛠️ Teknologi yang Digunakan
- **Framework:** Laravel (v10/11)
- **Authentication:** Laravel Breeze (Blade)
- **Styling:** Tailwind CSS
- **Database:** MySQL

## 🚀 Langkah Pengerjaan (How it was built)
Proyek ini dibangun dengan urutan langkah berikut:
1. **Inisialisasi Proyek & Auth:** Menginstal Laravel dan Laravel Breeze untuk sistem registrasi, login, dan manajemen profil dasar.
2. **Setup Database:** Memodifikasi *migration* tabel `users` dengan menambahkan kolom `is_admin`, serta membuat *migration* tabel `reports`.
3. **Pembuatan Model & Relasi:** Mengatur relasi *One-to-Many* antara model `User` dan `Report`.
4. **Logika Bisnis (Controller):** Membuat `ReportController` untuk mengatur logika CRUD dan pembatasan akses hak milik serta hak Admin.
5. **Kustomisasi UI (Tailwind):** Merombak total tampilan bawaan Breeze (Login, Register, Profile) dan membuat halaman utama (Feed) menjadi desain ala Twitter/X.
6. **Data Dummy (Seeder):** Membuat akun Admin, akun User, dan data laporan *dummy* menggunakan *Database Seeder*.

## 💻 Cara Instalasi & Menjalankan Proyek secara Lokal

Jika Anda ingin mencoba menjalankan proyek ini di komputer Anda, ikuti langkah-langkah berikut:

1. **Clone repositori ini**
   ```bash
   git clone [https://github.com/HarutodEa/lost-and-found.git](https://github.com/HarutodEa/lost-and-found.git)
   cd lost-and-found
