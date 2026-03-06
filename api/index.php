<?php
// Vercel Entry Point - Direct Logic to avoid relative path confusion
if( !session_id() ) session_start();

// Using __DIR__ to ensure paths are always correct regardless of CWD
require_once __DIR__ . '/../app/init.php';

$app = new App;
