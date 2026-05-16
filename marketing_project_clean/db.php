<?php
// Load credentials from config.php (which is git-ignored)
$config = __DIR__ . '/config.php';

if (!file_exists($config)) {
    die(
        '<b>Setup required:</b> Copy <code>config.example.php</code> to
         <code>config.php</code> and fill in your database credentials.'
    );
}

require_once $config;

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
