<?php
/**
 * Service Controller
 */

class ServiceController {
    private $serviceModel;

    public function __construct() {
        require_once APP_PATH . '/models/Service.php';
        $this->serviceModel = new Service();
    }

    public function index() {
        if (isset($_GET['manage']) && $this->isAdmin()) {
            $this->manage();
            return;
        }

        $services = $this->serviceModel->getAll();
        require_once APP_PATH . '/views/services/list.php';
    }

    private function manage() {
        $sub_action = isset($_GET['sub_action']) ? $_GET['sub_action'] : 'list';

        switch ($sub_action) {
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
        
        $services = $this->serviceModel->getAll(10, $offset);
        $total = $this->serviceModel->getTotalCount();
        $total_pages = ceil($total / 10);

        require_once APP_PATH . '/views/services/admin_list.php';
    }

    private function add() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $icon = trim($_POST['icon'] ?? '');
            $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;

            if (empty($name)) {
                $error = 'Tên dịch vụ không được để trống';
            } elseif (empty($description)) {
                $error = 'Mô tả không được để trống';
            } else {
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'icon' => $icon,
                    'price' => $price
                ];

                if ($this->serviceModel->create($data)) {
                    $success = 'Dịch vụ được thêm thành công!';
                    $_POST = [];
                } else {
                    $error = 'Lỗi khi thêm dịch vụ';
                }
            }
        }

        require_once APP_PATH . '/views/services/admin_form.php';
    }

    private function edit() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $service = $this->serviceModel->getById($id);

        if (!$service) {
            $_SESSION['error'] = 'Dịch vụ không tồn tại';
            header('Location: ?page=services&manage=1');
            exit();
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $icon = trim($_POST['icon'] ?? '');
            $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;

            if (empty($name)) {
                $error = 'Tên dịch vụ không được để trống';
            } elseif (empty($description)) {
                $error = 'Mô tả không được để trống';
            } else {
                $data = [
                    'name' => $name,
                    'description' => $description,
                    'icon' => $icon,
                    'price' => $price
                ];

                if ($this->serviceModel->update($id, $data)) {
                    $success = 'Dịch vụ được cập nhật thành công!';
                    $service = $this->serviceModel->getById($id);
                } else {
                    $error = 'Lỗi khi cập nhật dịch vụ';
                }
            }
        }

        require_once APP_PATH . '/views/services/admin_form.php';
    }

    private function delete() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($this->serviceModel->delete($id)) {
            $_SESSION['success'] = 'Dịch vụ được xóa thành công!';
        } else {
            $_SESSION['error'] = 'Lỗi khi xóa dịch vụ';
        }

        header('Location: ?page=services&manage=1');
        exit();
    }

    private function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
}
