// =========================================================
// MENU MOBILE (TOGGLE)
// =========================================================
const toggleNav = document.getElementById('toggleNav');
const menuNav = document.getElementById('menuNav');

if (toggleNav) {
    toggleNav.addEventListener('click', () => {
        menuNav.classList.toggle('terbuka');
    });
}

// Tutup menu saat link diklik (mobile)
document.querySelectorAll('.menu a').forEach(link => {
    link.addEventListener('click', () => {
        menuNav.classList.remove('terbuka');
    });
});

// =========================================================
// NAVBAR AKTIF SAAT SCROLL (highlight menu)
// =========================================================
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 30) {
        navbar.style.boxShadow = '0 4px 18px rgba(0,0,0,0.25)';
    } else {
        navbar.style.boxShadow = 'none';
    }
});

// =========================================================
// ANIMASI PROGRESS BAR SKILL SAAT MUNCUL DI VIEWPORT
// =========================================================
const progressBars = document.querySelectorAll('.progress-isi');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const target = entry.target.getAttribute('data-width');
            entry.target.style.width = target + '%';
        }
    });
}, { threshold: 0.3 });

progressBars.forEach(bar => {
    bar.style.width = '0%';
    observer.observe(bar);
});

// =========================================================
// FADE-IN SEDERHANA UNTUK KARTU SAAT SCROLL
// =========================================================
const elemenFade = document.querySelectorAll('.kartu-skill, .kartu-pengalaman, .kartu-proyek, .kartu-hobi');

const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, { threshold: 0.15 });

elemenFade.forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'all 0.6s ease';
    fadeObserver.observe(el);
});
