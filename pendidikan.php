<?php require_once __DIR__ . '/admin_header.php'; ?>

<?php
$pesanInfo = '';
$modeEdit = false;
$dataEdit = null;

// ===== HAPUS DATA =====
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pendidikan WHERE id = $id");
    header('Location: pendidikan.php');
    exit;
}

// ===== AMBIL DATA UNTUK EDIT =====
if (isset($_GET['edit'])) {
    $modeEdit = true;
    $dataEdit = ambilById('pendidikan', $_GET['edit']);
}

// ===== SIMPAN (TAMBAH / UPDATE) =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_sekolah    = bersihkan($_POST['nama_sekolah']);
    $jenjang         = bersihkan($_POST['jenjang']);
    $tahun_mulai     = (int)$_POST['tahun_mulai'];
    $tahun_selesai   = !empty($_POST['tahun_selesai']) ? (int)$_POST['tahun_selesai'] : 'NULL';
    $sedang_berjalan = isset($_POST['sedang_berjalan']) ? 1 : 0;
    $keterangan      = bersihkan($_POST['keterangan']);
    $urutan          = (int)$_POST['urutan'];

    if (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        $query = "UPDATE pendidikan SET
            nama_sekolah = '$nama_sekolah', jenjang = '$jenjang',
            tahun_mulai = '$tahun_mulai', tahun_selesai = $tahun_selesai,
            sedang_berjalan = $sedang_berjalan, keterangan = '$keterangan', urutan = $urutan
            WHERE id = $id";
        $aksi = 'diperbarui';
    } else {
        $query = "INSERT INTO pendidikan (nama_sekolah, jenjang, tahun_mulai, tahun_selesai, sedang_berjalan, keterangan, urutan)
            VALUES ('$nama_sekolah', '$jenjang', '$tahun_mulai', $tahun_selesai, $sedang_berjalan, '$keterangan', $urutan)";
        $aksi = 'ditambahkan';
    }

    if (mysqli_query($koneksi, $query)) {
        header('Location: pendidikan.php');
        exit;
    } else {
        $pesanInfo = '<div class="alert alert-gagal">Gagal menyimpan: ' . mysqli_error($koneksi) . '</div>';
    }
}

$semuaPendidikan = ambilSemua('pendidikan', 'tahun_mulai ASC');
?>

<div class="admin-topbar">
    <h1>Kelola Pendidikan</h1>
</div>

<?= $pesanInfo ?>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;"><?= $modeEdit ? 'Edit Data Pendidikan' : 'Tambah Pendidikan Baru' ?></h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $modeEdit ? $dataEdit['id'] : '' ?>">

        <div class="form-group">
            <label>Nama Sekolah / Universitas</label>
            <input type="text" name="nama_sekolah" value="<?= $modeEdit ? htmlspecialchars($dataEdit['nama_sekolah']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label>Jenjang (contoh: SD, SMP, SMK, S1 - Jurusan)</label>
            <input type="text" name="jenjang" value="<?= $modeEdit ? htmlspecialchars($dataEdit['jenjang']) : '' ?>">
        </div>

        <div class="form-group">
            <label>Tahun Mulai</label>
            <input type="number" name="tahun_mulai" value="<?= $modeEdit ? $dataEdit['tahun_mulai'] : '' ?>" required>
        </div>

        <div class="form-group">
            <label>Tahun Selesai (kosongkan jika masih berjalan)</label>
            <input type="number" name="tahun_selesai" value="<?= $modeEdit ? $dataEdit['tahun_selesai'] : '' ?>">
        </div>

        <div class="form-group">
            <label><input type="checkbox" name="sedang_berjalan" <?= ($modeEdit && $dataEdit['sedang_berjalan']) ? 'checked' : '' ?>> Sedang berjalan saat ini</label>
        </div>

        <div class="form-group">
            <label>Keterangan (contoh: 2012 - 2019 / Masih Semester 1)</label>
            <input type="text" name="keterangan" value="<?= $modeEdit ? htmlspecialchars($dataEdit['keterangan']) : '' ?>">
        </div>

        <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="urutan" value="<?= $modeEdit ? $dataEdit['urutan'] : '0' ?>">
        </div>

        <button type="submit" class="btn-tambah"><?= $modeEdit ? 'Update Data' : 'Tambah Data' ?></button>
        <?php if ($modeEdit): ?>
            <a href="pendidikan.php" class="btn-kecil btn-hapus" style="display:inline-block;margin-left:8px;">Batal</a>
        <?php endif; ?>
    </form>
</div>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;">Daftar Pendidikan</h3>
    <table class="tabel-admin">
        <thead>
            <tr>
                <th>#</th><th>Nama Sekolah</th><th>Jenjang</th><th>Keterangan</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($semuaPendidikan as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($p['nama_sekolah']) ?></td>
                <td><?= htmlspecialchars($p['jenjang']) ?></td>
                <td><?= htmlspecialchars($p['keterangan']) ?></td>
                <td><?= $p['sedang_berjalan'] ? '<span class="badge badge-kuning">Berjalan</span>' : '<span class="badge badge-hijau">Selesai</span>' ?></td>
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
