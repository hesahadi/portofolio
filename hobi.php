<?php require_once __DIR__ . '/admin_header.php'; ?>

<?php
$pesanInfo = '';
$modeEdit = false;
$dataEdit = null;

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM hobi WHERE id = $id");
    header('Location: hobi.php');
    exit;
}

if (isset($_GET['edit'])) {
    $modeEdit = true;
    $dataEdit = ambilById('hobi', $_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_hobi = bersihkan($_POST['nama_hobi']);
    $icon      = bersihkan($_POST['icon']);
    $urutan    = (int)$_POST['urutan'];

    if (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        $query = "UPDATE hobi SET nama_hobi = '$nama_hobi', icon = '$icon', urutan = $urutan WHERE id = $id";
    } else {
        $query = "INSERT INTO hobi (nama_hobi, icon, urutan) VALUES ('$nama_hobi', '$icon', $urutan)";
    }

    if (mysqli_query($koneksi, $query)) {
        header('Location: hobi.php');
        exit;
    } else {
        $pesanInfo = '<div class="alert alert-gagal">Gagal menyimpan: ' . mysqli_error($koneksi) . '</div>';
    }
}

$semuaHobi = ambilSemua('hobi', 'urutan ASC');
?>

<div class="admin-topbar">
    <h1>Kelola Hobi</h1>
</div>

<?= $pesanInfo ?>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;"><?= $modeEdit ? 'Edit Hobi' : 'Tambah Hobi Baru' ?></h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $modeEdit ? $dataEdit['id'] : '' ?>">

        <div class="form-group">
            <label>Nama Hobi</label>
            <input type="text" name="nama_hobi" value="<?= $modeEdit ? htmlspecialchars($dataEdit['nama_hobi']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label>Ikon</label>
            <select name="icon" style="width:100%;padding:12px;border-radius:8px;border:1.5px solid #e0e0e0;">
                <option value="music" <?= ($modeEdit && $dataEdit['icon'] === 'music') ? 'selected' : '' ?>>Musik / Menyanyi</option>
                <option value="star" <?= ($modeEdit && $dataEdit['icon'] === 'star') ? 'selected' : '' ?>>Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="urutan" value="<?= $modeEdit ? $dataEdit['urutan'] : '0' ?>">
        </div>

        <button type="submit" class="btn-tambah"><?= $modeEdit ? 'Update Data' : 'Tambah Data' ?></button>
        <?php if ($modeEdit): ?>
            <a href="hobi.php" class="btn-kecil btn-hapus" style="display:inline-block;margin-left:8px;">Batal</a>
        <?php endif; ?>
    </form>
</div>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;">Daftar Hobi</h3>
    <table class="tabel-admin">
        <thead><tr><th>#</th><th>Nama Hobi</th><th>Ikon</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($semuaHobi as $i => $h): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($h['nama_hobi']) ?></td>
                <td><?= htmlspecialchars($h['icon']) ?></td>
                <td>
                    <a href="?edit=<?= $h['id'] ?>" class="btn-kecil btn-edit">Edit</a>
                    <a href="?hapus=<?= $h['id'] ?>" class="btn-kecil btn-hapus">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/admin_footer.php'; ?>
