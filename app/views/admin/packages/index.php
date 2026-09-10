<?php
/**
 * Admin Packages Router
 */

require_once APP_PATH . '/controllers/PackageController.php';
$controller = new PackageController();
$controller->manage();
