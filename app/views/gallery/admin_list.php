<?php
/**
 * Admin Gallery List View
 */
?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-images me-2 text-danger"></i>Quản Lý Thư Viện Ảnh</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="?page=gallery&manage=1&sub_action=add" class="btn btn-danger">
                <i class="fas fa-plus me-2"></i>Thêm Thư Viện Mới
            </a>
        </div>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th style="width: 25%">Tiêu Đề</th>
                        <th style="width: 15%">Danh Mục</th>
                        <th style="width: 15%">Số Ảnh</th>
                        <th style="width: 25%">Mô Tả</th>
                        <th style="width: 15%">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($galleries)): ?>
                        <?php foreach ($galleries as $gallery): ?>
                        <tr>
                            <td><?php echo $gallery['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($gallery['title']); ?></strong></td>
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($gallery['category']); ?></span></td>
                            <td><?php echo $gallery['image_count']; ?> ảnh</td>
                            <td><?php echo substr(htmlspecialchars($gallery['description']), 0, 50) . '...'; ?></td>
                            <td>
                                <a href="?page=gallery&manage=1&sub_action=edit&id=<?php echo $gallery['id']; ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=gallery&manage=1&sub_action=delete&id=<?php echo $gallery['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                Chưa có thư viện ảnh nào
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=gallery&manage=1&page_num=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>
