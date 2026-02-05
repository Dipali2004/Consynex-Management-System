<?php
?>
<div class="row">
  <div class="col-12">
    <h2>Courses</h2>
  </div>
  <?php foreach ($courses as $c): ?>
    <div class="col-md-4">
      <div class="card mb-3 h-100">
        <?php if (!empty($c['image_path'])): ?>
          <img src="<?php echo htmlspecialchars($c['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($c['name']); ?>">
        <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($c['name']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars(mb_strimwidth($c['description'], 0, 140, '...')); ?></p>
          <div class="d-flex justify-content-between">
            <div class="small text-muted">Duration: <?php echo htmlspecialchars((string)$c['duration']); ?></div>
            <div class="badge bg-primary-subtle text-primary"><?php echo htmlspecialchars((string)($c['level'] ?? '')); ?></div>
          </div>
          <div class="mt-3 d-flex gap-2">
            <a href="<?php echo $base; ?>/course/<?php echo urlencode($c['slug']); ?>" class="btn btn-primary">View Details</a>
            <a href="<?php echo $base; ?>/contact" class="btn btn-outline-secondary">Enroll Now</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
