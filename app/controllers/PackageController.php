<?php
/**
 * Package Controller
 */

class PackageController {
    private $packageModel;
    private $action;

    public function __construct() {
        require_once APP_PATH . '/models/Package.php';
        $this->packageModel = new Package();
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'index';
    }

    public function index() {
        // Check if user is admin
        if (isset($_GET['manage']) && $this->isAdmin()) {
            $this->manage();
            return;
        }

        $page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        $offset = ($page - 1) * ITEMS_PER_PAGE;
        
        $packages = $this->packageModel->getAll(ITEMS_PER_PAGE, $offset);
        $total = $this->packageModel->getTotalCount();
        $total_pages = ceil($total / ITEMS_PER_PAGE);

        require_once APP_PATH . '/views/packages/list.php';
    }

    public function manage() {
        $action = isset($_GET['sub_action']) ? $_GET['sub_action'] : 'list';

        switch ($action) {
            case 'add':
                $this->add();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->adminList();
        }
    }

    private function adminList() {
        $page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        $offset = ($page - 1) * 10;
        
        $packages = $this->packageModel->getAll(10, $offset);
        $total = $this->packageModel->getTotalCount();
        $total_pages = ceil($total / 10);

        require_once APP_PATH . '/views/packages/admin_list.php';
    }

    private function add() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = $this->validatePackageData($_POST);

            if (empty($error)) {
                $data = [
                    'name' => trim($_POST['name']),
                    'description' => trim($_POST['description']),
                    'price' => (float)$_POST['price'],
                    'duration' => trim($_POST['duration']),
                    'features' => trim($_POST['features']),
                    'image' => $this->uploadImage($_FILES['image'] ?? null)
                ];

                if ($data['image'] || !isset($_FILES['image'])) {
                    if ($this->packageModel->create($data)) {
                        $success = 'Gói cưới được thêm thành công!';
                        $_POST = [];
                    } else {
                        $error = 'Lỗi khi thêm gói cưới';
                    }
                }
            }
        }

        require_once APP_PATH . '/views/packages/admin_form.php';
    }

    private function edit() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $package = $this->packageModel->getById($id);

        if (!$package) {
            $_SESSION['error'] = 'Gói cưới không tồn tại';
            header('Location: ?page=packages&manage=1');
            exit();
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = $this->validatePackageData($_POST);

            if (empty($error)) {
                $data = [
                    'name' => trim($_POST['name']),
                    'description' => trim($_POST['description']),
                    'price' => (float)$_POST['price'],
                    'duration' => trim($_POST['duration']),
                    'features' => trim($_POST['features']),
                    'image' => $package['image']
                ];

                if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                    $new_image = $this->uploadImage($_FILES['image']);
                    if ($new_image) {
                        $data['image'] = $new_image;
                    }
                }

                if ($this->packageModel->update($id, $data)) {
                    $success = 'Gói cưới được cập nhật thành công!';
                    $package = $this->packageModel->getById($id);
                } else {
                    $error = 'Lỗi khi cập nhật gói cưới';
                }
            }
        }

        require_once APP_PATH . '/views/packages/admin_form.php';
    }

    private function delete() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($this->packageModel->delete($id)) {
            $_SESSION['success'] = 'Gói cưới được xóa thành công!';
        } else {
            $_SESSION['error'] = 'Lỗi khi xóa gói cưới';
        }

        header('Location: ?page=packages&manage=1');
        exit();
    }

    private function validatePackageData($data) {
        if (empty($data['name'] ?? '')) return 'Tên gói không được để trống';
        if (empty($data['description'] ?? '')) return 'Mô tả không được để trống';
        if (empty($data['price'] ?? '') || !is_numeric($data['price'])) return 'Giá tiền không hợp lệ';
        if (empty($data['duration'] ?? '')) return 'Thời lượng không được để trống';
        
        return '';
    }

    private function uploadImage($file) {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ALLOWED_EXTENSIONS)) {
            return null;
        }

        if ($file['size'] > MAX_UPLOAD_SIZE) {
            return null;
        }

        if (!is_dir(UPLOAD_DIR)) {
            mkdir(UPLOAD_DIR, 0755, true);
        }

        $filename = 'package_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        $filepath = UPLOAD_DIR . $filename;

        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return '/uploads/' . $filename;
        }

        return null;
    }

    private function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
}
