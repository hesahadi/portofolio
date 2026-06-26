# Website Portofolio — PHP Native + MySQL

Website portofolio pribadi untuk **Maheswara Puwa Hadi Gautama**, dibangun dengan PHP native (tanpa framework) dan database MySQL/MariaDB. Sudah termasuk halaman admin untuk mengelola seluruh konten tanpa harus mengedit kode.

## ✅ Sudah Diuji
Seluruh halaman (website utama, login admin, dashboard, dan semua menu CRUD) telah dites langsung menggunakan PHP 8.3 + MariaDB dan berjalan tanpa error.

## Fitur

- **Tampilan publik** — Beranda, Data Pribadi, Pendidikan (timeline), Keahlian (progress bar), Pengalaman, Portofolio/Proyek, Hobi, dan Form Kontak (tersimpan ke database)
- **Panel admin** — Login aman (password di-hash dengan bcrypt), Dashboard statistik, dan CRUD (Tambah/Edit/Hapus) untuk:
  - Data Pribadi (termasuk upload foto)
  - Pendidikan
  - Keahlian
  - Pengalaman
  - Proyek/Portofolio (termasuk upload gambar)
  - Hobi
  - Pesan masuk dari pengunjung
- Desain responsif (mobile & desktop), tema warna gelap sesuai CV asli (navy + emas)

## Struktur Folder

```
portfolio/
├── admin/                  → Seluruh halaman panel admin
│   ├── login.php           → Login admin
│   ├── logout.php
│   ├── dashboard.php
│   ├── profil.php          → Edit data pribadi
│   ├── pendidikan.php      → CRUD pendidikan
│   ├── keahlian.php        → CRUD keahlian
│   ├── pengalaman.php      → CRUD pengalaman
│   ├── proyek.php          → CRUD proyek/portofolio
│   ├── hobi.php            → CRUD hobi
│   ├── pesan.php           → Lihat pesan pengunjung
│   ├── admin_header.php
│   └── admin_footer.php
├── assets/
│   ├── css/style.css
│   ├── js/main.js
│   └── img/                → Foto profil & gambar proyek
├── config/
│   └── koneksi.php         → ⚠️ Setting koneksi database
├── database/
│   └── portfolio.sql       → File untuk import database
├── includes/
│   ├── fungsi.php          → Fungsi-fungsi bantu (helper)
│   ├── header.php
│   └── footer.php
├── index.php               → Halaman utama website
└── proses_kontak.php       → Proses simpan pesan form kontak (AJAX)
```

## Cara Instalasi (Local — XAMPP / Laragon)

1. **Salin folder** `portfolio` ke dalam folder `htdocs` (XAMPP) atau `www` (Laragon).

2. **Buat database**:
   - Buka phpMyAdmin → klik "Import" → pilih file `database/portfolio.sql` → klik "Go".
   - Atau lewat terminal:
     ```
     mysql -u root -p < database/portfolio.sql
     ```
   - Ini otomatis membuat database `db_portofolio` beserta seluruh tabel dan data awal sesuai CV.

3. **Atur koneksi database** di `config/koneksi.php` (sesuaikan jika user/password MySQL kamu berbeda):
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'db_portofolio');
   ```

4. **Jalankan**, buka browser:
   - Website utama → `http://localhost/portfolio/index.php`
   - Panel admin → `http://localhost/portfolio/admin/login.php`

## Login Admin Default

```
Username : admin
Password : admin123
```

⚠️ **Penting:** Segera ganti password setelah login pertama kali (lewat database, karena fitur ganti password belum disediakan — bisa ditambahkan jika dibutuhkan).

## Catatan Teknis

- Menggunakan **MySQLi** (bukan PDO) untuk koneksi database, query disusun manual (PHP native, tanpa ORM).
- Password admin disimpan dalam bentuk **hash bcrypt** (`password_hash()` / `password_verify()`), tidak disimpan sebagai teks biasa.
- Form kontak diproses lewat **AJAX (fetch)** sehingga pesan terkirim tanpa reload halaman.
- Upload foto profil & gambar proyek otomatis tersimpan ke folder `assets/img/`.
- Seluruh input dibersihkan dengan fungsi `bersihkan()` di `includes/fungsi.php` untuk mengurangi risiko SQL Injection/XSS dasar.

## Mengganti Foto Profil

Foto profil default sudah disiapkan (`assets/img/default.jpg`, diambil dari foto CV). Untuk mengganti:
- Login ke admin → menu **Data Pribadi** → upload foto baru.

## Pengembangan Lanjutan (Opsional)

Jika ingin dikembangkan lebih jauh, beberapa ide tambahan:
- Fitur ganti password admin dari panel
- Multi-bahasa (Indonesia/Inggris)
- Statistik pengunjung website
- Export data pesan ke Excel/PDF
