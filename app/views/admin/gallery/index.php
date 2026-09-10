<?php
/**
 * Admin Gallery Router
 */

require_once APP_PATH . '/controllers/GalleryController.php';
$controller = new GalleryController();
$controller->index();
