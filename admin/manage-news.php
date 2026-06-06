<?php
require_once 'includes/auth.php';
require_once '../includes/functions.php';

$db = getDB();
$message = '';
$error = '';

// Ambil pesan dari redirect (setelah simpan/update/hapus)
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'inserted': $message = '✅ Berita baru berhasil ditambahkan.'; break;
        case 'updated':  $message = '✅ Berita berhasil diperbarui.'; break;
        case 'deleted':  $message = '✅ Berita berhasil dihapus.'; break;
    }
}

// Proses hapus (dengan konfirmasi di modal, jadi langsung eksekusi jika ada ?delete)
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("SELECT image FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $old = $stmt->fetch();
    if ($old && $old['image'] && file_exists(UPLOAD_DIR . $old['image'])) {
        unlink(UPLOAD_DIR . $old['image']);
    }
    $stmt = $db->prepare("DELETE FROM news WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: manage-news.php?msg=deleted');
    exit;
}

// Proses tambah/edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi CSRF
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $error = 'Token keamanan tidak valid. Silakan muat ulang halaman.';
    } else {
        $title       = trim($_POST['title'] ?? '');
        $content     = trim($_POST['content'] ?? '');
        $published_at = trim($_POST['published_at'] ?? '');
        $youtube_url = trim($_POST['youtube_url'] ?? '');
        $id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        // Validasi URL YouTube
        if (!empty($youtube_url)) {
            if (!preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w\-]{11}/', $youtube_url)) {
                $error = 'URL YouTube tidak valid.';
            }
        }

        // Validasi tanggal
        if (!empty($published_at) && !strtotime($published_at)) {
            $error = 'Format tanggal tidak valid.';
        }

        $imageName = null;
        if (!$error && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = uploadImage($_FILES['image']);
            if ($uploadResult['success']) {
                $imageName = $uploadResult['filename'];
            } else {
                $error = $uploadResult['error'];
            }
        }

        if ($title && $content && !$error) {
            if ($id > 0) {
                // Update
                if ($imageName) {
                    $stmt = $db->prepare("SELECT image FROM news WHERE id = ?");
                    $stmt->execute([$id]);
                    $old = $stmt->fetch();
                    if ($old['image'] && file_exists(UPLOAD_DIR . $old['image'])) {
                        unlink(UPLOAD_DIR . $old['image']);
                    }
                    $stmt = $db->prepare("UPDATE news SET title=?, content=?, published_at=?, youtube_url=?, image=? WHERE id=?");
                    $stmt->execute([$title, $content, $published_at ?: null, $youtube_url ?: null, $imageName, $id]);
                } else {
                    $stmt = $db->prepare("UPDATE news SET title=?, content=?, published_at=?, youtube_url=? WHERE id=?");
                    $stmt->execute([$title, $content, $published_at ?: null, $youtube_url ?: null, $id]);
                }
                header('Location: manage-news.php?msg=updated');
                exit;
            } else {
                // Insert
                $stmt = $db->prepare("INSERT INTO news (title, content, published_at, youtube_url, image) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$title, $content, $published_at ?: null, $youtube_url ?: null, $imageName]);
                header('Location: manage-news.php?msg=inserted');
                exit;
            }
        } elseif (!$error) {
            $error = 'Judul dan konten wajib diisi.';
        }
    }
}

// Ambil data untuk form edit (jika ada parameter edit dan bukan setelah POST)
$editData = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

// Pagination
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage = 10;
$offset = ($page - 1) * $perPage;

$totalStmt = $db->query("SELECT COUNT(*) FROM news");
$total = $totalStmt->fetchColumn();
$totalPages = ceil($total / $perPage);

