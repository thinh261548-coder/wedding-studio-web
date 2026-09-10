<?php
/**
 * Inquiry Controller
 */

class InquiryController {
    private $inquiryModel;

    public function __construct() {
        require_once APP_PATH . '/models/Inquiry.php';
        $this->inquiryModel = new Inquiry();
    }

    public function form() {
        require_once APP_PATH . '/views/inquiry/form.php';
    }

    public function submit() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = trim($_POST['full_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $service_type = trim($_POST['service_type'] ?? '');
            $event_date = trim($_POST['event_date'] ?? '');
            $message = trim($_POST['message'] ?? '');

            // Validation
            if (empty($full_name) || empty($email) || empty($phone)) {
                $error = 'Vui lòng điền đầy đủ các trường bắt buộc';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Email không hợp lệ';
            } else {
                $data = [
                    'user_id' => $_SESSION['user_id'] ?? null,
                    'full_name' => $full_name,
                    'email' => $email,
                    'phone' => $phone,
                    'service_type' => $service_type,
                    'event_date' => $event_date,
                    'message' => $message
                ];

                if ($this->inquiryModel->create($data)) {
                    $success = 'Yêu cầu của bạn được gửi thành công! Chúng tôi sẽ liên hệ với bạn sớm.';
                } else {
                    $error = 'Lỗi khi gửi yêu cầu. Vui lòng thử lại.';
                }
            }
        }

        require_once APP_PATH . '/views/inquiry/form.php';
    }
}
