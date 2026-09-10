<?php
/**
 * Dashboard Controller
 */

class DashboardController {
    public function index() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=auth&action=login');
            exit();
        }

        require_once APP_PATH . '/models/User.php';
        require_once APP_PATH . '/models/Inquiry.php';

        $userModel = new User();
        $inquiryModel = new Inquiry();

        $user = $userModel->findById($_SESSION['user_id']);
        $inquiries = $inquiryModel->getByUserId($_SESSION['user_id'], 10, 0);
        $inquiry_count = count($inquiries);

        require_once APP_PATH . '/views/dashboard/index.php';
    }
}
