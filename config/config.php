<?php
// Base URL configuration
define('BASEURL', getenv('BASEURL') ?: 'http://localhost/Aufa/public');

// Database configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'db_peminjaman_alat');
define('DB_PORT', getenv('DB_PORT') ?: '3306');

// Path constants
define('APPPATH', dirname(__DIR__) . '/app');
