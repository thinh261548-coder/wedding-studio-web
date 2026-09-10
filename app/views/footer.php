<?php
/**
 * Footer View
 */
?>
    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3"><i class="fas fa-ring text-danger me-2"></i><?php echo SITE_NAME; ?></h5>
                    <p>Cung cấp dịch vụ chụp ảnh và quay phim cưới chuyên nghiệp với chất lượng hàng đầu.</p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Liên Kết Nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="?page=home" class="text-white-50 text-decoration-none">Trang Chủ</a></li>
                        <li><a href="?page=packages" class="text-white-50 text-decoration-none">Gói Cưới</a></li>
                        <li><a href="?page=gallery" class="text-white-50 text-decoration-none">Thư Viện Ảnh</a></li>
                        <li><a href="?page=inquiry" class="text-white-50 text-decoration-none">Liên Hệ</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Thông Tin Liên Hệ</h5>
                    <p><i class="fas fa-map-marker-alt me-2 text-danger"></i>123 Đường XYZ, Hà Nội</p>
                    <p><i class="fas fa-phone me-2 text-danger"></i>0123 456 789</p>
                    <p><i class="fas fa-envelope me-2 text-danger"></i>info@weddingstudio.com</p>
                    <p><i class="fas fa-clock me-2 text-danger"></i>Mon - Sat: 9:00 - 18:00</p>
                </div>
            </div>
            <hr class="bg-white-50">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0">&copy; 2024 <?php echo SITE_NAME; ?>. Tất cả quyền được bảo lưu.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="<?php echo APP_URL; ?>/assets/js/script.js"></script>
</body>
</html>
