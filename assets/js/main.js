// === Mobile Menu Toggle ===
const menuToggle = document.getElementById('menuToggle');
const mainNav = document.getElementById('mainNav');

// Buat overlay
const overlay = document.createElement('div');
overlay.className = 'nav-overlay';
document.body.appendChild(overlay);

function openMenu() {
    menuToggle.classList.add('active');
    mainNav.classList.add('active');
    overlay.classList.add('active');
    document.body.classList.add('menu-open');
}

function closeMenu() {
    menuToggle.classList.remove('active');
    mainNav.classList.remove('active');
    overlay.classList.remove('active');
    document.body.classList.remove('menu-open');
}

if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', () => {
        if (mainNav.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    // Tutup menu saat overlay diklik
    overlay.addEventListener('click', closeMenu);

    // Tutup menu saat link di dalam nav diklik
    mainNav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });

    // Tutup menu saat resize ke desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768 && mainNav.classList.contains('active')) {
            closeMenu();
        }
    });
}

// === Smooth Scroll untuk Anchor Link ===
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === "#" || href === "") return;
        const target = document.querySelector(href);
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// === Animasi Counter Statistik (jika ada) ===
const statNumbers = document.querySelectorAll('.stat-number .counter');
if (statNumbers.length) {
    const animateValue = (el, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            el.innerText = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const endValue = parseInt(el.innerText);
                if (!isNaN(endValue) && !el.classList.contains('counted')) {
                    el.classList.add('counted');
                    animateValue(el, 0, endValue, 1500);
                }
            }
        });
    }, { threshold: 0.5 });

    statNumbers.forEach(el => observer.observe(el));
}

