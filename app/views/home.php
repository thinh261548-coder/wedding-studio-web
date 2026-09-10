<?php
/**
 * Home Page View
 */
?>

<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1200') center/cover; min-height: 600px; display: flex; align-items: center;">
    <div class="container text-white text-center">
        <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display';">Hôn Nhân Tuyệt Vời Của Bạn</h1>
        <p class="lead mb-4">Chúng tôi chuyên chụp những khoảnh khắc đẹp nhất của ngày cưới của bạn</p>
        <a href="?page=inquiry" class="btn btn-danger btn-lg"><i class="fas fa-heart me-2"></i>Yêu Cầu Dịch Vụ</a>
    </div>
</section>

<!-- Services Preview -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Playfair Display'; font-size: 2.5em;">Dịch Vụ Của Chúng Tôi</h2>
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-body">
                        <i class="fas fa-camera fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">Chụp Ảnh</h5>
                        <p class="card-text text-muted">Chụp ảnh chuyên nghiệp với thiết bị hiện đại</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-body">
                        <i class="fas fa-video fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">Quay Phim 4K</h5>
                        <p class="card-text text-muted">Video chất lượng 4K với chỉnh sửa chuyên nghiệp</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-body">
                        <i class="fas fa-cube fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">Drone</h5>
                        <p class="card-text text-muted">Hình ảnh từ trên không với độ phân giải cao</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-body">
                        <i class="fas fa-palette fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">Chỉnh Sửa</h5>
                        <p class="card-text text-muted">Chỉnh sửa chuyên nghiệp và tạo album ảnh</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Packages Preview -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Playfair Display'; font-size: 2.5em;">Các Gói Cưới</h2>
        <div class="row">
            <?php
                require_once APP_PATH . '/models/Package.php';
                $packageModel = new Package();
                $packages = $packageModel->getAll(3, 0);
                
                foreach ($packages as $package):
            ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 overflow-hidden">
                    <?php if ($package['image']): ?>
                        <img src="<?php echo $package['image']; ?>" class="card-img-top" alt="<?php echo $package['name']; ?>" style="height: 250px; object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-light" style="height: 250px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-gift fa-5x text-secondary"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($package['name']); ?></h5>
                        <p class="card-text text-muted small"><?php echo substr(htmlspecialchars($package['description']), 0, 100) . '...'; ?></p>
                        <div class="mb-3">
                            <span class="badge bg-danger"><?php echo $package['duration']; ?></span>
                        </div>
                        <h4 class="text-danger mb-3"><?php echo number_format($package['price'], 0, ',', '.'); ?> VNĐ</h4>
                        <a href="?page=packages" class="btn btn-outline-danger w-100">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="?page=packages" class="btn btn-danger btn-lg">Xem Tất Cả Gói Cưới</a>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Playfair Display'; font-size: 2.5em;">Thư Viện Ảnh</h2>
        <div class="row">
            <?php
                require_once APP_PATH . '/models/Gallery.php';
                $galleryModel = new Gallery();
                $galleries = $galleryModel->getAll(6, 0);
                
                foreach ($galleries as $gallery):
            ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="?page=gallery&action=detail&id=<?php echo $gallery['id']; ?>" class="card h-100 border-0 shadow-sm overflow-hidden text-decoration-none text-dark gallery-card">
                    <?php if ($gallery['thumb']): ?>
                        <img src="<?php echo $gallery['thumb']; ?>" class="card-img-top" alt="<?php echo $gallery['title']; ?>" style="height: 300px; object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-light" style="height: 300px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image fa-5x text-secondary"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($gallery['title']); ?></h5>
                        <p class="card-text text-muted small">
                            <i class="fas fa-images me-2"></i><?php echo $gallery['image_count']; ?> ảnh
                        </p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="?page=gallery" class="btn btn-danger btn-lg">Xem Tất Cả Ảnh</a>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Playfair Display'; font-size: 2.5em;">Cảm Nhận Của Khách Hàng</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text">"Nhóm chuyên gia của bạn đã tìm ra những khoảnh khắc tuyệt đẹp từ ngày cưới của chúng tôi. Chúng tôi rất hài lòng với công việc!"</p>
                        <h6 class="card-title">- Cô dâu An &amp; Chú rể Hà</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text">"Dịch vụ chuyên nghiệp và thân thiện. Đội ngũ rất nhanh nhạy và sáng tạo. Giá cả cũng hợp lý so với chất lượng."</p>
                        <h6 class="card-title">- Cô dâu Hương &amp; Chú rể Minh</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text">"Những bức ảnh cưới của chúng tôi tuyệt đẹp! Phim video cũng rất cảm động. Chúng tôi sẽ giới thiệu bạn cho bạn bè."</p>
                        <h6 class="card-title">- Cô dâu Linh &amp; Chú rể Tuấn</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
