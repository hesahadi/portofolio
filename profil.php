<?php require_once __DIR__ . '/admin_header.php'; ?>

<?php
$pesanInfo = '';
$profil = ambilProfil();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap      = bersihkan($_POST['nama_lengkap']);
    $status_pendidikan = bersihkan($_POST['status_pendidikan']);
    $tempat_lahir      = bersihkan($_POST['tempat_lahir']);
    $tanggal_lahir     = bersihkan($_POST['tanggal_lahir']);
    $alamat            = bersihkan($_POST['alamat']);
    $no_telepon        = bersihkan($_POST['no_telepon']);
    $jenis_kelamin     = bersihkan($_POST['jenis_kelamin']);
    $agama             = bersihkan($_POST['agama']);
    $kewarganegaraan   = bersihkan($_POST['kewarganegaraan']);
    $email             = bersihkan($_POST['email']);
    $status_pernikahan = bersihkan($_POST['status_pernikahan']);
    $deskripsi         = bersihkan($_POST['deskripsi']);

    $namaFoto = $profil['foto'];

    // Proses upload foto jika ada file baru
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ekstensiIzin = ['jpg', 'jpeg', 'png', 'webp'];
        $ekstensi = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ekstensi, $ekstensiIzin)) {
            $namaFoto = 'profil_' . time() . '.' . $ekstensi;
            move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__ . '/../assets/img/' . $namaFoto);
        }
    }

    $query = "UPDATE profil SET
        nama_lengkap = '$nama_lengkap',
        status_pendidikan = '$status_pendidikan',
        tempat_lahir = '$tempat_lahir',
        tanggal_lahir = '$tanggal_lahir',
        alamat = '$alamat',
        no_telepon = '$no_telepon',
        jenis_kelamin = '$jenis_kelamin',
        agama = '$agama',
        kewarganegaraan = '$kewarganegaraan',
        email = '$email',
        status_pernikahan = '$status_pernikahan',
        deskripsi = '$deskripsi',
        foto = '$namaFoto'
        WHERE id = " . (int)$profil['id'];

    if (mysqli_query($koneksi, $query)) {
        $pesanInfo = '<div class="alert alert-sukses">Data pribadi berhasil diperbarui!</div>';
        $profil = ambilProfil();
    } else {
        $pesanInfo = '<div class="alert alert-gagal">Gagal memperbarui data: ' . mysqli_error($koneksi) . '</div>';
    }
}
?>

<div class="admin-topbar">
    <h1>Data Pribadi</h1>
</div>

<?= $pesanInfo ?>

<div class="kartu-admin">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Foto Profil</label>
            <input type="file" name="foto" accept="image/*">
            <p style="font-size:0.8rem;color:#888;margin-top:5px;">Foto saat ini: <?= htmlspecialchars($profil['foto']) ?></p>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($profil['nama_lengkap']) ?>" required>
        </div>

        <div class="form-group">
            <label>Status Pendidikan (contoh: Lulusan Baru)</label>
            <input type="text" name="status_pendidikan" value="<?= htmlspecialchars($profil['status_pendidikan']) ?>">
        </div>

        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($profil['tempat_lahir']) ?>">
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($profil['tanggal_lahir']) ?>">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat"><?= htmlspecialchars($profil['alamat']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" name="no_telepon" value="<?= htmlspecialchars($profil['no_telepon']) ?>">
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" style="width:100%;padding:12px;border-radius:8px;border:1.5px solid #e0e0e0;">
                <option value="Laki-laki" <?= $profil['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $profil['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>Agama</label>
            <input type="text" name="agama" value="<?= htmlspecialchars($profil['agama']) ?>">
        </div>

        <div class="form-group">
            <label>Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" value="<?= htmlspecialchars($profil['kewarganegaraan']) ?>">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($profil['email']) ?>">
        </div>

        <div class="form-group">
            <label>Status Pernikahan</label>
            <input type="text" name="status_pernikahan" value="<?= htmlspecialchars($profil['status_pernikahan']) ?>">
        </div>

        <div class="form-group">
            <label>Deskripsi / Tentang Saya</label>
            <textarea name="deskripsi" style="min-height:150px;"><?= htmlspecialchars($profil['deskripsi']) ?></textarea>
        </div>

        <button type="submit" class="btn-tambah">Simpan Perubahan</button>
    </form>
</div>

<?php require_once __DIR__ . '/admin_footer.php'; ?>
