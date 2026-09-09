<?php

require_once __DIR__ . '/env.php';

// Load environment variables from the project root
loadEnv(__DIR__ . '/../.env');

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$database = getenv('DB_NAME') ?: 'smth_epr';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Database connection unavailable.");
}