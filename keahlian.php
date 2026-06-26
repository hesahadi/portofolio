<?php require_once __DIR__ . '/admin_header.php'; ?>

<?php
$pesanInfo = '';
$modeEdit = false;
$dataEdit = null;

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM keahlian WHERE id = $id");
    header('Location: keahlian.php');
    exit;
}

if (isset($_GET['edit'])) {
    $modeEdit = true;
    $dataEdit = ambilById('keahlian', $_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_keahlian = bersihkan($_POST['nama_keahlian']);
    $persentase    = (int)$_POST['persentase'];
    $icon          = bersihkan($_POST['icon']);
    $urutan        = (int)$_POST['urutan'];

    if (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        $query = "UPDATE keahlian SET nama_keahlian = '$nama_keahlian', persentase = $persentase, icon = '$icon', urutan = $urutan WHERE id = $id";
    } else {
        $query = "INSERT INTO keahlian (nama_keahlian, persentase, icon, urutan) VALUES ('$nama_keahlian', $persentase, '$icon', $urutan)";
    }

    if (mysqli_query($koneksi, $query)) {
        header('Location: keahlian.php');
        exit;
    } else {
        $pesanInfo = '<div class="alert alert-gagal">Gagal menyimpan: ' . mysqli_error($koneksi) . '</div>';
    }
}

$semuaKeahlian = ambilSemua('keahlian', 'urutan ASC');
?>

<div class="admin-topbar">
    <h1>Kelola Keahlian</h1>
</div>

<?= $pesanInfo ?>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;"><?= $modeEdit ? 'Edit Keahlian' : 'Tambah Keahlian Baru' ?></h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $modeEdit ? $dataEdit['id'] : '' ?>">

        <div class="form-group">
            <label>Nama Keahlian</label>
            <input type="text" name="nama_keahlian" value="<?= $modeEdit ? htmlspecialchars($dataEdit['nama_keahlian']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label>Persentase Penguasaan (0 - 100)</label>
            <input type="number" name="persentase" min="0" max="100" value="<?= $modeEdit ? $dataEdit['persentase'] : '80' ?>" required>
        </div>

        <div class="form-group">
            <label>Ikon</label>
            <select name="icon" style="width:100%;padding:12px;border-radius:8px;border:1.5px solid #e0e0e0;">
                <?php
                $opsiIkon = ['code' => 'Kode / Website', 'cpu' => 'IoT / Hardware', 'users' => 'Tim & Komunikasi'];
                foreach ($opsiIkon as $val => $label):
                ?>
                    <option value="<?= $val ?>" <?= ($modeEdit && $dataEdit['icon'] === $val) ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="urutan" value="<?= $modeEdit ? $dataEdit['urutan'] : '0' ?>">
        </div>

        <button type="submit" class="btn-tambah"><?= $modeEdit ? 'Update Data' : 'Tambah Data' ?></button>
        <?php if ($modeEdit): ?>
            <a href="keahlian.php" class="btn-kecil btn-hapus" style="display:inline-block;margin-left:8px;">Batal</a>
        <?php endif; ?>
    </form>
</div>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;">Daftar Keahlian</h3>
    <table class="tabel-admin">
        <thead>
            <tr><th>#</th><th>Nama Keahlian</th><th>Persentase</th><th>Ikon</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php foreach ($semuaKeahlian as $i => $k): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($k['nama_keahlian']) ?></td>
                <td><?= $k['persentase'] ?>%</td>
                <td><?= htmlspecialchars($k['icon']) ?></td>
                <td>
                    <a href="?edit=<?= $k['id'] ?>" class="btn-kecil btn-edit">Edit</a>
                    <a href="?hapus=<?= $k['id'] ?>" class="btn-kecil btn-hapus">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/admin_footer.php'; ?>
