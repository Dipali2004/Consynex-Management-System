<?php
?>
<div class="row">
  <div class="col-md-6">
    <h3>Add Banner</h3>
    <?php if (!empty($msg)): ?><div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <input type="hidden" name="action" value="create">
      <div class="mb-2"><input class="form-control" name="title" placeholder="Title"></div>
      <div class="mb-2">
        <label>Banner Image</label>
        <input class="form-control" type="file" name="image" required>
        <small class="text-muted">Recommended size: 1920x1080px</small>
      </div>
      <div class="mb-2"><input class="form-control" name="link_url" placeholder="Link URL"></div>
      <div class="mb-2"><input class="form-control" name="sort_order" type="number" value="0"></div>
      <div class="mb-2">
        <select class="form-select" name="status">
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
      <button class="btn btn-primary">Add</button>
    </form>
  </div>
  <div class="col-md-6">
    <h3>Existing Banners</h3>
    <?php foreach ($list as $b): ?>
      <div class="card mb-2">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <div class="fw-bold"><?php echo htmlspecialchars($b['title']); ?></div>
              <div class="small text-muted"><?php echo htmlspecialchars($b['image_path']); ?></div>
            </div>
            <form method="post" class="d-flex">
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
              <input type="hidden" name="id" value="<?php echo (int)$b['id']; ?>">
              <input type="hidden" name="action" value="delete">
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

