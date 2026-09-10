<?php
/**
 * Admin Services Router
 */

require_once APP_PATH . '/controllers/ServiceController.php';
$controller = new ServiceController();
$controller->index();
