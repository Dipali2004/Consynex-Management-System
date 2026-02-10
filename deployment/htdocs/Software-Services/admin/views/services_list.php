<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Services Management</h2>
    <a href="services.php?action=add" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Service</a>
</div>

<?php if (!empty($msg)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($msg); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card-modern">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Icon</th>
                    <th>Service Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($services) > 0): ?>
                    <?php foreach ($services as $srv): ?>
                        <tr>
                            <td class="ps-4">
                                <?php if (!empty($srv['icon'])): ?>
                                    <i class="<?php echo htmlspecialchars($srv['icon']); ?> fs-5 text-primary"></i>
                                <?php else: ?>
                                    <i class="fa-solid fa-cube fs-5 text-muted"></i>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-medium"><?php echo htmlspecialchars($srv['service_name']); ?></div>
                                <small class="text-muted text-truncate d-inline-block" style="max-width: 250px;">
                                    <?php echo htmlspecialchars($srv['description'] ?? ''); ?>
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?php echo htmlspecialchars($srv['category']); ?>
                                </span>
                            </td>
                            <td>
                                <form method="post" action="services.php" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $srv['id']; ?>">
                                    <input type="hidden" name="current_status" value="<?php echo $srv['status']; ?>">
                                    <input type="hidden" name="toggle_status" value="1">
                                    <button type="submit" class="btn btn-sm <?php echo $srv['status'] ? 'btn-success-soft text-success' : 'btn-secondary-soft text-secondary'; ?> border-0" style="width: 80px;">
                                        <?php echo $srv['status'] ? 'Active' : 'Inactive'; ?>
                                    </button>
                                </form>
                            </td>
                            <td class="text-end pe-4">
                                <a href="services.php?action=edit&id=<?php echo $srv['id']; ?>" class="btn btn-sm btn-icon btn-light text-primary me-1" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="post" action="services.php" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    <input type="hidden" name="id" value="<?php echo $srv['id']; ?>">
                                    <input type="hidden" name="delete_service" value="1">
                                    <button type="submit" class="btn btn-sm btn-icon btn-light text-danger" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No services found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
