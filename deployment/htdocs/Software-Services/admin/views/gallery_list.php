<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Gallery Management</h2>
    <a href="gallery.php?action=add" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Image</a>
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

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">S.No</th>
                        <th width="15%">Image</th>
                        <th width="25%">Title</th>
                        <th width="20%">Category</th>
                        <th width="10%">Status</th>
                        <th width="25%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($gallery_items) > 0): ?>
                        <?php $i = 1; foreach ($gallery_items as $item): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td>
                                    <?php if (!empty($item['image_path'])): ?>
                                        <img src="../<?php echo htmlspecialchars($item['image_path']); ?>" alt="Gallery" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="text-muted"><i class="fa-solid fa-image"></i></span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-bold"><?php echo htmlspecialchars($item['title'] ?? 'N/A'); ?></td>
                                <td><span class="badge bg-secondary"><?php echo htmlspecialchars($item['category']); ?></span></td>
                                <td>
                                    <?php if ($item['status'] == 1): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="gallery.php?action=edit&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="gallery.php?action=delete&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-danger me-1" onclick="return confirm('Are you sure you want to delete this image?');" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    <?php if ($item['status'] == 1): ?>
                                        <a href="gallery.php?action=toggle_status&id=<?php echo $item['id']; ?>&status=0" class="btn btn-sm btn-warning" title="Disable">
                                            <i class="fa-solid fa-ban"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="gallery.php?action=toggle_status&id=<?php echo $item['id']; ?>&status=1" class="btn btn-sm btn-success" title="Enable">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No images found in gallery.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
