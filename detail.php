<?php
require_once 'includes/db.php';
$db = getDB();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: berita.php');
    exit;
}

$stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();

if (!$news) {
    http_response_code(404);
    echo "<h1>404 - Berita tidak ditemukan</h1>";
    exit;
}

// Berita terkait (3 terbaru selain ini)
$relatedStmt = $db->prepare("SELECT id, title, image, COALESCE(published_at, created_at) AS pub_date FROM news WHERE id != ? ORDER BY COALESCE(published_at, created_at) DESC LIMIT 3");
$relatedStmt->execute([$id]);
$relatedNews = $relatedStmt->fetchAll();

// Ekstrak video ID
$videoId = '';
if (!empty($news['youtube_url'])) {
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]{11})/', $news['youtube_url'], $matches)) {
        $videoId = $matches[1];
    }
}

// Data Open Graph
$pageUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$pageTitle = htmlspecialchars($news['title']);
$cleanContent = strip_tags($news['content']);
$pageDescription = mb_substr($cleanContent, 0, 150) . (mb_strlen($cleanContent) > 150 ? '...' : '');
$pageImage = '';
if ($news['image']) {
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $pageImage = $baseUrl . UPLOAD_URL . $news['image'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> – HidroponikCerdas</title>

    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <meta property="og:url" content="<?= $pageUrl ?>">
    <?php if ($pageImage): ?>
        <meta property="og:image" content="<?= $pageImage ?>">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    <?php endif; ?>
    <meta property="og:site_name" content="HidroponikCerdas">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $pageTitle ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <?php if ($pageImage): ?>
        <meta name="twitter:image" content="<?= $pageImage ?>">
    <?php endif; ?>

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
        /* === Detail Article Layout === */
        .article-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .article-hero {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            padding: 3rem 0 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        .article-hero h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            margin-bottom: 0.5rem;
            color: #1b3b17;
            line-height: 1.3;
        }
        .article-meta {
            color: #2e7d32;
            font-weight: 500;
        }
        .featured-image-wrapper {
            margin: 2rem 0;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            position: relative;
        }
        .featured-image-wrapper img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            display: block;
        }
        .image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.5);
            color: white;
            padding: 10px 20px;
            font-size: 0.9rem;
            backdrop-filter: blur(4px);
        }
        .video-wrapper {
            margin: 2rem 0;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
        }
        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .article-content {
            max-width: 800px;
            margin: 3rem auto;
            font-size: 1.1rem;
            line-height: 1.9;
            color: #2c3e2a;
        }
        .article-content p {
            margin-bottom: 1.8rem;
        }
        .article-content h2, .article-content h3 {
            color: #1b3b17;
            margin: 2rem 0 1rem;
        }
        .article-divider {
            border: none;
            border-top: 1px solid #d0e0ca;
            margin: 2rem 0;
        }
        .action-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem 0;
            border-top: 1px solid #d0e0ca;
            margin-top: 2rem;
        }
        .share-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .share-group span {
            font-weight: 500;
            color: #5a7152;
        }
        .share-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2e7d32;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: all 0.2s;
            text-decoration: none;
        }
        .share-icon:hover {
            background: #2e7d32;
            color: white;
            transform: translateY(-2px);
        }
        .related-section {
            padding: 4rem 0;
            background: #f4f9f0;
        }
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .related-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.04);
            transition: transform 0.2s;
        }
        .related-card:hover {
            transform: translateY(-5px);
        }
        .related-card img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
        }
        .related-card-body {
            padding: 1.2rem;
        }
        .related-card-body h3 {
            font-size: 1.1rem;
            margin-bottom: 0.4rem;
        }
        .related-card-body h3 a {
            color: #1b3b17;
            text-decoration: none;
        }
        .related-card-body h3 a:hover {
            color: #2e7d32;
        }
        .related-date {
            font-size: 0.85rem;
            color: #6b8a64;
            margin-bottom: 0.5rem;
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

    <main>
        <!-- Hero Judul -->
        <div class="article-hero">
            <div class="article-container">
                <div class="article-meta">
                    <i class="far fa-calendar-alt"></i> <?= date('d F Y H:i', strtotime($news['published_at'] ?? $news['created_at'])) ?>
                </div>
                <h1><?= $pageTitle ?></h1>
            </div>
        </div>

        <div class="article-container">
            <!-- Gambar Utama -->
            <?php if ($news['image']): ?>
            <figure class="featured-image-wrapper">
                <img src="<?= htmlspecialchars(UPLOAD_URL . $news['image']) ?>" alt="<?= $pageTitle ?>">
                <figcaption class="image-caption"><?= $pageTitle ?></figcaption>
            </figure>
            <?php endif; ?>

            <!-- Video YouTube -->
            <?php if ($videoId): ?>
            <div class="video-wrapper">
                <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($videoId) ?>" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>
            </div>
            <?php endif; ?>

            <!-- Konten Teks -->
            <div class="article-content">
                <?= nl2br(htmlspecialchars($news['content'])) ?>
            </div>

            <!-- Garis pemisah -->
            <hr class="article-divider">

            <!-- Action Bar: Kembali + Share -->
            <div class="action-bar">
                <a href="berita.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Berita</a>
                <div class="share-group">
                    <span>Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($pageUrl) ?>" target="_blank" class="share-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode($pageUrl) ?>&text=<?= urlencode($pageTitle) ?>" target="_blank" class="share-icon" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://wa.me/?text=<?= urlencode($pageTitle . ' ' . $pageUrl) ?>" target="_blank" class="share-icon" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>

        <!-- Berita Terkait -->
        <?php if (!empty($relatedNews)): ?>
        <section class="related-section">
            <h2 style="text-align:center; color:#1b3b17; margin-bottom:2rem;">Berita Terkait</h2>
            <div class="related-grid">
                <?php foreach ($relatedNews as $item): ?>
                <div class="related-card">
                    <?php if ($item['image']): ?>
                        <img src="<?= htmlspecialchars(UPLOAD_URL . $item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                    <?php else: ?>
                        <img src="assets/images/placeholder.jpg" alt="Placeholder">
                    <?php endif; ?>
                    <div class="related-card-body">
                        <div class="related-date"><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($item['pub_date'])) ?></div>
                        <h3><a href="detail.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></a></h3>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
    </main>

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