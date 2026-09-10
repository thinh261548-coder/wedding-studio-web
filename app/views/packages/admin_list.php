<?php
/**
 * Admin Package List View
 */
?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-gift me-2 text-danger"></i>Quản Lý Gói Cưới</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="?page=packages&manage=1&sub_action=add" class="btn btn-danger">
                <i class="fas fa-plus me-2"></i>Thêm Gói Mới
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
                        <th style="width: 20%">Tên Gói</th>
                        <th style="width: 15%">Giá</th>
                        <th style="width: 15%">Thời Lượng</th>
                        <th style="width: 20%">Mô Tả</th>
                        <th style="width: 15%">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($packages)): ?>
                        <?php foreach ($packages as $package): ?>
                        <tr>
                            <td><?php echo $package['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($package['name']); ?></strong></td>
                            <td><span class="text-danger fw-bold"><?php echo number_format($package['price'], 0, ',', '.'); ?> VNĐ</span></td>
                            <td><?php echo htmlspecialchars($package['duration']); ?></td>
                            <td><?php echo substr(htmlspecialchars($package['description']), 0, 50) . '...'; ?></td>
                            <td>
                                <a href="?page=packages&manage=1&sub_action=edit&id=<?php echo $package['id']; ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="?page=packages&manage=1&sub_action=delete&id=<?php echo $package['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                Chưa có gói cưới nào
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
                    <a class="page-link" href="?page=packages&manage=1&page_num=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>
