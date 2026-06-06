<?php
require_once 'includes/auth.php';
$db = getDB();

// Ringkasan data
$totalNews     = $db->query("SELECT COUNT(*) FROM news")->fetchColumn();
$totalProducts = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
$newsWithVideo = $db->query("SELECT COUNT(*) FROM news WHERE youtube_url IS NOT NULL AND youtube_url != ''")->fetchColumn();
$productsWithImage = $db->query("SELECT COUNT(*) FROM products WHERE image IS NOT NULL AND image != ''")->fetchColumn();

// 5 berita terbaru
$latestNews = $db->query("SELECT id, title, COALESCE(published_at, created_at) AS pub_date FROM news ORDER BY COALESCE(published_at, created_at) DESC LIMIT 5")->fetchAll();

// 5 produk terbaru
$latestProducts = $db->query("SELECT id, name, price_per_unit, created_at FROM products ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin – Khala'Hidroponik</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            border-radius: 24px;
            padding: 1.8rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.04);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-4px);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }
        .stat-icon.news { background: #2e7d32; }
        .stat-icon.products { background: #f39c12; }
        .stat-icon.video { background: #c62828; }
        .stat-icon.image { background: #1565c0; }

        .stat-info h4 {
            font-size: 2rem;
            font-weight: 700;
            color: #1b3b17;
            line-height: 1.2;
            margin-bottom: 0.2rem;
        }
        .stat-info p {
            color: #5a7152;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .dashboard-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .dashboard-card-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid #e2ecd9;
            font-weight: 600;
            color: #1b3b17;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dashboard-card-body {
            padding: 0;
        }
        .list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f0f7ed;
            transition: background 0.2s;
        }
        .list-item:last-child {
            border-bottom: none;
        }
        .list-item:hover {
            background: #fafdf7;
        }
        .list-item a {
            color: #1e2e1c;
            text-decoration: none;
            font-weight: 500;
        }
        .list-item a:hover {
            color: #2e7d32;
        }
        .list-item small {
            color: #8ba888;
            font-size: 0.8rem;
        }
        .empty-message {
            padding: 1.5rem;
            text-align: center;
            color: #8ba888;
        }
    </style>
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <span>Khala'Hidroponik</span>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="nav-item active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="manage-news.php" class="nav-item"><i class="fas fa-newspaper"></i> Kelola Berita</a>
                <a href="manage-products.php" class="nav-item"><i class="fas fa-shopping-basket"></i> Kelola Produk</a>
                <a href="logout.php" class="nav-item nav-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-topbar">
                <h1>Dashboard</h1>
                <div class="admin-profile">
                    <span><i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['admin_username']) ?></span>
                </div>
            </header>

            <div class="admin-content">
                <!-- Selamat Datang -->
                <div class="welcome-card" style="background: white; padding: 1.5rem 2rem; border-radius: 24px; margin-bottom: 2rem; box-shadow: 0 10px 25px rgba(0,0,0,0.04);">
                    <h2 style="margin: 0; color: #1b3b17;">Selamat datang, <?= htmlspecialchars($_SESSION['admin_username']) ?>!</h2>
                    <p style="color: #5a7152; margin: 0.5rem 0 0;">Kelola konten website hidroponik Anda dengan mudah.</p>
                </div>

                <!-- Ringkasan Statistik -->
                <div class="stats-overview">
                    <div class="stat-card">
                        <div class="stat-icon news"><i class="fas fa-newspaper"></i></div>
                        <div class="stat-info">
                            <h4><?= $totalNews ?></h4>
                            <p>Total Berita</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon products"><i class="fas fa-shopping-basket"></i></div>
                        <div class="stat-info">
                            <h4><?= $totalProducts ?></h4>
                            <p>Total Produk</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon video"><i class="fab fa-youtube"></i></div>
                        <div class="stat-info">
                            <h4><?= $newsWithVideo ?></h4>
                            <p>Berita dengan Video</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon image"><i class="fas fa-images"></i></div>
                        <div class="stat-info">
                            <h4><?= $productsWithImage ?></h4>
                            <p>Produk Bergambar</p>
                        </div>
                    </div>
                </div>

                <!-- Berita & Produk Terbaru -->
                <div class="dashboard-grid">
                    <!-- Berita Terbaru -->
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <i class="fas fa-clock"></i> Berita Terbaru
                        </div>
                        <div class="dashboard-card-body">
                            <?php if (!empty($latestNews)): ?>
                                <?php foreach ($latestNews as $item): ?>
                                    <div class="list-item">
                                        <a href="detail.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></a>
                                        <small><?= date('d/m/Y', strtotime($item['pub_date'])) ?></small>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-message">Belum ada berita</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Produk Terbaru -->
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <i class="fas fa-box"></i> Produk Terbaru
                        </div>
                        <div class="dashboard-card-body">
                            <?php if (!empty($latestProducts)): ?>
                                <?php foreach ($latestProducts as $item): ?>
                                    <div class="list-item">
                                        <a href="produk.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['name']) ?></a>
                                        <small>Rp <?= number_format($item['price_per_unit'], 0, ',', '.') ?></small>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-message">Belum ada produk</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Tindakan Cepat -->
                <div class="quick-actions" style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem;">
                    <a href="manage-news.php" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Berita Baru</a>
                    <a href="manage-products.php" class="btn btn-primary" style="background: #f39c12; border-color: #f39c12;"><i class="fas fa-plus-circle"></i> Tambah Produk Baru</a>
                    <a href="../index.php" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i> Lihat Website</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>