<?php
/**
 * =========================================================
 * KUMPULAN FUNGSI BANTU (HELPER)
 * =========================================================
 */

require_once __DIR__ . '/../config/koneksi.php';

/**
 * Membersihkan input dari karakter berbahaya (XSS dasar)
 */
function bersihkan($data)
{
    global $koneksi;
    $data = trim($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    $data = mysqli_real_escape_string($koneksi, $data);
    return $data;
}

/**
 * Mengambil data profil utama (hanya 1 baris)
 */
function ambilProfil()
{
    global $koneksi;
    $query = "SELECT * FROM profil ORDER BY id DESC LIMIT 1";
    $hasil = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($hasil);
}

/**
 * Mengambil semua data dari sebuah tabel, diurutkan berdasarkan kolom urutan
 */
function ambilSemua($tabel, $urutBy = 'urutan ASC')
{
    global $koneksi;
    $tabel = mysqli_real_escape_string($koneksi, $tabel);
    $query = "SELECT * FROM `$tabel` ORDER BY $urutBy";
    $hasil = mysqli_query($koneksi, $query);
    $data = [];
    if ($hasil) {
        while ($baris = mysqli_fetch_assoc($hasil)) {
            $data[] = $baris;
        }
    }
    return $data;
}

/**
 * Mengambil 1 baris data berdasarkan id
 */
function ambilById($tabel, $id)
{
    global $koneksi;
    $tabel = mysqli_real_escape_string($koneksi, $tabel);
    $id = (int)$id;
    $query = "SELECT * FROM `$tabel` WHERE id = $id LIMIT 1";
    $hasil = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($hasil);
}

/**
 * Format tanggal Indonesia, misal: 13 Mei 2006
 */
function formatTanggalIndo($tanggal)
{
    if (!$tanggal) return '-';
    $bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    $waktu = strtotime($tanggal);
    $hari = date('d', $waktu);
    $bln = (int)date('n', $waktu);
    $tahun = date('Y', $waktu);
    return $hari . ' ' . $bulan[$bln] . ' ' . $tahun;
}

/**
 * Cek apakah admin sedang login
 */
function cekLogin()
{
    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}
