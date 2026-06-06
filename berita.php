<?php
require_once 'includes/db.php';
$db = getDB();

// Pagination
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 6;
$offset = ($page - 1) * $limit;

$totalStmt = $db->query("SELECT COUNT(*) FROM news");
$total = $totalStmt->fetchColumn();
$totalPages = ceil($total / $limit);

$stmt = $db->prepare("SELECT id, title, SUBSTRING(content, 1, 200) AS excerpt, image, created_at FROM news ORDER BY created_at DESC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $limit, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$newsList = $stmt->fetchAll();

// Ambil gambar kegiatan dari folder assets/images/
$activityImages = [];
$activitiesDir = 'assets/images/';
if (is_dir($activitiesDir)) {
    $files = scandir($activitiesDir);
    foreach ($files as $file) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $activityImages[] = $activitiesDir . $file;
        }
    }
}
if (empty($activityImages)) {
    $activityImages[] = 'assets/images/hero-bg.jpg';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Kegiatan – Khala' Hidroponik</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            padding-top: 80px;
            overflow-x: hidden;
        }
        body.menu-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
        }
        .navbar {
            z-index: 1000;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #ffffff;
        }
        /* Menu Mobile */
        @media (max-width: 768px) {
            nav {
                position: fixed;
                top: 0;
                right: 0;
                width: 80%;
                max-width: 320px;
                height: 100vh;
                background: white;
                box-shadow: -10px 0 30px rgba(0,0,0,0.15);
                padding: 6rem 2rem 2rem;
                transform: translateX(100%);
                transition: transform 0.4s ease;
                z-index: 999;
                overflow-y: auto;
                box-sizing: border-box;
            }
            nav.active {
                transform: translateX(0);
            }
        }
        /* Dropdown style (klik, vertikal) */
        .dropdown {
            position: relative;
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 220px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 0.5rem 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            z-index: 1001;
            list-style: none;
            margin: 0;
            display: block;
            flex-direction: column;
        }
        .dropdown.active .dropdown-menu {
            opacity: 1;
            visibility: visible;
        }
        .dropdown-menu li {
            display: block;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .dropdown-menu a {
            display: block;
            padding: 0.6rem 1.2rem;
            color: #2c5e2a;
            text-decoration: none;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .dropdown-menu a:hover {
            background: #eef5ea;
            color: #1b3b17;
        }
        @media (max-width: 768px) {
            .dropdown-menu {
                position: static;
                box-shadow: none;
                padding-left: 1rem;
                width: 100%;
                background: #f8f9fa;
                display: none;
                opacity: 1;
                visibility: visible;
            }
            .dropdown.active .dropdown-menu {
                display: block;
            }
            .dropdown-menu a {
                white-space: normal;
            }
        }
        /* Styles dari halaman berita */
        .page-header {
            width: 100%;
            padding: 20px 0px;
            margin: auto;
            margin-bottom: 30px;
            text-align: center;
        }
        .page-header div p {
            width: 80%;
            text-align: center;
            margin: auto;
        }
        .carousel-section {
            margin: 0 0 2rem;
            background: #f4f9f0;
            padding: 1rem 0;
        }
        .carousel-container {
            position: relative;
            max-width: 1100px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-slide {
            min-width: 100%;
            height: 400px;
            object-fit: cover;
            background: #c8e6c9;
        }
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.85);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.5rem;
            color: #2e7d32;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .carousel-btn:hover {
            background: #fff;
            transform: translateY(-50%) scale(1.05);
        }
        .carousel-btn.prev { left: 15px; }
        .carousel-btn.next { right: 15px; }
        .carousel-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 2;
        }
        .carousel-dots button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: background 0.3s;
            padding: 0;
        }
        .carousel-dots button.active {
            background: white;
            border-color: #2e7d32;
        }
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 40px;
        }
        .news-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(0,0,0,0.06);
            transition: transform 0.3s;
        }
        .news-card:hover { transform: translateY(-5px); }
        .news-card-img {
            height: 200px;
            overflow: hidden;
        }
        .news-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }
        .news-card-body { padding: 1.2rem; }
        .news-meta {
            font-size: 0.8rem;
            color: #8ba888;
            margin-bottom: 0.5rem;
        }
        .news-card-body h3 {
            margin: 0 0 0.5rem;
            font-size: 1.2rem;
        }
        .news-card-body h3 a {
            color: #1b3b17;
            text-decoration: none;
        }
        .news-card-body p {
            color: #5a7152;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        .read-more {
            color: #2e7d32;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .read-more:hover { color: #1b5e20; }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        .pagination a {
            background: #f0f7ed;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            color: #2c5e2a;
            text-decoration: none;
            transition: all 0.2s;
        }
        .pagination a:hover, .pagination a.active {
            background: #2e7d32;
            color: white;
        }
        .pagination-numbers { display: flex; gap: 0.5rem; }
        .footer-container { padding-top: 40px; }
        .footer-bottom { margin-top: 20px; }
        @media (max-width: 768px) {
            .carousel-slide { height: 250px; }
            .carousel-btn { width: 40px; height: 40px; font-size: 1.2rem; }
        }
        @media (max-width: 480px) {
            .carousel-slide { height: 200px; }
            .carousel-btn { width: 32px; height: 32px; font-size: 1rem; }
            .news-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- Navigasi dengan Dropdown Profil -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="logo" style="font-family: Brush Script MT, cursive;">
                <strong style="font-size: 32px;">Khala'</strong><span>Hidroponik</span>
            </a>
            <button class="mobile-menu-toggle" id="menuToggle" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav id="mainNav">
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <!-- Dropdown Profil -->
                    <li class="dropdown">
                        <a href="javascript:void(0)">Profil <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php#profil-usaha">Profil Usaha</a></li>
                            <li><a href="profile.php#sejarah">Sejarah</a></li>
                            <li><a href="profile.php#visi-misi">Visi & Misi</a></li>
                            <li><a href="profile.php#gambaran-usaha">Gambaran Usaha</a></li>
                            <li><a href="profile.php#produk-unggulan">Produk Unggulan</a></li>
                            <li><a href="profile.php#keunggulan">Keunggulan & Nilai Jual</a></li>
                            <li><a href="profile.php#target-pasar">Target Pasar</a></li>
                            <li><a href="profile.php#sistem-penjualan">Sistem Penjualan</a></li>
                            <li><a href="profile.php#potensi-tantangan">Potensi & Tantangan</a></li>
                            <li><a href="profile.php#penutup">Penutup</a></li>
                        </ul>
                    </li>
                    <li><a href="sertifikasi.php">Perizinan & Kemitraan</a></li>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="berita.php" class="active">Berita</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Carousel Kegiatan -->
    <?php if (!empty($activityImages)): ?>
    <section class="carousel-section">
        <div class="carousel-container" id="activityCarousel">
            <div class="carousel-track" id="carouselTrack">
                <?php foreach ($activityImages as $img): ?>
                    <img src="<?= htmlspecialchars($img) ?>" class="carousel-slide" alt="Kegiatan Hidroponik">
                <?php endforeach; ?>
            </div>
            <button class="carousel-btn prev" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
            <button class="carousel-btn next" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
            <div class="carousel-dots" id="carouselDots"></div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Page Header -->
    <section class="page-header">
        <div>
            <h1>Berita & Kegiatan</h1>
            <p>Informasi terbaru seputar dunia hidroponik, tips, dan inovasi.</p>
        </div>
    </section>

    <!-- Daftar Berita -->
    <section class="berita-list-section">
        <div class="container">
            <?php if (empty($newsList)): ?>
                <div class="empty-state">
                    <i class="fas fa-newspaper"></i>
                    <p>Belum ada berita. Silakan kembali lagi nanti.</p>
                </div>
            <?php else: ?>
                <div class="news-grid">
                    <?php foreach ($newsList as $item): ?>
                        <article class="news-card">
                            <div class="news-card-img">
                                <?php if ($item['image']): ?>
                                    <img src="<?= htmlspecialchars(UPLOAD_URL . $item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                                <?php else: ?>
                                    <img src="assets/images/placeholder.jpg" alt="Placeholder">
                                <?php endif; ?>
                            </div>
                            <div class="news-card-body">
                                <div class="news-meta">
                                    <span><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($item['created_at'])) ?></span>
                                </div>
                                <h3><a href="detail.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></a></h3>
                                <p><?= htmlspecialchars($item['excerpt']) ?>...</p>
                                <a href="detail.php?id=<?= $item['id'] ?>" class="read-more">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page-1 ?>" class="pagination-prev"><i class="fas fa-chevron-left"></i> Sebelumnya</a>
                        <?php endif; ?>
                        <div class="pagination-numbers">
                            <?php
                            $start = max(1, $page - 2);
                            $end = min($totalPages, $page + 2);
                            if ($start > 1) echo '<span>...</span>';
                            for ($i = $start; $i <= $end; $i++):
                            ?>
                                <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                            <?php endfor;
                            if ($end < $totalPages) echo '<span>...</span>';
                            ?>
                        </div>
                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?= $page+1 ?>" class="pagination-next">Selanjutnya <i class="fas fa-chevron-right"></i></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container footer-container">
            <div class="footer-about">
                <h3><i class="fas fa-seedling"></i> Khala'Hidroponik</h3>
                <p>Jual sayuran hidroponik segar dan informasi pertanian modern.</p>
            </div>
            <div class="footer-contact">
                <h4>Kontak Kami</h4>
                <ul>
                    <li><i class="fas fa-phone-alt"></i> 081241330346</li>
                    <li><i class="fas fa-map-marker-alt"></i> Jl. Soekarno Hatta, Kelurahan Karema, Kecamatan Mamuju, Kabupaten Mamuju, Sulawesi Barat.</li>
                </ul>
            </div>
            <div class="footer-social">
                <h4>Ikuti Kami</h4>
                <div class="social-icons">
                    <a href="https://www.instagram.com/khalahidroponik"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/religius.heryanto.5/"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.tiktok.com/@khalahidroponik"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; 2026 Khala'Hidroponik. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript: Carousel + Mobile Menu + Dropdown -->
    <script>
        // Carousel functionality
        const track = document.getElementById('carouselTrack');
        if (track) {
            const slides = Array.from(track.children);
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const dotsContainer = document.getElementById('carouselDots');
            let currentIndex = 0;
            let autoSlideInterval;

            function createDots() {
                dotsContainer.innerHTML = '';
                slides.forEach((_, index) => {
                    const dot = document.createElement('button');
                    if (index === 0) dot.classList.add('active');
                    dot.addEventListener('click', () => goToSlide(index));
                    dotsContainer.appendChild(dot);
                });
            }

            function updateDots(index) {
                const dots = dotsContainer.children;
                Array.from(dots).forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
            }

            function goToSlide(index) {
                if (index < 0) index = slides.length - 1;
                if (index >= slides.length) index = 0;
                currentIndex = index;
                track.style.transform = `translateX(-${currentIndex * 100}%)`;
                updateDots(currentIndex);
            }

            function nextSlide() { goToSlide(currentIndex + 1); }
            function prevSlide() { goToSlide(currentIndex - 1); }
            function startAutoSlide() { autoSlideInterval = setInterval(nextSlide, 4000); }
            function stopAutoSlide() { clearInterval(autoSlideInterval); }

            createDots();
            goToSlide(0);
            startAutoSlide();

            nextBtn.addEventListener('click', () => { stopAutoSlide(); nextSlide(); startAutoSlide(); });
            prevBtn.addEventListener('click', () => { stopAutoSlide(); prevSlide(); startAutoSlide(); });
            track.parentElement.addEventListener('mouseenter', stopAutoSlide);
            track.parentElement.addEventListener('mouseleave', startAutoSlide);
        }

        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const mainNav = document.getElementById('mainNav');
        const body = document.body;

        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', () => {
                menuToggle.classList.toggle('active');
                mainNav.classList.toggle('active');
                body.classList.toggle('menu-open', mainNav.classList.contains('active'));
            });

            // Tutup menu mobile saat link (kecuali dropdown toggle) diklik
            mainNav.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', (e) => {
                    const isDropdownToggle = (
                        window.innerWidth <= 768 &&
                        link.parentElement?.classList.contains('dropdown') &&
                        link.getAttribute('href') === 'javascript:void(0)'
                    );
                    if (isDropdownToggle) return;
                    menuToggle.classList.remove('active');
                    mainNav.classList.remove('active');
                    body.classList.remove('menu-open');
                });
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    menuToggle.classList.remove('active');
                    mainNav.classList.remove('active');
                    body.classList.remove('menu-open');
                }
            });
        }

        // Dropdown klik (desktop & mobile)
        const dropdownToggles = document.querySelectorAll('.dropdown > a');
        function closeAllDropdowns() {
            document.querySelectorAll('.dropdown').forEach(drop => drop.classList.remove('active'));
        }

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const parentDropdown = this.parentElement;
                const isActive = parentDropdown.classList.contains('active');
                closeAllDropdowns();
                if (!isActive) parentDropdown.classList.add('active');
            });
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) closeAllDropdowns();
        });

        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', e => e.stopPropagation());
        });

        // Smooth scroll untuk anchor link (jika ada)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === "#" || href === "javascript:void(0)") return;
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>