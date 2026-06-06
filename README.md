# Website Hidroponik Cerdas

Website informatif tentang pertanian hidroponik dengan panel admin untuk mengelola berita/kegiatan.

## Fitur
- Landing page modern dengan statistik keunggulan hidroponik.
- Halaman daftar berita dengan paginasi.
- Halaman detail berita.
- Admin panel (login) untuk CRUD berita.
- Keamanan: PDO prepared statements, upload file validasi, hashing password.

## Instalasi
1. Buat database `hidroponik_db` dan jalankan skema SQL (lihat dokumentasi).
2. Sesuaikan kredensial di `includes/config.php`.
3. Letakkan file di server web (misal XAMPP/htdocs/hidroponik).
4. Akses `http://localhost/hidroponik`.
5. Admin: `http://localhost/hidroponik/admin` (username: admin, password: password).

## Kredensial Default
- Username: `admin`
- Password: `password` (segera ganti setelah login)

## Struktur File
- `assets/` : CSS, JS, gambar.
- `includes/` : Konfigurasi, koneksi DB, fungsi.
- `admin/` : Halaman admin.
- `index.php`, `berita.php`, `detail.php` : Halaman publik.

## Keamanan
- Prepared statements untuk semua query.
- Escape output dengan `htmlspecialchars()`.
- Upload gambar hanya menerima JPEG/PNG, rename unik.
- Proteksi session admin.

## Rekomendasi Server
- Gunakan HTTPS.
- Pasang Cloudflare untuk mitigasi DDoS.
- Batasi ukuran upload dan request di server.