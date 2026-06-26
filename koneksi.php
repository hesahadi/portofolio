<?php
/**
 * =========================================================
 * KONEKSI DATABASE
 * =========================================================
 * Sesuaikan DB_USER, DB_PASS, dan DB_NAME dengan
 * konfigurasi MySQL/MariaDB di server / XAMPP / Laragon kamu.
 * =========================================================
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_portofolio');

// Membuat koneksi menggunakan MySQLi
$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error() .
        '<br>Pastikan database "db_portofolio" sudah dibuat dengan mengimport file database/portfolio.sql');
}

// Set charset agar mendukung karakter Indonesia dengan baik
mysqli_set_charset($koneksi, 'utf8mb4');
