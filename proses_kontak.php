<?php
/**
 * =========================================================
 * PROSES FORM KONTAK
 * Menyimpan pesan dari pengunjung website ke database
 * Dipanggil melalui AJAX (fetch) dari index.php
 * =========================================================
 */

header('Content-Type: application/json');
require_once __DIR__ . '/includes/fungsi.php';

$respon = ['sukses' => false, 'pesan' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama      = bersihkan($_POST['nama'] ?? '');
    $email     = bersihkan($_POST['email'] ?? '');
    $subjek    = bersihkan($_POST['subjek'] ?? '(Tanpa Subjek)');
    $isiPesan  = bersihkan($_POST['isi_pesan'] ?? '');

    if (empty($nama) || empty($email) || empty($isiPesan)) {
        $respon['pesan'] = 'Nama, email, dan pesan wajib diisi.';
        echo json_encode($respon);
        exit;
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $respon['pesan'] = 'Format email tidak valid.';
        echo json_encode($respon);
        exit;
    }

    $query = "INSERT INTO pesan (nama, email, subjek, isi_pesan) VALUES ('$nama', '$email', '$subjek', '$isiPesan')";

    if (mysqli_query($koneksi, $query)) {
        $respon['sukses'] = true;
        $respon['pesan']  = 'Terima kasih! Pesan kamu sudah berhasil terkirim.';
    } else {
        $respon['pesan'] = 'Gagal menyimpan pesan: ' . mysqli_error($koneksi);
    }
} else {
    $respon['pesan'] = 'Metode tidak diizinkan.';
}

echo json_encode($respon);
