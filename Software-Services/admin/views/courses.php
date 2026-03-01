<?php
?>
<div class="row">
  <div class="col-md-4">
    <h3>Add Course</h3>
    <?php if (!empty($msg)): ?><div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <input type="hidden" name="action" value="create">
      <div class="mb-2"><input class="form-control" name="name" placeholder="Name" required></div>
      <div class="mb-2"><input class="form-control" name="slug" placeholder="Slug (optional)"></div>
      <div class="mb-2"><input class="form-control" name="duration" placeholder="Duration"></div>
      <div class="mb-2">
        <select class="form-select" name="level">
          <option value="">Select Level</option>
          <option value="Beginner">Beginner</option>
          <option value="Intermediate">Intermediate</option>
          <option value="Advanced">Advanced</option>
        </select>
      </div>
      <div class="mb-2">
        <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
      </div>
      <div class="mb-2"><input class="form-control" name="fees" placeholder="Fees"></div>
      <div class="mb-2"><textarea class="form-control" name="description" placeholder="Description" rows="4"></textarea></div>
      <div class="mb-2">
        <select class="form-select" name="status">
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
      <div class="mb-2">
        <select class="form-select" name="featured">
          <option value="0">Not Featured</option>
          <option value="1">Featured</option>
        </select>
      </div>
      <button class="btn btn-primary">Add</button>
    </form>
  </div>
  <div class="col-md-8">
    <h3>Existing Courses</h3>
    <?php foreach ($list as $c): ?>
      <div class="card mb-3">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <div class="fw-bold"><?php echo htmlspecialchars($c['name']); ?></div>
              <div class="small text-muted">Slug: <?php echo htmlspecialchars($c['slug']); ?> | Duration: <?php echo htmlspecialchars((string)$c['duration']); ?> | Level: <?php echo htmlspecialchars((string)($c['level'] ?? '')); ?> | Fees: <?php echo htmlspecialchars((string)$c['fees']); ?> | Status: <?php echo (int)$c['status'] ? 'Active' : 'Inactive'; ?> | Featured: <?php echo (int)$c['featured'] ? 'Yes' : 'No'; ?></div>
              <?php if (!empty($c['image_path'])): ?>
                <div class="mt-2"><img src="<?php echo htmlspecialchars($c['image_path']); ?>" alt="" style="max-height:80px;width:auto"></div>
              <?php endif; ?>
            </div>
            <form method="post">
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
              <input type="hidden" name="id" value="<?php echo (int)$c['id']; ?>">
              <input type="hidden" name="action" value="delete">
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
          <form method="post" class="mt-3" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo (int)$c['id']; ?>">
            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars((string)($c['image_path'] ?? '')); ?>">
            <div class="row g-2">
              <div class="col-md-3"><input class="form-control" name="name" value="<?php echo htmlspecialchars($c['name']); ?>"></div>
              <div class="col-md-3"><input class="form-control" name="slug" value="<?php echo htmlspecialchars($c['slug']); ?>"></div>
              <div class="col-md-2"><input class="form-control" name="duration" value="<?php echo htmlspecialchars((string)$c['duration']); ?>"></div>
              <div class="col-md-2">
                <select class="form-select" name="level">
                  <option value="">Select Level</option>
                  <option value="Beginner" <?php echo ($c['level'] ?? '')==='Beginner' ? 'selected' : ''; ?>>Beginner</option>
                  <option value="Intermediate" <?php echo ($c['level'] ?? '')==='Intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                  <option value="Advanced" <?php echo ($c['level'] ?? '')==='Advanced' ? 'selected' : ''; ?>>Advanced</option>
                </select>
              </div>
              <div class="col-md-3"><input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.webp"></div>
              <div class="col-md-2"><input class="form-control" name="fees" value="<?php echo htmlspecialchars((string)$c['fees']); ?>"></div>
              <div class="col-md-12"><textarea class="form-control" name="description" rows="3"><?php echo htmlspecialchars($c['description']); ?></textarea></div>
              <div class="col-md-2">
                <select class="form-select" name="status">
                  <option value="1" <?php echo (int)$c['status'] ? 'selected' : ''; ?>>Active</option>
                  <option value="0" <?php echo !(int)$c['status'] ? 'selected' : ''; ?>>Inactive</option>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-select" name="featured">
                  <option value="0" <?php echo !(int)$c['featured'] ? 'selected' : ''; ?>>Not Featured</option>
                  <option value="1" <?php echo (int)$c['featured'] ? 'selected' : ''; ?>>Featured</option>
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
