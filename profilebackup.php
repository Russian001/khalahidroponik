<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Profil Khala' Hidroponik - Pertanian Modern Mamuju</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ===== GLOBAL & RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            overflow-x: hidden;
            width: 100%;
            scroll-behavior: smooth;
            background: #fefef7;
        }
        body {
            padding-top: 80px;
            font-family: 'Segoe UI', 'Poppins', system-ui, -apple-system, sans-serif;
        }
        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            z-index: 1000;
            padding: 0.8rem 0;
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
            color: #1b3b17;
        }
        .logo span {
            font-weight: normal;
            color: #2e7d32;
        }
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }
        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: #1b3b17;
            border-radius: 3px;
            transition: 0.3s;
        }
        nav ul {
            display: flex;
            gap: 1.8rem;
            list-style: none;
            align-items: center;
        }
        nav ul li a {
            text-decoration: none;
            color: #2c5e2a;
            font-weight: 500;
            transition: 0.2s;
        }
        nav ul li a:hover {
            color: #1b3b17;
        }
        /* Dropdown style klik (vertikal) */
        .dropdown {
            position: relative;
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 220px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            border-radius: 16px;
            padding: 0.5rem 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s ease;
            z-index: 1001;
            list-style: none;
        }
        .dropdown.active .dropdown-menu {
            opacity: 1;
            visibility: visible;
        }
        .dropdown-menu li {
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
            .mobile-menu-toggle {
                display: flex;
            }
            nav {
                position: fixed;
                top: 0;
                right: 0;
                width: 80%;
                max-width: 320px;
                height: 100vh;
                background: white;
                box-shadow: -10px 0 30px rgba(0,0,0,0.1);
                padding: 6rem 2rem 2rem;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                z-index: 999;
                overflow-y: auto;
            }
            nav.active {
                transform: translateX(0);
            }
            nav ul {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.2rem;
            }
            .dropdown-menu {
                position: static;
                box-shadow: none;
                background: #f8f9fa;
                display: none;
                opacity: 1;
                visibility: visible;
                padding-left: 1rem;
            }
            .dropdown.active .dropdown-menu {
                display: block;
            }
        }
        /* Container */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        /* Hero profil */
        .profile-hero {
            background: linear-gradient(135deg, #e0f2e0 0%, #c8e6c9 100%);
            border-radius: 0 0 40px 40px;
            padding: 3rem 0;
            margin-bottom: 2rem;
            text-align: center;
        }
        .profile-hero h1 {
            font-size: 3rem;
            color: #1b3b17;
            margin-bottom: 0.5rem;
        }
        .profile-hero p {
            font-size: 1.2rem;
            color: #2e5c2a;
        }
        /* Section umum */
        .section {
            padding: 4rem 0;
            border-bottom: 1px solid #e2ecd9;
        }
        .section:last-child {
            border-bottom: none;
        }
        .section-title {
            font-size: 2.2rem;
            color: #1b3b17;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 70px;
            height: 4px;
            background: #2e7d32;
            border-radius: 2px;
        }
        /* Grid & kartu */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .info-card {
            background: white;
            border-radius: 24px;
            padding: 1.8rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            transition: all 0.3s ease;
            border: 1px solid #e2ecd9;
        }
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px rgba(0,0,0,0.08);
        }
        .info-card i {
            font-size: 2.2rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        .info-card strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #1b3b17;
        }
        /* Timeline sejarah */
        .timeline {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            position: relative;
            padding-left: 2rem;
        }
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            border-left: 3px solid #a5d6a7;
        }
        .timeline-year {
            font-weight: bold;
            font-size: 1.3rem;
            color: #2e7d32;
            margin-bottom: 0.3rem;
        }
        /* Produk grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.8rem;
            margin-top: 2rem;
        }
        .product-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            transition: 0.2s;
            border: 1px solid #eef3ea;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        }
        .product-card i {
            font-size: 2.5rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        .product-card h4 {
            color: #1b3b17;
            margin-bottom: 0.5rem;
        }
        /* Pencapaian */
        .achievement-list {
            list-style: none;
        }
        .achievement-list li {
            padding: 0.8rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px dashed #d4e2cc;
        }
        .achievement-list li i {
            color: #2e7d32;
            width: 28px;
            font-size: 1.2rem;
        }
        /* Struktur organisasi */
        .org-chart {
            background: #f4f9f0;
            border-radius: 32px;
            padding: 2rem;
            text-align: center;
            margin-top: 1rem;
        }
        .org-level {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            margin: 1.5rem 0;
        }
        .org-card {
            background: white;
            border-radius: 20px;
            padding: 1rem 1.8rem;
            min-width: 180px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .org-card .title {
            font-weight: bold;
            color: #1b3b17;
            font-size: 1.1rem;
        }
        .org-card .name {
            color: #2e7d32;
            margin-top: 0.3rem;
        }
        /* Gambar ilustrasi */
        .img-float {
            border-radius: 30px;
            width: 100%;
            object-fit: cover;
            box-shadow: 0 20px 30px -10px rgba(0,0,0,0.1);
        }
        .flex-image {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
        .flex-image > div {
            flex: 1;
        }
        /* Footer */
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
        .footer-container h4 {
            color: white;
            margin-bottom: 1rem;
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
            .container { padding: 0 1.5rem; }
            .profile-hero h1 { font-size: 2rem; }
            .section-title { font-size: 1.8rem; }
            .flex-image { flex-direction: column; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo"><strong>Khala'</strong><span>Hidroponik</span></a>
            <button class="mobile-menu-toggle" id="menuToggle" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
            <nav id="mainNav">
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)">Profil <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#profil-usaha">Profil Usaha</a></li>
                            <li><a href="#sejarah">Sejarah</a></li>
                            <li><a href="#struktur">Struktur Organisasi</a></li>
                            <li><a href="#visi-misi">Visi & Misi</a></li>
                            <li><a href="#gambaran">Gambaran Usaha</a></li>
                            <li><a href="#produk">Produk Unggulan</a></li>
                            <li><a href="#keunggulan">Keunggulan & Nilai Jual</a></li>
                            <li><a href="#layanan">Layanan Professional</a></li>
                            <li><a href="#target">Target Pasar</a></li>
                            <li><a href="#penjualan">Sistem Penjualan</a></li>
                            <li><a href="#potensi">Potensi & Tantangan</a></li>
                            <li><a href="#perizinan">Perizinan & Pencapaian</a></li>
                            <li><a href="#penutup">Penutup</a></li>
                        </ul>
                    </li>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="berita.php">Berita</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Profil -->
    <section class="profile-hero">
        <div class="container">
            <h1>🍃 Khala' Hidroponik</h1>
            <p>Kebun Ajaib Tanpa Tanah • Pertanian Modern Mamuju</p>
        </div>
    </section>

    <div class="container">
        <!-- Profil Usaha dengan gambar -->
        <section id="profil-usaha" class="section">
            <div class="flex-image">
                <div>
                    <h2 class="section-title">Profil Usaha</h2>
                    <div class="grid-2" style="margin-top: 1.5rem;">
                        <div class="info-card"><i class="fas fa-store"></i><strong>Nama Usaha</strong>Khala' Hidroponik</div>
                        <div class="info-card"><i class="fas fa-calendar-alt"></i><strong>Berdiri Sejak</strong>20 Maret 2022</div>
                        <div class="info-card"><i class="fas fa-map-marker-alt"></i><strong>Lokasi</strong>Jl. Soekarno Hatta, Kelurahan Karema, Kecamatan Mamuju, Kabupaten Mamuju, Sulawesi Barat.</div>
                        <div class="info-card"><i class="fas fa-user"></i><strong>Pemilik</strong>Religius Heryanto, S.ST</div>
                        <div class="info-card"><i class="fas fa-phone-alt"></i><strong>Kontak</strong>081241330346 / Khala' Hidroponik (Instagram, FB, TikTok)</div>
                    </div>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=500&h=400&fit=crop" alt="Kebun Hidroponik" class="img-float">
                </div>
            </div>
        </section>

        <!-- Sejarah lengkap (tidak diringkas) -->
        <section id="sejarah" class="section">
            <h2 class="section-title">Sejarah Singkat</h2>
            <div class="flex-image">
                <div>
                    <p style="line-height:1.8; margin-bottom:1rem;">Khala' Hidroponik didirikan pada tanggal 20 Maret 2022 yang bermula dari sebuah kebun hidroponik skala rumahan dengan memanfaatkan rooftop yang tidak terpakai. Melihat tingginya permintaan sayuran segar berkualitas dan minat masyarakat terhadap sayuran hidroponik, Tahun 2025 khala' hidroponik berkembang menjadi usaha komersial dan edukasi yang terintegrasi. Saat ini, khala' hidroponik mengelola 320 m² area produksi dengan sistem NFT (Nutrient Film Technique) dan 12 m² area produksi benih.</p>
                    <p style="line-height:1.8;">Khala' hidroponik tidak hanya menghasilkan sayuran segar, tetapi juga berfungsi sebagai pusat edukasi dan ruang belajar hidup bagi berbagai kalangan. Sekolah-sekolah kerap menjadikannya destinasi eduwisata untuk field trip, di mana siswa dapat menyentuh langsung proses pertanian modern dan memahami prinsip sains seperti fotosintesis dan nutrisi tanaman. Para mahasiswa dari berbagai Perguruan Tinggi juga memanfaatkannya sebagai lokasi PKL dan penelitian untuk tugas akhir, menjembatani teori kampus dengan praktik lapangan. Khala' hidroponik telah menjadi mitra strategis untuk program pemagangan kerja yang dicanangkan oleh Kementerian Tenaga Kerja (Kemnaker), khususnya dalam menyiapkan tenaga kerja terampil di sektor pertanian modern dan ekonomi hijau.</p>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1589923188653-9e43bbd0d3d7?w=500&h=350&fit=crop" alt="Hidroponik Modern" class="img-float">
                </div>
            </div>
        </section>

        <!-- Struktur Organisasi (ditambahkan kembali) -->
        <section id="struktur" class="section">
            <h2 class="section-title">Struktur Organisasi</h2>
            <div class="org-chart">
                <div class="org-level">
                    <div class="org-card"><div class="title">Pemilik / Direktur</div><div class="name">Religius Heryanto, S.ST</div></div>
                </div>
                <div class="org-level">
                    <div class="org-card"><div class="title">Kepala Operasional</div><div class="name">Andi Saputra</div></div>
                    <div class="org-card"><div class="title">Kepala Divisi Produksi</div><div class="name">Nurul Hidayah</div></div>
                    <div class="org-card"><div class="title">Kepala Edukasi & Pemasaran</div><div class="name">Muhammad Faizal</div></div>
                </div>
                <p style="margin-top: 1.5rem; color: #3a5e36;">Tim didukung oleh staf produksi, teknisi hidroponik, dan fasilitator edukasi.</p>
            </div>
        </section>

        <!-- Visi & Misi lengkap -->
        <section id="visi-misi" class="section">
            <h2 class="section-title">Visi & Misi</h2>
            <div class="grid-2">
                <div class="info-card" style="background: linear-gradient(145deg, #f4faf0, white);">
                    <i class="fas fa-eye" style="font-size: 2rem;"></i>
                    <h3 style="margin: 1rem 0 0.5rem;">Visi</h3>
                    <p>Menjadi produsen sayuran segar dan sehat terdepan di Mamuju, sekaligus pusat pembelajaran pertanian modern yang menginspirasi seluruh lapisan masyarakat untuk bersama-sama mewujudkan ketahanan pangan lokal yang berkelanjutan.</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-bullseye"></i>
                    <h3 style="margin: 1rem 0 0.5rem;">Misi</h3>
                    <ol style="margin-left: 1.2rem; color: #3a4d35;">
                        <li>Memproduksi sayuran hidroponik bebas pestisida kimia dengan kualitas terbaik.</li>
                        <li>Menyediakan akses sayuran segar harian untuk keluarga Mamuju.</li>
                        <li>Menyelenggarakan program edukasi dan praktik yang inklusif dan aplikatif, seperti PKL, pelatihan, dan pemagangan, untuk semua lapisan masyarakat, dari pelajar, petani konvensional, hingga professional dalam menguasai teknologi pertanian modern.</li>
                        <li>Mengoptimalkan sumber daya lahan terbatas untuk hasil panen maksimal.</li>
                        <li>Menjadi mitra aktif pemerintah, institusi pendidikan, dan komunitas dalam mendorong gerakan kemandirian pangan melalui advokasi, pendampingan, dan penyediaan sarana praktik.</li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- Gambaran Usaha lengkap -->
        <section id="gambaran" class="section">
            <h2 class="section-title">Gambaran Usaha</h2>
            <div class="flex-image">
                <div>
                    <p style="line-height:1.8;">Khala' Hidroponik merupakan usaha pertanian modern berbasis urban farming yang berfokus pada budidaya berbagai jenis sayuran daun dengan menggunakan sistem hidroponik. Berlokasi di tengah Kota Mamuju, usaha ini hadir sebagai solusi atas keterbatasan lahan perkotaan sekaligus mendukung ketersediaan sayuran segar yang dibudidayakan secara higienis, sehat, dan ramah lingkungan. Melalui penerapan teknologi hidroponik, sayuran yang dihasilkan lebih bersih, berkualitas, serta minim risiko kontaminasi tanah dan penggunaan pestisida berbahaya.</p>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1592417817098-8fd3f2c1d98b?w=500&h=300&fit=crop" alt="Urban farming" class="img-float">
                </div>
            </div>
        </section>

        <!-- Produk Unggulan (lengkap) -->
        <section id="produk" class="section">
            <h2 class="section-title">🌿 Produk Unggulan</h2>
            <div class="product-grid">
                <div class="product-card"><i class="fas fa-leaf"></i><h4>Selada Keriting</h4><p>Untuk lalapan, salad, burger, kebab, gado-gado dan jus.</p></div>
                <div class="product-card"><i class="fas fa-seedling"></i><h4>Pakcoy / Sawi Sendok</h4><p>Produk utama dengan batang renyah dan daun hijau segar.</p></div>
                <div class="product-card"><i class="fas fa-water"></i><h4>Kangkung Hidroponik</h4><p>Tumbuh bersih, batang putih, dan daun hijau.</p></div>
                <div class="product-card"><i class="fas fa-heart"></i><h4>Bayam</h4><p>Daun lebar dan tebal.</p></div>
                <div class="product-card"><i class="fas fa-spa"></i><h4>Seledri</h4><p>Aromatik, untuk penyedap masakan.</p></div>
                <div class="product-card"><i class="fas fa-box"></i><h4>Paket Bulanan Sayur Segar</h4><p>Langganan untuk rumah tangga, UMKM, cafe, SPPG, Frozen Food, dan pasar lokal.</p></div>
                <div class="product-card"><i class="fas fa-tools"></i><h4>Starter Kit Hidroponik Sederhana</h4><p>Untuk masyarakat yang ingin belajar mandiri.</p></div>
                <div class="product-card"><i class="fas fa-phone-alt"></i><h4>Hidroponik Portable</h4><p>Penggunaannya fleksibel untuk pameran, seminar, workshop, bazar, acara perkantoran, kegiatan komunitas dan edukasi lingkungan.</p></div>
                <div class="product-card"><i class="fas fa-chalkboard-user"></i><h4>Tempat edukasi dan ruang belajar hidup</h4><p>Pusat edukasi dan ruang belajar hidup bagi berbagai kalangan.</p></div>
            </div>
        </section>

        <!-- Keunggulan & Nilai Jual (lengkap) -->
        <section id="keunggulan" class="section">
            <h2 class="section-title">⭐ Keunggulan & Nilai Jual</h2>
            <div class="grid-2">
                <div class="info-card"><i class="fas fa-heartbeat"></i><strong>SEHAT</strong>Bebas pestisida kimia, menggunakan nutrisi yang terkontrol.</div>
                <div class="info-card"><i class="fas fa-snowflake"></i><strong>SEGAR</strong>Dipanen sesuai pesanan (on-demand), memastikan kesegaran maksimal sampai ke konsumen.</div>
                <div class="info-card"><i class="fas fa-hand-sparkles"></i><strong>BERSIH</strong>Ditanam tanpa tanah, bebas dari polusi, kotoran dan ulat.</div>
                <div class="info-card"><i class="fas fa-globe"></i><strong>RAMAH LINGKUNGAN</strong>Menggunakan air secara efisien (hemat air hingga 90% dibanding pertanian konvensional) dan meminimalkan runoff pupuk.</div>
                <div class="info-card"><i class="fas fa-map-pin"></i><strong>LOKAL</strong>"Dari Kebun Mamuju untuk Mamuju", mengurangi jejak karbon dari transportasi sayuran luar daerah.</div>
                <div class="info-card"><i class="fas fa-chalkboard-user"></i><strong>EDUKATIF</strong>Terbuka untuk kunjungan edukasi dari sekolah-sekolah, perguruan tinggi, instansi pemerintah, komunitas, petani/kelompok tani atau masyarakat umum.</div>
            </div>
        </section>

        <!-- Layanan Professional (lengkap) -->
        <section id="layanan" class="section">
            <h2 class="section-title">🤝 Layanan Professional</h2>
            <div class="grid-2">
                <div class="info-card">
                    <i class="fas fa-graduation-cap"></i>
                    <strong>Layanan Eduwisata, Edukasi, Penelitian, Pelatihan, dan Pemagangan Pertanian Modern</strong>
                    <p>Khala' Hidroponik hadir bukan hanya sebagai tempat budidaya sayuran sehat dan segar, tetapi juga sebagai ruang belajar pertanian modern yang terbuka untuk berbagai kalangan. Kami menghadirkan konsep hidroponik yang edukatif, inovatif, dan ramah lingkungan sebagai sarana pembelajaran sekaligus pengalaman langsung mengenal teknologi pertanian masa kini.</p>
                    <p>Melalui program eduwisata, pengunjung dapat melihat secara langsung proses budidaya hidroponik, mulai dari penyemaian, perawatan tanaman, hingga panen. Kegiatan ini sangat cocok untuk siswa sekolah, mahasiswa, komunitas, maupun masyarakat umum yang ingin menambah wawasan tentang pertanian modern secara menyenangkan dan interaktif.</p>
                    <p>Khala' Hidroponik juga menjadi tempat pelaksanaan praktik kerja lapangan (PKL), penelitian, pelatihan, dan pemagangan bagi pelajar serta mahasiswa dari berbagai institusi pendidikan. Sebagai bagian dari dukungan terhadap pengembangan sumber daya manusia di sektor pertanian, Khala' Hidroponik turut membuka peluang kolaborasi dengan sekolah, perguruan tinggi, instansi, maupun lembaga pelatihan dalam menciptakan generasi muda yang kreatif, mandiri, dan siap menghadapi perkembangan pertanian berkelanjutan di masa depan.</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-leaf"></i>
                    <strong>Layanan Penyewaan Hidroponik Portable untuk Event Modern, Estetik, Edukatif, dan Ramah Lingkungan</strong>
                    <p>Menyediakan layanan penyewaan hidroponik portable yang praktis, modern, dan estetik, sehingga sangat cocok digunakan untuk berbagai jenis kegiatan dan acara. Hidroponik portable ini dapat menjadi pilihan dekorasi sekaligus sarana edukasi yang menarik, baik untuk kegiatan formal maupun nonformal. Penggunaannya sangat fleksibel dan dapat disesuaikan dengan kebutuhan acara, mulai dari pameran, seminar, workshop, bazar, kegiatan promosi, acara perkantoran, hingga kegiatan komunitas dan edukasi lingkungan.</p>
                    <p>Dengan desain yang rapi dan mudah dipindahkan, hidroponik portable kami sangat cocok digunakan pada kegiatan indoor maupun outdoor. Selain memberikan kesan hijau, segar, dan modern pada lokasi acara, instalasi hidroponik ini juga mampu menciptakan suasana yang lebih nyaman, menarik, dan bernilai edukatif bagi para pengunjung atau peserta kegiatan.</p>
                </div>
            </div>
        </section>

        <!-- Target Pasar (lengkap) -->
        <section id="target" class="section">
            <h2 class="section-title">🎯 Target Pasar</h2>
            <div class="grid-2">
                <div class="info-card"><i class="fas fa-home"></i><strong>Rumah Tangga</strong>Keluarga sadar kesehatan di Mamuju.</div>
                <div class="info-card"><i class="fas fa-utensils"></i><strong>Pelaku Usaha Kuliner</strong>UMKM, Restoran, MBG, cafe, Frozen Food, warung makan, hotel, pasar lokal dan catering yang membutuhkan pasokan sayuran berkualitas dan konsisten.</div>
                <div class="info-card"><i class="fas fa-store"></i><strong>Pasar Modern & Toko Sayur</strong>Menjadi supplier untuk toko-toko sayur segar.</div>
                <div class="info-card"><i class="fas fa-hospital"></i><strong>Institusi</strong>Sekolah, kantor pemerintah, dan rumah sakit.</div>
                <div class="info-card"><i class="fas fa-hand-peace"></i><strong>Komunitas & Individu</strong>Yang tertarik pada gaya hidup sehat dan urban farming.</div>
            </div>
        </section>

        <!-- Sistem Penjualan & Distribusi (lengkap) -->
        <section id="penjualan" class="section">
            <h2 class="section-title">📦 Sistem Penjualan & Distribusi</h2>
            <div class="grid-2">
                <div class="info-card"><i class="fab fa-whatsapp"></i><strong>Pre-Order via WhatsApp/Instagram</strong>Sistem utama, memastikan panen sesuai permintaan.</div>
                <div class="info-card"><i class="fas fa-store"></i><strong>Penjualan Langsung di Lokasi Kebun</strong>Pada jam tertentu.</div>
                <div class="info-card"><i class="fas fa-truck"></i><strong>Kerjasama dengan Kurir Lokal</strong>Untuk pengantaran dalam kota Mamuju.</div>
                <div class="info-card"><i class="fas fa-handshake"></i><strong>Penitipan di Titik Jemput</strong>Misalnya di gerai atau tempat strategis.</div>
                <div class="info-card"><i class="fas fa-chart-line"></i><strong>Supply Rutin</strong>Untuk pelanggan tetap (UMKM/cafe, SPPG, Frozen food dll).</div>
            </div>
        </section>

        <!-- Potensi & Tantangan (lengkap) -->
        <section id="potensi" class="section">
            <h2 class="section-title">📊 Potensi & Tantangan</h2>
            <div class="grid-2">
                <div class="info-card" style="background:#eef5ea;">
                    <i class="fas fa-rocket"></i>
                    <strong>Potensi</strong>
                    <ul style="margin-top: 0.8rem; margin-left: 1.2rem;">
                        <li>Kesadaran hidup sehat yang meningkat pasca pandemi.</li>
                        <li>Minimnya pesaing dengan model serupa di Mamuju.</li>
                        <li>Dukungan pemerintah untuk ketahanan pangan lokal dan pertanian modern.</li>
                        <li>Tren "buy local" yang semakin kuat.</li>
                    </ul>
                </div>
                <div class="info-card" style="background:#fff3e0;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Tantangan</strong>
                    <ul style="margin-top: 0.8rem; margin-left: 1.2rem;">
                        <li>Edukasi masyarakat tentang harga yang relatif lebih tinggi dibanding sayuran konvensional.</li>
                        <li>Ketergantungan pada listrik untuk sistem sirkulasi air.</li>
                        <li>Ketergantungan pada air baku.</li>
                        <li>Fluktuasi harga nutrisi AB Mix dan perlengkapan hidroponik.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Perizinan, Sertifikasi dan Pencapaian (lengkap) -->
        <section id="perizinan" class="section">
            <h2 class="section-title">🏆 Perizinan, Sertifikasi & Pencapaian</h2>
            <ul class="achievement-list">
                <li><i class="fas fa-check-circle"></i> Perizinan Busaha Berbasis Resiko dari Menteri Investasi/Kepala Badan Koordinasi Penanaman Modal Tahun 2023</li>
                <li><i class="fas fa-check-circle"></i> Sertifikat Merek dari Kementerian Hukum dan HAM Tahun 2023</li>
                <li><i class="fas fa-check-circle"></i> Telah menghasilkan 30 alumni Magang melalui Mitra dengan Balai Latihan Kerja (BLK) Provinsi Sulawesi Barat, Kementerian Tenaga Kerja</li>
                <li><i class="fas fa-check-circle"></i> Telah menjadi mitra praktik dan pelatihan bagi mahasiswa dari berbagai perguruan tinggi (UNIKA, UNIMAJU, UNSULBAR, UNHAS) dalam penguasaan teknologi dan praktik budidaya hidroponik.</li>
                <li><i class="fas fa-check-circle"></i> Telah memperkenalkan konsep hidroponik dasar melalui kunjungan program edukasi dari TK dan sekolah-sekolah.</li>
                <li><i class="fas fa-check-circle"></i> Bermitra dengan lembaga keagamaan dalam program pendampingan untuk mengembangkan kebun hidroponik komunitas yang mandiri.</li>
                <li><i class="fas fa-check-circle"></i> Telah menjadi lokasi penelitian dan sumber data bagi dua mahasiswa hingga berhasil menyelesaikan tugas akhir (skripsi) di bidang pertanian modern/hidroponik.</li>
            </ul>
        </section>

        <!-- Penutup (lengkap) -->
        <section id="penutup" class="section" style="text-align: center; background: #f9fdf7; border-radius: 40px; margin: 2rem 0; padding: 3rem;">
            <i class="fas fa-quote-right" style="font-size: 3rem; color: #a5d6a7;"></i>
            <p style="font-size: 1.2rem; margin-top: 1rem; line-height:1.7;">Khala' Hidroponik bukan sekadar tempat menjual sayur, tetapi merupakan bagian dari gerakan untuk membangun kemandirian pangan, gaya hidup sehat, dan pertanian berkelanjutan di Mamuju. Dengan setiap ikat sayur yang diproduksi, Khala' Hidroponik berkomitmen memberikan yang terbaik bagi kesehatan konsumen dan kelestarian lingkungan.</p>
            <p style="margin-top: 1.5rem; font-style: italic; font-size: 1.2rem;">"Khala' Hidroponik: Kebun Ajaib Tanpa Tanah"</p>
        </section>

        <!-- Peta Lokasi -->
        <section class="section">
            <h2 class="section-title">📍 Lokasi Kami</h2>
            <div style="border-radius: 24px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63766.687280113096!2d118.7992507486328!3d-2.691196200000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d92db80afa16fd3%3A0xada6d6a10dd3a318!2sKHALA&#39;%20HIDROPONIK!5e0!3m2!1sid!2sid!4v1778993729298!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer id="contact">
        <div class="container footer-container">
            <div><h4><i class="fas fa-seedling"></i> Khala'Hidroponik</h4><p>Jual sayuran hidroponik segar dan informasi pertanian modern.</p></div>
            <div><h4>Kontak Kami</h4><p><i class="fas fa-phone-alt"></i> 081241330346<br><i class="fas fa-map-marker-alt"></i> Jl. Soekarno Hatta, Kelurahan Karema, Kecamatan Mamuju, Kabupaten Mamuju, Sulawesi Barat.</p></div>
            <div><h4>Ikuti Kami</h4><div class="social-icons"><a href="https://www.instagram.com/khalahidroponik"><i class="fab fa-instagram"></i></a><a href="https://www.facebook.com/religius.heryanto.5/"><i class="fab fa-facebook-f"></i></a><a href="https://www.tiktok.com/@khalahidroponik"><i class="fab fa-tiktok"></i></a></div></div>
        </div>
        <div class="footer-bottom"><div class="container"><p>&copy; 2026 Khala'Hidroponik. Semua hak dilindungi.</p></div></div>
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
            mainNav.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', (e) => {
                    const isDropdownToggle = (window.innerWidth <= 768 && link.parentElement?.classList.contains('dropdown') && link.getAttribute('href') === 'javascript:void(0)');
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
        // Dropdown klik semua device
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
        document.querySelectorAll('.dropdown-menu').forEach(menu => { menu.addEventListener('click', e => e.stopPropagation()); });
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === "#") return;
                const target = document.querySelector(href);
                if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
            });
        });
    </script>
</body>
</html>