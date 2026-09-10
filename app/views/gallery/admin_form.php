<?php
/**
 * Admin Gallery Form View
 */
$edit_mode = isset($gallery);
?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><?php echo $edit_mode ? 'Chỉnh Sửa Thư Viện Ảnh' : 'Thêm Thư Viện Ảnh Mới'; ?></h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="?page=gallery&manage=1" class="btn btn-secondary">
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
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu Đề *</label>
                    <input type="text" class="form-control" id="title" name="title" required value="<?php echo isset($gallery) ? htmlspecialchars($gallery['title']) : (isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''); ?>">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô Tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo isset($gallery) ? htmlspecialchars($gallery['description']) : (isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Danh Mục *</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">-- Chọn danh mục --</option>
                        <option value="wedding" <?php echo (isset($gallery) && $gallery['category'] === 'wedding') ? 'selected' : ''; ?>>Lễ Cưới</option>
                        <option value="reception" <?php echo (isset($gallery) && $gallery['category'] === 'reception') ? 'selected' : ''; ?>>Tiệc Cưới</option>
                        <option value="pre-wedding" <?php echo (isset($gallery) && $gallery['category'] === 'pre-wedding') ? 'selected' : ''; ?>>Pre-Wedding</option>
                        <option value="other" <?php echo (isset($gallery) && $gallery['category'] === 'other') ? 'selected' : ''; ?>>Khác</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Hình Ảnh (chọn nhiều)</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                    <small class="form-text text-muted">Định dạng: JPG, PNG, GIF (Tối đa 5MB mỗi file)</small>
                </div>

                <?php if ($edit_mode && !empty($images)): ?>
                <div class="mb-3">
                    <label class="form-label">Hình Ảnh Hiện Tại</label>
                    <div class="row">
                        <?php foreach ($images as $image): ?>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <img src="<?php echo $image['image_path']; ?>" class="card-img-top" alt="Gallery image" style="height: 150px; object-fit: cover;">
                                <div class="card-body p-2">
                                    <a href="?page=gallery&manage=1&sub_action=edit&id=<?php echo $gallery['id']; ?>&delete_image=<?php echo $image['id']; ?>" class="btn btn-sm btn-danger w-100" onclick="return confirm('Xóa ảnh này?');">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fas fa-save me-2"></i><?php echo $edit_mode ? 'Cập Nhật' : 'Thêm Mới'; ?>
                        </button>
                        <a href="?page=gallery&manage=1" class="btn btn-secondary btn-lg ms-2">
                            <i class="fas fa-times me-2"></i>Hủy
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
