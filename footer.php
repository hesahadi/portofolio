<footer>
    <div class="kontainer">
        <div class="sosial">
            <a href="mailto:<?= htmlspecialchars($profil['email'] ?? '') ?>"><i class="fa-solid fa-envelope"></i></a>
            <a href="tel:<?= htmlspecialchars($profil['no_telepon'] ?? '') ?>"><i class="fa-solid fa-phone"></i></a>
            <a href="https://wa.me/62<?= htmlspecialchars(ltrim($profil['no_telepon'] ?? '', '0')) ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
        <p><?= htmlspecialchars($profil['nama_lengkap'] ?? '') ?></p>
        <small>&copy; <?= date('Y') ?> — Dibangun dengan PHP Native &amp; MySQL</small>
    </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
