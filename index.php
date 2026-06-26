<?php
require_once __DIR__ . '/includes/header.php';

$pendidikan  = ambilSemua('pendidikan', 'tahun_mulai ASC');
$keahlian    = ambilSemua('keahlian', 'urutan ASC');
$pengalaman  = ambilSemua('pengalaman', 'urutan ASC');
$hobi        = ambilSemua('hobi', 'urutan ASC');
$proyek      = ambilSemua('proyek', 'urutan ASC');
?>

<!-- ================= HERO / BERANDA ================= -->
<section class="hero" id="beranda">
    <div class="kontainer">
        <div class="hero-foto">
            <img src="assets/img/<?= htmlspecialchars($profil['foto']) ?>" alt="Foto <?= htmlspecialchars($profil['nama_lengkap']) ?>"
                 onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($profil['nama_lengkap']) ?>&size=260&background=1c3d4f&color=d4af37'">
        </div>
        <div class="hero-teks">
            <span class="label"><?= htmlspecialchars($profil['status_pendidikan']) ?></span>
            <h1><?= htmlspecialchars($profil['nama_lengkap']) ?></h1>
            <p><?= htmlspecialchars($profil['deskripsi']) ?></p>
            <a href="#kontak" class="btn btn-aksen">Hubungi Saya</a>
            <a href="#portofolio" class="btn btn-outline">Lihat Portofolio</a>
        </div>
    </div>
</section>

<!-- ================= DATA PRIBADI / TENTANG ================= -->
<section class="section" id="tentang">
    <div class="kontainer">
        <div class="judul-section">
            <h2>Data Pribadi</h2>
            <p>Informasi singkat mengenai diri saya</p>
        </div>
        <div class="grid-2">
            <div class="kartu-info">
                <table>
                    <tr><td>Tempat, Tanggal Lahir</td><td>: <?= htmlspecialchars($profil['tempat_lahir']) ?>, <?= formatTanggalIndo($profil['tanggal_lahir']) ?></td></tr>
                    <tr><td>Alamat</td><td>: <?= htmlspecialchars($profil['alamat']) ?></td></tr>
                    <tr><td>Nomor Telepon</td><td>: <?= htmlspecialchars($profil['no_telepon']) ?></td></tr>
                    <tr><td>Jenis Kelamin</td><td>: <?= htmlspecialchars($profil['jenis_kelamin']) ?></td></tr>
                    <tr><td>Agama</td><td>: <?= htmlspecialchars($profil['agama']) ?></td></tr>
                    <tr><td>Kewarganegaraan</td><td>: <?= htmlspecialchars($profil['kewarganegaraan']) ?></td></tr>
                    <tr><td>Email</td><td>: <?= htmlspecialchars($profil['email']) ?></td></tr>
                    <tr><td>Status</td><td>: <?= htmlspecialchars($profil['status_pernikahan']) ?></td></tr>
                </table>
            </div>
            <div class="tentang-deskripsi">
                <h3>Tentang Saya</h3>
                <p><?= htmlspecialchars($profil['deskripsi']) ?></p>
                <div class="kotak-status">
                    <i class="fa-solid fa-graduation-cap"></i> <?= htmlspecialchars($profil['status_pendidikan']) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= PENDIDIKAN ================= -->
