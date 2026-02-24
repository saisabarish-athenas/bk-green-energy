<?php
// Database Configuration
// Update these values with your Hostinger credentials

define('DB_HOST', 'localhost');
define('DB_NAME', 'bk_green_energy');
define('DB_USER', 'root');  // Change to your Hostinger DB username
define('DB_PASS', '');      // Change to your Hostinger DB password
define('DB_CHARSET', 'utf8mb4');

// Create PDO connection
function getDB() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection error. Please contact support.");
        }
    }
    
    return $pdo;
}
