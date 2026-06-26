<?php require_once __DIR__ . '/admin_header.php'; ?>

<?php
$jmlPendidikan = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pendidikan"));
$jmlKeahlian   = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM keahlian"));
$jmlProyek     = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM proyek"));
$jmlPesanBaru  = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pesan WHERE status_dibaca = 0"));
?>

<div class="admin-topbar">
    <h1>Dashboard</h1>
    <span>Halo, <strong><?= htmlspecialchars($_SESSION['admin_nama']) ?></strong> 👋</span>
</div>

<div class="statistik-grid">
    <div class="kotak-statistik">
        <div class="angka"><?= $jmlPendidikan ?></div>
        <div class="label"><i class="fa-solid fa-graduation-cap"></i> Riwayat Pendidikan</div>
    </div>
    <div class="kotak-statistik">
        <div class="angka"><?= $jmlKeahlian ?></div>
        <div class="label"><i class="fa-solid fa-bolt"></i> Keahlian</div>
    </div>
    <div class="kotak-statistik">
        <div class="angka"><?= $jmlProyek ?></div>
        <div class="label"><i class="fa-solid fa-diagram-project"></i> Proyek Portofolio</div>
    </div>
    <div class="kotak-statistik">
        <div class="angka"><?= $jmlPesanBaru ?></div>
        <div class="label"><i class="fa-solid fa-envelope"></i> Pesan Belum Dibaca</div>
    </div>
</div>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:14px;">Selamat Datang di Admin Panel</h3>
    <p style="color:#666;">Gunakan menu di samping untuk mengelola seluruh konten website portofolio kamu — mulai dari data pribadi, riwayat pendidikan, keahlian, pengalaman, proyek, hobi, hingga pesan yang dikirim oleh pengunjung melalui form kontak.</p>
</div>

<?php require_once __DIR__ . '/admin_footer.php'; ?>
