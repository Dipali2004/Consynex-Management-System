<?php
?>
<div class="row">
  <div class="col-md-4">
    <h3>Add Training Program</h3>
    <?php if (!empty($msg)): ?><div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <input type="hidden" name="action" value="create">
      <div class="mb-2"><input class="form-control" name="name" placeholder="Name" required></div>
      <div class="mb-2"><input class="form-control" name="slug" placeholder="Slug (optional)"></div>
      <div class="mb-2"><textarea class="form-control" name="description" placeholder="Description" rows="4"></textarea></div>
      <div class="mb-2">
        <select class="form-select" name="status">
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
      <button class="btn btn-primary">Add</button>
    </form>
  </div>
  <div class="col-md-8">
    <h3>Existing Training Programs</h3>
    <?php foreach ($list as $t): ?>
      <div class="card mb-3">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <div class="fw-bold"><?php echo htmlspecialchars($t['name']); ?></div>
              <div class="small text-muted">Slug: <?php echo htmlspecialchars($t['slug']); ?> | Status: <?php echo (int)$t['status'] ? 'Active' : 'Inactive'; ?></div>
            </div>
            <form method="post">
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
              <input type="hidden" name="id" value="<?php echo (int)$t['id']; ?>">
              <input type="hidden" name="action" value="delete">
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
          <form method="post" class="mt-3">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo (int)$t['id']; ?>">
            <div class="row g-2">
              <div class="col-md-4"><input class="form-control" name="name" value="<?php echo htmlspecialchars($t['name']); ?>"></div>
              <div class="col-md-4"><input class="form-control" name="slug" value="<?php echo htmlspecialchars($t['slug']); ?>"></div>
              <div class="col-md-12"><textarea class="form-control" name="description" rows="3"><?php echo htmlspecialchars($t['description']); ?></textarea></div>
              <div class="col-md-2">
                <select class="form-select" name="status">
                  <option value="1" <?php echo (int)$t['status'] ? 'selected' : ''; ?>>Active</option>
                  <option value="0" <?php echo !(int)$t['status'] ? 'selected' : ''; ?>>Inactive</option>
                </select>
              </div>
              <div class="col-md-2">
                <button class="btn btn-success">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

