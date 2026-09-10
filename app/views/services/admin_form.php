<?php
/**
 * Admin Services Form View
 */
$edit_mode = isset($service);
?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><?php echo $edit_mode ? 'Chỉnh Sửa Dịch Vụ' : 'Thêm Dịch Vụ Mới'; ?></h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="?page=services&manage=1" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Quay Lại
            </a>
        </div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" novalidate>
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Dịch Vụ *</label>
                    <input type="text" class="form-control" id="name" name="name" required value="<?php echo isset($service) ? htmlspecialchars($service['name']) : (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''); ?>">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô Tả Chi Tiết *</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required><?php echo isset($service) ? htmlspecialchars($service['description']) : (isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="icon" class="form-label">Icon (Font Awesome)</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="VD: camera, video, heart..." value="<?php echo isset($service) ? htmlspecialchars($service['icon']) : (isset($_POST['icon']) ? htmlspecialchars($_POST['icon']) : ''); ?>">
                        <small class="form-text text-muted">Xem danh sách: <a href="https://fontawesome.com/icons" target="_blank">Font Awesome Icons</a></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Giá (VNĐ)</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo isset($service) ? htmlspecialchars($service['price']) : (isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '0'); ?>">
                        <small class="form-text text-muted">Để trống hoặc 0 nếu giá phụ thuộc vào yêu cầu</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fas fa-save me-2"></i><?php echo $edit_mode ? 'Cập Nhật' : 'Thêm Mới'; ?>
                        </button>
                        <a href="?page=services&manage=1" class="btn btn-secondary btn-lg ms-2">
                            <i class="fas fa-times me-2"></i>Hủy
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
