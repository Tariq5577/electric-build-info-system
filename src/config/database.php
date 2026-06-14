<?php
/**
 * Database Configuration
 * Modify these settings according to your environment
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'electric_build_info');

// Connection
try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// System Configuration
define('ELECTRICITY_RATE', 0.12); // $ per unit
define('DEFAULT_BUILDING', 'Southern Park-2');
define('DEFAULT_TOWERS', ['Tower A', 'Tower B', 'Tower C']);
define('FLATS_PER_TOWER', 45);

// Logging
define('LOG_DIR', __DIR__ . '/../../logs');

// Initialize logs directory
if (!is_dir(LOG_DIR)) {
    mkdir(LOG_DIR, 0755, true);
}
