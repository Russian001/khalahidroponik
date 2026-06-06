<?php
require_once 'includes/db.php';
$db = getDB();

// Produk unggulan (3 terbaru)
$featuredProducts = $db->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 3")->fetchAll();

// Berita terbaru (3)
$latestNews = $db->query("SELECT id, title, SUBSTRING(content, 1, 150) AS excerpt, image, created_at FROM news ORDER BY created_at DESC LIMIT 3")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidroponik Cerdas – Pertanian Masa Depan, Jual Sayur Segar</title>
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
        }
        
        /* Sejarah & Visi Misi Styles (tidak berubah) */
        .history-section {
            padding: 5rem 0;
            background: white;
        }
        .history-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }
        .history-image img {
            /* border-radius: 50%; */
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
            width: 80%;
            transition: transform 0.5s;
            margin: auto;
        }
        .history-image img:hover {
            transform: scale(1.02);
        }
        .history-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #1b3b17;
            position: relative;
        }
        .history-content h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: #2e7d32;
            border-radius: 2px;
        }
        .history-content p {
            color: #3a4d35;
            line-height: 1.8;
            margin-bottom: 1rem;
        }
        .vision-mission {
            padding: 5rem 0;
            background: #f4f9f0;
        }
        .vision-mission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .vm-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 15px 30px rgba(0,0,0,0.03);
            border: 1px solid #e2ecd9;
            transition: all 0.3s ease;
        }
        .vm-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 40px rgba(0,0,0,0.08);
            border-color: #a5d6a7;
        }
        .vm-icon {
            font-size: 2.5rem;
            color: #2e7d32;
            margin-bottom: 1.2rem;
        }
        .vm-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.8rem;
            color: #1b3b17;
        }
        .vm-card p {
            color: #5a7152;
            line-height: 1.7;
        }
        .vm-card ol {
            padding-left: 1.2rem;
            color: #5a7152;
        }
        .vm-card ol li {
            margin-bottom: 0.5rem;
        }
        .footer-container{
            padding-top: 40px;
        }
        .footer-bottom{
            margin-top: 20px;
        }
        @keyframes scrollSponsors {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .sponsor-track:hover {
            animation-play-state: paused;
        }
        @media (max-width: 768px) {
            .history-grid {
                grid-template-columns: 1fr;
            }
            .history-image {
                order: -1;
            }
            .sponsor-track > div {
                width: 140px !important;
            }
            .sponsor-track > div > div {
                width: 80px; height: 80px; font-size: 1.5rem;
            }
        }
            @keyframes scrollSponsors {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .sponsor-track:hover {
        animation-play-state: paused;
    }
    .sponsor-track img{
        mix-blend-mode: multiply;
    }
    @media (max-width: 768px) {
        .sponsor-track > div {
            width: 140px !important;
        }
        .sponsor-track > div > div {
            width: 80px; height: 80px;
        }
        .sponsor-track img {
            max-width: 50px ; max-height: 50px ;
            mix-blend-mode: multiply;
        }
    }
        /* Di layar kecil (smartphone), card jadi horizontal scroll */
        @media (max-width: 768px) {
            .services-container {
                display: flex !important;
                overflow-x: auto;
                gap: 20px;
                padding-bottom: 20px;
                scroll-snap-type: x mandatory;
                /* Sembunyikan scrollbar */
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .services-container::-webkit-scrollbar {
                display: none;
            }
            .service-card {
                width: 80vw;
                min-width: 280px;
                max-width: 350px;
                scroll-snap-align: start;
            }
            .swipe-indicator {
                display: flex !important;
            }
        }
    </style>
</head>
<body>
    <!-- Navigasi -->
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
                    <li><a href="index.php"  class="active">Beranda</a></li>
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
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero" style="background-image: url('assets/images/hero1.jpeg');">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1>Khala' Hidroponik <br><span style="font-size: 45px;"> Kebun Ajaib Tanpa Tanah</span></h1>
            <p class="subhead">Menyediakan Sayur Hidroponik Segar dan Sehat. Beli sayur Bisa Panen Sendiri.</p>
            <div class="hero-buttons">
                <a href="produk.php" class="btn btn-primary"><i class="fas fa-shopping-basket"></i> Lihat Produk</a>
                <a href="berita.php" class="btn btn-outline"><i class="fas fa-newspaper"></i> Baca Berita</a>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="#fafdf7"></path>
            </svg>
        </div>
    </section>

    <!-- Sponsor & Mitra Slider -->
    <section style="padding: 50px 0; background: white; overflow: hidden;">
        <div class="container" style="text-align: center;">
            <h2 style="font-size: 2.5rem; color: #1b3b17; margin-bottom: 10px;">Sponsor & Mitra Kami</h2>
            <p style="color: #5a7152; margin-bottom: 35px;">Bersama mendukung pertanian hidroponik berkelanjutan</p>
        </div>
        <div style="position: relative; max-width: 100%; margin: 0 auto; overflow: hidden;" class="sponsor-slider-container">
            <div class="sponsor-track" style="display: flex; width: max-content; animation: scrollSponsors 30s linear infinite;">
                <?php
                $sponsors = [
                    ['name' => 'BRMP Sulbar',        'logo' => 'brmp-sulbar.png'],
                    ['name' => 'Kementerian Tenaga Kerja', 'logo' => 'kemnaker.png'],
                    ['name' => 'BLK Prov. Sulbar',   'logo' => 'blk-sulbar.png'],
                    ['name' => 'MBG',                'logo' => 'mbg.png'],
                    ['name' => 'UNIKA',              'logo' => 'unika.png'],
                    ['name' => 'UNIMAJU',            'logo' => 'unimaju.png'],
                    ['name' => 'TVRI',               'logo' => 'tvri.png'],
                    ['name' => 'RRI',                'logo' => 'rri.png'],
                ];
                // Duplikasi untuk efek infinite loop
                $logos = array_merge($sponsors, $sponsors);
                foreach ($logos as $sponsor):
                    $logoPath = 'assets/images/slider/' . $sponsor['logo'];
                    $fallbackIcon = 'fa-building'; // icon fallback jika gambar tidak ada
                ?>
                <div style="flex: 0 0 auto; width: 180px; padding: 15px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <div style="width: 80px; height: 80px; background: #f0f7ed; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; overflow: hidden;">
                        <?php if (file_exists($logoPath)): ?>
                            <img src="<?= $logoPath ?>" alt="<?= htmlspecialchars($sponsor['name']) ?>" 
                                style="max-width: 60px; max-height: 60px; object-fit: contain;">
                        <?php else: ?>
                            <i class="fas <?= $fallbackIcon ?>" style="font-size: 2rem; color: #2e7d32;"></i>
                        <?php endif; ?>
                    </div>
                    <span style="font-weight: 600; color: #1e2e1c; font-size: 0.9rem; text-align: center;"><?= htmlspecialchars($sponsor['name']) ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- Produk & Layanan Unggulan (dengan Swipe di Mobile) -->
    <section style="padding: 80px 0; background: linear-gradient(180deg, #ffffff 0%, #f7fbf5 100%); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -80px; right: -80px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(46,125,50,0.04) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
        <div style="position: absolute; bottom: -60px; left: -60px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(212,175,55,0.05) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>

        <div class="container" style="position: relative; z-index: 1;">
            <div style="text-align: center; margin-bottom: 60px;">
                <span style="display: inline-block; background: linear-gradient(135deg, #e8f5e9, #c8e6c9); color: #1b5e20; padding: 6px 20px; border-radius: 30px; font-size: 0.85rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px;">Layanan Kami</span>
                <h2 style="font-size: clamp(2rem, 5vw, 2.8rem); color: #1b3b17; margin-bottom: 8px; font-weight: 700;">Produk & Layanan Unggulan</h2>
                <div style="width: 60px; height: 3px; background: linear-gradient(90deg, #2e7d32, #a5d6a7); margin: 12px auto 16px; border-radius: 2px;"></div>
                <p style="color: #5a7152; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Solusi hidroponik lengkap untuk kebutuhan pangan sehat dan edukasi modern</p>
            </div>

            <!-- Container card: di desktop pakai grid, di mobile pakai flex horizontal scroll -->
            <div class="services-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 35px; scroll-behavior: smooth; -webkit-overflow-scrolling: touch;">
                <?php
                $services = [
                    [
                        'label' => 'Produk',
                        'title' => 'Tanaman Hidroponik Segar',
                        'desc'  => 'Dapatkan sayuran berkualitas premium, bebas pestisida, langsung panen dari greenhouse modern kami.',
                        'image' => 'assets/images/unggul/sayuran.jpeg',
                        'link'  => 'produk.php',
                        'btn_text' => 'Jelajahi Produk',
                        'btn_style' => 'primary',
                    ],
                    [
                        'label' => 'Pelatihan',
                        'title' => 'Vokasi & Pelatihan',
                        'desc'  => 'Program bersertifikat untuk pemula hingga mahir. Cocok untuk komunitas, sekolah, dan instansi.',
                        'image' => 'assets/images/img3.jpeg',
                        'link'  => 'https://wa.me/6281241330346?text=Halo%2C%20saya%20tertarik%20dengan%20program%20pelatihan%20hidroponik',
                        'btn_text' => 'Hubungi via WhatsApp',
                        'btn_style' => 'wa',
                    ],
                    [
                        'label' => 'Instalasi',
                        'title' => 'Sewa & Instalasi Alat',
                        'desc'  => 'Wujudkan kebun hidroponik impian Anda di rumah dengan layanan instalasi profesional kami.',
                        'image' => 'assets/images/unggul/sewa.webp',
                        'link'  => 'https://wa.me/6281241330346?text=Halo%2C%20saya%20ingin%20konsultasi%20sewa%20dan%20instalasi%20alat%20hidroponik',
                        'btn_text' => 'Konsultasi Sekarang',
                        'btn_style' => 'wa',
                    ]
                ];
                foreach ($services as $service):
                ?>
                <div class="service-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.04), 0 1px 0 rgba(0,0,0,0.02); transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); display: flex; flex-direction: column; border: 1px solid rgba(46,125,50,0.06); scroll-snap-align: start; flex-shrink: 0;"
                    onmouseover="this.style.transform='translateY(-12px)'; this.style.boxShadow='0 30px 60px rgba(0,0,0,0.08), 0 1px 0 rgba(0,0,0,0.02)'; this.style.borderColor='rgba(46,125,50,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.04), 0 1px 0 rgba(0,0,0,0.02)'; this.style.borderColor='rgba(46,125,50,0.06)';">
                    
                    <div style="position: relative; height: 220px; overflow: hidden;">
                        <img src="<?= $service['image'] ?>" alt="<?= htmlspecialchars($service['title']) ?>" 
                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                            onerror="this.onerror=null; this.src='assets/images/placeholder.jpg';"
                            onmouseover="this.style.transform='scale(1.05)';" 
                            onmouseout="this.style.transform='scale(1)';">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 60px; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);"></div>
                        <span style="position: absolute; top: 16px; left: 16px; background: rgba(255,255,255,0.9); backdrop-filter: blur(6px); color: #1b3b17; padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 0.5px; box-shadow: 0 4px 10px rgba(0,0,0,0.06);"><?= $service['label'] ?></span>
                    </div>

                    <div style="padding: 28px 26px 32px; text-align: left; flex: 1; display: flex; flex-direction: column;">
                        <h3 style="font-size: 1.4rem; color: #1b3b17; margin-bottom: 10px; font-weight: 700; line-height: 1.3;"><?= htmlspecialchars($service['title']) ?></h3>
                        <p style="color: #5a7152; line-height: 1.7; font-size: 0.95rem; margin-bottom: 24px; flex: 1;"><?= htmlspecialchars($service['desc']) ?></p>
                        
                        <?php if ($service['btn_style'] === 'wa'): ?>
                            <a href="<?= $service['link'] ?>" target="_blank" rel="noopener" 
                            style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: #25d366; color: white; padding: 14px 24px; border-radius: 10px; font-weight: 600; text-decoration: none; font-size: 0.95rem; transition: all 0.3s; box-shadow: 0 6px 18px rgba(37,211,102,0.3);"
                            onmouseover="this.style.background='#128c7e'; this.style.boxShadow='0 10px 25px rgba(18,140,126,0.35)'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.background='#25d366'; this.style.boxShadow='0 6px 18px rgba(37,211,102,0.3)'; this.style.transform='translateY(0)';">
                                <i class="fab fa-whatsapp" style="font-size: 1.2rem;"></i> <?= $service['btn_text'] ?>
                            </a>
                        <?php else: ?>
                            <a href="<?= $service['link'] ?>" 
                            style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: linear-gradient(135deg, #2e7d32, #1b5e20); color: white; padding: 14px 24px; border-radius: 10px; font-weight: 600; text-decoration: none; font-size: 0.95rem; transition: all 0.3s; box-shadow: 0 6px 18px rgba(46,125,50,0.3);"
                            onmouseover="this.style.background='linear-gradient(135deg, #1b5e20, #0d3b0f)'; this.style.boxShadow='0 10px 25px rgba(27,94,32,0.4)'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.background='linear-gradient(135deg, #2e7d32, #1b5e20)'; this.style.boxShadow='0 6px 18px rgba(46,125,50,0.3)'; this.style.transform='translateY(0)';">
                                <i class="fas fa-arrow-right"></i> <?= $service['btn_text'] ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Indikator geser (opsional, hanya muncul di mobile) -->
            <div class="swipe-indicator" style="display: none; justify-content: center; gap: 6px; margin-top: 24px;">
                <span style="width: 8px; height: 8px; background: #2e7d32; border-radius: 50%; opacity: 0.3;"></span>
                <span style="width: 8px; height: 8px; background: #2e7d32; border-radius: 50%; opacity: 0.3;"></span>
                <span style="width: 8px; height: 8px; background: #2e7d32; border-radius: 50%; opacity: 0.3;"></span>
            </div>
        </div>
    </section>

    <!-- Sejarah Usaha -->
    <section class="history-section">
        <div class="container">
            <div class="history-grid">
                <div class="history-content">
                    <h2>Sejarah Singkat Kami</h2>
                    <p><strong>Khala’ Hidroponik</strong> didirikan pada tanggal 20 Maret 2022 yang bermula dari sebuah kebun hidroponik skala rumahan dengan memanfaatkan rooftop yang tidak terpakai. Melihat tingginya permintaan sayuran segar berkualitas dan minat masyarakat terhadap sayuran hidroponik, Tahun 2025 <strong>khala’ hidroponik</strong> berkembang menjadi usaha komersial dan edukasi yang terintegrasi. Saat ini, khala’ hidroponik mengelola 320 m² area produksi dengan sistem NFT (Nutrient Film Technique) dan 12 m² area produksi benih.</p>
                    <p><strong>Khala’ hidroponik</strong> tidak hanya menghasilkan sayuran segar, tetapi juga berfungsi sebagai pusat edukasi dan ruang belajar hidup bagi berbagai kalangan. Sekolah-sekolah kerap menjadikannya destinasi eduwisata untuk field trip, di mana siswa dapat menyentuh langsung proses pertanian modern dan memahami prinsip sains seperti fotosintesis dan nutrisi tanaman. Para mahasiswa dari berbagai Perguruan Tinggi juga memanfaatkannya sebagai lokasi PKL dan penelitian untuk tugas akhir, menjembatani teori kampus dengan praktik lapangan. Khala’ hidroponik telah menjadi mitra strategis untuk program pemagangan kerja yang dicanangkan oleh Kementerian Tenaga Kerja (Kemnaker), khususnya dalam menyiapkan tenaga kerja terampil di sektor pertanian modern dan ekonomi hijau.</p>
                </div>
                <div class="history-image">
                    <img src="assets/images/logo/logo.jpeg" alt="Sejarah HidroponikCerdas">
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="vision-mission">
        <div class="container">
            <div class="section-header">
                <h2>Visi & Misi</h2>
                <p>Arah dan komitmen kami untuk masa depan pangan Indonesia</p>
            </div>
            <div class="vision-mission-grid">
                <div class="vm-card">
                    <div class="vm-icon"><i class="fas fa-eye"></i></div>
                    <h3>Visi</h3>
                    <p>Menjadi produsen sayuran segar dan sehat terdepan di Mamuju, sekaligus pusat pembelajaran pertanian modern yang menginspirasi seluruh lapisan masyarakat untuk bersama-sama mewujudkan ketahanan pangan lokal yang berkelanjutan.</p>
                </div>
                <div class="vm-card">
                    <div class="vm-icon"><i class="fas fa-bullseye"></i></div>
                    <h3>Misi</h3>
                    <ol>
                        <li><p>Memproduksi sayuran hidroponik bebas pestisida kimia dengan kualitas terbaik.</p></li>
                        <li><p>Menyediakan akses sayuran segar harian untuk keluarga Mamuju.</p></li>
                        <li><p>Menyelenggarakan program edukasi dan praktik yang inklusif dan aplikatif, seperti PKL, pelatihan, dan pemagangan, untuk semua lapisan masyarakat, dari pelajar, petani konvensional, hingga professional dalam menguasai teknologi pertanian modern.</p></li>
                        <li><p>Mengoptimalkan sumber daya lahan terbatas untuk hasil panen maksimal.</p></li>
                        <li><p>Menjadi mitra aktif pemerintah, institusi pendidikan, dan komunitas dalam mendorong gerakan kemandirian pangan melalui advokasi, pendampingan, dan penyediaan sarana praktik.</p></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Unggulan -->
    <?php if (!empty($featuredProducts)): ?>
    <section class="featured-products" style="background: #ffffff; padding: 60px 0;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 40px;">
                <h2 style="font-size: 2.5rem; color: #1b3b17;">Produk Unggulan Kami</h2>
                <p style="color: #5a7152; font-size: 1.1rem;">Sayuran hidroponik segar, sehat, dan bebas pestisida</p>
            </div>
            <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                <?php foreach ($featuredProducts as $product): ?>
                <div class="product-card" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 12px 24px rgba(0,0,0,0.06); transition: transform 0.3s ease, box-shadow 0.3s ease; display: flex; flex-direction: column;">
                    <div class="product-card-img" style="position: relative; height: 220px; overflow: hidden;">
                        <?php if ($product['image']): ?>
                            <img src="<?= htmlspecialchars(UPLOAD_URL . $product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s;">
                        <?php else: ?>
                            <img src="assets/images/placeholder.jpg" alt="Placeholder" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php endif; ?>
                        <?php if ($product['bulk_price'] < $product['price_per_unit']): ?>
                            <span style="position: absolute; top: 12px; left: 12px; background: #f39c12; color: white; padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Hemat Borongan</span>
                        <?php endif; ?>
                    </div>
                    <div style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                        <h3 style="margin: 0 0 8px; font-size: 1.3rem; color: #1b3b17;"><?= htmlspecialchars($product['name']) ?></h3>
                        <p style="color: #5a7152; font-size: 0.95rem; margin-bottom: 16px; flex: 1;"><?= htmlspecialchars($product['description']) ?></p>
                        <div style="display: flex; gap: 16px; margin-bottom: 18px; flex-wrap: wrap;">
                            <div>
                                <small style="color: #8ba888; text-transform: uppercase; font-weight: 600;">Eceran</small><br>
                                <strong style="font-size: 1.2rem; color: #2e7d32;">Rp <?= number_format($product['price_per_unit'], 0, ',', '.') ?></strong>
                            </div>
                            <div>
                                <small style="color: #8ba888; text-transform: uppercase; font-weight: 600;">Borongan</small><br>
                                <strong style="font-size: 1.2rem; color: #e67e22;">Rp <?= number_format($product['bulk_price'], 0, ',', '.') ?></strong>
                                <small style="color: #8ba888;">/ min <?= $product['bulk_min_qty'] ?></small>
                            </div>
                        </div>
                        <a href="https://wa.me/6281241330346?text=Halo%2C%20saya%20tertarik%20beli%20<?= urlencode($product['name']) ?>" target="_blank" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #25d366; color: white; padding: 12px; border-radius: 50px; font-weight: 600; text-decoration: none; margin-top: auto; transition: background 0.2s;">
                            <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="produk.php" style="display: inline-flex; align-items: center; gap: 8px; background: #2e7d32; color: white; padding: 14px 32px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: background 0.2s;">
                    <i class="fas fa-th-list"></i> Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Future Farming -->
    <section class="future-farming">
        <div class="container future-container">
            <div class="future-text">
                <h2>Masa Depan Pertanian Berkelanjutan</h2>
                <p>Hidroponik adalah solusi hemat lahan dan air. Kami menerapkan teknologi ini untuk menghasilkan sayuran berkualitas tinggi sepanjang tahun.</p>
                <ul class="future-features">
                    <li><i class="fas fa-check-circle"></i> Tanpa pestisida berbahaya</li>
                    <li><i class="fas fa-check-circle"></i> Hemat air hingga 90%</li>
                    <li><i class="fas fa-check-circle"></i> Dapat diterapkan di lahan sempit</li>
                </ul>
            </div>
            <div class="future-image">
                <img src="assets/images/future-farming.jpg" alt="Hidroponik Modern">
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

    <!-- Berita -->
    <section class="knowledge-tools">
        <div class="container">
            <div class="section-header">
                <h2>Pengetahuan & Alat untuk Pertanian Cerdas</h2>
                <p>Artikel dan panduan terbaru seputar hidroponik</p>
            </div>
            <div class="card-grid">
                <?php foreach ($latestNews as $news): ?>
                <article class="card">
                    <div class="card-img">
                        <?php if ($news['image']): ?>
                            <img src="<?= htmlspecialchars(UPLOAD_URL . $news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>">
                        <?php else: ?>
                            <img src="assets/images/placeholder.jpg" alt="Placeholder">
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="card-meta">
                            <span><i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($news['created_at'])) ?></span>
                        </div>
                        <h3><?= htmlspecialchars($news['title']) ?></h3>
                        <p><?= htmlspecialchars($news['excerpt']) ?>...</p>
                        <a href="detail.php?id=<?= $news['id'] ?>" class="read-more">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <div class="text-center">
                <a href="berita.php" class="btn btn-secondary"><i class="fas fa-newspaper"></i> Lihat Semua Berita</a>
            </div>
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
                    // Deteksi apakah link ini adalah pembuka dropdown di mobile
                    const isDropdownToggle = (
                        window.innerWidth <= 768 &&
                        link.parentElement?.classList.contains('dropdown') &&
                        link.getAttribute('href') === 'javascript:void(0)'
                    );
                    
                    if (isDropdownToggle) {
                        return; // Jangan tutup menu mobile
                    }
                    
                    // Untuk semua link lain, tutup menu mobile
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
                
                // Tutup semua dropdown lain
                closeAllDropdowns();
                
                // Buka dropdown ini jika belum aktif
                if (!isActive) {
                    parentDropdown.classList.add('active');
                }
            });
        });
        
        // Klik di luar dropdown akan menutup semua dropdown
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                closeAllDropdowns();
            }
        });
        
        // Mencegah klik di dalam dropdown menu menutup dropdown
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
        
        // Smooth scroll untuk anchor link
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === "#") return;
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