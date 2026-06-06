<?php
   
// Security Headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
header("Content-Security-Policy: default-src 'self';script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://maps.googleapis.com https://*.gstatic.com;style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com; img-src 'self' data: https: https://*.googleapis.com https://*.gstatic.com *.google.com *.googleusercontent.com https://maps.gstatic.com https://maps.googleapis.com; font-src 'self' https://cdnjs.cloudflare.com https://fonts.gstatic.com; connect-src 'self' https://*.googleapis.com *.google.com https://*.gstatic.com data: blob: https://maps.googleapis.com; frame-src 'self' https://www.youtube.com https://youtube.com https://www.youtube-nocookie.com https://youtube-nocookie.com https://www.google.com/maps https://maps.google.com;media-src 'self' https:;");

// Pengaturan database
define('DB_HOST', 'localhost');
define('DB_NAME', 'hidroponik_db');
define('DB_USER', 'root');
define('DB_PASS', '');


// Path fisik folder upload (absolut)
define('UPLOAD_DIR', __DIR__ . '/../assets/images/uploads/');

// URL folder upload - dihitung otomatis berdasarkan posisi config.php
$docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/\\');
$currentDir = str_replace('\\', '/', __DIR__);   // .../includes
$baseDir = dirname($currentDir);                 // .../ (root website)
$relPath = str_replace($docRoot, '', $baseDir);  // '' atau '/hidroponik'
define('UPLOAD_URL', $relPath . '/assets/images/uploads/');

// Sesi aman
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0);
session_start();