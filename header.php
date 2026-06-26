<?php
require_once __DIR__ . '/../includes/fungsi.php';
$profil = ambilProfil();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - <?= htmlspecialchars($profil['nama_lengkap'] ?? 'Portofolio') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="kontainer">
        <a href="#beranda" class="logo">M.PUWA</a>
        <ul class="menu" id="menuNav">
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#pendidikan">Pendidikan</a></li>
            <li><a href="#keahlian">Keahlian</a></li>
            <li><a href="#pengalaman">Pengalaman</a></li>
            <li><a href="#portofolio">Portofolio</a></li>
            <li><a href="#kontak">Kontak</a></li>
        </ul>
        <button class="toggle" id="toggleNav"><i class="fa-solid fa-bars"></i></button>
    </div>
</nav>