$newsList = $db->prepare("SELECT * FROM news ORDER BY COALESCE(published_at, created_at) DESC LIMIT ? OFFSET ?");
$newsList->bindValue(1, $perPage, PDO::PARAM_INT);
$newsList->bindValue(2, $offset, PDO::PARAM_INT);
$newsList->execute();
$newsList = $newsList->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita – Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Notifikasi */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 16px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease;
        }
        .alert.success {
            background: #e8f5e9;
            color: #2e7d32;
            border-left: 5px solid #2e7d32;
        }
        .alert.error {
            background: #ffebee;
            color: #c62828;
            border-left: 5px solid #c62828;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Input modern */
        .input-modern {
            position: relative;
            display: flex;
            align-items: center;
            background: #f9fdf7;
            border: 1px solid #d0e0ca;
            border-radius: 16px;
            padding: 0 1rem;
            transition: all 0.2s;
        }
        .input-modern:focus-within {
            border-color: #2e7d32;
            box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
            background: white;
        }
        .input-modern i {
            color: #8ba888;
            font-size: 1rem;
            margin-right: 0.6rem;
            transition: color 0.2s;
        }
        .input-modern:focus-within i {
            color: #2e7d32;
        }
        .input-modern input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            padding: 0.9rem 0;
            font-size: 0.95rem;
            color: #1e2e1c;
        }
        .input-modern input::placeholder {
            color: #b0c4a8;
        }
        .input-hint {
            font-size: 0.75rem;
            color: #8ba888;
            margin-top: 5px;
            display: block;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(2px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-box {
            background: white;
            border-radius: 24px;
            padding: 2rem 2rem 1.5rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 30px 50px rgba(0,0,0,0.2);
            animation: popIn 0.3s ease;
        }
        @keyframes popIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .modal-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .modal-icon.warning { color: #e67e22; }
        .modal-icon.danger { color: #c62828; }
        .modal-box h3 { margin-bottom: 0.8rem; color: #1b3b17; }
        .modal-box p { color: #5a7152; margin-bottom: 1.5rem; font-size: 0.95rem; }
        .modal-actions { display: flex; gap: 1rem; justify-content: center; }
        .modal-actions .btn { min-width: 100px; }

        /* Pagination */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1.5rem;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 8px;
            border-radius: 12px;
            background: white;
            color: #1e2e1c;
            font-weight: 500;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            transition: all 0.2s;
        }
        .pagination a:hover { background: #2e7d32; color: white; }
        .pagination a.active { background: #2e7d32; color: white; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <span>Khala'Hidroponik</span>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="nav-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="manage-news.php" class="nav-item active"><i class="fas fa-newspaper"></i> Kelola Berita</a>
                <a href="manage-products.php" class="nav-item"><i class="fas fa-shopping-basket"></i> Kelola Produk</a>
                <a href="logout.php" class="nav-item nav-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="admin-topbar">
                <h1>Kelola Berita</h1>
                <div class="admin-profile">
                    <span><i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['admin_username']) ?></span>
                </div>
            </header>

            <div class="admin-content">
                <?php if ($message): ?>
                    <div class="alert success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($message) ?></div>
                <?php elseif ($error): ?>
                    <div class="alert error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <!-- Form -->
                <div class="admin-card">
                    <div class="card-header">
                        <h3><?= $editData ? '✏️ Edit Berita' : '➕ Tambah Berita Baru' ?></h3>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="newsForm">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCSRFToken()) ?>">
                            <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

                            <div class="form-group">
                                <label for="title">Judul Berita</label>
                                <input type="text" name="title" id="title" value="<?= htmlspecialchars($editData['title'] ?? '') ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="content">Konten</label>
                                <textarea name="content" id="content" rows="6" required><?= htmlspecialchars($editData['content'] ?? '') ?></textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="published_at"><i class="far fa-calendar-alt"></i> Tanggal Publikasi</label>
                                    <div class="input-modern">
                                        <i class="far fa-calendar-alt"></i>
                                        <input type="datetime-local" name="published_at" id="published_at" 
                                               value="<?= isset($editData['published_at']) ? date('Y-m-d\TH:i', strtotime($editData['published_at'])) : '' ?>">
                                    </div>
                                    <span class="input-hint"><i class="fas fa-info-circle"></i> Kosongkan jika ingin menggunakan tanggal saat ini.</span>
                                </div>
                                <div class="form-group">
                                    <label for="youtube_url"><i class="fab fa-youtube"></i> Link YouTube (opsional)</label>
                                    <div class="input-modern">
                                        <i class="fab fa-youtube"></i>
                                        <input type="url" name="youtube_url" id="youtube_url" placeholder="https://youtube.com/watch?v=..." 
                                               value="<?= htmlspecialchars($editData['youtube_url'] ?? '') ?>">
                                    </div>
                                    <span class="input-hint"><i class="fas fa-play-circle"></i> Video akan otomatis ditampilkan di halaman detail.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">Gambar (opsional, maks 2MB, JPG/PNG)</label>
                                <input type="file" name="image" id="image" accept="image/jpeg,image/png">
                                <?php if ($editData && $editData['image']): ?>
                                    <div class="current-image">
                                        <p>Gambar saat ini:</p>
                                        <img src="<?= UPLOAD_URL . htmlspecialchars($editData['image']) ?>" alt="Preview" style="max-width:200px; border-radius:12px;">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?= $editData ? 'Update' : 'Simpan' ?></button>
                                <?php if ($editData): ?>
                                    <a href="manage-news.php" class="btn btn-secondary">Batal</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Daftar Berita -->
                <div class="admin-card">
                    <div class="card-header">
                        <h3>📋 Daftar Berita</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="admin-table" id="newsTable">
                            <thead>
                                <tr>
                                    <th width="80">Gambar</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($newsList as $item): ?>
                                <tr>
                                    <td>
                                        <?php if ($item['image']): ?>
                                            <img src="<?= UPLOAD_URL . htmlspecialchars($item['image']) ?>" alt="thumb" class="table-thumb">
                                        <?php else: ?>
                                            <span class="no-image">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($item['title']) ?>
                                        <?php if ($item['youtube_url']): ?>
                                            <br><small style="color:#c62828;"><i class="fab fa-youtube"></i> Video</small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($item['published_at'] ?? $item['created_at'])) ?></td>
                                    <td class="action-cell">
                                        <a href="?edit=<?= $item['id'] ?>" class="btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="?delete=<?= $item['id'] ?>" class="btn-icon delete" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($newsList)): ?>
                                <tr><td colspan="4" class="text-center">Belum ada berita.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <?php if ($totalPages > 1): ?>
                        <div class="pagination">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?= $page-1 ?>"><i class="fas fa-chevron-left"></i></a>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                            <?php endfor; ?>
                            <?php if ($page < $totalPages): ?>
                                <a href="?page=<?= $page+1 ?>"><i class="fas fa-chevron-right"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal-overlay" id="confirmModal">
        <div class="modal-box">
            <div class="modal-icon warning" id="modalIcon"><i class="fas fa-exclamation-triangle"></i></div>
            <h3 id="modalTitle">Konfirmasi</h3>
            <p id="modalMessage">Apakah Anda yakin?</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" id="modalCancel">Batal</button>
                <button class="btn btn-primary" id="modalOk">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    <script>
        // Modal konfirmasi
        let pendingAction = null;
        let deleteUrl = null;
        const modal = document.getElementById('confirmModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalIcon = document.getElementById('modalIcon');
        const modalOk = document.getElementById('modalOk');
        const modalCancel = document.getElementById('modalCancel');

        function showConfirm(type, customMessage, customTitle) {
            pendingAction = type;
            modalTitle.textContent = customTitle || (type === 'delete' ? 'Hapus Berita' : 'Simpan Perubahan');
            modalMessage.textContent = customMessage || (type === 'delete' ? 'Data yang dihapus tidak bisa dikembalikan. Tetap hapus?' : 'Pastikan data sudah benar. Lanjutkan?');
            if (type === 'delete') {
                modalIcon.className = 'modal-icon danger';
                modalIcon.innerHTML = '<i class="fas fa-trash-alt"></i>';
                modalOk.style.background = '#c62828';
            } else {
                modalIcon.className = 'modal-icon warning';
                modalIcon.innerHTML = '<i class="fas fa-save"></i>';
                modalOk.style.background = '#2e7d32';
            }
            modal.classList.add('active');
        }

        function hideConfirm() {
            modal.classList.remove('active');
            pendingAction = null;
            deleteUrl = null;
        }

        modalCancel.addEventListener('click', hideConfirm);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) hideConfirm();
        });

        modalOk.addEventListener('click', function() {
            if (pendingAction === 'submit') {
                document.getElementById('newsForm').submit();
            } else if (pendingAction === 'delete' && deleteUrl) {
                window.location.href = deleteUrl;
            }
            hideConfirm();
        });

        // Cegah submit langsung
        document.getElementById('newsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showConfirm('submit');
        });

        // Delegasi klik hapus
        document.getElementById('newsTable').addEventListener('click', function(e) {
            const deleteLink = e.target.closest('.btn-icon.delete');
            if (deleteLink) {
                e.preventDefault();
                deleteUrl = deleteLink.getAttribute('href');
                showConfirm('delete');
            }
        });
    </script>
</body>
</html>