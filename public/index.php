<?php
/**
 * Wedding Studio - Main Entry Point
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define base paths
define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_PATH', BASE_PATH . '/app');
define('PUBLIC_PATH', BASE_PATH . '/public');

// Load configuration
require_once APP_PATH . '/config/config.php';
require_once APP_PATH . '/config/Database.php';

// Start session
session_start();

// Simple routing
$page = isset($_GET['page']) ? trim($_GET['page']) : 'home';
$action = isset($_GET['action']) ? trim($_GET['action']) : 'index';

// Include header
require_once APP_PATH . '/views/header.php';

// Route to appropriate controller/view
switch ($page) {
    case 'home':
        require_once APP_PATH . '/views/home.php';
        break;
    case 'packages':
        require_once APP_PATH . '/controllers/PackageController.php';
        $controller = new PackageController();
        $controller->index();
        break;
    case 'gallery':
        require_once APP_PATH . '/controllers/GalleryController.php';
        $controller = new GalleryController();
        $controller->index();
        break;
    case 'services':
        require_once APP_PATH . '/controllers/ServiceController.php';
        $controller = new ServiceController();
        $controller->index();
        break;
    case 'inquiry':
        require_once APP_PATH . '/controllers/InquiryController.php';
        $controller = new InquiryController();
        if ($action === 'submit') {
            $controller->submit();
        } else {
            $controller->form();
        }
        break;
    case 'auth':
        require_once APP_PATH . '/controllers/AuthController.php';
        $controller = new AuthController();
        if ($action === 'login') {
            $controller->login();
        } elseif ($action === 'register') {
            $controller->register();
        } elseif ($action === 'logout') {
            $controller->logout();
        }
        break;
    case 'dashboard':
        require_once APP_PATH . '/controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
    default:
        require_once APP_PATH . '/views/home.php';
}

// Include footer
require_once APP_PATH . '/views/footer.php';
