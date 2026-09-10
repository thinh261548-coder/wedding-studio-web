<?php
/**
 * Application Configuration
 */

// Load environment variables from .env file
if (file_exists(BASE_PATH . '/.env')) {
    $env = parse_ini_file(BASE_PATH . '/.env');
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}

// Database Configuration
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'wedding_studio');
define('DB_PORT', $_ENV['DB_PORT'] ?? 3306);

// Application Configuration
define('APP_URL', $_ENV['APP_URL'] ?? 'http://localhost');
define('APP_ENV', $_ENV['APP_ENV'] ?? 'development');
define('APP_DEBUG', $_ENV['APP_DEBUG'] ?? false);

// Upload Settings
define('MAX_UPLOAD_SIZE', $_ENV['MAX_UPLOAD_SIZE'] ?? 5242880); // 5MB
define('ALLOWED_EXTENSIONS', explode(',', $_ENV['ALLOWED_EXTENSIONS'] ?? 'jpg,jpeg,png,gif'));
define('UPLOAD_DIR', PUBLIC_PATH . '/uploads/');

// Pagination
define('ITEMS_PER_PAGE', 12);

// Site settings
define('SITE_NAME', 'Wedding Studio');
define('SITE_DESCRIPTION', 'Professional Wedding Photography & Videography');
