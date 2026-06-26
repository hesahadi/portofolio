<?php
session_start();
require_once __DIR__ . '/../includes/fungsi.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$pesanError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = bersihkan($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $query = "SELECT * FROM admin WHERE username = '$username' LIMIT 1";
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil && mysqli_num_rows($hasil) > 0) {
        $admin = mysqli_fetch_assoc($hasil);
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id']   = $admin['id'];
            $_SESSION['admin_nama'] = $admin['nama'];
            header('Location: dashboard.php');
            exit;
        } else {
            $pesanError = 'Password salah!';
        }
    } else {
        $pesanError = 'Username tidak ditemukan!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Portofolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
    <div class="admin-login-wrap">
        <div class="admin-login-box">
            <h2><i class="fa-solid fa-lock"></i> Admin Login</h2>
            <p class="sub">Masuk untuk mengelola konten website portofolio</p>

            <?php if ($pesanError): ?>
                <div class="alert alert-gagal"><?= htmlspecialchars($pesanError) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-aksen" style="width:100%;">Masuk</button>
            </form>
            <p style="text-align:center;margin-top:18px;">
                <a href="../index.php" style="color:var(--warna-utama);font-size:0.85rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Website
                </a>
            </p>
        </div>
    </div>
</body>
</html>
