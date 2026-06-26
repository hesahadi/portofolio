<?php
session_start();
require_once __DIR__ . '/../includes/fungsi.php';
cekLogin();

$halamanAktif = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Portofolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-wrapper">

    <aside class="admin-sidebar">
        <div class="brand">
            <strong><i class="fa-solid fa-user-tie"></i> ADMIN PANEL</strong>
            <p style="font-size:0.8rem;color:#8b9aa0;margin-top:4px;">Portofolio Website</p>
        </div>
        <nav>
            <a href="dashboard.php" class="<?= $halamanAktif === 'dashboard.php' ? 'aktif' : '' ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="profil.php" class="<?= $halamanAktif === 'profil.php' ? 'aktif' : '' ?>"><i class="fa-solid fa-id-card"></i> Data Pribadi</a>
            <a href="pendidikan.php" class="<?= $halamanAktif === 'pendidikan.php' ? 'aktif' : '' ?>"><i class="fa-solid fa-graduation-cap"></i> Pendidikan</a>
            <a href="keahlian.php" class="<?= $halamanAktif === 'keahlian.php' ? 'aktif' : '' ?>"><i class="fa-solid fa-bolt"></i> Keahlian</a>
            <a href="pengalaman.php" class="<?= $halamanAktif === 'pengalaman.php' ? 'aktif' : '' ?>"><i class="fa-solid fa-briefcase"></i> Pengalaman</a>
            <a href="proyek.php" class="<?= $halamanAktif === 'proyek.php' ? 'aktif' : '' ?>"><i class="fa-solid fa-diagram-project"></i> Proyek</a>
            <a href="hobi.php" class="<?= $halamanAktif === 'hobi.php' ? 'aktif' : '' ?>"><i class="fa-solid fa-heart"></i> Hobi</a>
            <a href="pesan.php" class="<?= $halamanAktif === 'pesan.php' ? 'aktif' : '' ?>"><i class="fa-solid fa-envelope"></i> Pesan Masuk</a>
            <a href="../index.php" target="_blank"><i class="fa-solid fa-globe"></i> Lihat Website</a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
