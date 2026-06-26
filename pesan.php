<?php require_once __DIR__ . '/admin_header.php'; ?>

<?php
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pesan WHERE id = $id");
    header('Location: pesan.php');
    exit;
}

if (isset($_GET['baca'])) {
    $id = (int)$_GET['baca'];
    mysqli_query($koneksi, "UPDATE pesan SET status_dibaca = 1 WHERE id = $id");
    header('Location: pesan.php');
    exit;
}

$semuaPesan = ambilSemua('pesan', 'created_at DESC');
?>

<div class="admin-topbar">
    <h1>Pesan dari Pengunjung</h1>
</div>

<div class="kartu-admin">
    <table class="tabel-admin">
        <thead>
            <tr><th>#</th><th>Nama</th><th>Email</th><th>Subjek</th><th>Pesan</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php if (empty($semuaPesan)): ?>
            <tr><td colspan="8" style="text-align:center;color:#888;">Belum ada pesan masuk.</td></tr>
        <?php endif; ?>
        <?php foreach ($semuaPesan as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($p['nama']) ?></td>
                <td><?= htmlspecialchars($p['email']) ?></td>
                <td><?= htmlspecialchars($p['subjek']) ?></td>
                <td style="max-width:250px;"><?= htmlspecialchars(mb_strimwidth($p['isi_pesan'], 0, 60, '...')) ?></td>
                <td><?= date('d M Y, H:i', strtotime($p['created_at'])) ?></td>
                <td><?= $p['status_dibaca'] ? '<span class="badge badge-hijau">Dibaca</span>' : '<span class="badge badge-kuning">Baru</span>' ?></td>
                <td>
                    <?php if (!$p['status_dibaca']): ?>
                        <a href="?baca=<?= $p['id'] ?>" class="btn-kecil btn-edit">Tandai Dibaca</a>
                    <?php endif; ?>
                    <a href="?hapus=<?= $p['id'] ?>" class="btn-kecil btn-hapus">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/admin_footer.php'; ?>
