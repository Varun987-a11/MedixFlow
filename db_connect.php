<?php
/**
 * Secure Database Connection for Appointment Scheduler
 * 
 * This file connects to the MySQL database using environment variables.
 * No credentials are hardcoded, keeping it safe for public repositories.
 */

if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = array_map('trim', explode('=', $line, 2));
        $_ENV[$name] = $value;
    }
}

$host = $_ENV['DB_HOST'] ?? 'localhost';
$username = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASS'] ?? '';
$database = $_ENV['DB_NAME'] ?? 'appointment_scheduler';

$conn = @new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed. Please check your .env file settings.");
}
?>
