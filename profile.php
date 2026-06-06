<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Profil Khala' Hidroponik - Pertanian Modern Mamuju</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        /* ===== GLOBAL & RESET ===== */
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
            padding-top: 15px; 
        }
        body {
            padding-top: 80px;
            font-family: 'Segoe UI', 'Poppins', system-ui, -apple-system, sans-serif;
        }
        /* Navbar (sama dengan index) */
        .navbar {
            z-index: 1000;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #ffffff;
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
            display: block !important;
            flex-direction: column !important;
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
                display: none !important;
                opacity: 1;
                visibility: visible;
                padding-left: 1rem;
            }
            .dropdown.active .dropdown-menu {
                display: block !important;
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
            background-image: url('assets/images/heroprofil.jpeg');
            background-position: center;
            background-size: cover; 
            border-radius: 0 0 40px 40px;
            padding: 6rem 0;
            margin-bottom: 2rem;
            text-align: center;
        }
        .profile-hero h1 {
            font-size: 3rem;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }
        .profile-hero p {
            font-size: 1.2rem;
            color: #ffffff;
        }

        /* ========== KOMPONEN PREMIUM UMUM ========== */
        .pre-heading {
            display: inline-block;
            background: #eef5ea;
            color: #2e7d32;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 0.35rem 1.2rem;
            border-radius: 50px;
            margin-bottom: 1.2rem;
        }
        .section-heading-serif {
            font-family: 'Playfair Display', 'Times New Roman', serif;
            font-size: 2.6rem;
            font-weight: 700;
            color: #1b3b17;
            margin-bottom: 2rem;
            position: relative;
        }
        .section-heading-serif::after {
            content: '';
            display: block;
            width: 70px;
            height: 4px;
            background: linear-gradient(to right, #2e7d32, #a5d6a7);
            margin-top: 0.6rem;
            border-radius: 2px;
        }
        .section-header-center {
            text-align: center;
            margin-bottom: 3rem;
        }
        .section-header-center .section-heading-serif::after {
            margin: 0.6rem auto 0;
        }
        .section-premium {
            padding: 5rem 0;
            background: #ffffff;
        }
        .section-premium-alt {
            background: #fafbf9;
            padding: 5rem 0;
        }

        /* ========== PROFIL USAHA (PREMIUM) ========== */
        .profil-premium {
            background: #fafbf9;
            padding: 5rem 0;
            border-bottom: none;
        }
        .profil-container {
            display: flex;
            align-items: center;
            gap: 4rem;
            flex-wrap: wrap;
        }
        .profil-image-col {
            flex: 1 1 45%;
            position: relative;
        }
        .image-frame {
            position: relative;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 
                0 30px 50px -20px rgba(27, 59, 23, 0.15),
                0 0 0 1px rgba(46, 125, 50, 0.08);
            transition: transform 0.4s ease;
        }
        .image-frame:hover {
            transform: translateY(-8px);
        }
        .image-frame img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 40px;
        }
        .image-badge {
            position: absolute;
            bottom: 25px;
            left: 25px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 100px;
            padding: 0.5rem 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: #1b3b17;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }
        .image-badge i {
            color: #2e7d32;
            font-size: 1rem;
        }
        .profil-text-col {
            flex: 1 1 50%;
        }
        .profil-heading {
            font-family: 'Playfair Display', 'Times New Roman', serif;
            font-size: 3rem;
            font-weight: 700;
            color: #1b3b17;
            line-height: 1.2;
            margin-bottom: 1.2rem;
            position: relative;
        }
        .profil-heading::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #2e7d32, #a5d6a7);
            margin-top: 0.8rem;
            border-radius: 2px;
        }
        .profil-description {
            color: #3a4d35;
            font-size: 1.05rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 90%;
        }
        .info-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }
        .info-card-premium {
            background: white;
            border-radius: 20px;
            padding: 1.2rem 1.4rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 15px 25px -10px rgba(0,0,0,0.04);
            border: 1px solid rgba(46, 125, 50, 0.1);
            transition: all 0.3s ease;
        }
        .info-card-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 35px -12px rgba(27, 59, 23, 0.12);
            border-color: #c8e6c9;
        }
        .icon-circle {
            background: #f4faf0;
            width: 45px;
            height: 45px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #2e7d32;
            flex-shrink: 0;
        }
        .info-card-premium strong {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #6b7f64;
            margin-bottom: 0.2rem;
        }
        .info-card-premium span {
            font-weight: 600;
            color: #1b3b17;
            font-size: 0.95rem;
        }

        /* ========== STRUKTUR ORGANISASI PREMIUM ========== */
        .struktur-premium {
            background: #ffffff;
            padding: 5rem 0;
        }
        .org-grid {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            max-width: 1000px;
            margin: 0 auto;
        }
        .org-top {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .org-card-lead {
            background: white;
            border-radius: 24px;
            padding: 1.5rem 3rem;
            text-align: center;
            box-shadow: 0 20px 35px -15px rgba(0,0,0,0.08);
            border: 1px solid #d4e8d4;
        }
        .org-card-lead .position {
            font-weight: 700;
            font-size: 1.2rem;
            color: #1b3b17;
        }
        .org-divisions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            width: 100%;
        }
        .org-card-div {
            background: white;
            border-radius: 20px;
            padding: 1.5rem 1.2rem;
            text-align: center;
            box-shadow: 0 15px 25px -10px rgba(0,0,0,0.05);
            border: 1px solid #eef3ea;
            transition: all 0.3s;
        }
        .org-card-div:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 35px -15px rgba(0,0,0,0.1);
            border-color: #c8e6c9;
        }
        .org-card-div .div-icon {
            font-size: 2rem;
            color: #2e7d32;
            margin-bottom: 0.8rem;
        }
        .org-card-div .div-title {
            font-weight: 700;
            color: #1b3b17;
            margin-bottom: 0.3rem;
        }
        .org-card-div .div-desc {
            font-size: 0.85rem;
            color: #5a7152;
        }

        /* ========== SEJARAH PREMIUM ========== */
        .sejarah-premium {
            background: #fff;
            padding: 5rem 0;
        }
        .sejarah-container {
            display: flex;
            align-items: center;
            gap: 3.5rem;
            flex-wrap: wrap;
        }
        .sejarah-text-col {
            flex: 1 1 55%;
        }
        .sejarah-image-col {
            flex: 1 1 40%;
            display: flex;
            justify-content: center;
        }
        .timeline-premium {
            position: relative;
            padding-left: 2rem;
            border-left: 2px dashed #c8e6c9;
        }
        .timeline-item-premium {
            position: relative;
            margin-bottom: 2.2rem;
            padding-left: 1.8rem;
        }
        .timeline-item-premium:last-child {
            margin-bottom: 0;
        }
        .timeline-dot {
            position: absolute;
            left: -2.45rem;
            top: 0.4rem;
            width: 14px;
            height: 14px;
            background: #2e7d32;
            border-radius: 50%;
            box-shadow: 0 0 0 6px rgba(46,125,50,0.1);
        }
        .timeline-year {
            display: inline-block;
            background: #eef5ea;
            color: #2e7d32;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.25rem 0.9rem;
            border-radius: 20px;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        .timeline-content h4 {
            font-size: 1.2rem;
            color: #1b3b17;
            margin-bottom: 0.3rem;
        }
        .timeline-content p {
            color: #3a4d35;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        .image-frame-sejarah {
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 45px -20px rgba(0,0,0,0.12);
            max-width: 450px;
        }
        .image-frame-sejarah img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.4s;
        }
        .image-frame-sejarah:hover img {
            transform: scale(1.03);
        }
        .image-overlay-text {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 0.6rem 1.2rem;
            text-align: center;
        }
        .image-overlay-text span {
            display: block;
            font-weight: 700;
            color: #1b3b17;
            font-size: 1.3rem;
        }
        .image-overlay-text small {
            font-size: 0.7rem;
            color: #5a7152;
            text-transform: uppercase;
        }

        /* ========== VISI MISI PREMIUM ========== */
        .visi-misi-premium {
            background: #fafbf9;
            padding: 5rem 0;
        }
        .visi-misi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }
        .visi-card, .misi-card {
            background: white;
            border-radius: 28px;
            padding: 2.5rem 2rem;
            box-shadow: 0 20px 35px -15px rgba(27,59,23,0.08);
            border: 1px solid rgba(46,125,50,0.08);
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }
        .visi-card:hover, .misi-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 45px -15px rgba(27,59,23,0.12);
        }
        .visi-icon-box, .misi-icon-box {
            width: 55px;
            height: 55px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #2e7d32;
            margin-bottom: 1.5rem;
        }
        .visi-icon-box {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        }
        .misi-icon-box {
            background: linear-gradient(135deg, #f1f8e9, #dcedc8);
        }
        .visi-card h3, .misi-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #1b3b17;
            margin-bottom: 1rem;
        }
        .visi-card p {
            color: #3a4d35;
            line-height: 1.7;
        }
        .misi-list {
            list-style: none;
            padding: 0;
        }
        .misi-list li {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.5rem 0;
            color: #3a4d35;
            font-size: 0.95rem;
            border-bottom: 1px solid #f0f5ec;
        }
        .misi-list li:last-child {
            border-bottom: none;
        }
        .misi-list li i {
            color: #2e7d32;
            font-size: 1rem;
        }
        .visi-accent, .misi-accent {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #2e7d32, #a5d6a7);
        }

        /* ========== GAMBARAN USAHA PREMIUM ========== */
        .gambaran-premium {
            background: #ffffff;
            padding: 5rem 30px;
        }
        .gambaran-container {
            display: flex;
            align-items: center;
            gap: 3rem;
            flex-wrap: wrap;
        }
        .gambaran-text {
            flex: 1 1 55%;
        }
        .gambaran-text p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #3a4d35;
        }
        .gambaran-text .highlight {
            font-weight: 600;
            color: #2e7d32;
        }
        .gambaran-image {
            flex: 1 1 40%;
        }
        .gambaran-image img {
            width: 100%;
            border-radius: 32px;
            box-shadow: 0 25px 40px -15px rgba(0,0,0,0.1);
        }

        /* ========== PRODUK UNGGULAN PREMIUM ========== */
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.8rem;
        }
        .produk-card {
            background: white;
            border-radius: 24px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid #eef3ea;
            box-shadow: 0 10px 20px rgba(0,0,0,0.03);
            position: relative;
            overflow: hidden;
        }
        .produk-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 35px -12px rgba(0,0,0,0.08);
            border-color: #c8e6c9;
        }
        .produk-icon {
            font-size: 2.8rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        .produk-card h4 {
            font-size: 1.2rem;
            color: #1b3b17;
            margin-bottom: 0.5rem;
        }
        .produk-card p {
            color: #5a7152;
            font-size: 0.9rem;
        }
        .produk-accent {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #a5d6a7, #2e7d32);
        }

        /* ========== KEUNGGULAN GRID PREMIUM ========== */
        .keunggulan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }
        .keunggulan-card {
            background: white;
            border-radius: 20px;
            padding: 1.8rem 1.5rem;
            text-align: center;
            border: 1px solid #eef3ea;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(0,0,0,0.02);
        }
        .keunggulan-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -10px rgba(0,0,0,0.08);
            border-color: #c8e6c9;
        }
        .keunggulan-icon {
            font-size: 2.2rem;
            color: #2e7d32;
            margin-bottom: 0.8rem;
        }
        .keunggulan-card strong {
            display: block;
            font-size: 1.1rem;
            color: #1b3b17;
            margin-bottom: 0.3rem;
        }
        .keunggulan-card span {
            color: #5a7152;
            font-size: 0.9rem;
        }

        /* ========== TARGET PASAR & SISTEM PENJUALAN ========== */
        .info-grid-premium {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.8rem;
        }
        .target-card, .sistem-card {
            background: white;
            border-radius: 20px;
            padding: 2rem 1.8rem;
            text-align: center;
            border: 1px solid #eef3ea;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            transition: 0.3s;
        }
        .target-card:hover, .sistem-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(0,0,0,0.08);
            border-color: #c8e6c9;
        }
        .target-card i, .sistem-card i {
            font-size: 2.2rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        .target-card strong, .sistem-card strong {
            display: block;
            font-size: 1.1rem;
            color: #1b3b17;
            margin-bottom: 0.3rem;
        }
        .target-card p, .sistem-card p {
            color: #5a7152;
            font-size: 0.9rem;
        }

        /* ========== POTENSI & TANTANGAN ========== */
        .potensi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .potensi-card {
            border-radius: 24px;
            padding: 2rem;
        }
        .potensi-card.potensi {
            background: #eef5ea;
            border: 1px solid #c8e6c9;
        }
        .potensi-card.tantangan {
            background: #fff7ed;
            border: 1px solid #ffd8b0;
        }
        .potensi-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #1b3b17;
        }
        .potensi-card ul {
            list-style: none;
            padding: 0;
        }
        .potensi-card ul li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #3a4d35;
        }

        /* ========== PENUTUP QUOTE ========== */
        .penutup-premium {
            background: #fafbf9;
            border-radius: 40px;
            margin: 3rem 0;
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
        }
        .quote-icon {
            font-size: 4rem;
            color: #c8e6c9;
            margin-bottom: 1.5rem;
        }
        .quote-text {
            font-size: 1.4rem;
            font-style: italic;
            color: #1b3b17;
            max-width: 800px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }
        .quote-author {
            font-weight: 600;
            color: #2e7d32;
        }

        .footer-container{
            padding-top: 40px;
        }
        .footer-bottom{
            margin-top: 0px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container { padding: 0 1.5rem; }
            .profile-hero h1 { font-size: 2rem; }
            .profil-container, .sejarah-container, .gambaran-container {
                flex-direction: column;
            }
            .info-cards {
                grid-template-columns: 1fr;
            }
            .profil-heading { font-size: 2.4rem; }
            .section-heading-serif { font-size: 2.2rem; }
            .produk-grid { grid-template-columns: 1fr; }
            .keunggulan-grid { grid-template-columns: 1fr; }
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
                        <a href="javascript:void(0)"  class="active">Profil <i class="fas fa-chevron-down"></i></a>
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

    <!-- Hero Profil -->
    <section class="profile-hero">
        <div class="container">
            <h1>"Khala' Hidroponik"</h1>
            <p>Kebun Ajaib Tanpa Tanah • Pertanian Modern Mamuju</p>
        </div>
    </section>

    <div class="container">
        <!-- 1. Profil Usaha (Premium) -->
        <section id="profil-usaha" class="section profil-premium">
            <div class="profil-container">
                <div class="profil-image-col">
                    <div class="image-frame">
                        <img src="assets/images/logo/serti2.png" alt="Kebun Hidroponik Khala'" />
                        <div class="image-badge">
                            <i class="fas fa-leaf"></i>
                            <span>Sejak 2022</span>
                        </div>
                    </div>
                </div>
                <div class="profil-text-col">
                    <span class="pre-heading">Tentang Kami</span>
                    <h2 class="profil-heading">Khala' Hidroponik</h2>
                    <p class="profil-description">
                        Lebih dari sekadar kebun — kami adalah ekosistem pertanian modern yang menghadirkan sayuran bebas pestisida, 
                        pusat edukasi, dan mitra strategis bagi masyarakat Mamuju menuju hidup sehat dan berkelanjutan.
                    </p>
                    <div class="info-cards">
                        <div class="info-card-premium">
                            <div class="icon-circle"><i class="fas fa-calendar-alt"></i></div>
                            <div><strong>Berdiri</strong><span>20 Maret 2022</span></div>
                        </div>
                        <div class="info-card-premium">
                            <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                            <div><strong>Lokasi</strong><span>Jl. Soekarno Hatta, Mamuju</span></div>
                        </div>
                        <div class="info-card-premium">
                            <div class="icon-circle"><i class="fas fa-phone-alt"></i></div>
                            <div><strong>Kontak</strong><span>0812-4133-0346</span></div>
                        </div>
                        <div class="info-card-premium">
                            <div class="icon-circle"><i class="fab fa-instagram"></i></div>
                            <div><strong>Instagram</strong><span>@khalahidroponik</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. Struktur Organisasi (Premium) -->
        <section id="struktur" class="section struktur-premium">
            <div class="section-header-center">
                <span class="pre-heading">Tim Kami</span>
                <h2 class="section-heading-serif">Struktur Organisasi</h2>
            </div>
            <div class="org-grid">
                <div class="org-top">
                    <div class="org-card-lead">
                        <div class="position">Penanggung Jawab / Owner</div>
                    </div>
                </div>
                <div class="org-divisions">
                    <div class="org-card-div">
                        <div class="div-icon"><i class="fas fa-seedling"></i></div>
                        <div class="div-title">Produksi & Green House</div>
                        <div class="div-desc">Pengelolaan tanaman, panen, perawatan</div>
                    </div>
                    <div class="org-card-div">
                        <div class="div-icon"><i class="fas fa-bullhorn"></i></div>
                        <div class="div-title">Promosi & Pemasaran</div>
                        <div class="div-desc">Media sosial, penjualan, branding</div>
                    </div>
                    <div class="org-card-div">
                        <div class="div-icon"><i class="fas fa-handshake"></i></div>
                        <div class="div-title">Kemitraan & Pelatihan</div>
                        <div class="div-desc">PKL, magang, kerja sama institusi</div>
                    </div>
                    <div class="org-card-div">
                        <div class="div-icon"><i class="fas fa-coins"></i></div>
                        <div class="div-title">Keuangan & Administrasi</div>
                        <div class="div-desc">Pembukuan, logistik, inventaris</div>
                    </div>
                </div>
                <p style="margin-top: 2rem; color: #5a7152; font-style: italic;">Didukung oleh staf produksi, teknisi hidroponik, dan fasilitator edukasi profesional.</p>
            </div>
        </section>

        <!-- 3. Sejarah (Timeline Premium) -->
        <section id="sejarah" class="section sejarah-premium">
            <div class="sejarah-container">
                <div class="sejarah-text-col">
                    <span class="pre-heading">Perjalanan Kami</span>
                    <h2 class="section-heading-serif">Sejarah Singkat</h2>
                    <div class="timeline-premium">
                        <div class="timeline-item-premium">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year">2022</span>
                                <h4>Bermula dari Rooftop Rumah</h4>
                                <p>Didirikan 20 Maret 2022 sebagai kebun hidroponik skala rumahan yang memanfaatkan lahan rooftop tidak terpakai.</p>
                            </div>
                        </div>
                        <div class="timeline-item-premium">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year">2025</span>
                                <h4>Ekspansi Komersial & Edukasi</h4>
                                <p>Berkembang menjadi usaha terintegrasi dengan 320 m² area produksi NFT dan 12 m² pembibitan. Destinasi eduwisata dan lokasi PKL mahasiswa.</p>
                            </div>
                        </div>
                        <div class="timeline-item-premium">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-year">2026</span>
                                <h4>Kemitraan Strategis</h4>
                                <p>Menjadi mitra Kemnaker dalam program pemagangan kerja untuk tenaga terampil sektor pertanian modern dan ekonomi hijau.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sejarah-image-col">
                    <div class="image-frame-sejarah">
                        <img src="assets/images/logo/logo.jpeg" alt="Hidroponik Modern">
                        <div class="image-overlay-text">
                            <span>320 m²</span>
                            <small>Area Produksi</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Visi & Misi (Premium) -->
        <section id="visi-misi" class="section visi-misi-premium">
            <div class="section-header-center">
                <span class="pre-heading">Arah & Tujuan</span>
                <h2 class="section-heading-serif">Visi & Misi</h2>
            </div>
            <div class="visi-misi-grid">
                <div class="visi-card">
                    <div class="visi-icon-box"><i class="fas fa-eye"></i></div>
                    <h3>Visi</h3>
                    <p>Menjadi produsen sayuran segar terdepan di Mamuju dan pusat pembelajaran pertanian modern untuk ketahanan pangan berkelanjutan.</p>
                    <div class="visi-accent"></div>
                </div>
                <div class="misi-card">
                    <div class="misi-icon-box"><i class="fas fa-bullseye"></i></div>
                    <h3>Misi</h3>
                    <ul class="misi-list">
                        <li><i class="fas fa-check-circle"></i> Produksi sayuran bebas pestisida</li>
                        <li><i class="fas fa-check-circle"></i> Akses sayur segar harian bagi masyarakat</li>
                        <li><i class="fas fa-check-circle"></i> Edukasi inklusif (PKL, pelatihan)</li>
                        <li><i class="fas fa-check-circle"></i> Optimalisasi lahan terbatas</li>
                        <li><i class="fas fa-check-circle"></i> Mitra aktif pemerintah & komunitas</li>
                    </ul>
                    <div class="misi-accent"></div>
                </div>
            </div>
        </section>

        <!-- 5. Gambaran Usaha (Premium) -->
        <section id="gambaran-usaha" class="section gambaran-premium">
            <div class="section-header-center">
                <span class="pre-heading">Sekilas Usaha</span>
                <h2 class="section-heading-serif">Gambaran Usaha</h2>
            </div>
            <div class="gambaran-container">
                <div class="gambaran-text">
                    <p>
                        <span class="highlight">Khala' Hidroponik</span> merupakan usaha pertanian modern berbasis 
                        <span class="highlight">urban farming</span> yang berfokus pada budidaya berbagai jenis sayuran daun 
                        menggunakan sistem hidroponik. Berlokasi di tengah Kota Mamuju, usaha ini hadir sebagai solusi 
                        atas keterbatasan lahan perkotaan sekaligus mendukung ketersediaan sayuran segar yang dibudidayakan 
                        secara higienis, sehat, dan ramah lingkungan.
                    </p>
                </div>
                <div class="gambaran-image">
                    <img src="assets/images/heroproduk.jpeg" alt="Urban farming">
                </div>
            </div>
        </section>

        <!-- 6. Produk Unggulan (Premium) -->
        <section id="produk-unggulan" class="section-premium-alt">
            <div class="container">
                <div class="section-header-center">
                    <span class="pre-heading">Yang Kami Tawarkan</span>
                    <h2 class="section-heading-serif">Produk Unggulan</h2>
                </div>
                <div class="produk-grid">
                    <div class="produk-card">
                        <div class="produk-accent"></div>
                        <div class="produk-icon"><i class="fas fa-leaf"></i></div>
                        <h4>Selada Keriting</h4>
                        <p>Lalapan, salad, burger, jus</p>
                    </div>
                    <div class="produk-card">
                        <div class="produk-accent"></div>
                        <div class="produk-icon"><i class="fas fa-seedling"></i></div>
                        <h4>Pakcoy</h4>
                        <p>Sawi sendok renyah segar</p>
                    </div>
                    <div class="produk-card">
                        <div class="produk-accent"></div>
                        <div class="produk-icon"><i class="fas fa-water"></i></div>
                        <h4>Kangkung Hidroponik</h4>
                        <p>Batang putih, bersih</p>
                    </div>
                    <div class="produk-card">
                        <div class="produk-accent"></div>
                        <div class="produk-icon"><i class="fas fa-heart"></i></div>
                        <h4>Bayam</h4>
                        <p>Daun lebar tebal, nutrisi tinggi</p>
                    </div>
                    <div class="produk-card">
                        <div class="produk-accent"></div>
                        <div class="produk-icon"><i class="fas fa-spa"></i></div>
                        <h4>Seledri</h4>
                        <p>Aromatik, penyedap alami</p>
                    </div>
                    <div class="produk-card">
                        <div class="produk-accent"></div>
                        <div class="produk-icon"><i class="fas fa-box"></i></div>
                        <h4>Paket Bulanan</h4>
                        <p>Langganan sayur segar</p>
                    </div>
                    <div class="produk-card">
                        <div class="produk-accent"></div>
                        <div class="produk-icon"><i class="fas fa-tools"></i></div>
                        <h4>Starter Kit</h4>
                        <p>Belajar hidroponik di rumah</p>
                    </div>
                    <div class="produk-card">
                        <div class="produk-accent"></div>
                        <div class="produk-icon"><i class="fas fa-phone-alt"></i></div>
                        <h4>Hidroponik Portable</h4>
                        <p>Sewa untuk event</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. Keunggulan & Nilai Jual (Premium) -->
        <section id="keunggulan" class="section-premium">
            <div class="container">
                <div class="section-header-center">
                    <span class="pre-heading">Mengapa Kami?</span>
                    <h2 class="section-heading-serif">Keunggulan & Nilai Jual</h2>
                </div>
                <div class="keunggulan-grid">
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon"><i class="fas fa-heartbeat"></i></div>
                        <strong>SEHAT</strong>
                        <span>Bebas pestisida kimia</span>
                    </div>
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon"><i class="fas fa-snowflake"></i></div>
                        <strong>SEGAR</strong>
                        <span>Dipanen on-demand</span>
                    </div>
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon"><i class="fas fa-hand-sparkles"></i></div>
                        <strong>BERSIH</strong>
                        <span>Tanpa tanah & ulat</span>
                    </div>
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon"><i class="fas fa-globe"></i></div>
                        <strong>RAMAH LINGKUNGAN</strong>
                        <span>Hemat air 90%</span>
                    </div>
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon"><i class="fas fa-map-pin"></i></div>
                        <strong>LOKAL</strong>
                        <span>Dari Mamuju untuk Mamuju</span>
                    </div>
                    <div class="keunggulan-card">
                        <div class="keunggulan-icon"><i class="fas fa-chalkboard-user"></i></div>
                        <strong>EDUKATIF</strong>
                        <span>Pusat belajar modern</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- 8. Target Pasar (Premium) -->
        <section id="target-pasar" class="section-premium-alt">
            <div class="container">
                <div class="section-header-center">
                    <span class="pre-heading">Sasaran Kami</span>
                    <h2 class="section-heading-serif">Target Pasar</h2>
                </div>
                <div class="info-grid-premium">
                    <div class="target-card">
                        <i class="fas fa-home"></i>
                        <strong>Rumah Tangga</strong>
                        <p>Sadar kesehatan, gaya hidup hijau</p>
                    </div>
                    <div class="target-card">
                        <i class="fas fa-utensils"></i>
                        <strong>Kuliner</strong>
                        <p>Restoran, kafe, frozen food</p>
                    </div>
                    <div class="target-card">
                        <i class="fas fa-store"></i>
                        <strong>Pasar Modern</strong>
                        <p>Supplier sayur berkualitas</p>
                    </div>
                    <div class="target-card">
                        <i class="fas fa-hospital"></i>
                        <strong>Institusi</strong>
                        <p>Sekolah, RS, kantor</p>
                    </div>
                    <div class="target-card">
                        <i class="fas fa-hand-peace"></i>
                        <strong>Komunitas</strong>
                        <p>Urban farming enthusiast</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 9. Sistem Penjualan (Premium) -->
        <section id="sistem-penjualan" class="section-premium">
            <div class="container">
                <div class="section-header-center">
                    <span class="pre-heading">Cara Pesan</span>
                    <h2 class="section-heading-serif">Sistem Penjualan</h2>
                </div>
                <div class="info-grid-premium">
                    <div class="sistem-card">
                        <i class="fab fa-whatsapp"></i>
                        <strong>Pre-Order WA/IG</strong>
                        <p>Sistem utama, panen sesuai pesanan</p>
                    </div>
                    <div class="sistem-card">
                        <i class="fas fa-store"></i>
                        <strong>Langsung di Kebun</strong>
                        <p>Jam tertentu, lihat proses tanam</p>
                    </div>
                    <div class="sistem-card">
                        <i class="fas fa-truck"></i>
                        <strong>Kurir Lokal</strong>
                        <p>Antar dalam kota Mamuju</p>
                    </div>
                    <div class="sistem-card">
                        <i class="fas fa-handshake"></i>
                        <strong>Supply Rutin</strong>
                        <p>UMKM, kafe, program SPPG</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 10. Potensi & Tantangan (Premium) -->
        <section id="potensi-tantangan" class="section-premium-alt">
            <div class="container">
                <div class="section-header-center">
                    <span class="pre-heading">Analisis Bisnis</span>
                    <h2 class="section-heading-serif">Potensi & Tantangan</h2>
                </div>
                <div class="potensi-grid">
                    <div class="potensi-card potensi">
                        <h3><i class="fas fa-rocket" style="margin-right:0.5rem;"></i> Potensi</h3>
                        <ul>
                            <li><i class="fas fa-check-circle" style="color:#2e7d32;"></i> Kesadaran hidup sehat meningkat</li>
                            <li><i class="fas fa-check-circle" style="color:#2e7d32;"></i> Minim pesaing serupa di Mamuju</li>
                            <li><i class="fas fa-check-circle" style="color:#2e7d32;"></i> Dukungan ketahanan pangan lokal</li>
                            <li><i class="fas fa-check-circle" style="color:#2e7d32;"></i> Tren "buy local" menguat</li>
                        </ul>
                    </div>
                    <div class="potensi-card tantangan">
                        <h3><i class="fas fa-exclamation-triangle" style="margin-right:0.5rem;"></i> Tantangan</h3>
                        <ul>
                            <li><i class="fas fa-times-circle" style="color:#d97706;"></i> Edukasi harga premium</li>
                            <li><i class="fas fa-times-circle" style="color:#d97706;"></i> Ketergantungan listrik & air</li>
                            <li><i class="fas fa-times-circle" style="color:#d97706;"></i> Fluktuasi nutrisi AB Mix</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 11. Penutup (Premium) -->
        <section id="penutup" class="penutup-premium">
            <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
            <p class="quote-text">"Khala Hidroponik bukan sekadar tempat menjual sayur, tetapi merupakan bagian dari gerakan untuk membangun kemandirian pangan, gaya hidup sehat, dan pertanian berkelanjutan di Mamuju."</p>
            <p class="quote-author">Khala Hidroponik: Kebun Ajaib Tanpa Tanah</p>
        </section>

        <!-- Peta (tidak banyak berubah) -->
        <section class="section-premium">
            <div class="container">
                <div class="section-header-center">
                    <span class="pre-heading">Kunjungi Kami</span>
                    <h2 class="section-heading-serif">Lokasi Kami</h2>
                </div>
                <div style=" overflow: hidden; padding-bottom: 40px;">
                    <a href="https://maps.app.goo.gl/BAQxbxEGQrgbBqg39" target="_blank" rel="noopener" style="text-align:center; display: block; position: relative; border-radius: 24px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7970.8166238896465!2d118.86453866958617!3d-2.694143903870633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d92d90006d271ef%3A0xed82d96c4a48a5d5!2sKHALA&#39;%20HIDROPONIK%202!5e0!3m2!1sid!2sid!4v1779521453231!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.6); color: white; padding: 12px 24px; border-radius: 30px; font-weight: 600; display: flex; align-items: center; gap: 8px; pointer-events: none;">
                            <i class="fas fa-map-marker-alt"></i> Buka di Google Maps
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-container">
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