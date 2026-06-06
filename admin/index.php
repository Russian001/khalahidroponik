<?php
require_once '../includes/db.php';
require_once '../includes/functions.php'; // Pastikan fungsi generateCSRFToken() dan validateCSRFToken() ada

// Pastikan session_start() sudah dipanggil di includes/config.php (di-include via db.php)
// Jika belum, aktifkan manual:
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $error = 'Token keamanan tidak valid. Silakan muat ulang halaman.';
    } else {
        $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
        if ($ip === false) {
            $ip = '0.0.0.0';
        }
        $db = getDB();

        // Rate limiting: cek jumlah percobaan dalam 15 menit terakhir
        $stmt = $db->prepare("SELECT COUNT(*) FROM login_attempts WHERE ip_address = ? AND attempt_time > (NOW() - INTERVAL 15 MINUTE)");
        $stmt->execute([$ip]);
        $attempts = $stmt->fetchColumn();

        if ($attempts >= 5) {
            $error = 'Terlalu banyak percobaan login. Silakan coba lagi nanti.';
        } else {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username && $password) {
                // Validasi panjang input untuk mencegah DoS
                if (strlen($username) > 50 || strlen($password) > 255) {
                    $error = 'Input tidak valid.';
                } else {
                    $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
                    $stmt->execute([$username]);
                    $user = $stmt->fetch();

                    if ($user && password_verify($password, $user['password'])) {
                        // Login sukses, hapus catatan attempt
                        $stmt = $db->prepare("DELETE FROM login_attempts WHERE ip_address = ?");
                        $stmt->execute([$ip]);

                        // Regenerasi session ID untuk mencegah session fixation
                        session_regenerate_id(true);

                        $_SESSION['admin_logged_in'] = true;
                        $_SESSION['admin_id'] = $user['id'];
                        $_SESSION['admin_username'] = $user['username'];
                        header('Location: dashboard.php');
                        exit;
                    } else {
                        $error = 'Username atau password salah.';
                        // Catat attempt gagal
                        $stmt = $db->prepare("INSERT INTO login_attempts (ip_address) VALUES (?)");
                        $stmt->execute([$ip]);
                    }
                }
            } else {
                $error = 'Harap isi semua field.';
            }
        }
    }
}

// Generate CSRF token baru untuk form
$csrf_token = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin – Khala'Hidroponik</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Background khusus login */
        body {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }
        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            padding: 2.5rem 2rem;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header i {
            font-size: 3rem;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        .login-header h2 {
            color: #1b3b17;
            font-size: 1.8rem;
        }
        .login-header p {
            color: #5a7152;
            margin-top: 0.3rem;
        }
        .input-group {
            margin-bottom: 1.5rem;
        }
        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1e2e1c;
        }
        .input-group input {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1px solid #d0e0ca;
            border-radius: 16px;
            font-size: 1rem;
            transition: border 0.2s, box-shadow 0.2s;
        }
        .input-group input:focus {
            outline: none;
            border-color: #2e7d32;
            box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
        }
        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: #2e7d32;
            color: white;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        .btn-login:hover {
            background: #1b5e20;
            transform: translateY(-2px);
        }
        .alert {
            padding: 0.8rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        .alert.error {
            background: #ffebee;
            color: #c62828;
            border-left: 4px solid #c62828;
        }
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .back-link a {
            color: #5a7152;
            font-size: 0.9rem;
        }
        .back-link a:hover {
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <i class="fas fa-seedling"></i>
                <h2>Admin Panel</h2>
                <p>Hidroponik Cerdas</p>
            </div>
            <?php if ($error): ?>
                <div class="alert error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                
                <div class="input-group">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan username" required autofocus maxlength="50">
                </div>
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> Masuk</button>
            </form>
            <div class="back-link">
                <a href="../index.php"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>