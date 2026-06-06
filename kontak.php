<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Kontak & Sosial Media - Khala' Hidroponik</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', 'Poppins', system-ui, sans-serif;
            background: #fefef7;
            padding-top: 80px;
            overflow-x: hidden;
        }
        .navbar {
            z-index: 1000;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #ffffff;
        }
        /* ===== DROPDOWN STYLE (KLIK, BUKAN HOVER) UNTUK SEMUA PERANGKAT ===== */
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
            
            /* Pastikan vertikal */
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
        }
        .dropdown-menu a {
            display: block;
            padding: 0.6rem 1.2rem;
            color: #2c5e2a;
            transition: background 0.2s;
        }
        .dropdown-menu a:hover {
            background: #eef5ea;
            color: #1b3b17;
        }
        @media (max-width: 768px) {
            body { padding-top: 70px; }
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
        }
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        /* Hero Contact */
        .hero-contact {
            background: url("assets/images/logo/herkon.jpeg");
            background-position: center;
            background-size: cover; 
            color: white;
            padding: 4rem 0;
            text-align: center;
            border-radius: 0 0 40px 40px;
            margin-bottom: 3rem;
        }
        .hero-contact h1 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            
        }
        .hero-contact p {
            font-size: 1.2rem;
            opacity: 0.9;
            background-color: #03367e;
            border-radius: 5px;
            padding: 5px 0;
            margin-bottom: 15rem;
        }
        /* Section */
        .section {
            padding: 3rem 0;
            border-bottom: 1px solid #e2ecd9;
        }
        .section-title {
            font-size: 2rem;
            color: #1b3b17;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 70px;
            height: 4px;
            background: #2e7d32;
            border-radius: 2px;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        /* Card untuk kontak & sosmed */
        .contact-card {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border: 1px solid #eef3ea;
            text-align: center;
        }
        .contact-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 40px rgba(0,0,0,0.1);
        }
        .contact-icon {
            font-size: 2.8rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        .contact-card h3 {
            color: #1b3b17;
            margin-bottom: 0.8rem;
            font-size: 1.4rem;
        }
        .contact-card p, .contact-card a {
            color: #3a5e36;
            font-size: 1rem;
            line-height: 1.6;
            text-decoration: none;
        }
        .contact-card a:hover {
            color: #1b3b17;
            text-decoration: underline;
        }
        .social-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 7rem;
            margin-top: 1rem;
        }
        .social-item {
            text-align: center;
            transition: 0.3s;
            display: flex;
            align-items: center;
            
        }
        .social-item a {
            display: inline-block;
            background: white;
            width: 90px;
            height: 90px;
            border-radius: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #2e7d32;
            transition: 0.3s;
            border: 1px solid #eef3ea;
            margin-right: 30px;
        }
        .social-item a:hover {
            background: #2e7d32;
            color: white;
            transform: translateY(-6px);
            box-shadow: 0 18px 30px rgba(46,125,50,0.2);
        }
        .social-item span {
            display: block;
            margin-top: 0.8rem;
            font-weight: 600;
            color: #1b3b17;
            font-size: 0.95rem;
        }
        footer {
            background: #1b3b17;
            color: #ddd;
            padding: 3rem 0 1rem;
            margin-top: 3rem;
        }
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }
        .social-icons a {
            color: white;
            margin-right: 1rem;
            font-size: 1.4rem;
        }
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #3a5e36;
            margin-top: 2rem;
        }
        @media (max-width: 768px) {
            .hero-contact h1 { font-size: 2rem; }
            .section-title { font-size: 1.6rem; }
            .social-item a { width: 70px; height: 70px; font-size: 2rem; margin: auto;}
            .social-grid {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 2rem;
                margin-top: 1rem;
            }
            .social-item{
            	display: block;
                margin: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navigasi (TIDAK DIUBAH) -->
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
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="#contact" class="active">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- HERO BARU: KONTAK -->
    <section class="hero-contact">
        <div class="container">
            <h1></i>Hubungi Kami</h1>
            <p>Kami siap melayani Anda – temukan kontak dan media sosial resmi Khala' Hidroponik</p>
        </div>
    </section>

    <div class="container">
        <!-- Media Sosial -->
        <section class="section">
            <h2 class="section-title">Ikuti Sosial Media Kami</h2>
            <p style="margin-bottom:2rem; color:#3a5e36;">Dapatkan info terbaru, promo, dan tips hidroponik setiap hari.</p>
            <div class="social-grid">
                <div class="social-item">
                    <a href="https://www.instagram.com/khalahidroponik?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener" aria-label="Instagram">
                        <img style="width: 100px;" src="assets/images/logo/ig.png" alt="">
                    </a>
                    <span>@khalahidroponik</span>
                </div>
                <div class="social-item">
                    <a href="https://www.facebook.com/religius.heryanto.5/" target="_blank" rel="noopener" aria-label="Facebook">
                        <img style="width: 100px;" src="assets/images/logo/Facebook.png" alt="">
                    </a>
                    <span>khala hidroponik</span>
                </div>
                <div class="social-item">
                    <a href="https://www.tiktok.com/@khalahidroponik" target="_blank" rel="noopener" aria-label="TikTok">
                        <img style="width: 100px;" src="assets/images/logo/tktk.png" alt="">
                    </a>
                    <span>khalahidroponik</span>
                </div>
                <div class="social-item">
                    <a href="https://wa.me/6281241330346?" target="_blank" rel="noopener" aria-label="YouTube">
                        <img style="width: 100px;" src="assets/images/logo/wa.png" alt="">
                    </a>
                    <span>081241330346</span>
                </div>
                <div class="social-item">
                    <a href="https://shopee.co.id/khala_hidroponik" target="_blank" rel="noopener" aria-label="TikTok">
                        <img style="width: 100px;" src="assets/images/logo/sp.png" alt="">
                    </a>
                    <span>khala_hidroponik</span>
                </div>
            </div>
        </section>

        <!-- Peta Lokasi (Dipertahankan) -->
        <section style="padding: 60px 0; background: #f4f9f0; border-radius: 30px; margin: 3rem 0;">
            <div class="container" style="text-align: center;">
                <h2 style="font-size: 2.5rem; color: #1b3b17; margin-bottom: 10px;">Lokasi Kebun Kami</h2>
                <p style="color: #5a7152; margin-bottom: 30px;">Klik peta untuk langsung menuju Google Maps</p>
                <a href="https://maps.app.goo.gl/BAQxbxEGQrgbBqg39" target="_blank" rel="noopener" style="display: block; position: relative; border-radius: 24px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7970.8166238896465!2d118.86453866958617!3d-2.694143903870633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d92d90006d271ef%3A0xed82d96c4a48a5d5!2sKHALA&#39;%20HIDROPONIK%202!5e0!3m2!1sid!2sid!4v1779521453231!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.6); color: white; padding: 12px 24px; border-radius: 30px; font-weight: 600; display: flex; align-items: center; gap: 8px; pointer-events: none;">
                        <i class="fas fa-map-marker-alt"></i> Buka di Google Maps
                    </div>
                </a>
            </div>
        </section>

        <!-- Call to Action -->
        <section style="text-align: center; padding: 2rem 0 4rem;">
            <p style="font-size: 1.3rem; color: #1b3b17; margin-bottom: 1rem;">Butuh informasi lebih lanjut?</p>
            <a href="https://wa.me/6281241330346?text=Halo%20Khala'Hidroponik%2C%20saya%20tertarik%20dengan%20produk%20Anda" target="_blank" style="display: inline-block; background: #25D366; color: white; padding: 1rem 2.5rem; border-radius: 50px; font-weight: bold; font-size: 1.2rem; text-decoration: none; transition: 0.3s;">
                <i class="fab fa-whatsapp"></i> Chat WhatsApp Sekarang
            </a>
        </section>

    </div>

    <!-- Footer (TIDAK DIUBAH) -->
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
    // Mobile menu toggle (TIDAK DIUBAH)
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            mainNav.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
        mainNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 768 && link.parentElement?.classList.contains('dropdown') && link.getAttribute('href') === 'javascript:void(0)') {
                    return;
                }
                menuToggle.classList.remove('active');
                mainNav.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                menuToggle.classList.remove('active');
                mainNav.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    }
    // Dropdown klik (TIDAK DIUBAH)
    const dropdownToggles = document.querySelectorAll('.dropdown > a');
    function closeAllDropdowns() { document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('active')); }
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const parent = this.parentElement;
            const isActive = parent.classList.contains('active');
            closeAllDropdowns();
            if (!isActive) parent.classList.add('active');
        });
    });
    document.addEventListener('click', (e) => { if (!e.target.closest('.dropdown')) closeAllDropdowns(); });
</script>
</body>
</html>