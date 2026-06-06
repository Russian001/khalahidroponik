<?php
require_once 'includes/db.php';
$db = getDB();
$products = $db->query("SELECT * FROM products ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Segar Hidroponik – Khala' Hidroponik</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ===== PERBAIKAN OVERFLOW MOBILE ===== */
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
            padding-top: 42px;
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
        /* Menu Mobile dengan transform */
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
        
        /* ===== DROPDOWN STYLE (KLIK, VERTIKAL) UNTUK SEMUA PERANGKAT ===== */
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
            display: block !important;
            flex-direction: column !important;
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
        /* Tampilan mobile: dropdown full width, tidak absolute */
        @media (max-width: 768px) {
            .dropdown-menu {
                position: static;
                box-shadow: none;
                padding-left: 1rem;
                width: 100%;
                background: #f8f9fa;
                display: none !important;
                opacity: 1;
                visibility: visible;
            }
            .dropdown.active .dropdown-menu {
                display: block !important;
            }
            .dropdown-menu a {
                white-space: normal;
            }
        }
        
        /* ===== PRODUK PAGE ENHANCEMENT ===== */
        .produk-hero {
            background-image: url("assets/images/heroproduk.jpeg");
            background-position: center;
            background-size: cover; 
            padding: 5rem 0 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            background-color: black;
        }
        .produk-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.3) 0%, transparent 50%);
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, -20px); }
        }
        .produk-hero .container {
            position: relative;
            z-index: 1;
        }
        .produk-hero h1 {
            color: #ffffff;
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }
        .produk-hero p {
            color: #ffffff;
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 12rem;
            background-color: green;
            opacity: 0.7;
        }
        .product-grid-full {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0 4rem;
        }
        .product-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(46,125,50,0.08);
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 40px rgba(0,0,0,0.12);
            border-color: rgba(46,125,50,0.2);
        }
        .product-card-img {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1/1;
            background: #f0f7ed;
        }
        .product-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .product-card:hover .product-card-img img {
            transform: scale(1.08);
        }
        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #f39c12;
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .product-card-body {
            padding: 1.8rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .product-card-body h3 {
            font-size: 1.4rem;
            margin-bottom: 0.6rem;
            color: #1b3b17;
            font-weight: 700;
        }
        .product-desc {
            color: #5a7152;
            font-size: 0.95rem;
            margin-bottom: 1.2rem;
            line-height: 1.5;
            flex: 1;
        }
        .product-price {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .price-item {
            display: flex;
            flex-direction: column;
        }
        .price-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #8ba888;
            margin-bottom: 0.2rem;
            font-weight: 600;
        }
        .price-value {
            font-weight: 700;
            font-size: 1.3rem;
            color: #1b5e20;
        }
        .price-bulk .price-value {
            color: #f39c12;
        }
        .price-note {
            font-size: 0.75rem;
            color: #8ba888;
            font-weight: 400;
            margin-left: 4px;
        }
        .btn-order {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: #25d366;
            color: white;
            padding: 0.9rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 1rem;
            margin-top: auto;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.25);
        }
        .btn-order:hover {
            background: #128c7e;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.35);
            color: white;
        }
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            margin: 2rem 0;
        }
        .empty-state i {
            font-size: 5rem;
            color: #a5d6a7;
            margin-bottom: 1.5rem;
            display: block;
        }
        .empty-state p {
            font-size: 1.2rem;
            color: #5a7152;
        }
        .filter-info {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0 1rem;
            flex-wrap: wrap;
        }
        .filter-info span {
            background: white;
            padding: 0.6rem 1.4rem;
            border-radius: 40px;
            font-weight: 500;
            color: #1e2e1c;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .filter-info .highlight {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        .footer-container {
            padding-top: 40px;
        }
        .footer-bottom {
            margin-top: 20px;
        }
        @media (max-width: 600px) {
            .produk-hero h1 {
                font-size: 2.2rem;
            }
            .product-grid-full {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
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
                    <li><a href="produk.php" class="active">Produk</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="produk-hero">
            <div class="container">
                <h1>Produk Hidroponik Segar</h1>
                <p>Nikmati sayuran sehat bebas pestisida, langsung dari kebun hidroponik modern kami. Tersedia harga eceran & borongan.</p>
            </div>
        </section>

        <section class="container">
            <div class="filter-info">
                <span><i class="fas fa-tag"></i> Harga Eceran</span>
                <span class="highlight"><i class="fas fa-boxes"></i> Harga Borongan (min. jumlah tertentu)</span>
            </div>

            <?php if (empty($products)): ?>
                <div class="empty-state">
                    <i class="fas fa-seedling"></i>
                    <p>Belum ada produk tersedia. Silakan kembali lagi nanti.</p>
                </div>
            <?php else: ?>
                <div class="product-grid-full">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card" data-aos="fade-up">
                            <div class="product-card-img">
                                <?php if ($product['image']): ?>
                                    <img src="<?= htmlspecialchars(UPLOAD_URL . $product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                <?php else: ?>
                                    <img src="assets/images/placeholder.jpg" alt="Placeholder">
                                <?php endif; ?>
                                <?php if ($product['bulk_price'] < $product['price_per_unit']): ?>
                                    <span class="product-badge"><i class="fas fa-percent"></i> Hemat Borongan</span>
                                <?php endif; ?>
                            </div>
                            <div class="product-card-body">
                                <h3><?= htmlspecialchars($product['name']) ?></h3>
                                <p class="product-desc"><?= htmlspecialchars($product['description']) ?></p>
                                <div class="product-price">
                                    <div class="price-item">
                                        <span class="price-label">Eceran</span>
                                        <span class="price-value">Rp <?= number_format($product['price_per_unit'], 0, ',', '.') ?> <span class="price-note">/ pack</span></span>
                                    </div>
                                    <div class="price-item price-bulk">
                                        <span class="price-label">Borongan</span>
                                        <span class="price-value">Rp <?= number_format($product['bulk_price'], 0, ',', '.') ?> <span class="price-note">/ min <?= $product['bulk_min_qty'] ?></span></span>
                                    </div>
                                </div>
                                <a href="https://wa.me/6281241330346?text=Halo%2C%20saya%20tertarik%20beli%20<?= urlencode($product['name']) ?>" target="_blank" class="btn-order">
                                    <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
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
                    <a href="https://www.instagram.com/khalahidroponik?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class="fab fa-instagram"></i></a>
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

    <script>
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
            
            // Tutup menu mobile saat link (selain dropdown toggle) diklik
            mainNav.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', (e) => {
                    const isDropdownToggle = (
                        window.innerWidth <= 768 &&
                        link.parentElement?.classList.contains('dropdown') &&
                        link.getAttribute('href') === 'javascript:void(0)'
                    );
                    if (isDropdownToggle) {
                        return;
                    }
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
        
        // ========== DROPDOWN KLIK (Desktop & Mobile) ==========
        const dropdownToggles = document.querySelectorAll('.dropdown > a');
        function closeAllDropdowns() {
            document.querySelectorAll('.dropdown').forEach(drop => {
                drop.classList.remove('active');
            });
        }
        
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const parentDropdown = this.parentElement;
                const isActive = parentDropdown.classList.contains('active');
                closeAllDropdowns();
                if (!isActive) {
                    parentDropdown.classList.add('active');
                }
            });
        });
        
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                closeAllDropdowns();
            }
        });
        
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
        
        // Smooth scroll untuk anchor link
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === "#") return;
                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        
        // Animasi produk saat scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.product-card').forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>