<?php require_once __DIR__ . '/admin_header.php'; ?>

<?php
$pesanInfo = '';
$modeEdit = false;
$dataEdit = null;

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pengalaman WHERE id = $id");
    header('Location: pengalaman.php');
    exit;
}

if (isset($_GET['edit'])) {
    $modeEdit = true;
    $dataEdit = ambilById('pengalaman', $_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = bersihkan($_POST['judul']);
    $deskripsi = bersihkan($_POST['deskripsi']);
    $kategori  = bersihkan($_POST['kategori']);
    $urutan    = (int)$_POST['urutan'];

    if (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        $query = "UPDATE pengalaman SET judul = '$judul', deskripsi = '$deskripsi', kategori = '$kategori', urutan = $urutan WHERE id = $id";
    } else {
        $query = "INSERT INTO pengalaman (judul, deskripsi, kategori, urutan) VALUES ('$judul', '$deskripsi', '$kategori', $urutan)";
    }

    if (mysqli_query($koneksi, $query)) {
        header('Location: pengalaman.php');
        exit;
    } else {
        $pesanInfo = '<div class="alert alert-gagal">Gagal menyimpan: ' . mysqli_error($koneksi) . '</div>';
    }
}

$semuaPengalaman = ambilSemua('pengalaman', 'urutan ASC');
?>

<div class="admin-topbar">
    <h1>Kelola Pengalaman</h1>
</div>

<?= $pesanInfo ?>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;"><?= $modeEdit ? 'Edit Pengalaman' : 'Tambah Pengalaman Baru' ?></h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $modeEdit ? $dataEdit['id'] : '' ?>">

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" value="<?= $modeEdit ? htmlspecialchars($dataEdit['judul']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label>Kategori (contoh: Pengalaman / Hasil PKL)</label>
            <input type="text" name="kategori" value="<?= $modeEdit ? htmlspecialchars($dataEdit['kategori']) : '' ?>">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" style="min-height:120px;"><?= $modeEdit ? htmlspecialchars($dataEdit['deskripsi']) : '' ?></textarea>
        </div>

        <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="urutan" value="<?= $modeEdit ? $dataEdit['urutan'] : '0' ?>">
        </div>

        <button type="submit" class="btn-tambah"><?= $modeEdit ? 'Update Data' : 'Tambah Data' ?></button>
        <?php if ($modeEdit): ?>
            <a href="pengalaman.php" class="btn-kecil btn-hapus" style="display:inline-block;margin-left:8px;">Batal</a>
        <?php endif; ?>
    </form>
</div>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;">Daftar Pengalaman</h3>
    <table class="tabel-admin">
        <thead><tr><th>#</th><th>Judul</th><th>Kategori</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($semuaPengalaman as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($p['judul']) ?></td>
                <td><span class="badge badge-kuning"><?= htmlspecialchars($p['kategori']) ?></span></td>
                <td>
                    <a href="?edit=<?= $p['id'] ?>" class="btn-kecil btn-edit">Edit</a>
                    <a href="?hapus=<?= $p['id'] ?>" class="btn-kecil btn-hapus">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/admin_footer.php'; ?>
