<?php
/**
 * Authentication Controller
 */

class AuthController {
    private $userModel;

    public function __construct() {
        require_once APP_PATH . '/models/User.php';
        $this->userModel = new User();
    }

    public function login() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = 'Email và mật khẩu không được để trống';
            } else {
                $user = $this->userModel->findByEmail($email);
                
                if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['full_name'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_role'] = $user['role'] ?? 'user';
                    
                    header('Location: ?page=dashboard');
                    exit();
                } else {
                    $error = 'Email hoặc mật khẩu không chính xác';
                }
            }
        }

        require_once APP_PATH . '/views/auth/login.php';
    }

    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = trim($_POST['full_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirm_password = trim($_POST['confirm_password'] ?? '');

            // Validation
            if (empty($full_name) || empty($email) || empty($password)) {
                $error = 'Vui lòng điền đầy đủ các trường bắt buộc';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Email không hợp lệ';
            } elseif ($password !== $confirm_password) {
                $error = 'Mật khẩu xác nhận không khớp';
            } elseif (strlen($password) < 6) {
                $error = 'Mật khẩu phải có ít nhất 6 ký tự';
            } else {
                // Check if email already exists
                if ($this->userModel->findByEmail($email)) {
                    $error = 'Email này đã được đăng ký';
                } else {
                    $data = [
                        'full_name' => $full_name,
                        'email' => $email,
                        'phone' => $phone,
                        'password' => $password
                    ];

                    if ($this->userModel->register($data)) {
                        $success = 'Đăng ký thành công! Vui lòng đăng nhập.';
                    } else {
                        $error = 'Đăng ký thất bại. Vui lòng thử lại.';
                    }
                }
            }
        }

        require_once APP_PATH . '/views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ?page=home');
        exit();
    }
}
