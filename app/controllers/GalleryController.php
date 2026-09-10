<?php
/**
 * Gallery Controller
 */

class GalleryController {
    private $galleryModel;

    public function __construct() {
        require_once APP_PATH . '/models/Gallery.php';
        $this->galleryModel = new Gallery();
    }

    public function index() {
        if (isset($_GET['manage']) && $this->isAdmin()) {
            $this->manage();
            return;
        }

        $action = isset($_GET['action']) ? $_GET['action'] : 'view';

        if ($action === 'detail' && isset($_GET['id'])) {
            $this->detail();
        } else {
            $this->view();
        }
    }

    private function view() {
        $page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        $offset = ($page - 1) * ITEMS_PER_PAGE;
        
        $galleries = $this->galleryModel->getAll(ITEMS_PER_PAGE, $offset);
        $total = $this->galleryModel->getTotalCount();
        $total_pages = ceil($total / ITEMS_PER_PAGE);

        require_once APP_PATH . '/views/gallery/list.php';
    }

    private function detail() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $gallery = $this->galleryModel->getById($id);

        if (!$gallery) {
            require_once APP_PATH . '/views/404.php';
            return;
        }

        $images = $this->galleryModel->getImages($id);
        require_once APP_PATH . '/views/gallery/detail.php';
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
        
        $galleries = $this->galleryModel->getAll(10, $offset);
        $total = $this->galleryModel->getTotalCount();
        $total_pages = ceil($total / 10);

        require_once APP_PATH . '/views/gallery/admin_list.php';
    }

    private function add() {
        $error = '';
        $success = '';
        $gallery = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $category = trim($_POST['category'] ?? '');

            if (empty($title)) {
                $error = 'Tiêu đề không được để trống';
            } elseif (empty($category)) {
                $error = 'Danh mục không được để trống';
            } else {
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'category' => $category
                ];

                $gallery_id = $this->galleryModel->create($data);

                if ($gallery_id) {
                    // Handle multiple image uploads
                    if (isset($_FILES['images'])) {
                        $this->uploadMultipleImages($gallery_id, $_FILES['images']);
                    }
                    $success = 'Thư viện hình ảnh được tạo thành công!';
                    $_POST = [];
                } else {
                    $error = 'Lỗi khi tạo thư viện';
                }
            }
        }

        require_once APP_PATH . '/views/gallery/admin_form.php';
    }

    private function edit() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $gallery = $this->galleryModel->getById($id);

        if (!$gallery) {
            $_SESSION['error'] = 'Thư viện không tồn tại';
            header('Location: ?page=gallery&manage=1');
            exit();
        }

        $images = $this->galleryModel->getImages($id);
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $category = trim($_POST['category'] ?? '');

            if (empty($title)) {
                $error = 'Tiêu đề không được để trống';
            } else {
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'category' => $category
                ];

                if ($this->galleryModel->update($id, $data)) {
                    // Handle new image uploads
                    if (isset($_FILES['images']) && $_FILES['images']['error'][0] !== UPLOAD_ERR_NO_FILE) {
                        $this->uploadMultipleImages($id, $_FILES['images']);
                    }
                    $success = 'Thư viện được cập nhật thành công!';
                    $images = $this->galleryModel->getImages($id);
                } else {
                    $error = 'Lỗi khi cập nhật thư viện';
                }
            }
        }

        require_once APP_PATH . '/views/gallery/admin_form.php';
    }

    private function delete() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($this->galleryModel->delete($id)) {
            $_SESSION['success'] = 'Thư viện được xóa thành công!';
        } else {
            $_SESSION['error'] = 'Lỗi khi xóa thư viện';
        }

        header('Location: ?page=gallery&manage=1');
        exit();
    }

    private function uploadMultipleImages($gallery_id, $files) {
        if (!isset($files['name']) || !is_array($files['name'])) {
            return;
        }

        $count = count($files['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }

            $ext = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
            if (!in_array($ext, ALLOWED_EXTENSIONS)) {
                continue;
            }

            if ($files['size'][$i] > MAX_UPLOAD_SIZE) {
                continue;
            }

            if (!is_dir(UPLOAD_DIR)) {
                mkdir(UPLOAD_DIR, 0755, true);
            }

            $filename = 'gallery_' . time() . '_' . $i . '.' . $ext;
            $filepath = UPLOAD_DIR . $filename;

            if (move_uploaded_file($files['tmp_name'][$i], $filepath)) {
                $this->galleryModel->addImage($gallery_id, '/uploads/' . $filename);
            }
        }
    }

    private function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
}
