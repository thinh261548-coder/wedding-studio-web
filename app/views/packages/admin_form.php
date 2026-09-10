<?php
/**
 * Admin Package Form View
 */
$edit_mode = isset($package);
?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><?php echo $edit_mode ? 'Chỉnh Sửa Gói Cưới' : 'Thêm Gói Cưới Mới'; ?></h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="?page=packages&manage=1" class="btn btn-secondary">
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
            <form method="POST" enctype="multipart/form-data" novalidate>
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Gói *</label>
                            <input type="text" class="form-control" id="name" name="name" required value="<?php echo isset($package) ? htmlspecialchars($package['name']) : (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả Chi Tiết *</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required><?php echo isset($package) ? htmlspecialchars($package['description']) : (isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Giá (VNĐ) *</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required value="<?php echo isset($package) ? htmlspecialchars($package['price']) : (isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''); ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Thời Lượng *</label>
                                <input type="text" class="form-control" id="duration" name="duration" required value="<?php echo isset($package) ? htmlspecialchars($package['duration']) : (isset($_POST['duration']) ? htmlspecialchars($_POST['duration']) : ''); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="features" class="form-label">Các Tính Năng (cách nhau bằng dấu phẩy)</label>
                            <textarea class="form-control" id="features" name="features" rows="3" placeholder="VD: Chụp ảnh toàn bộ lễ, Album cứng, 100 ảnh đẹp nhất..."><?php echo isset($package) ? htmlspecialchars($package['features']) : (isset($_POST['features']) ? htmlspecialchars($_POST['features']) : ''); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình Ảnh <?php echo !$edit_mode ? '*' : ''; ?></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" <?php echo !$edit_mode ? 'required' : ''; ?>>
                            <small class="form-text text-muted">Định dạng: JPG, PNG, GIF (Tối đa 5MB)</small>
                            <?php if (isset($package) && $package['image']): ?>
                                <div class="mt-3">
                                    <p class="small text-muted">Hình ảnh hiện tại:</p>
                                    <img src="<?php echo $package['image']; ?>" alt="Package image" style="max-width: 100%; max-height: 200px;" class="img-thumbnail">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fas fa-save me-2"></i><?php echo $edit_mode ? 'Cập Nhật' : 'Thêm Mới'; ?>
                        </button>
                        <a href="?page=packages&manage=1" class="btn btn-secondary btn-lg ms-2">
                            <i class="fas fa-times me-2"></i>Hủy
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