<section class="section section-abu" id="pendidikan">
    <div class="kontainer">
        <div class="judul-section">
            <h2>Pendidikan</h2>
            <p>Riwayat pendidikan yang telah dan sedang saya jalani</p>
        </div>
        <div class="timeline">
            <?php foreach ($pendidikan as $p): ?>
            <div class="timeline-item <?= $p['sedang_berjalan'] ? 'aktif' : '' ?>">
                <span class="tahun"><?= htmlspecialchars($p['keterangan']) ?></span>
                <h4><?= htmlspecialchars($p['nama_sekolah']) ?></h4>
                <p><?= htmlspecialchars($p['jenjang']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================= KEAHLIAN ================= -->
<section class="section" id="keahlian">
    <div class="kontainer">
        <div class="judul-section">
            <h2>Keahlian</h2>
            <p>Kemampuan yang saya kuasai dan terus saya kembangkan</p>
        </div>
        <div class="grid-skill">
            <?php
            $iconMap = ['code' => 'fa-code', 'cpu' => 'fa-microchip', 'users' => 'fa-people-group'];
            foreach ($keahlian as $k):
                $ic = $iconMap[$k['icon']] ?? 'fa-star';
            ?>
            <div class="kartu-skill">
                <div class="ikon"><i class="fa-solid <?= $ic ?>"></i></div>
                <h4><?= htmlspecialchars($k['nama_keahlian']) ?></h4>
                <div class="progress-bar">
                    <div class="progress-isi" data-width="<?= (int)$k['persentase'] ?>"></div>
                </div>
                <div class="persen"><?= (int)$k['persentase'] ?>%</div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================= PENGALAMAN ================= -->
<section class="section section-abu" id="pengalaman">
    <div class="kontainer">
        <div class="judul-section">
            <h2>Pengalaman</h2>
            <p>Pengalaman yang saya peroleh selama PKL dan kegiatan lainnya</p>
        </div>
        <div class="grid-pengalaman">
            <?php foreach ($pengalaman as $pg): ?>
            <div class="kartu-pengalaman">
                <span class="kategori"><?= htmlspecialchars($pg['kategori']) ?></span>
                <h4><?= htmlspecialchars($pg['judul']) ?></h4>
                <p><?= htmlspecialchars($pg['deskripsi']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================= PORTOFOLIO / PROYEK ================= -->
<section class="section" id="portofolio">
    <div class="kontainer">
        <div class="judul-section">
            <h2>Portofolio</h2>
            <p>Beberapa proyek yang pernah saya kerjakan</p>
        </div>
        <div class="grid-proyek">
            <?php foreach ($proyek as $pr): ?>
            <div class="kartu-proyek">
                <div class="gambar-proyek">
                    <img src="assets/img/<?= htmlspecialchars($pr['gambar']) ?>" alt="<?= htmlspecialchars($pr['judul_proyek']) ?>"
                         onerror="this.src='https://placehold.co/500x300/1c3d4f/d4af37?text=Proyek'">
                </div>
                <div class="isi-proyek">
                    <h4><?= htmlspecialchars($pr['judul_proyek']) ?></h4>
                    <p><?= htmlspecialchars($pr['deskripsi']) ?></p>
                    <div>
                        <?php foreach (explode(',', $pr['teknologi']) as $tech): ?>
                            <span class="tag-tech"><?= htmlspecialchars(trim($tech)) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($pr['link_demo'] || $pr['link_github']): ?>
                    <div class="link-proyek">
                        <?php if ($pr['link_demo']): ?><a href="<?= htmlspecialchars($pr['link_demo']) ?>" target="_blank"><i class="fa-solid fa-up-right-from-square"></i> Demo</a><?php endif; ?>
                        <?php if ($pr['link_github']): ?><a href="<?= htmlspecialchars($pr['link_github']) ?>" target="_blank"><i class="fa-brands fa-github"></i> Github</a><?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================= HOBI ================= -->
<section class="section section-abu" id="hobi">
    <div class="kontainer">
        <div class="judul-section">
            <h2>Hobi</h2>
            <p>Hal-hal yang saya sukai di waktu luang</p>
        </div>
        <div class="grid-hobi">
            <?php
            $iconHobi = ['music' => 'fa-music', 'star' => 'fa-star'];
            foreach ($hobi as $h):
                $ic = $iconHobi[$h['icon']] ?? 'fa-star';
            ?>
            <div class="kartu-hobi">
                <div class="ikon"><i class="fa-solid <?= $ic ?>"></i></div>
                <h4><?= htmlspecialchars($h['nama_hobi']) ?></h4>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================= KONTAK ================= -->
<section class="section" id="kontak">
    <div class="kontainer">
        <div class="judul-section">
            <h2>Kontak</h2>
            <p>Jangan ragu untuk menghubungi saya</p>
        </div>
        <div class="grid-kontak">
            <div class="info-kontak">
                <div class="info-kontak-item">
                    <div class="ikon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <h4>Telepon</h4>
                        <p><?= htmlspecialchars($profil['no_telepon']) ?></p>
                    </div>
                </div>
                <div class="info-kontak-item">
                    <div class="ikon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <h4>Alamat</h4>
                        <p><?= htmlspecialchars($profil['alamat']) ?></p>
                    </div>
                </div>
                <div class="info-kontak-item">
                    <div class="ikon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <h4>Email</h4>
                        <p><?= htmlspecialchars($profil['email']) ?></p>
                    </div>
                </div>
            </div>

            <div class="form-kontak">
                <div id="pesanStatus"></div>
                <form id="formKontak">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Subjek</label>
                        <input type="text" name="subjek">
                    </div>
                    <div class="form-group">
                        <label>Pesan</label>
                        <textarea name="isi_pesan" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-aksen" style="width:100%;">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('formKontak').addEventListener('submit', function (e) {
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    const statusBox = document.getElementById('pesanStatus');

    fetch('proses_kontak.php', { method: 'POST', body: data })
        .then(res => res.json())
        .then(res => {
            statusBox.innerHTML = `<div class="alert ${res.sukses ? 'alert-sukses' : 'alert-gagal'}">${res.pesan}</div>`;
            if (res.sukses) form.reset();
        })
        .catch(() => {
            statusBox.innerHTML = `<div class="alert alert-gagal">Terjadi kesalahan. Coba lagi nanti.</div>`;
        });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
