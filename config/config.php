<?php
// Base URL configuration - Auto detect if not set in environment
// Check for proxy-forwarded protocol (Vercel uses this)
$protocol = 'http://';
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $protocol = 'https://';
} elseif (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
    $protocol = 'https://';
}

$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$default_base = $protocol . $host . (strpos($host, 'localhost') !== false ? '/Aufa/public' : '');

define('BASEURL', getenv('BASEURL') ?: $default_base);

// Database configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'db_peminjaman_alat');
define('DB_PORT', getenv('DB_PORT') ?: '3306');

// Path constants
define('APPPATH', dirname(__DIR__) . '/app');
