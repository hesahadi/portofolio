<?php require_once __DIR__ . '/admin_header.php'; ?>

<?php
$pesanInfo = '';
$modeEdit = false;
$dataEdit = null;

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM proyek WHERE id = $id");
    header('Location: proyek.php');
    exit;
}

if (isset($_GET['edit'])) {
    $modeEdit = true;
    $dataEdit = ambilById('proyek', $_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul_proyek = bersihkan($_POST['judul_proyek']);
    $deskripsi    = bersihkan($_POST['deskripsi']);
    $teknologi    = bersihkan($_POST['teknologi']);
    $link_demo    = bersihkan($_POST['link_demo']);
    $link_github  = bersihkan($_POST['link_github']);
    $urutan       = (int)$_POST['urutan'];

    $namaGambar = $modeEdit ? $dataEdit['gambar'] : 'default-project.jpg';
    if (!empty($_POST['id'])) {
        $existing = ambilById('proyek', $_POST['id']);
        $namaGambar = $existing['gambar'];
    }

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $ekstensiIzin = ['jpg', 'jpeg', 'png', 'webp'];
        $ekstensi = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        if (in_array($ekstensi, $ekstensiIzin)) {
            $namaGambar = 'proyek_' . time() . '.' . $ekstensi;
            move_uploaded_file($_FILES['gambar']['tmp_name'], __DIR__ . '/../assets/img/' . $namaGambar);
        }
    }

    if (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        $query = "UPDATE proyek SET
            judul_proyek = '$judul_proyek', deskripsi = '$deskripsi', teknologi = '$teknologi',
            gambar = '$namaGambar', link_demo = '$link_demo', link_github = '$link_github', urutan = $urutan
            WHERE id = $id";
    } else {
        $query = "INSERT INTO proyek (judul_proyek, deskripsi, teknologi, gambar, link_demo, link_github, urutan)
            VALUES ('$judul_proyek', '$deskripsi', '$teknologi', '$namaGambar', '$link_demo', '$link_github', $urutan)";
    }

    if (mysqli_query($koneksi, $query)) {
        header('Location: proyek.php');
        exit;
    } else {
        $pesanInfo = '<div class="alert alert-gagal">Gagal menyimpan: ' . mysqli_error($koneksi) . '</div>';
    }
}

$semuaProyek = ambilSemua('proyek', 'urutan ASC');
?>

<div class="admin-topbar">
    <h1>Kelola Proyek / Portofolio</h1>
</div>

<?= $pesanInfo ?>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;"><?= $modeEdit ? 'Edit Proyek' : 'Tambah Proyek Baru' ?></h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $modeEdit ? $dataEdit['id'] : '' ?>">

        <div class="form-group">
            <label>Judul Proyek</label>
            <input type="text" name="judul_proyek" value="<?= $modeEdit ? htmlspecialchars($dataEdit['judul_proyek']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" style="min-height:100px;"><?= $modeEdit ? htmlspecialchars($dataEdit['deskripsi']) : '' ?></textarea>
        </div>

        <div class="form-group">
            <label>Teknologi yang digunakan (pisahkan dengan koma)</label>
            <input type="text" name="teknologi" value="<?= $modeEdit ? htmlspecialchars($dataEdit['teknologi']) : '' ?>" placeholder="PHP, MySQL, HTML, CSS">
        </div>

        <div class="form-group">
            <label>Gambar Proyek</label>
            <input type="file" name="gambar" accept="image/*">
            <?php if ($modeEdit): ?><p style="font-size:0.8rem;color:#888;margin-top:5px;">Gambar saat ini: <?= htmlspecialchars($dataEdit['gambar']) ?></p><?php endif; ?>
        </div>

        <div class="form-group">
            <label>Link Demo (opsional)</label>
            <input type="text" name="link_demo" value="<?= $modeEdit ? htmlspecialchars($dataEdit['link_demo']) : '' ?>">
        </div>

        <div class="form-group">
            <label>Link Github (opsional)</label>
            <input type="text" name="link_github" value="<?= $modeEdit ? htmlspecialchars($dataEdit['link_github']) : '' ?>">
        </div>

        <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" name="urutan" value="<?= $modeEdit ? $dataEdit['urutan'] : '0' ?>">
        </div>

        <button type="submit" class="btn-tambah"><?= $modeEdit ? 'Update Data' : 'Tambah Data' ?></button>
        <?php if ($modeEdit): ?>
            <a href="proyek.php" class="btn-kecil btn-hapus" style="display:inline-block;margin-left:8px;">Batal</a>
        <?php endif; ?>
    </form>
</div>

<div class="kartu-admin">
    <h3 style="color:var(--warna-utama);margin-bottom:18px;">Daftar Proyek</h3>
    <table class="tabel-admin">
        <thead><tr><th>#</th><th>Judul</th><th>Teknologi</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($semuaProyek as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($p['judul_proyek']) ?></td>
                <td><?= htmlspecialchars($p['teknologi']) ?></td>
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
