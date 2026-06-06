<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Sertifikasi & Legalitas - Khala' Hidroponik</title>
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
        /* Hero */
        .hero-sertif {
            background-image: url('assets/images/logo/imgmitra.jpeg');
            background-position: center;
            background-size: cover; 
            color: white;
            padding: 5rem 0;
            text-align: center;
            border-radius: 0 0 40px 40px;
            margin-bottom: 3rem;
        }
        .hero-sertif h1 {
            font-size: 2.8rem;
            background-color: green;
            border-radius: 10px;
            padding: 5px 0;
            width: 50%;
            margin: 0px auto 1rem;
        }
        .hero-sertif p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 12rem;
            background-color: green;
            border-radius: 5px;
            padding: 5px 0;
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .cert-card {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border: 1px solid #eef3ea;
            text-align: center;
        }
        .cert-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 40px rgba(0,0,0,0.1);
        }
        .cert-icon {
            font-size: 3rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        .cert-card h3 {
            color: #1b3b17;
            margin-bottom: 0.5rem;
        }
        .cert-badge {
            display: inline-block;
            background: #e8f5e9;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            color: #2e7d32;
            margin-top: 1rem;
        }
        .achievement-list {
            list-style: none;
        }
        .achievement-list li {
            padding: 1rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid #e2ecd9;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .gallery-item {
            background: #f9fdf7;
            border-radius: 20px;
            padding: 1rem;
            text-align: center;
            border: 1px solid #e2ecd9;
            transition: 0.2s;
        }
        .gallery-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 0.5rem;
        }
        .btn-lightbox {
            background: #2e7d32;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 0.5rem;
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
            .hero-sertif h1 { font-size: 2rem; }
            .section-title { font-size: 1.6rem; }
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
                    <li><a href="sertifikasi.php"  class="active">Perizinan & Kemitraan</a></li>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

<section class="hero-sertif">
    <div class="container">
        <h1> Perizinan & Kemitraan</h1>
        <p>Komitmen kami terhadap standar mutu, legalitas usaha, dan pencapaian terbaik</p>
    </div>
</section>

<div class="container">
    <!-- Perizinan Usaha -->
    <section class="section">
        <h2 class="section-title">📜 Perizinan dan Serifikat Usaha</h2>
        <div class="grid-2">
            <div class="cert-card">
                <!-- <div class="cert-icon"><i class="fas fa-building"></i></div> -->
                <!-- <h3>NIB (Nomor Induk Berusaha)</h3> -->
                <p>Perizinan Berusaha Berbasis Risiko dari Menteri Investasi/Kepala BKPM Tahun 2023</p>
                <span class="cert-badge">Aktif & Terdaftar</span>
            </div>
            <div class="cert-card">
                <!-- <div class="cert-icon"><i class="fas fa-trademark"></i></div> -->
                <h3>Sertifikat Merek</h3>
                <p>Terdaftar di Kementerian Hukum dan HAM RI Tahun 2023</p>
                <span class="cert-badge">Hak Kekayaan Intelektual</span>
            </div>
        </div>
    </section>

    <!-- Sertifikat Pencapaian & Kemitraan -->
    <section class="section">
        <h2 class="section-title">🏆 Kemitraan</h2>
        <div class="grid-2">
            <div class="cert-card">
                <div class="cert-icon"><i class="fas fa-graduation-cap"></i></div>
                <h3>Mitra Pemagangan Kemnaker</h3>
                <p>Program Pemagangan Kerja Kementerian Tenaga Kerja RI - 2024</p>
                <span class="cert-badge">30+ Alumni Magang</span>
            </div>
            <div class="cert-card">
                <div class="cert-icon"><i class="fas fa-university"></i></div>
                <h3>Mitra Praktik & Penelitian</h3>
                <p>Kerjasama dengan UNIKA, UNIMAJU, UNSULBAR, UNHAS</p>
                <span class="cert-badge">Pusat Penelitian Hidroponik</span>
            </div>
            <div class="cert-card">
                <div class="cert-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h3>Mitra Lembaga Keagamaan, TNI & Polri serta Instansi Pemerintah</h3>
                <p>Program pendampingan kebun hidroponik komunitas</p>
                <span class="cert-badge">Kemandirian Pangan Berbasis Komunitas</span>
            </div>
            <div class="cert-card">
                <div class="cert-icon"><i class="fas fa-leaf"></i></div>
                <h3>Mitra Pelatihan Vokasi</h3>
                <p>Sebagai mitra pelatihan vokasi dengan balai latihan kerja (BLK) provinsi sulawesi barat.</p>
                <span class="cert-badge">mitra pelatiahan vokasi oleh BLK</span>
            </div>
    		<div class="cert-card">
                <div class="cert-icon"><i class="fas fa-leaf"></i></div>
                <h3>Edukasi Lingkungan</h3>
                <p>Sebagai pusat eduwisata, edukasi, penelitian dan pelatihan pertanian modern.</p>
                <span class="cert-badge">Destinasi Field Trip Sekolah dan Kampus</span>
            </div>
    		<div class="cert-card">
                <div class="cert-icon"><i class="fas fa-leaf"></i></div>
                <h3>Mitra Pendampingan Petani</h3>
                <p>Menjadi mitra yang memberikan pelatihan dan pendampingan kepada petani.</p>
                <span class="cert-badge">Pelatihan dan Pendampingan ke Petani</span>
            </div>
        </div>
    </section>

    <!-- Daftar Lengkap Legalitas & Pencapaian -->
    <section class="section">
        <h2 class="section-title">✅ Legalitas & Pencapaian Lainnya</h2>
        <ul class="achievement-list">
            <li><i class="fas fa-check-circle" style="color:#2e7d32; font-size:1.4rem;"></i> <strong>Perizinan Berusaha Berbasis Risiko</strong> - Menteri Investasi (2023)</li>
            <li><i class="fas fa-check-circle" style="color:#2e7d32; font-size:1.4rem;"></i> <strong>Sertifikat Merek</strong> - Kemenkumham (2023)</li>
            <li><i class="fas fa-check-circle" style="color:#2e7d32; font-size:1.4rem;"></i> <strong>30 Alumni Magang</strong> - BLK Provinsi Sulawesi Barat & Kemnaker</li>
            <li><i class="fas fa-check-circle" style="color:#2e7d32; font-size:1.4rem;"></i> <strong>Mitra Praktik Mahasiswa</strong> - UNIKA, UNIMAJU, UNSULBAR, UNHAS</li>
            <li><i class="fas fa-check-circle" style="color:#2e7d32; font-size:1.4rem;"></i> <strong>Program Edukasi TK & SD</strong> - Kunjungan rutin eduwisata</li>
            <li><i class="fas fa-check-circle" style="color:#2e7d32; font-size:1.4rem;"></i> <strong>Mitra Komunitas Keagamaan</strong> - Pengembangan kebun hidroponik mandiri</li>
            <li><i class="fas fa-check-circle" style="color:#2e7d32; font-size:1.4rem;"></i> <strong>Lokasi Penelitian Skripsi</strong> - 2 mahasiswa berhasil menyelesaikan tugas akhir</li>
            <li><i class="fas fa-check-circle" style="color:#2e7d32; font-size:1.4rem;"></i> <strong>Mitra Kementrian Tenaga Kerja</strong>- Program Pemagangan lulusan perguruan tinggi. </li>
        </ul>
    </section>

    <!-- Galeri Sertifikat (Placeholder - bisa diganti gambar asli) -->
    <!-- <section class="section">
        <h2 class="section-title">🖼️ Galeri Sertifikat</h2>
        <div class="gallery">
            <div class="gallery-item">
                <img src="https://placehold.co/400x300/e8f5e9/2e7d32?text=NIB" alt="NIB">
                <p><strong>NIB & Legalitas</strong></p>
                <button class="btn-lightbox" onclick="alert('Foto sertifikat NIB akan segera diunggah')">Lihat Detail</button>
            </div>
            <div class="gallery-item">
                <img src="https://placehold.co/400x300/e8f5e9/2e7d32?text=Merek" alt="Sertifikat Merek">
                <p><strong>Sertifikat Merek HKI</strong></p>
                <button class="btn-lightbox" onclick="alert('Foto sertifikat merek akan segera diunggah')">Lihat Detail</button>
            </div>
            <div class="gallery-item">
                <img src="https://placehold.co/400x300/e8f5e9/2e7d32?text=Magang" alt="Mitra Kemnaker">
                <p><strong>Sertifikat Mitra Pemagangan</strong></p>
                <button class="btn-lightbox" onclick="alert('Foto sertifikat kemitraan magang akan segera diunggah')">Lihat Detail</button>
            </div>
            <div class="gallery-item">
                <img src="https://placehold.co/400x300/e8f5e9/2e7d32?text=Penelitian" alt="Mitra PT">
                <p><strong>Kerjasama Perguruan Tinggi</strong></p>
                <button class="btn-lightbox" onclick="alert('Foto MoU dengan PT akan segera diunggah')">Lihat Detail</button>
            </div>
        </div>
        <p style="text-align:center; margin-top:1rem; color:#5a7152;">*Dokumen asli sertifikat dapat dilihat langsung di lokasi kebun kami</p>
    </section> -->

    <!-- Call to Action -->
    <!-- <section style="background: linear-gradient(120deg, #e8f5e9, #c8e6c9); border-radius: 32px; padding: 3rem; text-align: center; margin: 2rem 0;">
        <h3 style="color: #1b3b17; font-size: 1.8rem;">Ingin melihat bukti legalitas kami?</h3>
        <p style="margin: 1rem 0;">Kami terbuka untuk verifikasi dokumen perizinan dan sertifikat secara langsung.</p>
        <a href="#contact" style="background: #2e7d32; color: white; padding: 0.8rem 2rem; border-radius: 40px; text-decoration: none; display: inline-block;">Hubungi Kami</a>
    </section> -->
</div>

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
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            mainNav.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
        // Tutup menu saat link diklik (kecuali dropdown toggle di mobile)
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
    // Dropdown klik
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