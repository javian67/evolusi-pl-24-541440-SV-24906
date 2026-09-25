🚀 Fitur Utama

Aplikasi ini mengimplementasikan operasi CRUD (Create, Read, Update, Delete) sederhana pada satu tabel utama:
-Catat Pengeluaran Baru: Menambahkan detail pengeluaran (nama barang/jasa, nominal, tanggal).
-Lihat Daftar Pengeluaran: Menampilkan riwayat pengeluaran.
-Ubah Data: Memperbaiki kesalahan input pada catatan pengeluaran.
-Hapus Data: Menghapus catatan pengeluaran yang tidak relevan.

⚙️ CI/CD Pipeline (GitHub Actions)
Repositori ini telah dilengkapi dengan workflow CI/CD 4 Tahap yang berjalan secara sekuensial menggunakan parameter needs:
-Build: Menyiapkan environment dan menginstal dependensi (composer install).
-Test: Menjalankan unit testing (php artisan test) secara otomatis.
-Staging: Simulasi pengerahan ke server staging.
-Production: Eksekusi skrip deployment (diwakili perintah echo). Tahap ini dilindungi dengan environment protection, wajib required reviewer, dan hanya dieksekusi dari branch main.