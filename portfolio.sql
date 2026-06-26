-- =========================================================
-- DATABASE PORTOFOLIO - Maheswara Puwa Hadi Gautama
-- =========================================================

CREATE DATABASE IF NOT EXISTS db_portofolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_portofolio;

-- =========================================================
-- TABEL: profil
-- Data pribadi utama yang ditampilkan di header/sidebar
-- =========================================================
CREATE TABLE profil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    status_pendidikan VARCHAR(100) DEFAULT 'Lulusan Baru',
    tempat_lahir VARCHAR(100),
    tanggal_lahir DATE,
    alamat TEXT,
    no_telepon VARCHAR(20),
    jenis_kelamin VARCHAR(20),
    agama VARCHAR(50),
    kewarganegaraan VARCHAR(50),
    email VARCHAR(100),
    status_pernikahan VARCHAR(50),
    deskripsi TEXT,
    foto VARCHAR(255) DEFAULT 'default.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =========================================================
-- TABEL: pendidikan
-- Riwayat pendidikan
-- =========================================================
CREATE TABLE pendidikan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_sekolah VARCHAR(150) NOT NULL,
    jenjang VARCHAR(50),
    tahun_mulai YEAR,
    tahun_selesai YEAR NULL,
    sedang_berjalan TINYINT(1) DEFAULT 0,
    keterangan VARCHAR(150),
    urutan INT DEFAULT 0
);

-- =========================================================
-- TABEL: keahlian
-- Skill / kemampuan
-- =========================================================
CREATE TABLE keahlian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_keahlian VARCHAR(100) NOT NULL,
    persentase INT DEFAULT 80,
    icon VARCHAR(50) DEFAULT 'code',
    urutan INT DEFAULT 0
);

-- =========================================================
-- TABEL: pengalaman
-- Pengalaman organisasi / kerja / PKL
-- =========================================================
CREATE TABLE pengalaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT,
    kategori VARCHAR(50) DEFAULT 'Pengalaman',
    urutan INT DEFAULT 0
);

-- =========================================================
-- TABEL: hobi
-- =========================================================
CREATE TABLE hobi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_hobi VARCHAR(100) NOT NULL,
    icon VARCHAR(50) DEFAULT 'star',
    urutan INT DEFAULT 0
);

-- =========================================================
-- TABEL: proyek
-- Portofolio proyek/karya
-- =========================================================
CREATE TABLE proyek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul_proyek VARCHAR(150) NOT NULL,
    deskripsi TEXT,
    teknologi VARCHAR(150),
    gambar VARCHAR(255) DEFAULT 'default-project.jpg',
    link_demo VARCHAR(255),
    link_github VARCHAR(255),
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- TABEL: pesan
-- Pesan dari form kontak pengunjung website
-- =========================================================
CREATE TABLE pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subjek VARCHAR(150),
    isi_pesan TEXT NOT NULL,
    status_dibaca TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- TABEL: admin
-- Akun untuk login ke halaman admin (CRUD)
-- =========================================================
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- DATA AWAL (SEED DATA) sesuai CV pada gambar
-- =========================================================

INSERT INTO profil (nama_lengkap, status_pendidikan, tempat_lahir, tanggal_lahir, alamat, no_telepon, jenis_kelamin, agama, kewarganegaraan, email, status_pernikahan, deskripsi, foto)
VALUES (
    'Maheswara Puwa Hadi Gautama',
    'Lulusan Baru',
    'Tulungagung',
    '2006-05-13',
    'Perum Bumi Mas Blok M14, Tunggulsari, Kedungwaru, Tulungagung',
    '083113172888',
    'Laki-laki',
    'Islam',
    'Indonesia',
    'maheswarapuwa@gmail.com',
    'Belum Menikah',
    'Lulusan SMK jurusan Rekayasa Perangkat Lunak yang cekatan, sigap, dan dapat diandalkan. Terbiasa bekerja dalam tim serta memiliki kemampuan komunikasi yang baik untuk mendukung kolaborasi dan penyelesaian proyek secara efisien. Saat ini saya masih kuliah di UBHI semester 1 jurusan Pendidikan Teknologi Informasi.',
    'default.jpg'
);

INSERT INTO pendidikan (nama_sekolah, jenjang, tahun_mulai, tahun_selesai, sedang_berjalan, keterangan, urutan) VALUES
('SDN 1 Rejoagung', 'SD', 2012, 2019, 0, '2012 - 2019', 1),
('SMPN 1 Kedungwaru', 'SMP', 2019, 2022, 0, '2019 - 2022', 2),
('SMKN 1 Boyolangu', 'SMK', 2022, 2025, 0, '2022 - 2025', 3),
('Universitas Bhinneka Tunggal Ika (UBHI)', 'S1 - Pendidikan Teknologi Informasi', 2025, NULL, 1, 'Masih Semester 1', 4);

INSERT INTO keahlian (nama_keahlian, persentase, icon, urutan) VALUES
('Pengembangan Website', 85, 'code', 1),
('Pemrograman IoT', 75, 'cpu', 2),
('Kerja Tim & Komunikasi', 90, 'users', 3);

INSERT INTO pengalaman (judul, deskripsi, kategori, urutan) VALUES
('Komunikasi Internal', 'Selama PKL, saya belajar berkomunikasi secara internal dengan rekan satu tim dan pembimbing, yang sangat baik.', 'Pengalaman', 1),
('Relawan Komunikasi', 'Berperan sebagai relawan komunikasi selama kegiatan PKL, membantu dalam penyampaian informasi.', 'Pengalaman', 2),
('Pengalaman Sistem IoT', 'Mendapatkan pengalaman dalam membangun dan memahami sistem IoT selama masa PKL.', 'Hasil PKL', 3),
('Pengalaman Pengembangan Website', 'Mendapatkan pengalaman langsung dalam pengembangan website selama masa PKL.', 'Hasil PKL', 4),
('Kerja Tim dan Komunitas', 'Mengasah kemampuan kerja tim dan beradaptasi dengan komunitas baru selama PKL.', 'Hasil PKL', 5);

INSERT INTO hobi (nama_hobi, icon, urutan) VALUES
('Menyanyi', 'music', 1);

INSERT INTO proyek (judul_proyek, deskripsi, teknologi, gambar, urutan) VALUES
('Website Portofolio Pribadi', 'Website portofolio pribadi dibangun menggunakan PHP native dan MySQL sebagai latihan pengembangan web.', 'PHP, MySQL, HTML, CSS, JavaScript', 'default-project.jpg', 1),
('Sistem Monitoring IoT Sederhana', 'Proyek IoT sederhana untuk memantau data sensor menggunakan mikrokontroler selama kegiatan PKL.', 'IoT, Arduino/ESP32, PHP', 'default-project.jpg', 2);

-- Password default: admin123 (sudah di-hash dengan password_hash PHP bcrypt)
-- Hash di bawah ini adalah contoh untuk 'admin123'
INSERT INTO admin (username, password, nama) VALUES
('admin', '$2y$10$VIO4D3J0kVHz9l49z2vRiuG/iQFFfxkuiXwBSBgc.M9gbRbZlMO3K', 'Maheswara Puwa Hadi Gautama');
