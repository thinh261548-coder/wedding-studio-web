<?php
/**
 * Admin Settings View
 */
?>

<div class="container-fluid py-4">
    <h2 class="mb-4"><i class="fas fa-cog me-2 text-danger"></i>Cài Đặt</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-globe me-2"></i>Thông Tin Trang Web</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="site_name" class="form-label">Tên Trang Web</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo SITE_NAME; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="site_description" class="form-label">Mô Tả Trang Web</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3"><?php echo SITE_DESCRIPTION; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-save me-2"></i>Lưu Cài Đặt
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Thông Tin Liên Hệ</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số Điện Thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="0123 456 789">
                        </div>

                        <div class="mb-3">
                            <label for="email_contact" class="form-label">Email Liên Hệ</label>
                            <input type="email" class="form-control" id="email_contact" name="email_contact" value="info@weddingstudio.com">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label"Địa Chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="123 Đường XYZ, Hà Nội">
                        </div>

                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-save me-2"></i>Lưu Cài Đặt
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-database me-2"></i>Dự Liệu</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Nhật ký và tập chí hệ thống</p>
                    <a href="#" class="btn btn-sm btn-outline-secondary mb-2">
                        <i class="fas fa-download me-2"></i>Sao Lưu Dự Liệu
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-history me-2"></i>Xem Nhật Ký
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông Tin Hệ Thống</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Phiên Bản:</strong> 1.0.0</p>
                    <p class="mb-2"><strong>PHP:</strong> <?php echo phpversion(); ?></p>
                    <p class="mb-2"><strong>MySQL:</strong> 5.7+</p>
                    <p class="mb-0"><strong>Máy Chủ:</strong> <?php echo php_uname(); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
